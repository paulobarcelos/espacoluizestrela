<article id="post-<?php the_ID(); ?>" <?php post_class('entry row'); ?>>

	<div class="eight columns">
	<div class="entry-head">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<time datetime="<?php echo get_the_date('Y-m-d'); ?>"><i class="icon-calendar"></i><?php echo get_the_date(); ?></time>
			<span class="entry-author"><i class="icon-user"></i><?php the_author(); ?></span>
			<a class="comment-no" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>
		</div>

		<figure class="entry-thumb audio-hold">
			<span class="audio-link-hold">
				<span class="audio-link">
					<a class="audio-play sm2_link" href="<?php echo esc_url(post_custom('ci_format_audio_url')); ?>">
						<i class="icon-ci-player"></i>
					</a>
				</span>
			</span>
		</figure>

		<?php ci_e_content(); ?>
		<div id="comments">
			<?php comments_template(); ?>
		</div>
		</div>
	</div>

	<?php get_sidebar(); ?>
</article>
