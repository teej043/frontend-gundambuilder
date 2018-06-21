<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package gndmbldr
 */

get_header(); ?>

	<main class="gb-main container-fluid">
		<div class="gb-page error-404 not-found row" style="background:#eee;">
			<aside class="gb-aside-nav visible-sm visible-md visible-lg" style="background:#fff;">
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
					<div class="gb-main-content col-md-12">

                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="gb-page-title  page-title row">
                                <section class="gb-post-title col-xs-12 col-sm-12 col-md-12 col-lg-12" style="">
                                    <h1 style="display:inline;font-size:42px;"><a href="<?php the_permalink(); ?>"><?php _e( 'Oops! That page can&rsquo;t be found.', 'gndmbldr' ); ?></br><small>Secondary text</small></a></h1>
                                </section>
                            </header>

                            <section class="gb-page-content gb-post-content page-content">
								<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'gndmbldr' ); ?></p>
                            </section><!--- post content --->


                            <footer class="entry-meta">
                                <?php edit_post_link( __( 'Edit', 'gndmbldr' ), '<span class="edit-link">', '</span>' ); ?>
                            </footer><!-- .entry-meta -->

                        </article>


                    </div><!--- main content --->

				</div><!-- row --->
			</div><!-- gb-content-area end -->

			<!-- gb-sidebar begin -->
			<?php get_sidebar(); ?>
			<!-- gb-sidebar end -->

		</div><!--- gb-page --->


<?php
get_footer();
