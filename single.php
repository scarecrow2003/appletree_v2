<?php
/**
 * Apple Tree template for displaying Single-Posts
 *
 * @package WordPress
 * @subpackage Apple Tree
 * @since Apple Tree 1.0
 */

get_header(); ?>

	<!--<section class="page-content primary" role="main">-->
    <div class="row wrapper content">

		<?php
			if ( have_posts() ) : the_post();

				get_template_part( 'loop', get_post_format() ); ?>

				<aside class="post-aside">

					<div class="post-links">
						<?php previous_post_link( '%link', __( '&laquo; Previous post', 'appletree' ) ) ?>
						<?php next_post_link( '%link', __( 'Next post &raquo;', 'appletree' ) ); ?>
					</div>

					<?php
						if ( comments_open() || get_comments_number() > 0 ) :
							comments_template( '', true );
						endif;
					?>

				</aside><?php

			else :

				get_template_part( 'loop', 'empty' );

			endif;
		?>

    </div>
	<!--</section>-->

<?php get_footer(); ?>