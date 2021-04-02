<?php
$primary_content = ! empty( $instance['primary_content'] ) ? $instance['primary_content'] : '';
$secondary_primary = $instance['secondary_content'];

$layout_type = ! empty( $secondary_primary['layout_type'] ) ? esc_attr($secondary_primary['layout_type']) : 'default';
$email = $secondary_primary['email'];
$tks_file = ! empty( $secondary_primary['tks_file'] ) ? $secondary_primary['tks_file'] : 0;
?>
<?php switch ($layout_type) :?>
<?php case 'default': ?>
    <div class="bounder">
        <div class="thank-you-container">
            <div class="container text-center default-layout">
                <?php echo $primary_content; ?>
                <?php if (!empty($email)) : ?>
                <p><a href="mailto:<?php echo $email?>?subject=Contacting Quest" class="btn btn-success-dark">Email Us Today</a></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php break; ?>
<?php case 'event': ?>
    <div class="bounder">
        <div class="thank-you-container">
            <div class="container event-layout">
	            <?php echo $primary_content; ?>
                <div class="tks-content mx-auto row">
                    <div class="col-lg-6 col-12 mb-4">
                        <div class="tks-content-item bg-white d-flex align-items-center">
                            <span class="pr-md-3"><em class="fa fa-calendar" aria-hidden="true"></em></span>
                            <a href="<?php echo wp_get_attachment_url($tks_file);?>"><?php get_the_title($tks_file); ?>Add this event to your Outlook Calendar.</a>
<p>&nbsp;</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 mb-4">
                        <div class="tks-content-item bg-white d-flex align-items-center">
                            <span class="pr-md-3"><em class="fa fa-envelope" aria-hidden="true"></em></span>
                            <a href="mailto:<?php echo $email?>?subject=Contacting Quest">Have additional comments, questions or concerns? Email Us Today!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php break; ?>
<?php case 'download_file': ?>
    <div class="bounder">
        <div class="thank-you-container">
            <div class="container event-layout">
                <?php echo $primary_content; ?>
                <div class="tks-content mx-auto row">
                    <div class="col-lg-6 col-12 mb-4">
                        <div class="tks-content-item bg-white d-flex align-items-center">
                            <span class="pr-md-3"><em class="fa fa-file-o" aria-hidden="true"></em></span>
                            <a href="<?php echo wp_get_attachment_url($tks_file);?>"><?php get_the_title($tks_file); ?>Link download</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 mb-4">
                        <div class="tks-content-item bg-white d-flex align-items-center">
                            <span class="pr-md-3"><em class="fa fa-envelope" aria-hidden="true"></em></span>
                            <a href="mailto:<?php echo $email?>?subject=Contacting Quest">Have additional comments, questions or concerns? Email Us Today!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php break; ?>
<?php endswitch; ?>