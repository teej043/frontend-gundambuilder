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

 Template name:Homepage
 */

get_header(); ?>

	<main class="gb-main container-fluid">
		<div class="gb-page row" style="background:#eee;">
			<aside class="gb-aside-nav col-xs-12 col-sm-2 col-md-12 col-lg-2 visible-sm visible-md visible-lg" style="background:#fff;">
				<div class="row">
					<nav class="col-md-12 col-lg-12" style="background:#fff;">
						<ul class="gb-nav-cat">
							<li><img src="images/logo-mobile-suit-gundam-seed.png" /></li>
							<li><img src="images/logo-mobile-suit-gundam-unicorn.png" /></li>
							<li><img src="images/logo-mobile-suit-gundam-wings.png" /></li>
							<li><img src="images/logo-mobile-suit-gundam-zeta.png" /></li>
							<li>ITEM5</li>
						</ul>
					</nav>
				</div>
			</aside><!--- gb-aside-nav --->
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
					<div class="gb-main-content col-md-12">

						<?php if ( have_posts() ) : ?>

                            <?php /* Start the Loop */ ?>
                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php
                                    /* Include the Post-Format-specific template for the content.
                                     * If you want to overload this in a child theme then include a file
                                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                     */
                                    get_template_part( 'content', get_post_format() );
                                ?>

                            <?php endwhile; ?>

                            <?php //bootstrap_pagination();?>

                        <?php else : ?>

                            <?php get_template_part( 'no-results', 'index' ); ?>

                        <?php endif; ?>


					</div><!--- main content --->

				</div><!-- row --->
      </div><!-- gb-content-area end -->

			<!-- gb-sidebar begin -->
			<?php get_sidebar(); ?>
			<!-- gb-sidebar end -->

		</div><!--- gb-page --->


<?php
get_footer();
