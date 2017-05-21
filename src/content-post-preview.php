<?php
/**
 * @package gndmbldr
 * Content POST Preview
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
    <header class="row template-content-post-preview">
        <section class="gb-post-title col-xs-12 col-sm-12 col-md-12 col-lg-12" style="">
            <h1 style="display:inline;font-size:42px;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        </section>


        <section id="gb-post-meta-b" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p class="gb-post-meta-post" style="float:left;text-align:left;">Posted By: <?php echo get_the_author(); ?> | Posted on <?php echo get_the_date(); ?></p>
        </section>

        <?php
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_image_src( $thumb, 'large' ); //get full URL to image (use "large" or "medium" if the images too big)
			//$image = aq_resize( $img_url, 300, 150, true ); //resize & crop the image
      $hasExcerpt = has_excerpt( $post->ID);
      $hasContent = (($post->post_content) == "" ? 0 : 1);
      $hasThumb = has_post_thumbnail($post->ID);

		?>

		<?php
			if ($hasThumb && $hasContent){
		?>

        <figure class="gb-post-head-image col-xs-12 col-sm-7 col-md-12 col-lg-7 text-center b-lazy" data-src="<?php echo($img_url[0]); ?>" src="http://placehold.it/500x250&text=placeholder" style="">
          <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
          </div>
        </figure>

		<summary class="lead col-xs-12 col-sm-5 col-md-12 col-lg-5"><?php the_excerpt(); ?></summary>
    <?php
  }else if ($hasThumb==1 && $hasContent==0){
    ?>

      <figure class="gb-post-head-image col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center b-lazy" data-src="<?php echo($img_url[0]); ?>" src="http://placehold.it/500x250&text=placeholder" style="">
        <div class="spinner">
          <div class="bounce1"></div>
          <div class="bounce2"></div>
          <div class="bounce3"></div>
        </div>
      </figure>

  <summary class="lead col-xs-12 col-sm-5 col-md-12 col-lg-5"><?php the_excerpt(); ?></summary>


		<?php } else if ($hasThumb==0 && $hasContent==1) { ?>

			<summary class="lead col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php the_excerpt(); ?></summary>

		<?php } ?>

    </header>
    <section class="gb-post-content">

    </section><!--- post content --->


    <footer class="entry-meta">
		<?php
            /* translators: used between list items, there is a space after the comma */
            $category_list = get_the_category_list( __( ', ', 'gndmbldr' ) );

            /* translators: used between list items, there is a space after the comma */
            $tag_list = get_the_tag_list( '', __( ', ', 'gndmbldr' ) );

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
