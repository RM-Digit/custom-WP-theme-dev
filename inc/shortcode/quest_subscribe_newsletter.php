<?php
function quest_subscribe_newsletter($args, $content)
{

    $title = $args['title'];
    $inputs = explode(",", $args['input']);
    $shortcode = "
        <form>
        <div class=' subscribe-newsletter text-center text-white'>
            <h2> {$title} </h2>
            <h5> {$content} </h5>
            <div class=' fex-column d-flex justify-content-center'>
    ";
    foreach ($inputs as $input) {
        $shortcode .= "<input class='form-control mr-4 mt-4 {$input}' id='{$input}' placeholder='{$input}'>";
    }
    $shortcode .= "<input class='btn btn-success mt-4' type='submit' value='Submit' >
</div>
</div>
</form>";
    return $shortcode;
}

add_shortcode('subscribe_newsletter', 'quest_subscribe_newsletter');