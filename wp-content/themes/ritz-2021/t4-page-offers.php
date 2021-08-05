<?php
// Template Name: T4 Offers Page
get_header();
global $loadAccommodation;
$bookAccomLink = '';
if($loadAccommodation) {
	$bookAccomLink = '#/booking/step-1';
} else {
	$redirect_page = get_field( 'redirect_page', 'option' );
	if($redirect_page) {
		$bookAccomLink = $redirect_page.'/#/booking/step-1';
	}
}

?>

<?php

$desktop = '<div class="desktop">';
$desktop .= '<div class="container t4-page-offers">';
$mobile  = '<div class="mobile">';

if ( get_field( 'page_title_h1' ) ) :
	$desktop .= '<h1 class="garamond--32 blue caps center landing">' . get_field( 'page_title_h1' ) . '</h1>';
	$mobile  .= '<h1 class="garamond--32 blue caps center landing fixed">' . get_field( 'page_title_h1' ) . '</h1>';
endif;

$include_extended_description = get_field( 'include_extended_description' );
$extended_description         = get_field( 'extended_description' );

if ( ! $include_extended_description ) {
	if ( get_field( 'introduction_text' ) ) :
		$desktop .= '<p class="grey gotham--18 center landing offer">' . get_field( 'introduction_text' ) . '</p>';
		$mobile  .= '<p class="grey gotham--14 center landing offer fixed">' . get_field( 'introduction_text' ) . '</p>';
	endif;
}

if ( have_rows( 'strike_through_headings' ) ) :
	$desktop .= '<h2 class="strikethrough"><div><span class="garamond--14 grey">';
	/*$mobile .= '<h2 class="strikethrough"><div><span class="garamond--12 dark-grey fixed">';*/
	$countH = count( get_field( 'strike_through_headings' ) );
	$iH     = 1;
	while ( have_rows( 'strike_through_headings' ) ) : the_row();
		$desktop .= get_sub_field( 'strikethrough_heading' );
		/*$mobile .= get_sub_field('strikethrough_heading');*/
		if ( $iH < $countH ) {
			$desktop .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			/*$mobile .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';*/
		};
		$iH ++;
	endwhile;
	$desktop .= '</span></div></h2>';
	/* $mobile .= '</span></div></h2>';*/
endif;

$hide_filters = get_field( 'hide_filters' );

if ( ! $hide_filters ) {
	$desktop .= '<h2 class="strikethrough"><div><span class="garamond--14 grey">';
	$desktop .= '<span class="unfilter active event-filter" data-filter="*">All</span>' . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	$desktop .= '<span class="filter-special-events event-filter" data-filter=".special-events">Special Events</span>' . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	$desktop .= '<span class="filter-suites-dining event-filter" data-filter=".suites-dining">Accommodation</span>' . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	$desktop .= '<span class="filter-dining event-filter" data-filter=".dining">Dining</span>';
	$desktop .= '</span></div></h2>';
}


if ( $include_extended_description ) {
	$desktop .= '<div class="extended-description grey gotham--18">';
	$desktop .= $extended_description;
	$desktop .= '</div>';
	$mobile  .= '<div class="mobile-row">';
	$mobile  .= '<div class="gotham--16 grey fixed left" style="padding-top: 30px;">' . $extended_description . '</div></div>';
}

function bookTea( $ident, $conversionjs, $restaurantid, $promotionid, $connectionid, $sessionid ) {
	$baseColor = '011e40';

	$return = '<script type="text/javascript">';
	$return .= 'jQuery(document).ready(function($) { $("' . $ident . '").lbuiDirect({';
	$return .= 'connectionid  :  "' . $connectionid . '",';
	$return .= 'style  :  {';
	$return .= 'baseColor  :  "' . $baseColor . '"';
	$return .= '},';
	if ( $conversionjs != '' ) {
		$return .= 'conversionjs  :  "' . $conversionjs . '",';
	}
	if ( $restaurantid != '' ) {
		$return .= 'restaurantid  :  "' . $restaurantid . '",';
	}
	if ( $promotionid != '' ) {
		$return .= 'promotionid  :  "' . $promotionid . '",';
	}
	if ( $sessionid != '' ) {
		$return .= 'preselect  :  {';
		if ( $sessionid != '' ) {
			$return .= 'sessionid  :  "' . $sessionid . '",';
		}
		$return .= '},';
	}
	$return .= 'modalWindow  :  {enabled  :  true},';
	$return .= '});});';
	$return .= '</script>';

	return $return;
}

