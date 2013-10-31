<?php get_header(); ?>

<div id="content">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<?php
			$format = get_post_format($post->ID);
			if ( $format == '' ) {
				$format = 'standard';
			}

			// Set the default coloring for our formats in case the user hasn't set up any of his own.
			if ( $format == 'standard' OR $format == 'gallery' ) {
				$container_class = 'blue';
			} elseif ( $format == 'image' or $format == 'video' ) {
				$container_class = 'yellow';
			} elseif ( $format == 'quote' or $format == 'link' ) {
				$container_class = 'orange';
			} else {
				$container_class = 'blue';
			}
		?>

		<div id="entry-<?php the_ID(); ?>" class="container <?php echo $container_class; ?>">

			<?php do_action('ci_theme_print_post_custom_css', get_the_ID()); ?>

			<?php
			if ( is_single() ) {
				get_template_part('content', $format);
			} else {
				get_template_part('format', $format);
			}
			?>
		</div> <!-- .container -->

	<?php endwhile; endif; ?>

	<?php if ( !is_single() ) : ?>
	<div id="paging">
		<div class="row">
		<?php ci_pagination(array(
			'container_id' => '',
			'container_class' => 'twelve columns',
			'prev_text' => __('Older posts', 'ci_theme'),
			'next_text' => __('Newer posts', 'ci_theme')
		)); ?>
		</div>
	</div>
	<?php endif; ?>

</div> <!-- #content -->

<?php get_footer(); ?>
