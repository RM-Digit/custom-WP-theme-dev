<?php
$slx_default_code = '
        <script type="text/javascript">
            __sf_config = {
                customer_id: 95975,
                host: "www3.questsys.com",
                ip_privacy: 0,
                subsite: "",
                
                __img_path: "/web-next.gif?"
            };
            
            (function() {
                var s = function() {
                    var e, t;
                    var n = 10;
                    var r = 0;
                    e = document.createElement("script");
                    e.type = "text/javascript";
                    e.async = true;
                    e.src = "//" + __sf_config.host + "/js/frs-next.js";
                    t = document.getElementsByTagName("script")[0];
                    t.parentNode.insertBefore(e, t);
                    var i = function() {
                        if (r < n) {
                            r++;
                            if (typeof frt !== "undefined") {
                                frt(__sf_config);
                            } else {
                                setTimeout(function() { i(); }, 500);
                            }
                        }
                     };
                    i();
                };
                if (window.attachEvent) {
                    window.attachEvent("onload", s);
                } else {
                    window.addEventListener("load", s, false);
                }
            })();
        </script>';
$slx_tracking_code = get_option('quest_slx_web_tracker_code', $slx_default_code);
$slx_tracking_target = get_option('quest_slx_tracking_target', 1);

$scripts = '<script type="text/javascript"> if (getCookie("cookie_consent") !== "") {' . strip_tags($slx_tracking_code) . '}</script>';

if ($slx_tracking_target == 1) {
	add_action('quest_salesfusion_web_tracking_code', function () use ($scripts) {
		echo $scripts;
	});
} else {
	add_action('quest_salesfusion_web_tracking_code_whole_site', function () use ($scripts) {
		echo $scripts;
	});
}