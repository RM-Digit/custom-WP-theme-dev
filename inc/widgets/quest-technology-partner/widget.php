<?php
$title = ! empty( $instance['title'] ) ? esc_attr($instance['title']) : '';

$video_repeater = ! empty( $instance['video_repeater'] ) ? $instance['video_repeater'] : array();


?>
<!--<pre>-->
<?php //var_dump($video_repeater); ?>

<div class="technology-partner">
    <div class="container" >
        <div class="technology-content">
            <div class="row">
                <div class="col-md-4 col-12 technology-title">
                    <h4><?php echo $title; ?></h4>
                </div>
                <div class="col-12 technology-slider">
                    <div class="regular slider">
                        <?php $youtube_video_ids = []; ?>
						<?php foreach ($video_repeater as $item) : ?>
							<?php
							$video_link = $item['video_link'];
							preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $video_link, $matches);
							$youtube_video_ids[] = $matches[0];
							?>
                            <div class="video-image-block">
                                <a class="video-img" href="#video-<?php echo $matches[0];?>">
                                    <div class="video-content">
                                        <?php if (empty($item['video_thumbnail'])): ?>
                                            <img alt="Quest youtube video" src="//img.youtube.com/vi/<?php echo $matches[0]; ?>/maxresdefault.jpg">
                                        <?php else: ?>
                                            <img alt="Quest youtube video" src="<?php echo wp_get_attachment_image_src($item['video_thumbnail'], 'large')[0]; ?>">
                                        <?php endif; ?>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
						<?php endforeach; ?>
                    </div>

                    <!-- control arrows -->
                    <div class="prev">
                        <span><em class="fa fa-chevron-left" aria-hidden="true"></em></span>
                    </div>
                    <div class="next">
                        <span><em class="fa fa-chevron-right" aria-hidden="true"></em></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php foreach ($youtube_video_ids as $id) : ?>
<!-- Modal -->
<div class="modal fade youtube-catch-event" id="video-<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabel">Watch video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body embed-responsive embed-responsive-16by9">
                <iframe class='youtube-catch-event-iframe embed-responsive-item' data-src="https://www.youtube.com/embed/<?php echo $id; ?>" src="https://www.youtube.com/embed/<?php echo $id; ?>" style="border:0;" allow="encrypted-media" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>