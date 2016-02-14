<?php
/**
 * Apple Tree template for displaying the footer
 *
 * @package WordPress
 * @subpackage Apple Tree
 * @since Apple Tree 1.0
 */
?>

				<ul class="footer-widgets"><?php
					if ( function_exists( 'dynamic_sidebar' ) ) :
						dynamic_sidebar( 'footer-sidebar' );
					endif; ?>
				</ul>

                <div class="row footer">
                    <div class="col-lg-12 copyright text-center">
                        <p>
                            <?php _e('Copyright © 2009-2016 Apple Tree Studio', 'appletreesg.com'); ?> &nbsp;|&nbsp;<?php _e('All Rights Reserved.', 'appletreesg.com'); ?>
                        </p>
                    </div>
                </div>

			</div>

        <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
        <![endif]-->
        <!-- Template scripts -->
        <!--<script type="text/javascript">
            var templateDir = "<?php /*bloginfo('template_directory') */?>";
        </script>-->
        <!-- Bower dependencies -->
        <script src="<?php echo get_template_directory_uri(); ?>/bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Bower dependencies: Bootstrap plugins -->
        <script src="<?php echo get_template_directory_uri(); ?>/bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
        <!-- Template script dependency -->
        <script src="<?php echo get_template_directory_uri(); ?>/js/scripts.min.js"></script>

        <?php
            $temp = pathinfo(get_page_template(), PATHINFO_FILENAME);
            if ($temp == 'template-home') {
        ?>
        <script src="<?php echo get_template_directory_uri(); ?>/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.owl-carousel').owlCarousel({
                    autoplay: true,
                    loop: true,
                    items: 1,
                    autoHeight: true
                });
            });
        </script>
        <?php
            }
        ?>

		<?php wp_footer(); ?>
	</body>
</html>