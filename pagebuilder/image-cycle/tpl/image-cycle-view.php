<ul class="tiny-slider">
    <?php foreach($images as $src) : ?>
        <li><img src="<?php echo $src ?>" /></li>
    <?php endforeach; ?>
</ul>

<script>
    jQuery(document).ready(function($) {
        $('.tiny-slider').tinySlider();
    });
</script>