<?php
/*
Template Name: Model Submit
*/

get_header();


/* Create temporary post 'draft'*/

$pargs = array(
	'post_content' => 'temporary draft post '.date('Y-m-d'),
	'post_name' => 'temporary draft name',
	'post_title' => 'temporary title',
	'post_status' => 'draft',
	'post_type' => 'model'

);

$pid = wp_insert_post($pargs);

?>

	<main class="gb-main container-fluid template-model-submit">
		<div class="gb-page row">
			<aside class="gb-aside-nav col-xs-12 col-sm-2 col-md-12 col-lg-2 visible-sm visible-md visible-lg" style="background:#fff;">
				<div class="row">
					<nav class="col-md-12 col-lg-12" style="background:#fff;">
						<div id="toggle-show-series">Show Mobile Suit Series <span class="caret"></span></div>
						<ul class="gb-nav-cat">
							<?php
							$mslist = gb_ms_series_list(); ?>
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
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="row template-content-single-model">
								<section class="gb-post-title col-xs-12 col-sm-12 col-md-12 col-lg-12" style="">
									<h1 style="display:inline;font-size:42px;"><?php the_title(); ?></h1>
								</section>
							</header>

							<section class="gb-post-content">
								<?php
								$thecontent = apply_filters( 'the_content', $post->post_content );
								$thecontent = str_replace( ']]>', ']]&gt;', $thecontent );
								echo($thecontent);
								?>

								<form>
									<div class="panel-group">
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
													<a href="#form-group-model-kit-details" style="display:block;" >
														Gundam Model
													</a>
												</h4>
											</div>
											<div id="form-group-model-kit-details">
												<div class="form-horizontal panel-body">
													<div class="form-group" style="border-bottom: 1px solid #ccc;">
														<label for="single" class="col-sm-4 col-lg-2 control-label"><span class="glyphicon glyphicon-info-sign" data-container="body" data-toggle="popover" data-content="You must primarily choose the Mobile Suit Gundam model first. If your model does not exist yet then leave this field blank and fill the appropriate fields below.">&nbsp;</span>Select Model</label>
														<div class="col-sm-8 col-lg-10">
														  <select id="ms-select" name="gb-ms" class="select2 input-full">
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
																<option value="<?php echo($post->post_title) ?>" data-wikilink="<?php echo get_post_meta($post->ID,'GB_model-kit-detail-wiki-link',true); ?>" data-alias="<?php echo get_post_meta($post->ID,'GB_model-kit-detail-alias',true); ?>" data-codename="<?php echo get_post_meta($post->ID,'GB_model-kit-detail-code-name',true); ?>"><?php echo($post->post_title) ?></option>
															<?php
															endwhile;
															endif;
															$wp_query = null;
															$wp_query = $temp;?>
														  </select>
														</div>
														<p class="col-sm-offset-4 col-sm-8 col-lg-offset-2 col-lg-10" style="padding-top:15px;">Note: You should select the gundam model first if it already exists on this site so relevant fields below will be automatically filled, if there's no existing model please leave this field blank (by clicking the 'x' icon on the far right) and continue filling the form the usual.</p>
													</div>




													<div class="form-group">
														<label for="model-code" class="col-sm-4 col-lg-2 control-label"><span class="glyphicon glyphicon-info-sign" data-container="body" data-toggle="popover" data-content="Specify the code name of the Mobile Suit e.g. ZGMF-2000, you can easily find this information on the web searches.">&nbsp;</span>Model Code</label>
														<div class="col-sm-8 col-lg-10">
															<input type="text" class="form-control" id="model-code" name="model-code" placeholder="e.g. ZGMF-2000">
														</div>
													</div>
													<div class="form-group">
														<label for="model-alias" class="col-sm-4 col-lg-2 control-label">Model Alias</label>
														<div class="col-sm-8 col-lg-10">
															<input type="text" class="form-control" id="model-alias" name="model-alias" placeholder="e.g. My Strike Noir Custom">
														</div>
													</div>
													<div class="form-group">
														<label for="model-wikilink" class="col-sm-4 col-lg-2 control-label">Gundam Wiki</label>
														<div class="col-sm-8 col-lg-10">
															<input type="url" class="form-control" id="model-wikilink" name="model-wikilink" placeholder="e.g. http://gundam.wikia.com/wiki/AGE-1_Gundam_AGE-1_Normal">
														</div>
													</div>
                                                    <!--- ms list --->
                                                	<div class="form-group">
														<label for="single" class="col-sm-4 col-lg-2 control-label"><span class="glyphicon glyphicon-info-sign" data-container="body" data-toggle="popover" data-content="Select the series where this Mobile Suit appeared in.">&nbsp;</span>Select Series</label>
														<div class="col-sm-8 col-lg-10">
														  <select multiple id="ms-series-select" name="gb-ms-series" class="select2 input-full">
															<option></option>
                                                            <?php
															foreach ( $mslist as $term ) {
																// Sanitize the term, since we will be displaying it.
																$term = sanitize_term( $term, 'gundam-series' );
																$term_link = get_term_link( $term, 'gundam-series' );
																// If there was an error, continue to the next term.
																if ( is_wp_error( $term_link ) ) {
																	continue;
																} ?>
																<option value="<?php echo($term->slug) ?>" data-image="" ><?php echo($term->name) ?></option>
															<?php } ?>
														  </select>
														</div>
													</div>

													<div class="form-group">
														<div class="col-sm-offset-4 col-sm-8 col-lg-offset-2 col-lg-10">
															<div class="checkbox">
																<label>
																	<input type="checkbox"> Remember me
																</label>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
													<a href="#form-group-model-kit-photos" style="display:block;">
														Model Kit Photos
													</a>
												</h4>
											</div>
											<div id="form-group-model-kit-photos">
												<div class="form-horizontal panel-body">
                                                	<!--
                                                	<div class="form-group">
														<label for="model-name" class="col-sm-4 col-lg-2 control-label"><span class="glyphicon glyphicon-info-sign" data-container="body" data-toggle="popover" data-content="Enter the name of the Mobile Suit.">&nbsp;</span>Model Name</label>
														<div class="col-sm-8 col-lg-10">
															<input type="text" class="form-control" id="model-name" name="model-name" placeholder="e.g. Strike Noir" autofocus>
														</div>

													</div>
                                                    -->
                                                	<div class="form-group">
                                                    	<label for="gb-options" class="col-sm-4 col-lg-2 control-label"><span class="glyphicon glyphicon-info-sign" data-container="body" data-toggle="popover" data-content="Select the series where this Mobile Suit appeared in.">&nbsp;</span>Gunpla Scale</label>
                                                        <div class="btn-group col-sm-8 col-lg-10" data-toggle="buttons">
                                                          <label class="btn btn-default">
                                                            <input type="radio" name="gb-options" id="option1" value="option1"> 1/144
                                                          </label>
                                                          <label class="btn btn-default">
                                                            <input type="radio" name="gb-options" id="option2" value="option2"> 1/100
                                                          </label>
                                                          <label class="btn btn-default">
                                                            <input type="radio" name="gb-options" id="option3" value="option3"> 1/48
                                                          </label>
                                                        </div>
                                                    </div>


                                                    <!--- ms list --->
                                                     <?php $kittypes = gb_kit_type_list(); ?>
                                                	<div class="form-group">
														<label for="gb-kit-type-select" class="col-sm-4 col-lg-2 control-label"><span class="glyphicon glyphicon-info-sign" data-container="body" data-toggle="popover" data-content="Select the grade of this gunpla kit.">&nbsp;</span>Gunpla Grade</label>
														<div class="col-sm-8 col-lg-10">
														  <select id="gb-kit-type-select" name="gb-kit-type" class="select2 input-full">
															<option></option>
                                                            <?php
															foreach ( $kittypes as $term ) {
																// Sanitize the term, since we will be displaying it.
																$term = sanitize_term( $term, 'model-types' );
																$term_link = get_term_link( $term, 'model-types' );
																// If there was an error, continue to the next term.
																if ( is_wp_error( $term_link ) ) {
																	continue;
																} ?>
																<option value="<?php echo($term->slug) ?>" data-image="" ><?php echo($term->name) ?></option>
															<?php } ?>
														  </select>
														</div>
													</div>

                                                    <div class="form-group">
                                                    	<label for="desc" class="col-sm-2 control-label">Description</label>
                                                        <div class="col-sm-10">
	                                                    	<textarea id="desc" name="gb-desc" class="form-control" rows="5"></textarea>
                                                        </div>
                                                    </div>

													<div class="form-group">
														<label for="email" class="col-sm-2 control-label">Email</label>
														<div class="col-sm-10">
															<input type="email" class="form-control" id="email" name="gb-email" placeholder="Email">
														</div>
													</div>
													<div class="form-group">
														<label for="pass" class="col-sm-2 control-label">Password</label>
														<div class="col-sm-10">
															<input type="password" class="form-control" id="pass" name="gb-pass" placeholder="Password">
														</div>
													</div>

													<div class="form-group">
														<div class="col-sm-offset-2 col-sm-10">
															<div class="checkbox">
																<label>
																	<input id="rem" name="rem" type="checkbox"> Remember me
																</label>
															</div>
														</div>
													</div>
                                                    <div class="form-group">
                                                    	<div class="col-sm-12">
                                                    		<input name="file" type="file" multiple />
                                                    	</div>
                                                    </div>
                                                    <div class="form-group">
                                                    	<div class="col-sm-12">

                                                        	<div action="<?php echo(get_template_directory_uri() . '/inc/dropzone/upload.php'); ?>" class="dropzone">
                                                            	<input type="hidden" name="myparam1" value="test" />
                                                            </div>
                                                        	<!--<iframe src="http://mytestsite.tk/jquery-file-upload/" frameborder=0 width="100%" height="500" >
                                                            </iframe>-->
                                                        </div>
                                                    </div>


													<div class="form-group">
														<div class="col-sm-offset-2 col-sm-10">
															<button type="submit" class="btn btn-default">Sign in</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
                                    <input type="hidden" name="gb-pid" id="gb-pid" value="<?php echo($pid);?>"  />
								</form>

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
					</div><!--- main content --->

				</div><!-- row --->
			</div><!-- gb-content-area end -->

			<!-- gb-sidebar begin -->
			<?php get_sidebar(); ?>
			<!-- gb-sidebar end -->

		</div><!--- gb-page --->


<?php
get_footer();
