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

						<div class="entry-meta">
							<a class="comment-no" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>
						</div>

						<?php if ( ci_has_image_to_show() ) : ?>
							<figure class="entry-thumb">
								<?php
									$url = ci_get_featured_image_src('large');
									echo '<a href="'. $url .'" class="fancybox" title="">'.get_the_post_thumbnail($post->ID, 'ci_featured_single').'</a>';
								?>
							</figure>
						<?php endif; // has_post_thumbnail ?>

						<?php the_content(); ?>

						<div id="comments">
							<?php comments_template(); ?>
						</div>
					</div>
				</div>
				<?php get_sidebar(); ?>
			</article>

		</div> <!-- .container -->

	<?php endwhile; endif; ?>

</div> <!-- #content -->

<?php get_footer(); ?>
