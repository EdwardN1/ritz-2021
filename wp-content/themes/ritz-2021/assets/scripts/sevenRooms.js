jQuery(document).ready(function ($) {
    $('.ritz-seven-rooms').each(function () {
        let thisVenueID = $(this).data("venueid");
        let thistriggerId = $(this).attr("id");
        SevenroomsWidget.init({
            venueId: thisVenueID,
            triggerId: thistriggerId, // id of the dom element that will trigger this widget
            type: "reservations", // either 'reservations' or 'waitlist' or 'events'
            styleButton: false, // true if you are using the SevenRooms button
            clientToken: "" //(Optional) Pass the api generated clientTokenId here
        })
    });

});