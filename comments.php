<?php
	/**
	 * The template for displaying Comments.
	 *
	 * The area of the page that contains both current comments
	 * and the comment form. The actual display of comments is
	 * handled by a callback to under_foundation_comment() which is
	 * located in the inc/template-tags.php file.
	 *
	 * @package Under_Foundation
	 * @author Cole Geissinger <cole@colegeissinger.com>
	 *
	 * @version 0.1
	 * @since   0.1
	 */

	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() )
		return;
	?>

		<div id="comments" class="comments-area">

		<?php // You can start editing here -- including this comment! ?>

		<?php if ( have_comments() ) : ?>
			<h2 class="comments-title">
				<?php
					printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'under_foundation' ),
						number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
				?>
			</h2>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-above" class="navigation-comment" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'under_foundation' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'under_foundation' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'under_foundation' ) ); ?></div>
			</nav><!--[END #comment-nav-above]-->
			<?php endif; // check for comment navigation ?>

			<ol class="comment-list">
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use under_foundation_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define under_foundation_comment() and that will be used instead.
					 * See under_foundation_comment() in inc/template-tags.php for more.
					 */
					wp_list_comments( array( 'callback' => 'under_foundation_comment' ) );
				?>
			</ol><!--[END .comment-list]-->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below" class="navigation-comment" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'under_foundation' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'under_foundation' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'under_foundation' ) ); ?></div>
			</nav><!--[END #comment-nav-below]-->
			<?php endif; // check for comment navigation ?>

		<?php endif; // have_comments() ?>

		<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="no-comments"><?php _e( 'Comments are closed.', 'under_foundation' ); ?></p>
		<?php endif; ?>

		<?php comment_form(); ?>

	</div><!--[END #comments]-->
