<?php
$request_link = ! empty( $instance['request_link'] ) ? esc_attr($instance['request_link']) : '';
$request_title = isset( $instance['request_title'] ) ? $instance['request_title'] : 'Request Your Workshop';
$request_btn_name = isset( $instance['request_btn_name'] ) ? esc_attr($instance['request_btn_name']) : 'Request';
$request_position = isset( $instance['request_position'] ) ? esc_attr($instance['request_position']) : 'top';
?>
<div class="assessment-workshop d-flex flex-column">
	<?php if (!empty($instance['request_link']) || !empty( $instance['request_title'] )) : ?>
    <div class="text-center bg-primary pb-5 pt-5
                <?php echo strtolower($request_title) == 'request your workshop' ? 'pr-5 pl-5' : 'pr-3 pl-3' ?>
                <?php echo $request_position == 'top' ? 'order-0 mb-5' : 'order-2 mt-5' ?>">
        <h2 class="text-white"><?php echo $request_title ?></h2>
	    <?php if (!empty($instance['request_link'])) : ?>
        <a class="btn btn-success text-white <?php echo !empty( $instance['request_title'] ) ? 'mt-2' : ''?>" href="<?php echo $request_link ?>" target="_blank">
            <?php echo $request_btn_name ?>
        </a>
	    <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="border pt-5 pr-3 pl-3 pb-5 order-1">
        <h4 class="widget-header align-items-center text-center text-primary pb-3">WORKSHOP DETAILS</h4>
        <div class="row pt-3 pr-4">
            <div class="col-2 text-secondary align-items-end text-right">
                <em style="font-size: 2rem" class="quest-icon quest-date"></em>
            </div>
            <div class="col-10">
                <h6 class="text-primary font-weight-bold">Date/Time </h6>
                <?php echo $instance['date_time']; ?>
            </div>
        </div>
        <div class="row pt-3 pr-4">
            <div class="col-2 text-secondary align-items-end text-right">
                <em style="font-size: 2rem" class="quest-icon quest-location"></em>
            </div>
            <div class="col-10">
                <h6 class="text-primary font-weight-bold">Location </h6>
                <?php echo $instance['location']; ?>
            </div>
        </div>
        <div class="row pt-3 pr-4">
            <div class="col-2 text-secondary align-items-end text-right">
                <em style="font-size: 2rem" class="quest-icon quest-person"></em>
            </div>
            <div class="col-10">
                <h6 class="text-primary font-weight-bold">Recommended Attendee Titles </h6>
                <?php echo $instance['recommended_attendee_titles']; ?>
            </div>
        </div>
        <div class="row pt-3 pr-4">
            <div class="col-2 text-secondary align-items-end text-right">
                <em style="font-size: 2rem" class="quest-icon quest-document"></em>
            </div>
            <div class="col-10">
                <h6 class="text-primary font-weight-bold">Preferred Documentation to Review </h6>
                <?php echo $instance['preferred_documentation_to_review']; ?>
            </div>
        </div>
        <div class="row pt-3 pr-4">
            <div class="col-2 text-secondary align-items-end text-right">
                <em style="font-size: 2rem" class="quest-icon quest-time"></em>
            </div>
            <div class="col-10">
                <h6 class="text-primary font-weight-bold">Timeline at a Glance </h6>
                <?php echo $instance['timeline_at_a_glance']; ?>
            </div>
        </div>
    </div>
</div>