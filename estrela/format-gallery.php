<?php
	$args = array(
		'post_type' => 'attachment',
		'numberposts' => -1,
		'post_status' => null,
		'post_parent' => $post->ID,
		'order_by' => 'menu_order',
		'post_mime_type' => 'image'
	);
	$attachments = get_posts($args);
	$image_count = count($attachments);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry row'); ?>>

	<div class="twelve columns entry-head">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo sprintf(__('Permanent link to: %s', 'ci_theme'), get_the_title()); ?>"><?php the_title(); ?></a></h1>

		<div class="entry-meta">
			<time datetime="<?php echo get_the_date('Y-m-d'); ?>"><i class="icon-calendar"></i><?php echo get_the_date(); ?></time>
			<span class="entry-author"><i class="icon-user"></i><?php the_author(); ?></span>
			<a class="comment-no" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>
		</div>

		<?php if ( $image_count > 0 ) : ?>
		<ul class="row gallery-wrap">
			<?php
				foreach ( $attachments as $attachment )	{
					$attr = array(
						'alt'   => trim(strip_tags( get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) )),
						'title' => trim(strip_tags( $attachment->post_title ))
					);
					$img_url = ci_get_image_src( $attachment->ID, 'large' );
					echo '<li class="three columns"><a href="'.$img_url.'" class="fancybox" data-fancybox-group="gallery-'.get_the_ID().'" title="">'.wp_get_attachment_image( $attachment->ID, 'ci_thumb_square', false, $attr ).'</a></li>';
				}
			?>
		</ul>
		<?php endif; ?>

		<?php ci_e_content(); ?>

		<?php ci_read_more(); ?>
	</div>
</article>