function bookRestaurant( $ident, $conversionjs, $restaurantid, $promotionid, $connectionid, $sessionid ) {


	$baseColor = '011e40';

	$return = '<script type="text/javascript">';
	$return .= 'jQuery(document).ready(function($) { $("' . $ident . '").lbuiDirect({';
	$return .= 'connectionid  :  "' . $connectionid . '",';
	$return .= 'style  :  {';
	$return .= 'baseColor  :  "' . $baseColor . '"';
	$return .= '},';
	if ( $conversionjs != '' ) {
		$return .= 'conversionjs  :  "' . $conversionjs . '",';
	}
	if ( $restaurantid != '' ) {
		$return .= 'restaurantid  :  "' . $restaurantid . '",';
	}
	if ( $promotionid != '' ) {
		$return .= 'promotionid  :  "' . $promotionid . '",';
	}
	if ( $sessionid != '' ) {
		$return .= 'preselect  :  {';
		if ( $sessionid != '' ) {
			$return .= 'sessionid  :  "' . $sessionid . '",';
		}
		$return .= '},';
	}
	$return .= 'modalWindow  :  {enabled  :  true},';
	$return .= '});});';
	$return .= '</script>';

	return $return;
}

if ( have_rows( 'offers' ) ) :
	$desktop .= '<div class="special-offers-grid">';
	$mobile  .= '<div class="special-offers-grid">';
	$scripts = '';
	while ( have_rows( 'offers' ) ) : the_row();
		$image                           = get_sub_field( 'image' );
		$heading                         = get_sub_field( 'heading' );
		$description                     = get_sub_field( 'description' );
		$page_link                       = get_sub_field( 'page_link' );
		$page_link_text                  = get_sub_field( 'page_link_text' );
		$booking_link                    = 'href="' . get_sub_field( 'booking_link' ) . '"';
		$booking_link_text               = get_sub_field( 'booking_link_text' );
		$open_in_new_tab                 = get_sub_field( 'open_in_new_tab' );
		$booking_link_type               = get_sub_field( 'booking_link_type' );
		$afternoon_tea_change_parameters = get_sub_field( 'afternoon_tea_change_parameters' );
		$at_connectionid                 = get_sub_field( 'at_connectionid' );
		$at_conversionjs                 = get_sub_field( 'at_conversionjs' );
		$at_restaurantid                 = get_sub_field( 'at_restaurantid' );
		$at_sessionid                    = get_sub_field( 'at_sessionid' );
		$at_promotionid                  = get_sub_field( 'at_promotionid' );
		$res_change_parameters           = get_sub_field( 'res_change_parameters' );
		$res_connectionid                = get_sub_field( 'res_connectionid' );
		$res_conversionjs                = get_sub_field( 'res_conversionjs' );
		$res_restaurantid                = get_sub_field( 'res_restaurantid' );
		$res_sessionid                   = get_sub_field( 'res_sessionid' );
		$res_promotionid                 = get_sub_field( 'res_promotionid' );
		$offer_types                     = get_sub_field( 'offer_type' );
		$offer_classes                   = '';
		if ( $offer_types ) {
			foreach ( $offer_types as $offer_type ) {
				if ( $offer_type == 'Special Events' ) {
					$offer_classes .= ' special-events';
				}
				if ( $offer_type == 'Accomodation' ) {
					$offer_classes .= ' suites-dining';
				}
				if ( $offer_type == 'Dining' ) {
					$offer_classes .= ' dining';
				}
			}
			$target = '';
		}
		if ( $open_in_new_tab ) {
			$target = ' target="_blank" ';
		};

		$mob_booking_link = $booking_link;

		$get_ident = uniqid();

		if ( $booking_link_type == 'Afternoon Tea' ) {
			$booking_link     = 'href="#" ID="book-tea-now' . $get_ident . '"';
			$mob_booking_link = 'href="#" ID="mob-book-tea-now' . $get_ident . '"';
		}
		if ( $booking_link_type == 'Restaurant' ) {
			$booking_link     = 'href="#" ID="book-restaurant-now' . $get_ident . '"';
			$mob_booking_link = 'href="#" ID="mob-book-restaurant-now' . $get_ident . '"';
		}
		if ( $booking_link_type == 'Book Accommodation' ) {
			$dataTags = '';
			$dataTags_Sep = '?';
			if ( have_rows( 'accommodation_codes' ) ) :
				while ( have_rows( 'accommodation_codes' ) ) : the_row();
					$key   = get_sub_field( 'key' );
					if($key=='ratecode') {$key='Rate';}
					if($key=='child') {$key='Child';}
					$value = get_sub_field( 'value' );
					if( $key !== '') {
						if ($value == '') {
							$dataTags .= $dataTags_Sep.$key;
							$dataTags_Sep='&';
							//$dataTags .= ' data-'.$key;
						} else {
							//$dataTags .= ' data-'.$key.'="'.$value.'"';
							$dataTags .= $dataTags_Sep.$key.'='.$value;
							$dataTags_Sep = '&';
						}
					}
				endwhile;
			endif;
			$booking_link = 'href="'.$bookAccomLink.$dataTags.'" class="ic-borderleft" style="cursor: pointer;"';
			$mob_booking_link = $booking_link;
			$target = '';
		}

		$desktop .= '<div class="sogcol-1-3 sog' . $offer_classes . ' visible">';
		$desktop .= '<div class="sogimage" style="background-image: url(' . $image['url'] . ')"></div>';
		$desktop .= '<div class="sogtitle"><h2 class="garamond--20 dark-grey caps center">' . $heading . '</h2></div>';
		$desktop .= '<div class="sogdescription gotham--16 grey center">' . $description . '</div>';
		$desktop .= '<div class="landing-links wide">';
		$desktop .= '<span class="gotham--12 grey caps fixed center"><a href="' . $page_link . '">' . $page_link_text . '</a></span>';
		$desktop .= '<span class="gotham--12 blue caps fixed center"><a ' . $booking_link . $target . '>' . $booking_link_text . '</a></span><div class="clear"></div></div>';
		$desktop .= '</div>';

		if ( $booking_link_type == 'Afternoon Tea' ) {
			$scripts .= bookTea( '#book-tea-now' . $get_ident . ',#mob-book-tea-now' . $get_ident, $at_conversionjs, $at_restaurantid, $at_promotionid, $at_connectionid, $at_sessionid );
		}

		if ( $booking_link_type == 'Restaurant' ) {
			$scripts .= bookRestaurant( '#book-restaurant-now' . $get_ident . ',#mob-book-restaurant-now' . $get_ident, $res_conversionjs, $res_restaurantid, $res_promotionid, $res_connectionid, $res_sessionid );
		}

		$mobile .= '<div class="mobile-box">';
		$mobile .= '<div class=""><img src="' . $image['url'] . '" alt="' . $image['alt'] . '"/></div>';
		$mobile .= '<div class="sogtitle"><h2 class="garamond--20 dark-grey caps center fixed">' . $heading . '</h2></div>';
		$mobile .= '<div class="sogdescription gotham--16 grey center fixed">' . $description . '</div>';
		$mobile .= '<div class="landing-links">';
		$mobile .= '<span class="gotham--12 grey caps fixed center"><a href="' . $page_link . '">' . $page_link_text . '</a></span>';
		$mobile .= '<span class="gotham--12 blue caps fixed center"><a ' . $mob_booking_link . $target . '>' . $booking_link_text . '</a></span><div class="clear"></div></div>';
		$mobile .= '</div>';
	endwhile;
	$desktop .= '<div class="clear"></div>';
	$desktop .= '</div>';
	$desktop .= $scripts;
	$mobile  .= '</div>';
	$mobile  .= '<div class="clear"></div>';
endif;


$desktop .= '</div></div>';
$mobile  .= '</div>';

echo $desktop;
echo $mobile;

?>

<?php get_footer(); ?>
