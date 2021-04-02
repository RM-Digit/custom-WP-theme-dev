<?php


/* Failed Login Attempts */
add_action('init', 'quest_add_action_to_init_hook');

function quest_add_action_to_init_hook()
{
	quest_exclude_from_search();
	//quest_id_address_gate();
}

function quest_exclude_from_search()
{
	global $wp_post_types;
	$wp_post_types['attachment']->exclude_from_search = true;
}

// Validate the accessible wp-admin
function quest_id_address_gate()
{
	// Deny and allow IP address that can access wp-admin
	$deny_list = get_ip_denied_list();
	$allowed_list = get_ip_allowed_list();

	$client_id = get_client_ip();

	$isAllowAdmin = ($client_id == '127.0.0.1') || quest_is_existing_list($allowed_list, $client_id);
	$is_denied = !($client_id == '127.0.0.1') && quest_is_existing_list($deny_list, $client_id);

	if (!$isAllowAdmin && $is_denied) {
		status_header(403);
		get_template_part(403);
		exit();
	}

}

add_action( 'wp_login_failed', function( $username ) {
	$client_id = get_client_ip();
	$allowed_list = get_ip_allowed_list();

	$isAllowAdmin = ($client_id == '127.0.0.1') || quest_is_existing_list($allowed_list, $client_id);

	// IP is included in allow list won't be verified
	if ($isAllowAdmin) return;

	$is_banned = false;
	$attempted_ips = get_failed_login_attempts_ips();

	if (!empty($attempted_ips[$client_id]) && $attempted_ips[$client_id] < 3) {
		$attempted_ips[$client_id]++;
		$attempts_remaining =  3 - $attempted_ips[$client_id];

		if ($attempted_ips[$client_id] == 3) {
			$updated_denylist = $client_id . "\n" . get_option('quest_ip_deny_list');
			update_option('quest_ip_deny_list', $updated_denylist);
			$is_banned = true;
			$errors_message = get_failed_attemps_error_messages('', true);

			// Send email alert
			$email_content = get_email_alert_template($client_id, $username);
			$email_header = array('Content-Type: text/html; charset=UTF-8');
			$email_status = wp_mail(get_bloginfo('admin_email'), "Quest Failed Login Attempts Alerting", $email_content, $email_header);

			if (!$email_status || true) {
				try {
					$log_content = date('Y-m-d H:i:s') . " - IP: {$client_id} - User Name: {$username} \n";
					file_put_contents(FAILED_LOGIN_ATTEMPTS_LOGS_PATH, $log_content, FILE_APPEND);
				} catch (Exception $exception) {

				}
			}
			// Log to file if sending email is failed
		} else {
			$errors_message = get_failed_attemps_error_messages($attempts_remaining);
		}
	} else {
		$attempted_ips[$client_id] = 1;
		$attempts_remaining =  3 - $attempted_ips[$client_id];
		$errors_message = get_failed_attemps_error_messages($attempts_remaining);
	}

	update_option('quest_failed_login_attempts_ips', $attempted_ips);

	add_filter('login_errors', function($errors) use ($errors_message, $is_banned) {
		if (!empty($is_banned)) {
			return $errors_message;
		}
		return $errors . $errors_message;
	});

});

add_action('wp_login', function () {
	$client_id = get_client_ip();
	$attempted_ips = get_failed_login_attempts_ips();

	if (!empty($attempted_ips[$client_id])) {
		unset($attempted_ips[$client_id]);
		update_option('quest_failed_login_attempts_ips', $attempted_ips);
	}
});

function quest_is_existing_list($list, $clientIP)
{
	$clientIP = ip2long($clientIP);

	foreach ($list as $item) {
		$temp = explode('-', $item);

		$startIPStr = trim(reset($temp));
		$startIP = ip2long($startIPStr);
		if (sizeof($temp) == 1 && $startIP == $clientIP) {
			return true;
		}

		if (sizeof($temp) == 2) {
			$endIPstr = trim(end($temp));
			$endIP = ip2long($endIPstr);

			if ($startIP <= $clientIP && $clientIP <= $endIP) {
				return true;
			}
		}
	}

	return false;
}

function get_ip_allowed_list()
{
	return explode("\n",get_option('quest_ip_allow_list'));

}

function get_ip_denied_list()
{
	return explode("\n",get_option('quest_ip_deny_list'));
}

function get_failed_login_attempts_ips()
{
	$attempted_ips = get_option('quest_failed_login_attempts_ips');
	return empty($attempted_ips) ? [] : $attempted_ips;
}

function get_failed_attemps_error_messages($attempts_remaining, $is_banned = false)
{
	$admin_email = get_bloginfo('admin_email');
	$errors_message = "<p style='margin-top: 7px'>
                            <strong>WARNING: </strong>%d attempts remaining 
                            before you are denied access to website. 
                       </p>";

	if ($is_banned) {
		return "<p style='margin-top: 7px'> 
                    <strong>ERROR: </strong>Too many failed login attempts. You are denied access to website. 
                    <br> Please contact <a href='mailto:{$admin_email}'>{$admin_email}</a> to be solved if you are denied access! 
                </p>";
	}
	return sprintf($errors_message, $attempts_remaining);
}

function get_email_alert_template($client_ip, $username = '')
{
	$content = "<p>Hi Sir/Madam,</p>
                <p>IP address: {$client_ip} was banned because of too many failed login attempts to https://www.questsys.com by user name: 
                <strong>{$username}</strong>.
                </p>
                <p>To allow this IP address to be accessible to the site, please go to <strong>Settings > Quest Settings</strong> then remove this IP address from IP Blacklist.</p>
                <p>Sincerely, <br>Quest System Support Team</p>";

	return $content;
}

// Function to get the client IP address
function get_client_ip() {
	$ipaddress = '';
	if (isset($_SERVER['HTTP_CLIENT_IP']))
		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_X_FORWARDED']))
		$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
		$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_FORWARDED']))
		$ipaddress = $_SERVER['HTTP_FORWARDED'];
	else if(isset($_SERVER['REMOTE_ADDR']))
		$ipaddress = $_SERVER['REMOTE_ADDR'];
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}