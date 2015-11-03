<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package gndmbldr
 */
?>
		<section class="gb-sidebar">
			<div id="secondary" class="widget-area container-fluid" role="complementary">
				<div style="float:left;width:100%;padding-bottom:20px;">
					<div class="gb-search-sidebar input-group" style="display:none;">
					  <input type="text" class="form-control">
					  <span class="input-group-btn">
						<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
					  </span>
					</div><!-- /input-group -->
		
					
					<form role="search" method="get" class="search-form" action="<?php bloginfo('home'); ?>">
						<div class="gb-sidebar-search input-group">
						  <input class="search-field form-control" placeholder="Search …" value="<?php the_search_query(); ?>" name="s" title="Search for:" type="search">
						  <div class="input-group-btn">
							<button id="search-button" type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
							<input id="search-submit" class="search-submit btn btn-default" value="Search" type="submit">
							<input id="hidden" type="hidden" value="model" name="post_type">


							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1">
							  <span class="caret"></span>
							  <span class="sr-only">Toggle Dropdown</span>
							</button>

							<ul class="dropdown-menu pull-right" role="menu">
							  <li><a href="#">Site</a></li>
							  <li><a href="#">Model Kits</a></li>
							  <li><a href="#">Tutorials</a></li>
							  <li><a href="#">Articles</a></li>
							  <li class="divider"></li>
							  <li><a href="#">Separated link</a></li>
							</ul>
						  </div>
						</div>
					</form>
					

					<!---
					<form role="search" method="get" id="searchformx" action="<?php bloginfo('home'); ?>">
					  <div>
						<input type="text" value="" name="s" id="s" /> 

					<?php
					function get_terms_dropdown($taxonomies, $args){
						$myterms = get_terms($taxonomies, $args);
						$optionname = "optionname";
						$emptyvalue = "";
						$output ="<select name='".$optionname."'><option selected='".$selected."' value='".$emptyvalue."'>Select a Category</option>'";

						foreach($myterms as $term){
							$term_taxonomy=$term->gundam-series; //CHANGE ME
							$term_slug=$term->slug;
							$term_name =$term->name;
							$link = $term_slug;
							$output .="<option name='".$link."' value='".$link."'>".$term_name."</option>";
						}
						$output .="</select>";
					return $output;
					}

					$taxonomies = array('gundam-series'); // CHANGE ME
					$args = array('order'=>'ASC','hide_empty'=>true);
					echo get_terms_dropdown($taxonomies, $args);

					?>

					<input type="submit" id="searchsubmit" value="Search" />
					</div>
					</form>
					
					--->
					
				</div>
				
					<script type="text/javascript">
							/*
							jQuery('input#search-submit').click(function(){
								alert('test');
							});*/
							
							jQuery('.gb-sidebar-search .dropdown-menu li a').click(function(){
								//alert('waa');
								var optName = jQuery(this).text();
								jQuery('.gb-sidebar-search #search-submit').val(optName);
								jQuery('.gb-sidebar-search #hidden').val(optName);
							});
							
							jQuery('#search-button').on('click',function(){
								jQuery('#search-submit').trigger('click');
							});
							
					</script>
				
				
				<aside class="widget gb-sidebar-model-types-links">
					<h2 class="widget-title">Model Types</h2>
					<ul>
					<?php
						$mtypes = get_terms("model-types","orderby=id&hide_empty=1&parent=0");
						//print_r($mtypes);
						foreach($mtypes as $term){
							//$term_taxonomy=$term->gundam-series; //CHANGE ME
							
							$term = sanitize_term( $term, 'model-types' );
							$term_link = get_term_link( $term, 'model-types' );
							$term_slug=$term->slug;
							$term_name =$term->name;
							$img = get_stylesheet_directory_uri().'/images/logo-gunpla-kit-type-'.$term_slug.'.png';
							echo "<li style='float:left;padding:5px;'><a href='".$term_link."'><img src='".$img."' title='".$term_name."' width='54'/></a></li>";
						}
					?>
					</ul>
				</aside>
				
				
				
                <div class="gb-sidebar-featured-kits">
                	<h2>Featured Models</h2>
                    <ul style="list-style:none;padding:0px;margin:0px;">
                    	<?php 
							$temp = $wp_query;
							$wp_query= null;
		
							$args = array(
								'post_type' => 'model',
								'tax_query' => array(
									'relation' => 'AND',
									array(
										'taxonomy' => 'category',
										'field' => 'slug',
										'terms' => 'featured'
									)
								),
								'showposts'=>4
							);
							$wp_query = new WP_Query( $args );
							
							
						?>
                        <?php if (have_posts()):?>
                        	<?php while ($wp_query->have_posts()) : $wp_query->the_post(); 
								$featimg = wp_get_attachment_image_src( get_post_meta($post->ID,'GB_model-kit-imagick-id',true),'sidebar-half-thumb');								
							?>
                            <li id="feat-kit-<?php echo($post->ID); ?>" style="float:left;padding:5px;">
                                <a href="<?php echo(get_permalink($post->ID)); ?>" target="_blank">
                                <figure>
                                	<img src="<?php echo($featimg[0]); ?>" width="150" height="84" />
                                </figure>
                                </a>
                            </li> 
                        	<?php endwhile; ?>
                        <?php endif; ?>
                        <?php $wp_query = null; $wp_query = $temp;?>
                    </ul>
                </div>
				<div style="clear:both;"></div>
                <hr />
                <div class="widget gb-sidebar-ads">
                	<ul>
						<li style="padding:10px;background:#fff;">
							<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
							<!-- gundambuilder-sidebar-300x250 -->
							<ins class="adsbygoogle"
								 style="display:inline-block;width:300px;height:250px"
								 data-ad-client="ca-pub-0525167998828307"
								 data-ad-slot="4405839419"></ins>
							<script>
							(adsbygoogle = window.adsbygoogle || []).push({});
							</script>
						</li>
						<li>
							<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
							<!-- gundambuilder-sidebar-320x50 -->
							<ins class="adsbygoogle"
								 style="display:inline-block;width:320px;height:50px"
								 data-ad-client="ca-pub-0525167998828307"
								 data-ad-slot="2104201016"></ins>
							<script>
							(adsbygoogle = window.adsbygoogle || []).push({});
							</script>
						</li>
                    </ul>
                </div>
				
				
				
				<!--
				<aside id="archives-2" class="widget widget_archive">
					<h2 class="widget-title">Archives</h2>	
					<ul>
						<li><a href="#">December 2013</a></li>
						<li><a href="#">November 2013</a></li>
						<li><a href="#">October 2013</a></li>
						<li><a href="#">September 2013</a></li>
						<li><a href="#">August 2013</a></li>
					</ul>
				</aside>
                -->
                <?php do_action( 'before_sidebar' ); ?>
				<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
        
                <?php endif; // end sidebar widget area ?>
                <?php //get_template_part( 'sponsors' ); ?>
			</div>
		</section><!--- /GB-SIDEBAR ---->