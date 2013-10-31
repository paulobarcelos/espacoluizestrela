
<footer id="footer">
	<div class="row">
		<div class="twelve columns">
			<p><?php echo ci_footer(); ?></p>
		</div>
	</div>
</footer>
</div> <!-- #page -->

<div id="mobilemenu">
<?php
	wp_nav_menu( array(
		'theme_location' 	=> 'ci_main_menu',
		'fallback_cb' 		=> '',
		'container' 		=> '',
		'menu_id' 			=> '',
		'menu_class' 		=> ''
	));
?>
</div>

<?php wp_footer(); ?>
</body>
</html>
