<?php
//
function anona_custom_style() {
	$atp_option_var = array(
		'atp_themecolor',
		'atp_wrapbg',
		'atp_wrap_txt',
		'atp_theme_border',
		'atp_h1',
		'atp_h2',
		'atp_h3',
		'atp_h4',
		'atp_h5',
		'atp_h6',
		'atp_bodyp',
		'atp_overlayimages',
		'atp_headerproperties',
		'atp_subheaderproperties',
		'atp_subheader_textcolor',
		'atp_footerbg',
		'atp_footertext',
		'atp_copyrights',
		'atp_breadcrumbtext',
		'atp_stickybarcolor',
		'atp_stickybartext',
		'atp_sidebartitle',
		'atp_footertitle',
		'atp_bodyproperties',
		'atp_logotitle',
		'atp_tagline',
		'atp_topmenu',
		'atp_topmenu_linkhover',
		'atp_topmenu_hoverbg',
		'atp_topmenu_sub_bg',
		'atp_topmenu_sub_link',
		'atp_topmenu_sub_linkhover',
		'atp_topmenu_sub_hoverbg',
		'atp_topmenu_active_link',
		'atp_menu_dropdown_border_color',
		'atp_link',
		'atp_linkhover',
		'atp_subheaderlink',
		'atp_subheaderlinkhover',
		'atp_footerlinkcolor',
		'atp_footerlinkhovercolor',
		'atp_copylinkcolor',
		'atp_subheader_pt',
		'atp_subheader_pb',
		'atp_logo_ml',
		'atp_logo_mt',
		'atp_footerheadingcolor',
		'atp_topbar_bgcolor',
		'atp_topbar_text',
		'atp_topbar_link',
		'atp_mmenu',
		'atpbodyfont',
		'atp_headings',
		'atp_mainmenufont',
		'atp_sidebar_link',
		'atp_countdown_font',
		'iva_weatherbg',
		'iva_weather_textcolor',
		'atp_extracss',
		'atp_content_width',
		'atp_innercontent_width',
		'atp_boxedcontent_width',
	);

	foreach ( $atp_option_var as $value ) {
		$$value = get_option( $value );
	}

	$atp_sidebar_cw = '';
	if ( get_option( 'atp_content_width' ) ) {
		$atp_sidebar_cw = 100 - get_option( 'atp_content_width' );
	}

	$anona_page_bg_properties = get_post_meta( get_the_ID(), 'anona_page_bg_prop', true );

	if ( ! empty( $anona_page_bg_properties ) ) {
		$anona_page_bg_properties = array(
			'image'      => $anona_page_bg_properties['0']['image'],
			'repeat'     => $anona_page_bg_properties['0']['repeat'],
			'position'   => $anona_page_bg_properties['0']['position'],
			'color'      => $anona_page_bg_properties['0']['color'],
			'attachment' => $anona_page_bg_properties['0']['attachement'],
		);
	}

	$custom_css = '';

	// Mega Menu Custom CSS
	$menu_id = get_nav_menu_locations();

	$iva_custom_styles = '';
	$padding_right     = '';
	$padding_bottom    = '';
	$padding_left      = '';

	if ( isset( $menu_id['primary-menu'] ) ) {
		$iva_menu_items = wp_get_nav_menu_items( $menu_id['primary-menu'] );
		foreach ( $iva_menu_items as $iva_item ) {
			if ( $iva_item->menu_item_parent === '0' ) {
				$mmenu_stored_val = get_option( 'mm_menu_bg_' . $iva_item->object_id );
				if ( isset($mmenu_stored_val['image']) != '' ) {
					if ( $mmenu_stored_val['pright'] == '' ) {
						$padding_right = '0';
					} else {
						$padding_right = $mmenu_stored_val['pright'];
					}

					if ( $mmenu_stored_val['pbottom'] == '' ) {
						$padding_bottom = '0';
					} else {
						$padding_bottom = $mmenu_stored_val['pbottom'];
					}

					if ( $mmenu_stored_val['pleft'] == '' ) {
						$padding_left = '0';
					} else {
						$padding_left = $mmenu_stored_val['pleft'];
					}
					$custom_css .= "
					#iva_megamenu .menu-item-{$iva_item->ID} > .sub-container > .sub-menu {
						background-image: url({$mmenu_stored_val['image']});
						background-repeat: no-repeat;
						background-position: {$mmenu_stored_val['position']};
						padding: 25px {$padding_right}px {$padding_bottom}px {$padding_left}px !important;
					}";
				}
			}
		}
	}// Megamenu style ends here

	if ( get_option( 'atp_content_width' ) ) {
		$atp_sidebar_cw = 100 - get_option( 'atp_content_width' );
	}

	$theme_color = isset( $atp_themecolor ) ? $atp_themecolor : '';
	if ( '' !== $theme_color ) {
		$custom_css = "
		.iva-progress-bar .bar-color,
		.homepage_teaser,
		table.fancy_table th,
		.status-format,
		.comment-edit-link,
		.ei-slider-thumbs li a:hover,
		.ei-slider-thumbs li.ei-slider-element,
		a.btn,
		#back-top span,
		.flickr_badge_image:hover,
		.events-carousel .carousel-event-date,
		.client-image img:hover,
		.imageborder:hover,
		.sub_nav li.current_page_item > a,
		.sub_nav li.current_page_item > a:hover,
		.flex-title h5 span,
		.iva-services:hover .cs-title,
		.grid figcaption,
		.ac_title.active .arrow,
		.toggle-title.active .arrow,
		.cs-title::after,
		.ac_title .arrow:hover,
		.iva-progress-bar .bar-color,
		.services_icon3,
		.services_icon4,
		#subheader,
		.highlight1,
		.iva-date-wrap,
		hr,
		.iva-date-ui.ui-widget-content .ui-state-active {
			background-color:{$theme_color} !important;
		}

		a,
		#footer a,
		#atp_menu > li:hover,
		#atp_menu > li.sfHover,
		#atp_menu > li.current-menu-item,
		#atp_menu > li.current-menu-ancestor,
		#atp_menu > li.current-page-ancestor,
		#atp_menu li.current-cat > a,
		#atp_menu li.current_page_item > a,
		#atp_menu li.current-page-ancestor > a,
		#atp_menu li li:hover,
		#atp_menu li li.sfHover,
		#atp_menu li li a:focus,
		#atp_menu li li a:hover,
		#atp_menu li li a:active,
		.services_icon1,.highlight2,
		.tarrow,
		.services_icon2a,
		.services_icon2b,
		.sf-menu li.current-menu-item > a,
		.sf-menu li.current-menu-ancestor > a,
		.sf-menu li.current-page-ancestor > a {
			color: {$theme_color};
		}

		#footer,
		.hortabs .tabs li.current,
		.fancyheading span,
		blockquote.alignright,
		blockquote.alignleft,
		.cs-title,
		.fancytitle span {
			border-color: {$theme_color};
		}

		blockquote.aligncenter,
		.toggle-title.active,
		.ac_title.active,
		.ac_wrap .ac_content,
		.ac_wrap .toggle_content,
		.ac_wrap .ac_title:hover {
			border-left-color: {$theme_color};
		}";
	} // End if().

	$custom_css .= anona_generate_font_prop(
		array(
			'h1#site-title a',
		), $atp_logotitle
	);
	$custom_css .= anona_generate_font_prop(
		array(
			'h2#site-description',
		), $atp_tagline
	);

	$custom_css .= anona_generate_image_prop(
		array(
			'body',
		), $atp_bodyproperties
	);
	$custom_css .= anona_generate_image_prop(
		array(
			'body',
		), $anona_page_bg_properties
	);

	if ( ! empty( $atp_overlayimages ) ) {
		$custom_css .= anona_gen_css_prop(
			array(
				'.bodyoverlay',
			), array(
				'background-image' => 'url( ' . THEME_PATTDIR . '/' . $atp_overlayimages . ')',
			)
		);
	}

	$custom_css .= anona_gen_css_prop(
		array(
			'h1',
			'h2',
			'h3',
			'h4',
			'h5',
			'h6',
			'.flex-title h5 span',
		), array(
			'font-family' => $atp_headings,
		)
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'body',
		), array(
			'font-family' => $atpbodyfont,
		)
	);
	$custom_css .= anona_gen_css_prop(
		array(
			'.sf-menu a',
		), array(
			'font-family' => $atp_mainmenufont,
		)
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'.topbar',
		), array(
			'background-color' => $atp_topbar_bgcolor,
			'color'            => $atp_topbar_text,
		)
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'.atp_sub_nav ul li a',
			'.topbar a',
		), array(
			'color' => $atp_topbar_link,
		)
	);

	$custom_css .= anona_generate_image_prop(
		array(
			'.header',
			'#fixedheader',
		), $atp_headerproperties
	);
	// Styling Menu
	$custom_css .= anona_gen_css_prop(
		array(
			'.header-style2 .primarymenu',
			'.header-style3 .primarymenu',
		), array(
			'background-color' => $atp_mmenu,
		)
	);
	$custom_css .= anona_generate_font_prop( array( '.sf-menu > li > a' ), $atp_topmenu );
	$custom_css .= anona_generate_image_prop( array( '.sf-menu ul li a' ), $atp_topmenu_sub_bg );
	$custom_css .= anona_gen_css_prop(
		array(
			'.sf-menu ul li a',
			'.topbar a',
		), array(
			'background-color' => $atp_topmenu_sub_bg,
			'border-color'     => $atp_menu_dropdown_border_color,
		)
	);
	$custom_css .= anona_generate_font_prop(
		array(
			'.sf-menu > li > a',
			'.primarymenu > li > a',
		), $atp_mainmenufont
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'#atp_menu li:hover',
			'#atp_menu li.sfHover',
		), array(
			'background-color' => $atp_topmenu_hoverbg,
		)
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'#atp_menu li:hover',
			'#atp_menu li.sfHover',
			'#atp_menu a:focus',
			'#atp_menu a:hover',
			'#atp_menu a:active',
		), array(
			'color' => $atp_topmenu_linkhover,
		)
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'#atp_menu ul li',
		), array(
			'background-color' => $atp_topmenu_sub_bg,
		)
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'#atp_menu ul a',
		), array(
			'color' => $atp_topmenu_sub_link,
		)
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'#atp_menu li li:hover',
			'#atp_menu li li.sfHover',
			'#atp_menu li li a:focus',
			'#atp_menu li li a:hover',
			'#atp_menu li li a:active',
		), array(
			'background-color' => $atp_topmenu_sub_hoverbg,
			'color'            => $atp_topmenu_sub_linkhover,
		)
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'#atp_menu li.current-cat > a',
			'#atp_menu li.current_page_item > a',
			'#atp_menu li.current-page-ancestor > a',
			'#atp_menu li.current-menu-item > a',
			'#atp_menu li.current-menu-ancestor > a',
			'#atp_menu li.current-page-ancestor > a',
		), array(
			'color' => $atp_topmenu_active_link,
		)
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'#atp_menu > li:hover',
			'#atp_menu > li.sfHover',
			'#atp_menu > li.current-menu-item',
			'#atp_menu > li.current-menu-ancestor',
			'#atp_menu > li.current-page-ancestor',
		), array(
			'color' => $atp_topmenu_active_link,
		)
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'#atp_menu > li.current-menu-item:hover',
			'#atp_menu > li.current-menu-ancestor:hover',
			'#atp_menu > li.current-page-ancestor:hover',
		), array(
			'color' => $atp_topmenu_active_link,
		)
	);
	// Link Colors
	$custom_css .= anona_gen_css_prop(
		array(
			'a',
			'.entry-meta > span a',
			'.entry-meta > span',
			'.widget.widget_nav_menu li a',
			'.sub_nav li a',
		), array(
			'color' => $atp_link
		)
	);
	$custom_css .= anona_gen_css_prop(
		array(
			'a:hover',
			'.entry-meta > span a:hover',
			'.entry-header .entry-title a:hover',
			'.widget.widget_nav_menu li a:hover',
			'.sub_nav li a:hover',
		), array(
			'color' => $atp_linkhover
		)
	);

	$custom_css .= anona_gen_css_prop( array( '#subheader a' ), array( 'color' => $atp_subheaderlink ) );
	$custom_css .= anona_gen_css_prop( array( '#subheader a:hover' ), array( 'color' => $atp_subheaderlinkhover ) );
	$custom_css .= anona_gen_css_prop( array( '#footer a' ), array( 'color' => $atp_footerlinkcolor ) );
	$custom_css .= anona_gen_css_prop( array( '#footer a:hover' ), array( 'color' => $atp_footerlinkhovercolor ) );
	$custom_css .= anona_gen_css_prop( array( '#footer .copyright a' ), array( 'color' => $atp_copylinkcolor ) );

	// Subheader Background
	$custom_css .= anona_generate_image_prop(
		array(
			'#subheader',
		), $atp_subheaderproperties
	);

	$custom_css .= anona_generate_image_prop(
		array(
			'#footer',
		), $atp_footerbg
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'.pagemid',
		), array(
			'background-color' => $atp_wrapbg,
			'color' => $atp_wrap_txt,
		)
	);
	// Theme Border Color
	$custom_css .= anona_gen_css_prop(
		array(
			'.rightsidebar #sidebar .content',
			'.rightsidebar .content-area',
			'.leftsidebar #sidebar .content',
			'.leftsidebar .content-area',
			'.widget.widget_nav_menu li:first-child a, .sub_nav li:first-child a',
			'.widget.widget_nav_menu li a, .sub_nav li a',
			'.widget.widget_nav_menu li:last-child a, .sub_nav li:last-child a',
			'.copyright .inner',
			'.cs-title',
			'.ac_wrap .ac_content',
			'.ac_wrap .toggle_content',
			'.toggle-title.active',
			'.ac_title.active',
			'.hortabs .tab_content',
			'.btn.light',
			'.vertabs .tab_content',
			'.ac_wrap .ac_title:hover',
			'.ac_title.active .arrow',
			'.toggle-title.active .arrow',
			'.pest-meta-info',
			'table th',
			'table td',
			'table.fancy_table',
			'table.fancy_table td',
			'.divider',
			'.iva-testimonial',
		), array(
			'border-color' => $atp_theme_border,
		)
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'#subheader',
		), array(
			'padding-top' => $atp_subheader_pt,
			'padding-bottom' => $atp_subheader_pb,
			'color' => $atp_subheader_textcolor,
		)
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'#subheader .page-title',
		), array(
			'color' => $atp_subheader_textcolor,
		)
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'.logo',
		), array(
			'margin-left' => 'auto',
			'margin-top'  => 'auto',
		)
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'#sticky',
		), array(
			'background-color' => $atp_stickybarcolor,
			'color'            => $atp_stickybartext,
		)
	);

	$custom_css .= anona_generate_font_prop(
		array(
			'body',
			'input',
			'select',
			'textarea',
		), $atp_bodyp
	);
	$custom_css .= anona_generate_font_prop( array( 'h1' ), $atp_h1 );
	$custom_css .= anona_generate_font_prop( array( 'h2' ), $atp_h2 );
	$custom_css .= anona_generate_font_prop( array( 'h3' ), $atp_h3 );
	$custom_css .= anona_generate_font_prop( array( 'h4' ), $atp_h4 );
	$custom_css .= anona_generate_font_prop( array( 'h5' ), $atp_h5 );
	$custom_css .= anona_generate_font_prop( array( 'h6' ), $atp_h6 );

	$custom_css .= anona_generate_font_prop( array( '.widget-title' ), $atp_sidebartitle );
	$custom_css .= anona_generate_font_prop( array( '#footer .widget-title' ), $atp_footertitle );
	$custom_css .= anona_generate_font_prop( array( '#footer' ), $atp_footertext );
	$custom_css .= anona_generate_font_prop( array( '#footer .copyright' ), $atp_copyrights );

	$custom_css .= anona_generate_image_prop(
		array(
			'.iva-date-wrap',
		), $iva_weatherbg
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'.iva-date-wrap',
		), array(
			'color' => $iva_weather_textcolor,
		)
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'#footer .widget-title',
		), array(
			'color' => $atp_footerheadingcolor,
		)
	);
	$custom_css .= anona_gen_css_prop(
		array(
			'.breadcrumbs',
		), array(
			'color' => $atp_breadcrumbtext,
		)
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'.countdown-amount',
			'.countdown-section',
		), array(
			'color' => $atp_countdown_font,
		)
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'.rightsidebar .content-area',
		), array(
			'width' => $atp_content_width . '%',
		)
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'.rightsidebar #sidebar',
		), array(
			'width' => $atp_sidebar_cw . '%',
		)
	);

	$custom_css .= anona_gen_css_prop(
		array(
			'.inner',
			'.pagemid > .inner',
			'.header-area',
			'.subheader-inner',
		), array(
			'width' => $atp_innercontent_width . 'px',
		)
	);
	$custom_css .= anona_gen_css_prop(
		array(
			'#boxed #wrapper',
		), array(
			'width' => $atp_boxedcontent_width . 'px',
		)
	);

	// Custom CSS from theme options
	$custom_css .= $atp_extracss;
	$custom_css = preg_replace( '/\b[\w-]+:(?:(?:url\(\))?;|(?=}))/', '', $custom_css );

	wp_add_inline_style( 'iva-responsive', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'anona_custom_style', 2000 );

