<?php
/**
 * Apple Tree template for displaying the standard Loop
 *
 * @package WordPress
 * @subpackage Apple Tree
 * @since Apple Tree 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="preview">
        <div class="title cf">
            <h2 class="post-title">
                <a href="<?php echo is_singular()?'#':esc_url( get_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark">
                    <span><?php the_title(); ?></span>
                </a>
            </h2>
        </div>
    </header>

	<!--<h2 class="post-title"><?php
/*
		if ( is_singular() ) :
			the_title();
		else : */?>

			<a href="<?php /*echo esc_url( get_permalink() ); */?>" rel="bookmark"><?php
/*				the_title(); */?>
			</a><?php
/*
		endif; */?>

	</h2>-->

	<!--<div class="post-meta"><?php
/*		appletree_post_meta(); */?>
	</div>-->

	<div class="post-content text-center"><?php

		if ( '' != get_the_post_thumbnail() ) : ?>
			<?php the_post_thumbnail(); ?><?php
		endif; ?>

		<?php if ( is_front_page() || is_category() || is_archive() || is_search() ) : ?>

			<?php the_excerpt(); ?>
			<a href="<?php the_permalink(); ?>"><?php _e( 'Read more &raquo;', 'appletree' ); ?></a>

		<?php else : ?>

			<?php the_content( __( 'Continue reading &raquo', 'appletree' ) ); ?>

		<?php endif; ?>

		<?php
			wp_link_pages(
				array(
					'before'           => '<div class="linked-page-nav"><p>'. __( 'This article has more parts: ', 'appletree' ),
					'after'            => '</p></div>',
					'next_or_number'   => 'number',
					'separator'        => ' ',
					'pagelink'         => __( '&lt;%&gt;', 'appletree' ),
				)
			);
		?>

	</div>

    <div class="apple-sep">
        <div class="popular"></div>
    </div>

</article>