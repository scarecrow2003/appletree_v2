<?php
/**
 * Created by PhpStorm.
 * User: hougang
 * Date: 10/17/15
 * Time: 10:35 PM
 * Template Name: AppleTreeGeneralPage
 */

get_header(); the_post(); ?>
<?php if( is_page() ): ?>
    <div class="row wrapper">
        <div class="col-xs-12">
            <img src="<?php echo get_post_meta(get_the_ID(), 'banner', true); ?>" class="img-responsive" alt="Banner"/>
        </div>
        <div class="clearfix"></div>
        <div class="apple-sep">
            <div class="popular"></div>
        </div>
        <div class="col-xs-12">
            <h1><?php _e(get_post_meta(get_the_ID(), 'h1', true), 'appletreesg.com'); ?></h1>
            <?php the_content(); ?>
        </div>

    </div>
<?php endif; ?>
<?php get_footer(); ?>