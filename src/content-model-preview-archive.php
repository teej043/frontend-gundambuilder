<?php
/**
* @package gndmbldr
*/

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('col-sm-12 col-md-6'); ?> >
  <div class="container-fluid gb-post-container content-model-preview content-preview content-preview--model">
    <header class="row gb-post-heading">
      <section class="gb-post-title col-xs-12 col-sm-12 col-md-12 col-lg-12" style="">
        <h2 style="display:block;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <span style="font-family:Norwester,Helvetica,Arial,sans-serif;font-size:14px;color:#aaa;"><?php echo(get_post_meta($post->ID,'GB_model-kit-detail-code-name',true));?> <?php echo(get_post_meta($post->ID,'GB_model-kit-detail-alias',true));?></span>
      </section>
    </header>
    <?php
		$type = $post->post_type;
		$thumb = get_post_thumbnail_id();
		switch($type){
			case "model-kit": $img_url = wp_get_attachment_image_src( $thumb,'medium' );break;
			default: $img_url = wp_get_attachment_image_src( $thumb,'homepage-preview-thumb' );break;
		}
		$image = aq_resize( $img_url[0], 300, 150, true ); //resize & crop the image
		if (isset($img_url)){
	?>

	<?php if ($type == "mobile-suit"){ ?>
    			<figure class="gb-mobile-suit-art loading">
  					<img class="b-lazy" data-src="<?php echo($img_url[0]); ?>" src="http://placehold.it/200x150&text=placeholder"/>
            <div class="spinner">
              <div class="bounce1"></div>
              <div class="bounce2"></div>
              <div class="bounce3"></div>
            </div>

		<?php }else{ ?>

				<figure class="gb-model-kit-boxart b-lazy" data-src="<?php echo($img_url[0]); ?>" src="http://placehold.it/200x150&text=placeholder" style="background-image:url(http://placehold.it/200x150&text=placeholder);">
          <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
          </div>

		<?php } ?>


        	<?php
			if ($post->post_type == 'mobile-suit'):
				/*
				$args = array(
					'orderby'          => 'post_date',
					'order'            => 'DESC',
					'meta_key'         => 'GB_model-kit-base-ms',
					'meta_value'       => $post->ID,
					'post_type'        => model-kit,
					'post_status'      => 'publish',
				);

				$models = get_posts($args);
				print_r($models);

				foreach($models as $model){
					echo '<a href="'.get_permalink($model->ID).'">'.$model->post_title.'</a>';
				}
				*/


				$msid = ($post->ID);
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
        <div class="kits-bar kits-bar--vertical">
  				<ul class="kits">
  					<?php while ($wp_query->have_posts()) : $wp_query->the_post();
  						//$featimg = wp_get_attachment_image_src( get_post_meta($post->ID,'GB_model-kit-imagick-id',true),'medium');

  						$thumb = get_post_thumbnail_id();
  						$img_url = wp_get_attachment_image_src( $thumb,'medium' );

  						if($img_url == false){
  							$img_url[0]=get_stylesheet_directory_uri().'/images/logo-ms-unknown.png';
  						}
  					?>
  					<li class="kit" id="rel-mkit-<?php echo($post->ID); ?>"><a href="<?php echo get_permalink($post->ID); ?>"><img src="<?php echo($img_url[0]); ?>" title="<?php echo($post->post_title); ?>" /></a></li>
  					<?php endwhile; ?>
  				</ul>

        </div>
        <div class="indicator-down">&#128315;</div>
				<?php endif; ?>
				<?php $wp_query = null; $wp_query = $temp;

			endif;
		?>

		</figure>
    <?php } ?>



    <section class="gb-post-content">
    <!--- <summary class="lead"><?php the_excerpt(); ?></summary>---->




    </section>
    <!--- post content --->
    <footer class="entry-meta">
      <?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
      <?php  /* translators: used between list items, there is a space after the comma */
	  	$categories_list = get_the_category_list( __( ', ', 'gndmbldr' ) );
		if ( $categories_list && gndmbldr_categorized_blog() ) : ?>
      		<span class="cat-links"> <?php printf( __( 'Posted in %1$s', 'gndmbldr' ), $categories_list ); ?> </span>
      <?php endif; // End if categories ?>
      <?php                    /* translators: used between list items, there is a space after the comma */
	  	$tags_list = get_the_tag_list( '', __( ', ', 'gndmbldr' ) );
		if ( $tags_list ) :  ?>
      	<span class="tags-links"> <?php printf( __( 'Tagged %1$s', 'gndmbldr' ), $tags_list ); ?> </span>
      <?php endif; // End if $tags_list ?>
      <?php endif; // End if 'post' == get_post_type() ?>
      <?php edit_post_link( __( 'Edit', 'gndmbldr' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-meta -->
   </div><!-- container --->
 </article>
