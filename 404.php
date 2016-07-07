<?php
/**
 * @package WordPress
 * @subpackage Unshackled-Theme
 * @since 1.0
 */

get_header(); ?>

<div class="error-404">
    <h1>Page Not Found</h1>
    <p>Oops! The page you were trying to view could not be found. This could be due to an outdated link, a mistyped URL, or a site error.</p>
    <p class="margin-top-md">
        <a href="<?php echo site_url(); ?>">Back to Home</a>
    </p>
</div>

<?php get_footer(); ?>
