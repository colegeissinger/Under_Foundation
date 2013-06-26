<?php
	/**
	 * The template for displaying the footer.
	 *
	 * Contains the closing of the id=main div and all content after
	 *
	 * @package Under_Foundation
	 * @author Cole Geissinger <cole@colegeissinger.com>
	 *
	 * @version 0.1
	 * @since   0.1
	 */
?>

			</div><!--[END #main]-->

			<footer id="colophon" class="site-footer" role="contentinfo">
				<div class="site-info">
					<?php do_action( 'under_foundation_credits' ); ?>
					<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'under_foundation' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'under_foundation' ), 'WordPress' ); ?></a>
					<span class="sep"> | </span>
					<?php printf( __( 'Theme: %1$s by %2$s.', 'under_foundation' ), 'Under_Foundation', '<a href="http://www.colegeissinger.com" rel="designer">Cole Geissinger</a>' ); ?>
				</div><!--[END .site-info]-->
			</footer><!--[END #colophon]-->
		</div><!--[END #page]-->

		<?php wp_footer(); ?>

	</body>
</html>