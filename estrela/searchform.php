<form action="<?php echo esc_url(home_url('/')); ?>" method="get" role="search" class="searchform">
	<div>
		<label for="s" class="screen-reader-text"><?php _e('Search for:', 'ci_theme'); ?></label>
		<input type="text" id="s" name="s" value="" placeholder="<?php echo (get_search_query()!="" ? get_search_query() : __('Search', 'ci_theme') ); ?>">
		<button type="submit" class="searchsubmit"><i class="icon-search"></i></button>
	</div>
</form>
