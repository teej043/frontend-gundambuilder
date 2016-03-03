<?php
/**
 * @package gndmbldr
 * Template for showing videos
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="row template-content-standard">
        <section class="gb-post-title col-xs-12 col-sm-12 col-md-12 col-lg-12" style="">
            <h1 style="display:inline;font-size:42px;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></br><small><?php if (get_post_meta($post->ID,'GB_model-kit-detail-code-name',true) != "" ) echo get_post_meta($post->ID,'GB_model-kit-detail-code-name',true); ?></small></a></h1>
        </section>

        <section id="gb-post-meta-b" class="col-xs-12 col-sm-5 col-md-5 col-lg-12">
            <p class="gb-post-meta-post" style="float:left;text-align:left;">By: <?php the_author(); ?><br>on <?php the_time('jS F Y') ?></p>
        </section>

        <?php
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
			$image = aq_resize( $img_url, 300, 150, true ); //resize & crop the image
		?>

    </header>
    <section class="gb-post-content template-content-standard">
        <summary class="lead hide"><?php the_excerpt(); ?></summary>

        <?php the_content(); ?>


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