//for font css attributes
function anona_generate_font_prop( $selectors = null, $arr_var = null ) {

	$css = '';

	$inline_css = '';

	$size       = isset( $arr_var['size'] ) ? 'font-size:' . $arr_var['size'] . ';' : '';
	$color      = isset( $arr_var['color'] ) ? 'color:' . $arr_var['color'] . ';' : '';
	$lineheight = isset( $arr_var['lineheight'] ) ? 'line-height:' . $arr_var['lineheight'] . ';' : '';
	$style      = isset( $arr_var['style'] ) ? 'font-style:' . $arr_var['style'] . ';' : '';
	$variant    = isset( $arr_var['fontvariant'] ) ? 'font-weight:' . $arr_var['fontvariant'] . ';' : '';

	$css = "{$size} {$color} {$lineheight} {$style} {$variant}";
	$css = trim( $css );

	if ( isset( $selectors ) ) {
		if ( is_array( $selectors ) && ! empty( $selectors ) ) {
			$inline_css .= implode( ",\n$inline_css", $selectors );
		}
	}

	// Apply inline CSS
	if ( '' == trim( $inline_css ) ) {
		$inline_css .= $css;
	} else {
		$inline_css .= '{ ' . $css . '} ';
	}

	// Format/Clean the CSS.
	$inline_css = "\n" . $inline_css;
	if ( '' != $css ) {
		return $inline_css;
	}
}

