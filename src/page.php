<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package gndmbldr
 */

get_header(); ?>


	<main class="gb-main container-fluid template-page">
		<div class="gb-page row">
			<aside class="gb-aside-nav visible-sm visible-md visible-lg">
				<div class="row">
					<nav class="col-md-12 col-lg-12">
                    	<div id="toggle-show-series">Show Mobile Suit Series <span class="caret"></span></div>
						<ul class="gb-nav-cat show-half">
							<?php gb_ms_series_list(); ?>
						</ul>
					</nav>
				</div>
			</aside><!-- gb-aside-nav -->
			<div class="gb-content-area">
				<div class="row">
					<div class="col-xs-12 col-sm-12 visible-xs visible-sm">
						<div class="gb-search input-group input-group-lg input-group-sm">
						  <input type="text" class="form-control">
						  <span class="input-group-btn">
							<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
						  </span>
						</div><!-- /input-group -->
					</div>
					<div style="clear:both"></div>
					<div class="gb-main-content col-md-12">
                    	<h1 class="hide">
                        	<?php the_title(); ?>
                        </h1>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'content', 'page' ); ?>

                            <?php
                                // If comments are open or we have at least one comment, load up the comment template
                                if ( comments_open() || '0' != get_comments_number() )
                                    comments_template();
                            ?>

                        <?php endwhile; // end of the loop. ?>


					</div><!--- main content --->

				</div><!-- row --->
			</div><!-- gb-content-area end -->

			<!-- gb-sidebar begin -->
			<?php get_sidebar(); ?>
			<!-- gb-sidebar end -->

		</div><!--- gb-page --->


<?php
get_footer();
