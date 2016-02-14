<?php
/**
 * Created by PhpStorm.
 * User: hougang
 * Date: 10/17/15
 * Time: 10:35 PM
 * Template Name: AppleTreeGalleryPage
 */

get_header(); the_post(); ?>
<?php if( is_page() ): ?>
    <div class="row wrapper">
        <div class="col-xs-12">
            <h1><?php _e(get_post_meta(get_the_ID(), 'h1', true), 'appletreesg.com'); ?></h1>
            <div>
                <?php the_content(); ?>
            </div>
        </div>

        <?php
        $uri = substr($_SERVER["REQUEST_URI"], 1);
        $lid = strpos($uri, '/');
        $slug = substr($uri, 0, $lid);
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $query_images_args = array(
            'post_type' => 'attachment',
            'post_mime_type' =>'image',
            'post_status' => 'inherit',
            'posts_per_page' => 10,
            'paged' => $paged,
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
        global $wp_query;
        $wp_query = new WP_Query( $query_images_args );
        if ( $wp_query->have_posts() ) {
            $index = 1;
            while ( $wp_query->have_posts() ) {
                $wp_query->the_post();
                $url = wp_get_attachment_url( get_the_ID());
                $alt = get_post_meta(get_the_ID(), '_wp_attachment_image_alt', true);
                if ($alt == "") {
                    $alt = "Photo ".$index;
                }
                echo '<div class="col-xs-12 category-img"><img src="'.$url.'" class="img-responsive" alt="'.$alt.'"></div>';
                $index++;
            }
        }
        wp_reset_postdata();
        ?>
    </div>
    <div class="pagination">

        <?php get_template_part( 'template-part', 'pagination' ); ?>

    </div>
<?php endif; ?>
<?php get_footer(); ?>