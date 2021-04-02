<?php
function create_career_at_quest($args, $content) {
	$logo = get_bloginfo('template_url') . '/img/logo-eVerify.png';
	$iframeUrl = '//questsys.hrmdirect.com/employment/job-openings.php?nohd';

	$html = "<div class='career-at-quest text-center'>" .
	        "<div class='up-content'>" .

	        "<p><a href='javascript:;' class='btn btn-success text-white' id='join-our-team' data-iframe='{$iframeUrl}'>Search for a Job</a></p>" .
	        "</div>" .
	        "<div class='down-content'>" .
	        "<p><img src='{$logo}' alt='E-Verify' /></p>" .
	        "<p class='text-primary'>E-Verify® is a registered trademark of the U.S. Department of Homeland Security</p>" .
	        "</div>";
	$html .= "</div>";

    return $html;
}

add_shortcode( 'career_at_quest', 'create_career_at_quest' );