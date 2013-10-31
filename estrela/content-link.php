<article id="post-<?php the_ID(); ?>" <?php post_class('entry row'); ?>>
	<div class="eight columns">
		<div class="entry-head">
			<h1 class="entry-title"><?php the_title(); ?></h1>

			<div class="entry-meta">
				<time datetime="<?php echo get_the_date('Y-m-d'); ?>"><i class="icon-calendar"></i><?php echo get_the_date(); ?></time>
				<span class="entry-author"><i class="icon-user"></i><?php the_author(); ?></span>
				<a class="comment-no" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>
			</div>

			<?php if ( ci_has_image_to_show() ) : ?>
				<figure class="entry-thumb">
					<?php
					$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large', true );
					echo '<a href="'. $url[0] .'" class="fancybox" title="">'.get_the_post_thumbnail($post->ID, 'ci_featured_single').'</a>';
					?>
				</figure>
			<?php endif; // has_post_thumbnail ?>

			<?php
				$linkurl = get_post_meta($post->ID, 'ci_format_link_url', true);
				$nofollow = get_post_meta($post->ID, 'ci_format_link_nofollow', true);
				$nofollow = $nofollow=='nofollow' ? 'rel="nofollow"' : '';
			?>
			<p><a class="external-link" href="<?php echo esc_url($linkurl); ?>" <?php echo $nofollow; ?> title="<?php echo esc_attr(sprintf(__('External link to: %s', 'ci_theme'), get_the_title())); ?>"><?php echo esc_url($linkurl); ?></a></p>

			<?php the_content(); ?>

			<div id="comments">
				<?php comments_template(); ?>
			</div>
		</div>
	</div>

	<?php get_sidebar(); ?>
</article>