//for background image css attributes
function anona_generate_image_prop( $selectors = null, $arr_var = null ) {

	$css = '';

	$inline_css = '';

	$image      = isset( $arr_var['image'] ) ? 'background-image:url( ' . $arr_var['image'] . ' );' : '';
	$repeat     = isset( $arr_var['style'] ) ? 'background-repeat:' . $arr_var['style'] . ';' : '';
	$position   = isset( $arr_var['position'] ) ? 'background-position:' . $arr_var['position'] . ';' : '';
	$color      = isset( $arr_var['color'] ) ? 'background-color:' . $arr_var['color'] . ';' : '';
	$attachment = isset( $arr_var['attachment'] ) ? 'background-attachment:' . $arr_var['attachment'] . ';' : '';

	if ( '' !== $image ) {
		$css = "{$image} {$color} {$position} {$repeat} {$attachment}";
	} else {
		$css = "{$color}";
	}

	if ( isset( $selectors ) ) {
		if ( is_array( $selectors ) && ! empty( $selectors ) ) {
			$inline_css .= implode( ",\n$inline_css", $selectors );
		}
	}

	// Apply inline CSS
	if ( '' == trim( $inline_css ) ) {
		$inline_css .= $css;
	} else {
		$inline_css .= '{ ' . $css . '} ';
	}

	// Format/Clean the CSS.
	$inline_css = "\n" . $inline_css;
	if ( '' != $css ) {
		return $inline_css;
	}
}

function anona_gen_css_prop( $selectors = null, $properties = null ) {

	$css = '';

	$inline_css = '';

	if ( is_array( $properties ) && ! empty( $properties ) ) {
		foreach ( $properties as $name => $value ) {
			if ( '' !== $value ) {
				if ( 'font-family' === $name ) {
					$value = '"' . $value . '"';
				}
				$css .= "$name:$value; ";
			}
		}
	}
	if ( isset( $selectors ) ) {
		if ( is_string( $selectors ) && '' != $selectors ) {
			$inline_css .= $selectors;
		} elseif ( is_array( $selectors ) && ! empty( $selectors ) ) {
			$inline_css .= implode( ",\n$inline_css", $selectors );
		}
	}
	// Apply inline CSS
	if ( '' == trim( $inline_css ) ) {
		$inline_css .= $css;
	} else {
		$inline_css .= '{ ' . $css . '} ';
	}

	// Format/Clean the CSS.
	$inline_css = "\n" . $inline_css;
	if ( '' != $css ) {
		return $inline_css;
	}
}
