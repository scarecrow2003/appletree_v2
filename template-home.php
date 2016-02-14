<?php
/**
 * Created by PhpStorm.
 * User: hougang
 * Date: 10/11/15
 * Time: 9:38 PM
 * Template Name: AppleTreeHomePage
 */

get_header(); the_post(); ?>
<?php if( is_page() ): ?>
    <div class="row wrapper banner">
        <div class="col-xs-12">
            <div class="owl-carousel">
            <?php
            $query_images_args = array(
                'post_type' => 'attachment',
                'post_mime_type' =>'image',
                'post_status' => 'inherit',
                'posts_per_page' => -1,
                'orderby' => 'slug',
                'order' => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => 'slideshow',
                    ),
                ),
            );
            $query_images = new WP_Query( $query_images_args );
            if ( $query_images->have_posts() ) {
                while ( $query_images->have_posts() ) {
                    $query_images->the_post();
                    $url = wp_get_attachment_url( get_the_ID());
                    $alt = get_post_meta(get_the_ID(), '_wp_attachment_image_alt', true);
                    if ($alt == "") {
                        $alt = "Photo ".$index;
                    }
                    echo '<div><img src="'.$url.'" alt="'.$alt.'"></div>';
                }
            }
            wp_reset_postdata();
            ?>
            <?php /*echo do_shortcode('[wp_owl id="225"]'); */?>
            </div>
        </div>
    </div>
    <div class="row wrapper content">
        <div class="apple-sep">
            <div class="popular"></div>
        </div>
        <div class="col-xs-12">
            <h1><?php echo __(get_post_meta(get_the_ID(), 'h1', true), 'appletreesg.com'); ?></h1>
            <?php the_content(); ?>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-3 col-xs-6 cat-link">
            <a href="<?php echo get_post_meta(get_the_ID(), 'linkone', true); ?>">
                <img src="<?php echo get_post_meta(get_the_ID(), 'imageone', true); ?>" width="300" height="307" class="img-responsive" alt="New born">
                <div class="link-text home-link-text" id="link-1">
                    <label>Dream Begin</label>
                </div>
            </a>
        </div>
        <div class="col-sm-3 col-xs-6 cat-link">
            <a href="<?php echo get_post_meta(get_the_ID(), 'linktwo', true); ?>">
                <img src="<?php echo get_post_meta(get_the_ID(), 'imagetwo', true); ?>" width="300" height="307" class="img-responsive" alt="Studio">
                <div class="link-text home-link-text" id="link-2">
                    <label>Happy Life</label>
                </div>
            </a>
        </div>
        <div class="col-sm-3 col-xs-6 cat-link">
            <a href="<?php echo get_post_meta(get_the_ID(), 'linkthree', true); ?>">
                <img src="<?php echo get_post_meta(get_the_ID(), 'imagethree', true); ?>" width="300" height="307" class="img-responsive" alt="Outdoor">
                <div class="link-text home-link-text" id="link-3">
                    <label>Forest Story</label>
                </div>
            </a>
        </div>
        <div class="col-sm-3 col-xs-6 cat-link">
            <a href="<?php echo get_post_meta(get_the_ID(), 'linkfour', true); ?>">
                <img src="<?php echo get_post_meta(get_the_ID(), 'imagefour', true); ?>" width="300" height="307" class="img-responsive" alt="Maternity">
                <div class="link-text home-link-text" id="link-4">
                    <label>All Love</label>
                </div>
            </a>
        </div>
        <div class="clearfix"></div>
    </div>
<?php endif; ?>
<?php get_footer(); ?>
