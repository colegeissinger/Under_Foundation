<?php
	/**
	 * Custom template tags for this theme.
	 *
	 * Eventually, some of the functionality here could be replaced by core features
	 *
	 * @package Under_Foundation
	 * @author Cole Geissinger <cole@colegeissinger.com>
	 *
	 * @version 0.1
	 * @since   0.1
	 */

	/**
	 * Display navigation to next/previous pages when applicable
	 * @param  String $nav_id The ID to add to the nav tag
	 * @return Void
	 *
	 * @version 0.1
	 * @since   0.1
	 */
	if ( ! function_exists( 'under_foundation_content_nav' ) ) :
		function under_foundation_content_nav( $nav_id ) {

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

			$nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging'; ?>
			<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
				<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'under_foundation' ); ?></h1>

				<?php
					if ( is_single() ) : // navigation links for single posts

						previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'under_foundation' ) . '</span> %title' );
						next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'under_foundation' ) . '</span>' );

					elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages

						if ( get_next_posts_link() ) : ?>
							<div class="nav-previous">
								<?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'under_foundation' ) ); ?>
							</div>
						<?php endif;

						if ( get_previous_posts_link() ) : ?>
							<div class="nav-next">
								<?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'under_foundation' ) ); ?>
							</div>
						<?php endif;

					endif;
				?>

			</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
		<?php }
	endif; // under_foundation_content_nav


	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 * @param  String $comment The comment to be passed through
	 * @param  Array  $args    The arguments
	 * @param  [type] $depth   [description]
	 * @return Mixed
	 *
	 * @version 0.1
	 * @since   0.1
	 */
	if ( ! function_exists( 'under_foundation_comment' ) ) :
		function under_foundation_comment( $comment, $args, $depth ) {
			$GLOBALS['comment'] = $comment;

			if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

				<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
					<div class="comment-body">
						<?php _e( 'Pingback:', 'under_foundation' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'under_foundation' ), '<span class="edit-link">', '</span>' ); ?>
					</div>

			<?php else : ?>

				<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
					<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
						<footer class="comment-meta">
							<div class="comment-author vcard">
								<?php if ( 0 != $args['avatar_size'] )
									echo get_avatar( $comment, $args['avatar_size'] ); ?>
								<?php printf( __( '%s <span class="says">says:</span>', 'under_foundation' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
							</div><!-- .comment-author -->

							<div class="comment-metadata">
								<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
									<time datetime="<?php comment_time( 'c' ); ?>">
										<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'under_foundation' ), get_comment_date(), get_comment_time() ); ?>
									</time>
								</a>
								<?php edit_comment_link( __( 'Edit', 'under_foundation' ), '<span class="edit-link">', '</span>' ); ?>
							</div><!-- .comment-metadata -->

							<?php if ( '0' == $comment->comment_approved ) : ?>
								<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'under_foundation' ); ?></p>
							<?php endif; ?>
						</footer><!-- .comment-meta -->

						<div class="comment-content">
							<?php comment_text(); ?>
						</div><!-- .comment-content -->

						<div class="reply">
							<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div><!-- .reply -->
					</article><!-- .comment-body -->

			<?php endif;
		}
	endif;


	/**
	 * Prints the attached image with a link to the next attached image.
	 * @return void
	 *
	 * @version 0.1
	 * @since   0.1
	 */
	if ( ! function_exists( 'under_foundation_the_attached_image' ) ) :
		function under_foundation_the_attached_image() {
			$post                = get_post();
			$attachment_size     = apply_filters( 'under_foundation_attachment_size', array( 1200, 1200 ) );
			$next_attachment_url = wp_get_attachment_url();

			/**
			 * Grab the IDs of all the image attachments in a gallery so we can get the URL
			 * of the next adjacent image in a gallery, or the first image (if we're
			 * looking at the last image in a gallery), or, in a gallery of one, just the
			 * link to that image file.
			 */
			$attachments = array_values( get_children( array(
				'post_parent'    => $post->post_parent,
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => 'ASC',
				'orderby'        => 'menu_order ID'
			) ) );


			// If there is more than 1 attachment in a gallery...
			if ( count( $attachments ) > 1 ) {
				foreach ( $attachments as $k => $attachment ) {
					if ( $attachment->ID == $post->ID )
						break;
				}
				$k++;

				// get the URL of the next image attachment...
				if ( isset( $attachments[ $k ] ) ) {
					$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );

				// or get the URL of the first image attachment.
				} else {
					$next_attachment_url = get_attachment_link( $attachments[0]->ID );
				}
			}

			printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>', esc_url( $next_attachment_url ),the_title_attribute( array( 'echo' => false ) ), wp_get_attachment_image( $post->ID, $attachment_size ) );
		}
	endif;

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 * @return void
	 *
	 * @version 0.1
	 * @since   0.1
	 */
	if ( ! function_exists( 'under_foundation_posted_on' ) ) :
		function under_foundation_posted_on() {
			printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'under_foundation' ),
				esc_url( get_permalink() ),
				esc_attr( get_the_time() ),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'under_foundation' ), get_the_author() ) ),
				get_the_author()
			);
		}
	endif;

	/**
	 * Returns true if a blog has more than 1 category
	 * @return Boolean
	 *
	 * @version 0.1
	 * @since   0.1
	 */
	function under_foundation_categorized_blog() {
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
			// This blog has more than 1 category so under_foundation_categorized_blog should return true
			return true;
		} else {
			// This blog has only 1 category so under_foundation_categorized_blog should return false
			return false;
		}
	}

	/**
	 * Flush out the transients used in under_foundation_categorized_blog
	 * @return void
	 *
	 * @version 0.1
	 * @since   0.1
	 */
	function under_foundation_category_transient_flusher() {
		// Like, beat it. Dig?
		delete_transient( 'all_the_cool_cats' );
	}
	add_action( 'edit_category', 'under_foundation_category_transient_flusher' );
	add_action( 'save_post',     'under_foundation_category_transient_flusher' );
