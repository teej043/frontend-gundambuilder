<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package web2feel
 */

 
 
get_header(); ?>


<?php
global $query_string;
$opt = $_GET['option'];
echo($opt)
?>

	<main class="gb-main container-fluid">
		<div class="gb-page row" style="background:#eee;">
			<aside class="gb-aside-nav col-xs-12 col-sm-2 col-md-12 col-lg-2 visible-sm visible-md visible-lg" style="background:#fff;">
				<div class="row">
					<nav class="col-md-12 col-lg-12" style="background:#fff;">
						<ul class="gb-nav-cat">
							<?php gb_ms_series_list(); ?>
						</ul>
					</nav>
				</div>
			</aside><!--- gb-aside-nav --->
			<div class="gb-content-area col-xs-12 col-sm-10 col-md-12 col-lg-10" style="background:#fff;">
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
					echo($opt);
					/*
					$temp = $wp_query;
					$wp_query= null;
					
					if ($opt == 'model'){
						$args = array('post_type' => 'model');
					}
					else{
						$args = array('post_type' => array('post','model','page','turntable'));
					}
					
					$wp_query = new WP_Query( $args );
					*/
					?>
					
					
                    <?php if ( have_posts() ) : ?>
                    
					<div class="gb-main-content col-md-12">
						
                    
                    	<div>
							<h1><?php printf( __( 'Search Results for: %s', 'web2feel' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
        				</div>
						<div class="gb-post-list">
						
						
						
						
                    	<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>
            
                            <?php get_template_part( 'content', 'archive' ); ?>
            
                        <?php endwhile; ?>
            
                        <?php bootstrap_pagination();?>
						
						
                        </div>
					</div><!--- main content --->
                    <?php else : ?>
            		<div class="gb-main-content col-md-12">
                        <?php get_template_part( 'no-results', 'search' ); ?>
            		</div><!--- main content --->
                    <?php endif; ?>
					
				</div><!-- row --->
			</div><!--- gb-content-area --->
		</div><!--- gb-page --->
		

<?php
get_sidebar();
get_footer();