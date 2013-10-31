<?php
	$format = get_post_format($post->ID);
	if ( $format == '' ) {
		$format = 'standard';
	}
	
	// Echo column classes depending on the layout selected
	$image_left = post_custom('ci_image_on_left');
	
	if ( $image_left != 'disabled' ) {
		$col_class = 'five pull-seven';
		$img_class = "seven push-five";
	} elseif ( $image_left == 'disabled' ) {
		$col_class = 'five';
		$img_class = 'seven';
	} else {
		$col_class = 'twelve';
		$img_class = '';
	}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry row'); ?>>

	<div class="<?php echo $img_class; ?> columns">
		<?php ci_embed_video(610, 300, '', 'entry-thumb entry-video'); ?>
	</div>

	<div class="<?php echo $col_class; ?> columns entry-head">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo sprintf(__('Permanent link to: %s', 'ci_theme'), get_the_title()); ?>"><?php the_title(); ?></a></h1>

		<div class="entry-meta">
			<time datetime="<?php echo get_the_date('Y-m-d'); ?>"><i class="icon-calendar"></i><?php echo get_the_date(); ?></time>
			<span class="entry-author"><i class="icon-user"></i><?php the_author(); ?></span>
			<a class="comment-no" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>
		</div>

		<?php ci_e_content(); ?>

	</div>
</article>
