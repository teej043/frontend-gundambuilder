<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package gndmbldr
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="gb-page-title  page-title row">
        <section class="gb-post-title col-xs-12 col-sm-12 col-md-12 col-lg-12" style="">
            <h1 style="display:inline;font-size:42px;"><?php _e( 'Nothing Found', 'gndmbldr' ); ?></h1>		
        </section>
    </header>
    
    <section class="gb-page-content gb-post-content page-content">                        
        <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'gndmbldr' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'gndmbldr' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'gndmbldr' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
    </section><!--- post content --->
    
    
    <footer class="entry-meta">
        <?php edit_post_link( __( 'Edit', 'gndmbldr' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-meta -->
    
</article>
                        

