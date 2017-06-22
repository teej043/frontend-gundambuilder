<?php
/**
 * The Template for displaying all single mobile suit post
 *
 * @package gndmbldr
 */
get_header(); ?>

	<main class="gb-main container-fluid template-single-mobile-suit">
		<div class="gb-page row">
			<aside class="gb-aside-nav col-xs-12 col-sm-2 col-md-12 col-lg-2 visible-sm visible-md visible-lg" style="background:#fff;">
				<div class="row">
					<nav class="col-md-12 col-lg-12">
						<div id="toggle-show-series">Show Mobile Suit Series <span class="caret"></span></div>
						<ul class="gb-nav-cat">
							<?php gb_ms_series_list(); ?>
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
                    <?php while ( have_posts() ) : the_post(); ?>

						<!--- CONTENT AREA START ---->



						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="row template-content-single-model">
								<section class="gb-post-title col-xs-12 col-sm-12 col-md-12 col-lg-8" style="">
									<h1 style="display:inline;font-size:42px;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></br><small><?php if (get_post_meta($post->ID,'GB_ms-detail-code-name',true) != "" ) echo get_post_meta($post->ID,'GB_ms-detail-code-name',true); ?></small></a></h1>
								</section>

								<section id="gb-post-meta-a" class="col-xs-12 col-sm-7 col-md-7 col-lg-4" style="">
									<ul>
										<?php
										$terms = get_the_terms( $post->ID, 'gundam-series');
										foreach($terms as $term){ ?>
											<li class="gb-post-meta-mobile-suit-series"><a href="<?php echo(get_term_link( $term->slug, 'gundam-series' )) ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $term->name; ?>" ><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo-<?php echo $term->slug; ?>.png" /></a></li>
										<?php }  ?>

									</ul>
								</section>

								<!--
								<section id="gb-post-meta-b" class="col-xs-12 col-sm-5 col-md-5 col-lg-12">
									<p class="gb-post-meta-post">Posted By: <?php echo get_the_author();?> | Posted on <?php echo(get_the_date( 'm/d/Y' )); ?></p>
								</section>
								-->

								<?php
									$thumb = get_post_thumbnail_id();
									$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
									$image = aq_resize( $img_url, 300, 150, true ); //resize & crop the image
								?>

								<figure class="gb-post-head-image col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" style="background-image:url(<?php echo($img_url); ?>);">

								</figure>
							</header>
							<section class="gb-post-content">
								<summary>
										<blockquote style="font-size:15px;min-height:90px;">
										<a style="padding-left:10px;display:block;float:right;width:20%;height:auto;" href="<?php echo get_post_meta($post->ID,'GB_ms-detail-wiki-link',true); ?>" target="_blank"><img style="width:100%;height:auto;" src="<?php bloginfo('stylesheet_directory'); ?>/images/img-gundam-wiki.png" data-toggle="tooltip" data-placement="bottom" title="Visit gundam.wikia.com for more info" /></a>
										<?php if($post->post_excerpt != "") {
											echo $post->post_excerpt.'. <em>Click the gundam wiki logo image on the right for more information.</em>'; }else{
											echo 'I recommend the wiki page at gundam.wikia.com for a vast in-depth information about the mobile suit '.$post->post_title.'. click the gundam wiki logo image on the right to take you there.';
										} ?>
										</blockquote>
								</summary>

								<p style="float:left;">
									<?php $mspict = wp_get_attachment_image_src( get_post_meta($post->ID,'GB_ms-pict',true),'sidebar-half-thumb');
									if (!empty($mspict)) echo'<img class="alignleft" style="padding-right:10px;padding-bottom:10px;" src="'.$mspict[0].'" />'; ?>
									<?php echo(get_the_content()); ?>
								</p>

								<!-- VIDEO --->
								<?php $msvid = get_post_meta($post->ID,'GB_ms-vid',true);
								if ($msvid != ''){?>



								<div style="clear:both;"></div>
								<div class="gb-video gb-video--discreet">
									<div class="gb-video__wrapper">
										<div class="gb-video__player" data-videoid="<?php echo ''.$msvid.'' ?>"></div>
									</div>
									<div class="gb-video__toggler">play</div>	
								</div>
								<?php } ?>

								<style>
									.gb-mobile-suit-genealogy{
										float:left;width:100%;
									}

									.gb-mobile-suit-genealogy .ms-old{
										float:left;padding:0px 10px 10px 10px;
										background:#ccc;
										height:210px;
										position:relative;
										z-index:2;
									}

									.gb-mobile-suit-genealogy .ms-old span.info{
										display:inline-block;
										text-align:center;
										color:#fff;
										height:30px;
										line-height:30px;
										width:100%;
									}

									.gb-mobile-suit-genealogy .ms-old span.arrow{
										position:absolute;
										top:50%;
										margin-top:-10px;
										height:20px;
										line-height:20px;
										color:#ccc;
										right:-10px;
									}

									.gb-mobile-suit-genealogy .ms-old a{
										display:block;
										height:170px;
										text-align: center;
									}

									.gb-mobile-suit-genealogy .ms-old img{
										height:170px;width:auto;margin:0 auto;

									}

									.gb-mobile-suit-genealogy .ms-current{
										float:left;padding:0px 10px;
										z-index:1;

									}

									.gb-mobile-suit-genealogy .ms-current img{
										height:210px;width:auto;
									}


									.gb-mobile-suit-genealogy .ms-new{
										float:left;padding:0px 10px 10px 10px;
										background:#ccc;
										height:210px;
										z-index:2;
										position:relative;
									}

									.gb-mobile-suit-genealogy .ms-new span.info{
										display:inline-block;
										text-align:center;
										color:#fff;
										height:30px;
										line-height:30px;
										width:100%;
									}

									.gb-mobile-suit-genealogy .ms-new ul{
										display:block;
										height:170px;
										list-style:none;
										padding:0px;
										margin:0px;
									}

									.gb-mobile-suit-genealogy .ms-new ul li{
										float:left;padding-right:10px;
									}

									.gb-mobile-suit-genealogy .ms-new ul li img{
										height:170px;width:auto;margin:0 auto;

									}

									.gb-mobile-suit-genealogy .ms-new span.arrow{
										position:absolute;
										top:50%;
										margin-top:-10px;
										height:20px;
										line-height:20px;
										color:#fff;
										left:-5px;
									}
								</style>

                                <div class="gb-mobile-suit-genealogy">
                                	<?php

										$ms_old = array();


										$temp = get_post_meta($post->ID,'GB_model-kit-base-orig-ms',true);
										if (($temp != 0) || ($temp != '')){
											$featimg = wp_get_attachment_image_src( get_post_meta($temp,'GB_ms-pict',true), 'sidebar-half-thumb');
											array_push($ms_old, get_post_field('post_title',$temp), get_permalink($temp), $featimg[0]);
										}

										$msid = ($post->ID);

										//load the related model kits based on this mobile suit
										$temp = $wp_query;
										$wp_query= null;

										$args = array(
											'post_type' => 'mobile-suit',
											'meta_query' => array(
											   array(
												   'key' => 'GB_model-kit-base-orig-ms',
												   'value' => $msid,
												   'compare' => 'LIKE'
												)
											),
											'posts_per_page' => -1
										);

										$wp_query = new WP_Query( $args );

										if (have_posts()):
										$ms_new = true;

										endif;

										?>

										<?php if (($ms_new == true) || (!empty($ms_old))):
											if (!empty($ms_old)) { ?>
											<div class="ms-old">
												<span class="info">Developed From</span>
                                            	<a href="<?php echo($ms_old[1]); ?>"><img src="<?php echo($ms_old[2]);?>" title="<?php echo($ms_old[0]); ?>" /></a>
												<span class="arrow glyphicon glyphicon-play"></span>
                                            </div>
											<?php } ?>
                                            <div class="ms-current">
                                            	<img src="<?php echo($mspict[0]); ?>" />
                                            </div>
                                            <?php
											if (!empty($ms_new)) {
												echo'<div class="ms-new"><span class="info">Developed Into</span><ul>';
												while ($wp_query->have_posts()) : $wp_query->the_post();
													$featimg = wp_get_attachment_image_src( get_post_meta($post->ID,'GB_ms-pict',true),'sidebar-half-thumb'); ?>
												<li>
													<a href="<?php echo(get_permalink($post->ID)); ?>"><img src="<?php echo($featimg[0]);?>" title="<?php echo($post->post_title); ?>" /></a>
												</li>
											<?php
												endwhile;
												echo'<span class="arrow glyphicon glyphicon-play"></span></ul></div>';
											}

										endif; ?>

                                        <?php $wp_query = null; $wp_query = $temp; ?>
                                </div>




							</section><!--- post content --->


							<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'gndmbldr' ),
								'after'  => '</div>',
							) );
							?>

							<hr />
							<section class="list-model-kits">
								<h2>Gunpla Model Kits</h2>
								<?php $msid = ($post->ID); ?>
								<?php
								//load the related model kits based on this mobile suit
								$temp = $wp_query;
								$wp_query= null;

								$args = array(
									'post_type' => model-kit,
									'meta_query' => array(
									   array(
										   'key' => 'GB_model-kit-base-ms',
										   'value' => $msid,
										   'compare' => 'LIKE'
										)
									),
									'posts_per_page' => -1
								);
								//$args = 'post_type=model-kit&meta_key=GB_model-kit-base-ms&meta_value='.$msid;

								$wp_query = new WP_Query( $args );

								//print_r($wp_query);

								if (have_posts()):?>
								<ul style="list-style:none;padding:10px 0px;margin:0px;">
									<?php while ($wp_query->have_posts()) : $wp_query->the_post();
										//$featimg = wp_get_attachment_image_src( get_post_meta($post->ID,'GB_model-kit-imagick-id',true),'medium');

										$thumb = get_post_thumbnail_id();
										$img_url = wp_get_attachment_image_src( $thumb,'medium' );
									?>
									<li id="rel-mkit-<?php echo($post->ID); ?>"><a href="<?php echo get_permalink($post->ID); ?>"><img src="<?php echo($img_url[0]); ?>" title="<?php echo($post->post_title); ?>" /></a></li>
									<?php endwhile; ?>
								</ul>
								<?php else:
									echo 'There are no Model Kits associated for this Mobile Suit as of now';
								endif; ?>
								<?php $wp_query = null; $wp_query = $temp;?>
							</section>


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
			</div><!-- gb-content-area end -->

			<!-- gb-sidebar begin -->
			<?php get_sidebar(); ?>
			<!-- gb-sidebar end -->

		</div><!--- gb-page --->


<?php
get_footer();
