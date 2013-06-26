<?php
	/**
	 * The template used for displaying page content in page.php
	 *
	 * @package Under_Foundation
	 * @author Cole Geissinger <cole@colegeissinger.com>
	 *
	 * @version 0.1
	 * @since   0.1
	 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!--[END .entry-header]-->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'under_foundation' ),
				'after'  => '</div>',
			) );
		?>
	</div><!--[END .entry-content]-->
	<?php edit_post_link( __( 'Edit', 'under_foundation' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article><!--[END #post-##]-->
