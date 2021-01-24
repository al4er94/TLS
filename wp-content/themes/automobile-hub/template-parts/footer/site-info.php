<?php
/**
 * Displays footer site info
 *
 * @package Automobile Hub
 * @subpackage automobile_hub
 */

?>
<div class="site-info">
	<div class="container">
		<p><?php echo esc_html(get_theme_mod('automobile_hub_footer_text',__('Automobile WordPress Theme By','automobile-hub'))); ?> <?php automobile_hub_credit(); ?></p>
	</div>
</div>