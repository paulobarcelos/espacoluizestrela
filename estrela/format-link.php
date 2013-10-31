<?php
	$format = get_post_format($post->ID);
	if ( $format == '' ) {
		$format = 'standard';
	}
	
	// Echo column classes depending on the layout selected
	$image_left = post_custom('ci_image_on_left');
	
	if ( has_post_thumbnail() AND ( $image_left != 'disabled' ) ) {
		$col_class = 'seven pull-five';
		$img_class = "five push-seven";
	} elseif ( has_post_thumbnail() AND ( $image_left == 'disabled' ) ) {
		$col_class = 'seven';
		$img_class = 'five';
	} else {
		$col_class = 'twelve';
		$img_class = '';
	}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry row'); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="<?php echo $img_class; ?> columns">
			<figure class="entry-thumb">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('ci_thumb'); ?>
				</a>
			</figure>
		</div>
	<?php endif; // has_post_thumbnail ?>

	<div class="<?php echo $col_class; ?> columns entry-head">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo sprintf(__('Permanent link to: %s', 'ci_theme'), get_the_title()); ?>"><?php the_title(); ?></a></h1>

		<div class="entry-meta">
			<time datetime="<?php echo get_the_date('Y-m-d'); ?>"><i class="icon-calendar"></i><?php echo get_the_date(); ?></time>
			<span class="entry-author"><i class="icon-user"></i><?php the_author(); ?></span>
			<a class="comment-no" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>
		</div>

		<?php
			$linkurl = get_post_meta($post->ID, 'ci_format_link_url', true);
			$nofollow = get_post_meta($post->ID, 'ci_format_link_nofollow', true);
			$nofollow = $nofollow=='nofollow' ? 'rel="nofollow"' : '';
		?>
		<p><a class="external-link" href="<?php echo esc_url($linkurl); ?>" <?php echo $nofollow; ?> title="<?php echo esc_attr(sprintf(__('External link to: %s', 'ci_theme'), get_the_title())); ?>"><?php echo esc_url($linkurl); ?></a></p>

		<?php ci_e_content(); ?>

		<?php ci_read_more(); ?>
	</div>
</article>
