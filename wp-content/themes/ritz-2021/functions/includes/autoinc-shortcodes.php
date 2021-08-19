<?php

add_shortcode( 'accordionform', 'sc_accordionform' );

function sc_accordionform( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'formid' => '',
	), $atts );

	$formID = '';

	$return = '';

	if ( array_key_exists( 'formid', $a ) ) {
		if ( $a['formid'] != '' ) {
			$formID = $a['formid'];
		};
	};

	if ( ( $formID != '' ) ) {
		$return .= '<ul class="accordion event-forms" data-accordion data-allow-all-closed="true" >';
		$return .= '<li id="frm' . $formID . '" class="accordion-item" data-accordion-item>';
		$return .= '<a href="#" class="accordion-title">BOOK NOW</a>';
		$return .= '<div class="accordion-content" data-tab-content>';
		$return .= do_shortcode( '[gravityform id="' . $formID . '" title="false" description="false"]' );
		$return .= '</div></li></ul>';
		$return .= '<script>/*jQuery(document).ready(function ($) {$(".accordion-item").each(function () {var hash = window.location.hash;window.console.log("hash = " + hash);if (hash === ("#" + $(this).attr("id"))) {$(this).addClass("is-active");}});});*/</script>';

	}

	return $return;
}