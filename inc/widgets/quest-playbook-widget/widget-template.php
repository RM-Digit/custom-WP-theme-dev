<?php
$title = !empty($instance['title']) ? $instance['title'] : '';
$playbook = $instance['playbook'];
$contacts = $instance['contact'];
?>

<div class="playbook-container container">
    <div class="playbook-header mb-5">
        <?php echo $title; ?>
    </div>
    <div class="playbook-body row">
        <div class="col-lg-9 col-12 playbook-list mb-5">
	        <?php foreach ($playbook as $item) : ?>
            <div class="playbook-item" href="javascript:;">
                <a class="pb-item-header" href="javascript:;">
                    <span class="fa fa-caret-right" style="width: 10px;"></span>
                    <img src="<?php echo wp_get_attachment_url($item['icon']); ?>" alt="playbook icon">
                    <span><?php echo $item['item_title']; ?></span>
                </a>
                <div class="pb-item-content" style="display:none;">
                    <?php echo $item['content']; ?>
                </div>
            </div>
	        <?php endforeach; ?>
        </div>
        <div class="col-lg-3 col-12 playbook-contact mb-5">
	        <?php foreach ($contacts as $contact) : ?>
            <div class="contact-item">
                <div class="c-item-portrait">
                    <img src="<?php echo wp_get_attachment_url($contact['portrait']); ?>" alt="Assistant's Portrait">
                </div>
                <div class="c-item-content">
                    <div class="contact-name"><span><?php echo $contact['first_name'] . ' ' . $contact['last_name']; ?></span></div>
                    <div class="contact-info">
                        <p>Click to contact <?php echo $contact['first_name']; ?>:</p>
                        <p>
                            <a class="ci-email" href="mailto:<?php echo $contact['email']; ?>" target="_blank"><span class="sr-only">Contact Email</span><em class="fa fa-envelope-o"></em></a>
                            <a class="ci-phone" href="tel:<?php echo $contact['phone']; ?>"><span class="sr-only">Contact Phone</span><em class="fa fa-phone"></em></a>
                        </p>
                    </div>
                </div>
            </div>
	        <?php endforeach; ?>
        </div>
    </div>

</div>
