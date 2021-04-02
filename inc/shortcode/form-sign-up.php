<?php
function create_shortcode_form_sign_up($args, $content)
{
    $title = $args['title'];
    $content = $args['content'];
    $inputs = explode(",", $args['input']);
    $shortcode = "
    <form>
    <div class='text-center' style='padding: 40px; background: linear-gradient(89.66deg, #144A8D 0%, #08336B 65.02%, #02295B 100%) '>
    <h3 style='color: white; padding-bottom: 5px;'>{$title}</h3>
    <h6 style='color: white; padding-bottom: 20px;'>{$content}</h6>";
    foreach ($inputs as $input) {
        $shortcode .= "<input class='form-control {$input}' id='{$input}' style='width: -webkit-fill-available;
    border-radius: 5px;
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 3px 0 rgba(0,0,0,0.1);
    margin: 10px;
    background-color: white;
    height: 40px;' type='text' placeholder='{$input}' ><br>";
    }
    $shortcode .= "<input class='btn btn-success' style='margin-top: 20px; color: white' type='submit' value='Submit' >
</div>
</form>";
    return $shortcode;
}

add_shortcode('form_sign_up', 'create_shortcode_form_sign_up');