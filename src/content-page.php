<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package gndmbldr
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="cell-block">
    <header class="row">
        <section class="gb-post-title col-xs-12 col-sm-12 col-md-12 col-lg-8" style="">
            <h1 style="display:inline;font-size:42px;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>		
        </section>
    </header>
    <section class="gb-post-content">      
    	<!--                  
        <h1>Bootstrap starter template</h1>
        <summary class="lead"><?php the_excerpt(); ?></summary>
        
        <figure class="gb-post-head-box-art">
            <h2>Boxart</h2>
            <img src="images/boxart-hg-heavyarms-custom.jpg" />
        </figure>-->
        
        <?php the_content(); ?>
      
      
      	<!--  
        <div class="gb-page-404">
            <h1 class="page-title">Oops! That page can&rsquo;t be found.</h1>
            <p>It looks like nothing was found at this location. Maybe try one of the links below or a search?</p>
        </div><!-- page 404 -->
        
    </section><!--- post content --->
    
    
		<?php
        wp_link_pages( array(
            'before' => '<div class="page-links">' . __( 'Pages:', 'gndmbldr' ),
            'after'  => '</div>',
        ) );
    ?>
    
    <footer class="entry-meta">
        <?php edit_post_link( __( 'Edit', 'gndmbldr' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-meta -->
</article>

