<?php

namespace App\Classes;

class FCMAction
{
    const NO_ACTION = "no_action";
    const OPEN_CHAT = "open_chat";
    const DRIVER_CHANGE_LICENCE_DATE = "driver_edit_profile";
    const CLIENT_OPEN_NEW_TRIPS = "client_open_new_trips";
    const DRIVER_OPEN_PREVIOUS_TRIPS = "driver_open_previous_trips";
    const DRIVER_CANCEL_TRIP = "driver_cancel_trip";
    const CLIENT_OPEN_PREVIOUS_TRIPS = "client_open_previous_trips";
    const CLIENT_OPEN_UPCOMING_TRIPS = "client_open_upcoming_trips";
    const DRIVER_OPEN_UPCOMING_TRIPS = "driver_open_upcoming_trips";
    const DRIVER_OPEN_NEW_TRIPS = "driver_open_new_trips";
    const CLIENT_OPEN_CURRENT_TRIPS = "client_open_current_trips";
    const DRIVER_OPEN_CURRENT_TRIPS = "driver_open_current_trips";
    const OWNER_TRIP_RATED = "owner_show_trip";
    const ADMIN_TRIP_RATED = "admin_show_trip";
    const ADMIN_WALLET_REQUEST = "admin_wallet_request";
    const DRIVER_WALLET_REQUEST_ACCEPTED = "driver_wallet";
    const DRIVER_WALLET_REQUEST_REJECTED = "driver_wallet";
    const DRIVER_OPEN_EDIT_PROFILE = "driver_open_edit_profile";
    const DRIVER_CHANGE_PRICE = "driver_change_price";
}