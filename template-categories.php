<?php
/**
 * Created by PhpStorm.
 * User: hougang
 * Date: 10/17/15
 * Time: 10:35 PM
 * Template Name: AppleTreeCategoryPage
 */

get_header(); the_post(); ?>
<?php if( is_page() ): ?>
    <div class="row wrapper">
        <div class="col-xs-12">
            <h1><?php _e(get_post_meta(get_the_ID(), 'h1', true), 'appletreesg.com'); ?></h1>
        </div>
        <div class="col-xs-12">
        <?php
        $uri = $_SERVER["REQUEST_URI"];
        $lid = strrpos($uri, '/');
        $slug = substr($uri, 1, $lid);
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
                    'terms'    => $slug,
                ),
            ),
        );
        $query_images = new WP_Query( $query_images_args );
        if ( $query_images->have_posts() ) {
            $index = 0;
            $count = $query_images->post_count;
            while ( $query_images->have_posts() ) {
                $query_images->the_post();
                $url = wp_get_attachment_url( get_the_ID());
                $alt = get_post_meta(get_the_ID(), '_wp_attachment_image_alt', true);
                $link = str_replace(' ', '-', strtolower($alt));
                echo '<div class="col-xs-6 col-sm-4 col-md-3 category-img text-center"><a href="/' . $link . '"><img src="' . $url . '" class="img-responsive" alt="'.$alt.'"><div class="link-text gallery-link-text"><label>'.$alt.'</label></div></a></div>';
                $index++;
            }
        }
        wp_reset_postdata();
        ?>
        </div>
    </div>
<?php endif; ?>
<?php get_footer(); ?>