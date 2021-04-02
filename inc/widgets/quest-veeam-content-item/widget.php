<div class="veeam-content-item">
    <header>
        <h4><?php echo $instance['title'];?></h4>
    </header>
    <div class="item-content">
        <p><?php echo $instance['content'];?></p>
    </div>
    <footer>
        <a href="<?php echo esc_url($instance['button_link']);?>"><?php echo $instance['button_text'];?></a>
    </footer>
</div>
