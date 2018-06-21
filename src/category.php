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


	<main class="gb-main container-fluid template-category">
		<div class="gb-page row">
			<aside class="gb-aside-nav visible-sm visible-md visible-lg" style="background:#fff;">
				<div class="row">
					<nav class="col-md-12 col-lg-12" style="background:#fff;">
                    	<div id="toggle-show-series">Show Mobile Suit Series <span class="caret"></span></div>
						<ul class="gb-nav-cat show-half">
							<?php gb_ms_series_list(); ?>
						</ul>
					</nav>
				</div>
			</aside><!-- gb-aside-nav -->
			<div class="gb-content-area" style="background:#fff;">
				<div class="row">
					<div class="col-xs-12 col-sm-12 visible-xs visible-sm" style="background:#fff;">
						<div class="gb-search input-group input-group-lg input-group-sm">
						  <input type="text" class="form-control">
						  <span class="input-group-btn">
							<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
						  </span>
						</div><!-- /input-group -->
					</div>
					<div style="clear:both"></div>
					<div class="gb-main-content">
					<div>
                        <h1>
						<?php
                                if ( is_category() ) :
                                    single_cat_title();

                                elseif ( is_tag() ) :
                                    single_tag_title();

                                elseif ( is_author() ) :
                                    /* Queue the first post, that way we know
                                     * what author we're dealing with (if that is the case).
                                    */
                                    the_post();
                                    printf( __( 'Author: %s', 'gndmbldr' ), '<span class="vcard">' . get_the_author() . '</span>' );
                                    /* Since we called the_post() above, we need to
                                     * rewind the loop back to the beginning that way
                                     * we can run the loop properly, in full.
                                     */
                                    rewind_posts();

                                elseif ( is_day() ) :
                                    printf( __( 'Day: %s', 'gndmbldr' ), '<span>' . get_the_date() . '</span>' );

                                elseif ( is_month() ) :
                                    printf( __( 'Month: %s', 'gndmbldr' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

                                elseif ( is_year() ) :
                                    printf( __( 'Year: %s', 'gndmbldr' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

                                elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
                                    _e( 'Asides', 'gndmbldr' );

                                elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
                                    _e( 'Images', 'gndmbldr');

                                elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
                                    _e( 'Videos', 'gndmbldr' );

                                elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
                                    _e( 'Quotes', 'gndmbldr' );

                                elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
                                    _e( 'Links', 'gndmbldr' );

																elseif ( is_tax( 'tax-manufacturer')) :
																	_e( 'Archives Manufacturer', 'gndmbldr' );

                                else :
                                    //_e( 'Archives', 'gndmbldr' );
																		echo single_cat_title();
																		echo '<span>'. term_description() . '</span>';
                                endif;
                            ?>
												</h1>
											</div>
												

						<div class="gb-post-list row">

						<?php $ind = 0;
									while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'content', 'category-preview' ); ?>

                            <?php

                                // If comments are open or we have at least one comment, load up the comment template
                                if ( comments_open() || '0' != get_comments_number() )
                                    comments_template();

																$postCount+=1;


																if (($postCount % 2) == 0 ){
																	echo '<div class="clearfix visible-md hidden-lg"></div>';
																}
																																		
																if (($postCount % 3) == 0 ){
																	echo '<div class="clearfix hidden-md visible-lg"></div>';
																}
														?>

												<?php endwhile; // end of the loop. ?>
						
												<div style="clear:both"></div>
												<?php bootstrap_pagination();?>


					</div></div><!-- main content -->

				</div><!-- row -->
			</div><!-- gb-content-area end -->

			<!-- gb-sidebar begin -->
			<?php get_sidebar(); ?>
			<!-- gb-sidebar end -->

		</div><!-- gb-page -->


<?php
get_footer();
