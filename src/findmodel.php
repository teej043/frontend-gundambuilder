<?php
/*
Template Name: TestAjax
*/

get_header(); ?>


	<main class="gb-main container-fluid template-page">
		<div class="gb-page row" style="background:#eee;">
			<aside class="gb-aside-nav col-xs-12 col-sm-2 col-md-12 col-lg-2 visible-sm visible-md visible-lg" style="background:#fff;">
				<div class="row">
					<nav class="col-md-12 col-lg-12" style="background:#fff;">
                    	<div id="toggle-show-series">Show Mobile Suit Series <span class="caret"></span></div>
						<ul class="gb-nav-cat show-half">
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
                    	<div>
                        	<?php the_title(); ?>
                        </div>
                        
						
						
						<form>
							<select id="ms-models" name="q" onchange="showModel(this.value)">
								<option></option>
								<?php 
								$temp = $wp_query;
								$wp_query= null;
								$args = array(
								'post_type' => 'model',
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
								'showposts'=>100
								);
								$wp_query = new WP_Query( $args );
								if (have_posts()):
								while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
								<option value="<?php echo($post->ID) ?>" data-wikilink="<?php echo get_post_meta($post->ID,'GB_model-kit-detail-wiki-link',true); ?>" data-alias="<?php echo get_post_meta($post->ID,'GB_model-kit-detail-alias',true); ?>" data-codename="<?php echo get_post_meta($post->ID,'GB_model-kit-detail-code-name',true); ?>"><?php echo($post->post_title) ?></option>
								<?php 
								endwhile; 
								endif;
								$wp_query = null; 
								$wp_query = $temp;?>
							</select>
						</form>
						<br>
						<div id="txtHint"><b>Person info will be listed here.</b></div>
						
						<script>
						
						function showModel(str) {
							var path;
							path = "<?php echo (get_stylesheet_directory_uri()); ?>";
							if (str=="") {
							document.getElementById("txtHint").innerHTML="";
							return;
							} 
							if (window.XMLHttpRequest) {
							// code for IE7+, Firefox, Chrome, Opera, Safari
							xmlhttp=new XMLHttpRequest();
							} else { // code for IE6, IE5
							xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
							}
							xmlhttp.onreadystatechange=function() {
							if (xmlhttp.readyState==4 && xmlhttp.status==200) {
							  document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
							}
							}
							xmlhttp.open("GET",path+"/getuser.php?q="+str,true);
							xmlhttp.send();
						}
						</script>
						
						
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
			</div><!--- gb-content-area --->
		</div><!--- gb-page --->
		

<?php
get_sidebar();
get_footer();

