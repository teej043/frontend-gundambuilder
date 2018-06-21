<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package gndmbldr
 */

//testing if it works

get_header(); ?>

	<main class="gb-main container-fluid template-index">
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

					<!-- infinite scroll load more -->
					<div class="post-listing">
						<?php if ( have_posts() ) : ?>

                            <?php /* Start the Loop */ ?>
                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php
                                    /* Include the Post-Format-specific template for the content.
                                     * If you want to overload this in a child theme then include a file
                                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                     */
                                    get_template_part( 'content', 'post-preview-tiles' );
                                ?>

                            <?php endwhile; ?>

                            <?php //bootstrap_pagination();?>

                        <?php else : ?>

                            <?php get_template_part( 'no-results', 'index' ); ?>

                        <?php endif; ?>


					</div>

					<div style="clear:both"></div>

					<!-- disable this post list -->


					<!--- main content --->

					<?php
					//load the new straight, modified builds listings
					/*
					$temp = $wp_query;
					$wp_query= null;
					$wp_query = new WP_Query();
					$wp_query->query(
						array(
							'tax-query' => array(
							'relation'=>'AND',
								array(
									'taxonomy'=>'build-status',
									'field'=>'name',
									'terms'=>'Straight Build'
								),
								array(
									'taxonomy'=>'build-status',
									'field'=>'name',
									'terms'=>'Modified'
								)
							),
							'post_status' => 'publish',
							'post_type'=>'model',
							'showposts'=>4
						)
					);
						*/
						$temp = $wp_query;
					$wp_query= null;


						$args = array(
							'post_type' => "model",
							'tax_query' => array(
								'relation' => 'OR',
								array(
									'taxonomy' => 'build-status',
									'field' => 'slug',
									'terms' => 'straight-build'
								),
								array(
									'taxonomy' => 'build-status',
									'field' => 'slug',
									'terms' => 'modified'
								)
							),
							'showposts'=>12
						);
						$wp_query = new WP_Query( $args );
					 ?>


					<?php if (have_posts()):?>
					<div class="gb-main-content gb-new-model-kits col-xs-12 col-sm-12 col-lg-12 hide">
						<div class="gb-post-list">
						<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
						<?php get_template_part( 'content', 'model-preview' ); ?>
						<?php endwhile; ?>
						</div>
					</div> <!-- gb-content-models --->
					<?php endif; ?>
					<?php $wp_query = null; $wp_query = $temp;?>


					<?php
					//load the newest stock kits listings
					$temp = $wp_query;
					$wp_query= null;

					$args = array(
						'post_type' => 'model',
						'build-status' => 'stock',
						'showposts'=>3
					);
					$wp_query = new WP_Query( $args );

					if (have_posts()):?>
					<div class="gb-main-content gb-new-model-kits remove-padding-left col-xs-12 col-sm-12 col-lg-3 hide">
						<div class="gb-post-list-alt">
						<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
						<?php get_template_part( 'content', 'model-preview' ); ?>
						<?php endwhile; ?>
						</div>
					</div> <!-- gb-content-models --->
					<?php endif; ?>
					<?php $wp_query = null; $wp_query = $temp;?>

				</div><!-- row --->

			</div><!-- gb-content-area end -->

			<!-- gb-sidebar begin -->
			<?php get_sidebar(); ?>
			<!-- gb-sidebar end -->

		</div><!--- gb-page --->


<?php
get_footer();
