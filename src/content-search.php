<?php
/**
 * @package gndmbldr
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="row">
        <section class="gb-post-title col-xs-12 col-sm-12 col-md-12 col-lg-12" style="">
            <h1 style="display:inline;font-size:42px;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></br><small>Secondary text</small></a></h1>		
        </section>
		<section id="gb-post-meta-b" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!--<p class="gb-post-meta-builder">Model Builder: Admin</p><p class="gb-post-meta-post">Posted By: Admin | Posted on 10/10/10</p>-->
            <?php if ( 'post' == get_post_type() ) : ?>
				<?php gndmbldr_posted_on(); ?>
            <?php endif; ?>
        </section>
    </header>
    <section class="gb-post-content">      
        <summary class="lead"><?php the_excerpt(); ?></summary>
    </section><!--- post content --->
    
  	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'gndmbldr' ) );
				if ( $categories_list && gndmbldr_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'gndmbldr' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'gndmbldr' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'gndmbldr' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'gndmbldr' ), __( '1 Comment', 'gndmbldr' ), __( '% Comments', 'gndmbldr' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'gndmbldr' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article>




<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php gndmbldr_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->


	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'gndmbldr' ) );
				if ( $categories_list && gndmbldr_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'gndmbldr' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'gndmbldr' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'gndmbldr' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'gndmbldr' ), __( '1 Comment', 'gndmbldr' ), __( '% Comments', 'gndmbldr' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'gndmbldr' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
