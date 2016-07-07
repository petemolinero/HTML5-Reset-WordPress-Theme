<?php
  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

  $custom_args = array(
      'post_type' => $instance['post_type'],
      'posts_per_page' => $instance['posts_per_page'],
      'paged' => $paged
    );

  $custom_query = new WP_Query( $custom_args ); ?>

  <?php if ( $custom_query->have_posts() ) : ?>

    <!-- the loop -->
    <div class="blog">
        <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
          <article class="loop">
                <div class="banner">
                    <a href="<?php the_permalink(); ?>" class="featured-img"><?php the_post_thumbnail( 'blog' ); ?></a>
                    <div class="title-area">
                        <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="meta">
                        By <?php echo get_the_author(); ?> on <?php the_time('F jS, Y'); ?> <?php edit_post_link(__('[Edit]'), ''); ?>
                        </div>
                    </div>
                </div>
            <div class="excerpt">
              <?php the_excerpt(); ?>
            </div>
          </article>
        <?php endwhile; ?>
    </div>
    <!-- end of the loop -->

    <!-- Next and Previous Links -->
    <?php if ($the_query->max_num_pages > 1 && $instance['display_older_newer']) { // check if the max number of pages is greater than 1  ?>
      <nav class="prev-next-posts">
        <div class="prev-posts-link">
          <?php echo get_next_posts_link( 'Older Entries', $the_query->max_num_pages ); // display older posts link ?>
        </div>
        <div class="next-posts-link">
          <?php echo get_previous_posts_link( 'Newer Entries' ); // display newer posts link ?>
        </div>
      </nav>
    <?php } ?>

    <!-- pagination here -->
    <?php
      if (function_exists('custom_pagination') && $instance['display_pagination']) {
        custom_pagination($custom_query->max_num_pages,"",$paged);
      }
    ?>

  <?php wp_reset_postdata(); ?>

  <?php else:  ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
  <?php endif; ?>