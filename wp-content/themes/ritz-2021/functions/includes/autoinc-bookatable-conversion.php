<?php

global $use_seven_rooms;

$use_seven_rooms = false;

if(get_field('dining_booking_engine','option')=='Seven Rooms') {
    $use_seven_rooms = true;
}

function rid_to_quadranet_link($restaurant_id,$link_text) {
    //error_log('$restaurantid = '.$restaurant_id);
    $rid = $restaurant_id;
    if($rid == '') $rid = '108823';
    $lt = $link_text;
    if ($lt=='') $lt = 'BOOK NOW';
    if($rid =='108823') {
        return '<a href="https://bookings.quadranet.co.uk/?slug=the_ritz_restaurant&brand=73" class="button-ritz" target="_blank">'.$lt.'</a>';
    }
    if($rid =='460014') {
        return '<a href="https://bookings.quadranet.co.uk/?slug=the_ritz_garden&brand=73" class="button-ritz" target="_blank">'.$lt.'</a>';
    }
    if($rid =='108845') {
        return '<a href="https://bookings.quadranet.co.uk/?slug=the_ritz_afternoon_tea&brand=73" class="button-ritz" target="_blank">'.$lt.'</a>';
    }
}