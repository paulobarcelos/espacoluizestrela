<?php
/*
 * Template Name: Post Archives
 */
?>

<?php get_header(); ?>

<div id="content">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<?php
			$format = 'standard';
			$container_class = 'blue';
		?>

		<div id="entry-<?php the_ID(); ?>" class="container <?php echo $container_class; ?>">

			<?php do_action('ci_theme_print_post_custom_css', get_the_ID()); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('entry row'); ?>>
				<div class="eight columns">
					<div class="entry-head">
						<h1 class="entry-title"><?php the_title(); ?></h1>

						<?php if ( ci_has_image_to_show() ) : ?>
							<figure class="entry-thumb">
								<?php
									$url = ci_get_featured_image_src('large');
									echo '<a href="'. $url .'" class="fancybox" title="">'.get_the_post_thumbnail($post->ID, 'ci_featured_single').'</a>';
								?>
							</figure>
						<?php endif; // has_post_thumbnail ?>

						<?php the_content(); ?>

						<?php
							global $paged;
							$arrParams = array(
								'paged' => $paged,
								'ignore_sticky_posts'=>1,
								'showposts' => ci_setting('archive_no')
							);
							query_posts($arrParams);
						?>

						<ul class="lst archive">
							<?php while (have_posts() ) : the_post(); ?>
								<li><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(sprintf(__('Permanent link to: %s', 'ci_theme'), get_the_title())); ?>"><?php the_title(); ?></a> - <?php echo get_the_date(); ?><?php the_excerpt(); ?></li>
							<?php endwhile; ?>
						</ul>

						<?php wp_reset_query(); ?>

						<?php if (ci_setting('archive_week')=='enabled'): ?>
							<h3 class="hdr"><?php _e('Weekly Archive', 'ci_theme'); ?></h3>
							<ul class="lst archive"><?php wp_get_archives('type=weekly&show_post_count=1') ?></ul>
						<?php endif; ?>
	
						<?php if (ci_setting('archive_month')=='enabled'): ?>
							<h3 class="hdr"><?php _e('Monthly Archive', 'ci_theme'); ?></h3>
							<ul class="lst archive"><?php wp_get_archives('type=monthly&show_post_count=1') ?></ul>
						<?php endif; ?>
	
						<?php if (ci_setting('archive_year')=='enabled'): ?>
							<h3 class="hdr"><?php _e('Yearly Archive', 'ci_theme'); ?></h3>
							<ul class="lst archive"><?php wp_get_archives('type=yearly&show_post_count=1') ?></ul>
						<?php endif; ?>

					</div>
				</div>
				<?php get_sidebar(); ?>
			</article>

		</div> <!-- .container -->

	<?php endwhile; endif; ?>

</div> <!-- #content -->

<?php get_footer(); ?>
