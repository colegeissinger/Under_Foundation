<?php
	/**
	 * The template for displaying Search Results pages.
	 *
	 * @package Under_Foundation
	 * @author Cole Geissinger <cole@colegeissinger.com>
	 *
	 * @version 1.0
	 * @since   1.0
	 */

	get_header(); ?>

		<section id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">
						<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'under_foundation' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					</header><!--[END .page-header]-->

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', 'search' ); ?>

					<?php endwhile; ?>

					<?php under_foundation_content_nav( 'nav-below' ); ?>

				<?php else : ?>

					<?php get_template_part( 'no-results', 'search' ); ?>

				<?php endif; ?>

			</div><!--[END #content]-->
		</section><!--[END #primary]-->

		<?php get_sidebar(); ?>
	<?php get_footer(); ?>