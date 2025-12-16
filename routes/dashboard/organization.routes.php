<?php

use App\Http\Controllers\Dashboard\Organization\OrganizationController;
use App\Http\Controllers\Dashboard\Organization\OrganizationRequestController;


Route::name("organization")->resource('organization', OrganizationController::class);

Route::name("organization")->resource('organizationRequest', OrganizationRequestController::class);

Route::get("organization/approve/{id}" ,  [OrganizationRequestController::class , "approve" ])->name("organization.organizationRequest.approve");

Route::post("organization/revoke/{id}" ,  [OrganizationRequestController::class , "revoke" ])->name("organization.organizationRequest.revoke");


Route::middleware("role:admin")->post('organization/activation',[ OrganizationController::class , "activation"])->name("organization.activation");
