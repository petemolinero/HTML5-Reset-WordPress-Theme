<div class='embed-video-container'>
    <?php if ($host == 'youtube'): ?>
        <iframe width="560" height="349" src="http://www.youtube.com/embed/<?php echo $video_id; ?>?rel=0&hd=1" frameborder="0" allowfullscreen></iframe>

    <?php else: ?>
        <iframe src='http://player.vimeo.com/video/<?php echo $video_id; ?>?title=0&byline=0&portrait=0' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
    <?php endif; ?>
</div>