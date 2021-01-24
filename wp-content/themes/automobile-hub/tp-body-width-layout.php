<?php

	$automobile_hub_theme_lay = get_theme_mod( 'automobile_hub_tp_body_layout_settings','Full');
    if($automobile_hub_theme_lay == 'Container'){
		$automobile_hub_tp_theme_css .='body{';
			$automobile_hub_tp_theme_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$automobile_hub_tp_theme_css .='}';
		$automobile_hub_tp_theme_css .='.scrolled{';
			$automobile_hub_tp_theme_css .='width: auto; left:0; right:0;';
		$automobile_hub_tp_theme_css .='}';
	}else if($automobile_hub_theme_lay == 'Container Fluid'){
		$automobile_hub_tp_theme_css .='body{';
			$automobile_hub_tp_theme_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$automobile_hub_tp_theme_css .='}';
		$automobile_hub_tp_theme_css .='.scrolled{';
			$automobile_hub_tp_theme_css .='width: auto; left:0; right:0;';
		$automobile_hub_tp_theme_css .='}';
	}else if($automobile_hub_theme_lay == 'Full'){
		$automobile_hub_tp_theme_css .='body{';
			$automobile_hub_tp_theme_css .='max-width: 100%;';
		$automobile_hub_tp_theme_css .='}';
	}