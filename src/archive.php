<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package gndmbldr
 */

get_header(); ?>


	<main class="gb-main container-fluid">
		<div class="gb-page row">
			<!-- gb-aside-nav begin -->
			<aside class="gb-aside-nav col-xs-12 col-sm-2 col-md-12 col-lg-2 visible-sm visible-md visible-lg" style="background:#fff;">
				<div class="row">
					<nav class="col-md-12 col-lg-12" style="background:#fff;">
						<div id="toggle-show-series">Show Mobile Suit Series <span class="caret"></span></div>
						<ul class="gb-nav-cat show-half">
							<?php gb_ms_series_list(); ?>
						</ul>
					</nav>
				</div>
			</aside>
			<!--- gb-aside-nav end--->

			<!-- gb-content-area begin -->
			<div class="gb-content-area col-xs-12 col-sm-10 col-md-9 col-lg-7" style="background:#fff;">
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

                    <?php

					if ( have_posts() ) : ?>

					<div class="gb-main-content col-md-12">


                    	<div>
                        <h1>
						<?php
                                if ( is_category() ) :
                                    single_cat_title();
																		echo 'test';

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
                        </h1></div>
                        <div class="gb-post-list row">
                        <?php /* Start the Loop */ ?>
                            <?php
																$postCount = 0;
																while ( have_posts() ) : the_post(); ?>

                                <?php
																		$postCount += 1;
                                    /* Include the Post-Format-specific template for the content.
                                     * If you want to overload this in a child theme then include a file
                                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                     */
                                    get_template_part( 'content', 'model-preview' );

																		if (($postCount % 2) == 0){
																			echo '<div class="clearfix"></div>';
																		}
                                ?>

                            <?php endwhile; ?>
                        </div>
                        <?php bootstrap_pagination();?>





					</div><!--- main content --->
                    <?php else : ?>
            		<div class="gb-main-content col-md-12">
                        <?php get_template_part( 'no-results', 'archive' ); ?>
            		</div><!--- main content --->
                    <?php endif; ?>

				</div><!-- row --->

			</div><!-- gb-content-area end -->

			<!-- gb-sidebar begin -->
			<?php get_sidebar(); ?>
			<!-- gb-sidebar end -->

		</div><!--- gb-page --->


<?php
get_footer();
