<?php if ( $instance['display_heading'] ): ?>
    <h3>Related Posts</h3>
<?php endif; ?>

<?php
    // Loop through the posts and do something with them.
    if($posts->have_posts()) : ?>
        <div class="post-list">
            <?php while($posts->have_posts()) : $posts->the_post(); ?>
                <p>
                    <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                </p>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    <?php endif;
?>
