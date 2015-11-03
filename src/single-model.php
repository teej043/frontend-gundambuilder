<?php
/**
 * The Template for displaying all single model posts.
 *
 * @package gndmbldr
 */
get_header(); ?>

	<main class="gb-main container-fluid template-single-model">
		<div class="gb-page row" style="background:#eee;">
			<aside class="gb-aside-nav col-xs-12 col-sm-2 col-md-12 col-lg-2 visible-sm visible-md visible-lg" style="background:#fff;">
				<div class="row">
					<nav class="col-md-12 col-lg-12" style="background:#fff;">
						<div id="toggle-show-series">Show Mobile Suit Series <span class="caret"></span></div>
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
					<div class="gb-main-content col-md-12">
                    <?php while ( have_posts() ) : the_post(); ?>

						<!--- CONTENT AREA START ---->
						
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="row template-content-single-model">
								<section class="gb-post-title col-xs-12 col-sm-12 col-md-12 col-lg-8" style="">
									<h1 style="display:inline;font-size:42px;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></br><small><?php if (get_post_meta($post->ID,'GB_model-kit-detail-code-name',true) != "" ) echo get_post_meta($post->ID,'GB_model-kit-detail-code-name',true); ?></small></a></h1>		
								</section>
								
								<section id="gb-post-meta-a" class="col-xs-12 col-sm-7 col-md-7 col-lg-4" style="">
									<ul>
										<?php  
										$basekitId = get_post_meta($post->ID,'GB_model-base-kit',true);
										$terms = get_the_terms( $basekitId, 'manufacturer'); 
										
										foreach($terms as $term){ ?>
											<li class="gb-post-meta-manufacturer"><a href="<?php echo(get_term_link( $term->slug, 'manufacturer' )) ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $term->name; ?>" ><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo-manufacturer-<?php echo $term->slug; ?>.png" /></a></li>
										<?php } 
										$terms = get_the_terms( $basekitId, 'model-types');
										foreach($terms as $term){ ?>
											<li class="gb-post-meta-model-type"><a href="<?php echo(get_term_link( $term->slug, 'model-types' )) ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $term->name; ?>" ><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo-gunpla-kit-type-<?php echo $term->slug; ?>.png" /></a></li>
										<?php } 
										$basemsId = get_post_meta($basekitId,'GB_model-kit-base-ms',true);
										$terms = get_the_terms( $basemsId, 'gundam-series');
										foreach($terms as $term){ ?>
											<li class="gb-post-meta-mobile-suit-series"><a href="<?php echo(get_term_link( $term->slug, 'gundam-series' )) ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $term->name; ?>" ><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo-<?php echo $term->slug; ?>.png" /></a></li>
										<?php } 
										if (get_post_meta($basemsId,'GB_model-kit-detail-wiki-link',true) != ""){ ?>
											<li class="gb-post-meta-wiki-link"><a href="<?php echo get_post_meta($post->ID,'GB_model-kit-detail-wiki-link',true); ?>" data-toggle="tooltip" data-placement="bottom" title="Visit gundam.wikia.com for more info" target="_blank"/><img src="<?php bloginfo('stylesheet_directory'); ?>/images/img-gundam-wiki.png" /></a></li>
										<?php } ?>
										<li class="gb-post-meta-model-scale"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo-gunpla-scale-144.png" /></li>
									   
									</ul>							
								</section>
								
								<section id="gb-post-meta-b" class="col-xs-12 col-sm-5 col-md-5 col-lg-12">
									<p class="gb-post-meta-builder">Model Builder: Admin</p><p class="gb-post-meta-post">Posted By: <?php echo get_the_author();?> | Posted on <?php echo(get_the_date( 'm/d/Y' )); ?></p>
								</section>
								
								<?php
									$thumb = get_post_thumbnail_id();
									$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
									$image = aq_resize( $img_url, 300, 150, true ); //resize & crop the image
								?>
								
								<figure class="gb-post-head-image col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" style="background-image:url(<?php echo($img_url); ?>);">
									
								</figure>
							</header>
							<section class="gb-post-content">                        
								<summary class="lead"><?php the_excerpt(); ?></summary>
								
								
								<?php 
									$picsbox = get_post_meta($post->ID,'GB_model-kit-pictures-box-cover',false);
									if (!empty($picsbox)){
								?>
								<figure class="gb-post-head-box-art">
									<h2>Boxart</h2>
									<?php foreach($picsbox as $pic){ $img_url = wp_get_attachment_url( $pic,'full' ); ?>
									<img src="<?php echo($img_url); ?>" />
									<?php } ?>
								</figure>
								<?php } ?>
								
								<figure class="gb-post-head-box-art">       
									<h2>CardPic</h2>
									<?php $featimg = wp_get_attachment_image_src( get_post_meta($post->ID,'GB_model-kit-imagick-id',true),'full');?>
									<img src="<?php echo($featimg[0]); ?>" />
								</figure>
								
								<?php the_content(); ?>
								
								<h2>Accessories</h2>
								<ul style="text-align:center;padding:0px;margin:0px;width:100%;" class="">
								<?php 
									$accrs = get_post_meta($post->ID,'GB_model-kit-accessories',false);
									foreach($accrs as $items){
										foreach($items as $item){
											$accrtitle = get_post_field('post_title',$item);
											$accrcont = get_post_field('post_content',$item);
											$accrfimg = get_post_thumbnail_id($item);
											$accrlink = get_permalink($item);
											$img_url = wp_get_attachment_image_src( $accrfimg,'medium' );
											if ($img_url != false){
												echo '<li style="display:inline-block;height:100px;"><a href="'.$accrlink.'" target="_blank" ><img src="'.$img_url[0].'" style="padding:2px;height:100%;width:auto;" data-toggle="tooltip" title="'.$accrtitle.'"/></a></li>';
											}
										}
									}
								
								?>
								</ul>

								<?php 
									$turntable = get_post_meta($post->ID,'GB_model-kit-turntable-show',true);
								?>
								
								<ul class="nav nav-tabs">
								  <li><a href="#gb-builder-verdict-a" data-toggle="tab">Good</a></li>
								  <li><a href="#gb-builder-verdict-b" data-toggle="tab">Bad</a></li>
								  <li class="active"><a href="#gb-builder-gallery" data-toggle="tab">Gallery</a></li>
								  <?php if ( $turntable != 0) echo '<li><a href="#gb-builder-turntable" data-toggle="tab">Turntable</a></li>'; ?>
								</ul>
								

							
								<div class="gb-model-stats tab-content">
								  <div class="tab-pane" id="gb-builder-verdict-a">
									<h3>What so good about this kit?</h3>
									<ul>
										<li>Lorem ipsum dolor isit amet</li>
										<li>Lorem ipsum dolor isit amet</li>
										<li>Lorem ipsum dolor isit amet</li>
										<li>Lorem ipsum dolor isit amet</li>
									</ul>
									<div class="panel panel-default" style="display:none">
										<ul class="list-group">
											<li class="list-group-item">Cras justo odio</li>
											<li class="list-group-item">Dapibus ac facilisis in</li>
											<li class="list-group-item">Morbi leo risus</li>
											<li class="list-group-item">Porta ac consectetur ac</li>
											<li class="list-group-item">Vestibulum at eros</li>
										</ul>
										<div class="panel-heading">Panel heading</div>
										<div class="panel-body">
											<p>Lorem ipsum dolor isit amet adipiscing</p>
										</div>
									</div>
									
								  </div>
								  <div class="tab-pane" id="gb-builder-verdict-b">
									<h3>What so bad about this kit?</h3>
									<ul>
										<li>Lorem ipsum dolor isit amet</li>
										<li>Lorem ipsum dolor isit amet</li>
										<li>Lorem ipsum dolor isit amet</li>
										<li>Lorem ipsum dolor isit amet</li>
									</ul>
								  </div>
								  <div class="tab-pane active" id="gb-builder-gallery">
								  
									<?php 
									$glrypics = get_post_meta($post->ID,'GB_model-pictures-gallery',false);
									//print_r($glrypics);
									if (empty($glrypics)){
										echo '<h3>No pictures have been associated for this model kit yet.</h3>';
									}else{
										foreach($glrypics as $pic){
											$img_url = wp_get_attachment_image_src( $pic,'full' );
											$img_alt = get_post_meta($pic,_wp_attachment_image_alt,true);
											$img_post = get_post( $pic );
											$img_desc = $img_post->post_content;
											$img_data = wp_get_attachment_metadata( $pic );
											$img_loader = get_stylesheet_directory_uri().'/images/loadingx.gif';
											echo '<figure class="glrypic">';
											echo '<div class="lazyload">';
											//echo '<!--';
											echo '<img src="'.$img_url[0].'" />';
											//echo '-->';
											echo '</div>';
											if ($img_desc != '')  echo('<p>'.$img_desc.'</p>');
											echo '</figure>';
										}
									} ?>
								  </div>
								  <?php if ( $turntable != 0) : ?>
								  <div class="tab-pane" id="gb-builder-turntable">
											<?php
											$trntbl[0] = wp_get_attachment_url(get_post_meta($post->ID,'GB_model-kit-turntable-frame-first',true),'full');
											$trntbl[1] = basename(wp_get_attachment_url(get_post_meta($post->ID,'GB_model-kit-turntable-sprite',true),'full'));
											$trntbl[2] = get_post_meta($post->ID,'GB_model-kit-turntable-frame-width',true);
											$trntbl[3] = get_post_meta($post->ID,'GB_model-kit-turntable-frame-height',true);
											$trntbl[4] = get_post_meta($post->ID,'GB_model-kit-turntable-frame-total',true);
											$trntbl[5] = get_post_meta($post->ID,'GB_model-kit-turntable-frame-start',true);
											$trntbl[6] = get_post_meta($post->ID,'GB_model-kit-turntable-line-length',true);
											$trntbl[7] = get_post_meta($post->ID,'GB_model-kit-turntable-speed',true);
											$path = dirname(wp_get_attachment_url(get_post_meta($post->ID,'GB_model-kit-turntable-sprite',true),'full'));
											echo '<img style="text-align:center;" src="'.$trntbl[0].'" width="'.$trntbl[2].'" height="'.$trntbl[3].'" class="reel" data-ratio="1" data-path="'.$path.'/" data-image="'.$trntbl[1].'" data-frames="'.$trntbl[4].'" data-frame="'.$trntbl[5].'" data-footage="'.$trntbl[6].'" data-speed="'.$trntbl[7].'" data-throwable="1.2" data-brake="0.2" data-responsive="TRUE" data-shy="true"/>';
											?>
								  </div>
								  <?php endif; ?>
								</div>
							   
								
							</section><!--- post content --->
							
							
							<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'gndmbldr' ),
								'after'  => '</div>',
							) );
							?>
							
							<footer class="entry-meta">
								<?php
									/* translators: used between list items, there is a space after the comma */
									$category_list = get_the_category_list( __( ', ', 'gndmbldr' ) );

									/* translators: used between list items, there is a space after the comma */
									$tag_list = get_the_tag_list( '<span class="label label-default" style="margin:0px 1px;color:#fff;">', '</span><span class="label label-default" style="margin:0px 1px;color:#fff;">','</span>' );

									if ( ! gndmbldr_categorized_blog() ) {
										// This blog only has 1 category so we just need to worry about tags in the meta text
										if ( '' != $tag_list ) {
											$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'gndmbldr' );
										} else {
											$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'gndmbldr' );
										}

									} else {
										// But this blog has loads of categories so we should probably display them here
										if ( '' != $tag_list ) {
											$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'gndmbldr' );
										} else {
											$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'gndmbldr' );
										}

									} // end check for categories on this blog

									printf(
										$meta_text,
										$category_list,
										$tag_list,
										get_permalink(),
										the_title_attribute( 'echo=0' )
									);
								?>

								<?php edit_post_link( __( 'Edit', 'gndmbldr' ), '<span class="edit-link">', '</span>' ); ?>
							</footer><!-- .entry-meta -->
						</article>
						
						<!--- CONTENT AREA END ---->
			
			
                        <?php gndmbldr_content_nav( 'nav-below' ); ?>
            
                        <?php
                            // If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() )
                                comments_template();
                        ?>
            
                    <?php endwhile; // end of the loop. ?>


                        
					</div><!--- main content --->
					
				</div><!-- row --->
			</div><!--- gb-content-area --->
		</div><!--- gb-page --->
		

<?php
get_sidebar();
get_footer();


