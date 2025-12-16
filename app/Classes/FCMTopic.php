<?php

namespace App\Classes;

class FCMTopic
{
    const DEFAULT = "default";
    const NEW_MESSAGE = "new_message";
    const CLIENT_CANCELED_TRIP = "client_canceled_trip";

    const DRIVER_LICENCE_EXPIRED = "driver_licence_expired";
    const CLIENT_TALEBAT_NEW_TRIPS = "client_talebat_new_trips";
    const CLIENT_OTHER_TRIP = "client_other_new_trip";
    const CLIENT_TRIP_STARTING_SOON = "client_trip_starting_soon";
    const CLIENT_TRIP_STARTED = "client_trip_started";
    const ADMIN_TRIP_STARTED = "admin_trip_started";
    const DRIVER_TRIP_STARTED = "driver_trip_started";
    const DRIVER_TRIP_STARTING = "driver_trip_starting";
    const DRIVER_TRIP_FINISHED = "driver_trip_finished";
    const DRIVER_TRIP_BOOKED = "driver_trip_booked";
    const DRIVER_ACCEPT_TRIP = "driver_accept_trip";
    const DRIVER_REJECT_TRIP = "driver_reject_trip";
    const DRIVER_ARRIVED_TO_CLIENT = "driver_arrived_to_client";
    const ADMIN_TRIP_FINISHED = "admin_trip_finished";
    const CLIENT_TRIP_FINISHED = "client_trip_finished";
    const OWNER_TRIP_RATED = "client_rated_trip";
    const ADMIN_TRIP_RATED = "client_rated_trip";
    const ADMIN_ROLE_UPDATED = "admin_role_updated";
    const CLIENT_PRICE_CHANGED = "client_price_changed";
    const ADMIN_WALLET_REQUEST = "admin_wallet_request";
    const DRIVER_WALLET_REQUEST_ACCEPTED = "driver_wallet_request_accepted";
    const DRIVER_WALLET_REQUEST_REJECTED = "driver_wallet_request_rejected";
    const ADMIN_UPDATE_DRIVER_PROFILE = "admin_update_driver_profile";
    const ORGANIZATION_CHANGED_PRICE = "organization_changed_price";
}
