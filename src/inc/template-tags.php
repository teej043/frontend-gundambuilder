<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package gndmbldr
 */

if ( ! function_exists( 'gndmbldr_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function gndmbldr_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'gndmbldr' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'gndmbldr' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'gndmbldr' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'gndmbldr' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'gndmbldr' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // gndmbldr_content_nav


if ( ! function_exists( 'gndmbldr_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function gndmbldr_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'gndmbldr' ); ?> <?php comment_author_link(); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-avatar">
				<?php echo get_avatar( $comment, 65 ); ?>
			</div><!-- .comment-avatar -->
			<div class="comment-content"><?php comment_text(); ?></div>
			<footer>
				<div class="comment-author vcard">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
					<?php 
					// Older than a week, show date; otherwise show __ time ago.
					if ( current_time( 'timestamp' ) - get_comment_time( 'U' ) > 604800 ) {
						$time = sprintf( _x( '%1$s at %2$s', '1: date, 2: time', 'gndmbldr' ), get_comment_date(), get_comment_time() );
					} else {
						$time = sprintf( __( '%1$s ago', 'gndmbldr' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) );
					}
					printf(
						__( 'posted %1$s by %2$s', 'gndmbldr' ), 
						'<time datetime="'. get_comment_time( 'c' ) .'">'. $time .'</time>',
						sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) 
					); ?>
					</a>
					<?php
						if ( $comment->comment_parent ) {
							printf(
								'<a href="%1$s">%2$s</a>',
								esc_url( get_comment_link( $comment->comment_parent ) ),
								sprintf( __( 'in reply to %s', 'gndmbldr' ), get_comment_author( $comment->comment_parent ) )
							);
						}
						comment_reply_link( array_merge( $args, array(
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<span class="alignright">',
							'after'     => '</span>',
						) ) );
					?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'gndmbldr' ); ?></em>
				<?php endif; ?>
			</footer>
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for gndmbldr_comment()





if ( ! function_exists( 'gndmbldr_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 */
function gndmbldr_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'gndmbldr_attachment_size', array( 1200, 1200 ) );
	$next_attachment_url = wp_get_attachment_url();

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the
	 * URL of the next adjacent image in a gallery, or the first image (if
	 * we're looking at the last image in a gallery), or, in a gallery of one,
	 * just the link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'gndmbldr_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function gndmbldr_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) )
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'gndmbldr' ),
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'gndmbldr' ), get_the_author() ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category
 */
function gndmbldr_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so gndmbldr_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so gndmbldr_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in gndmbldr_categorized_blog
 */
function gndmbldr_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'gndmbldr_category_transient_flusher' );
add_action( 'save_post',     'gndmbldr_category_transient_flusher' );
