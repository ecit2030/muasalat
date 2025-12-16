<?php

namespace App\Http\Controllers\Dashboard\General\Administration;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\Administration\AdminRequest;
use App\Models\User;
use App\Notifications\FcmNotification;
use Collective\Html\FormFacade;
use Illuminate\Contracts\View\View;

class AdminProfileController extends DashboardController
{
    protected string $routeName = 'dashboard.general.administration.admins';

    public function index(): View
    {
        FormFacade::setModel(auth()->user());

        return view("{$this->routeName}.profile");
    }

    public function update(AdminRequest $request)
    {
        $user = auth()->user();
        $validated = $request->validated();

        $oldOtherPrice = $user->other_price ?? 0;
        $oldTalebatPrice = $user->talebat_price ?? 0;
        tap($user)->update($validated)->fresh();
        if (is_array($request->roles) && in_array('organization', $request->roles)) {
            if ($validated['other_price'] != $oldOtherPrice || $validated['talebat_price'] != $oldTalebatPrice) {
                $message = __("messages.price_range_is_changed_to_be") . $event->otherMin . t_("for") . t_("other min") . "," . " "
                    . $event->otherMax . t_("for") . t_("other max") . "," . " "
                    . $event->talebatMin . t_("for") . t_("talebat min") . "," . " "
                    . $event->talebatMax . t_("for") . t_("talebat max");
                $drivers = User::whereIsActive(1)->whereStatus('active')->whereOrganizationId(auth()->id())->with(['deviceTokens'])->get();
                foreach ($drivers as $driver) {
                    $tokens = $driver->sendableTokens;
                    $driver->notify(new FcmNotification($tokens, __("Organization prices changed should update"), $message, FCMTopic::ORGANIZATION_CHANGED_PRICE, FCMAction::DRIVER_CHANGE_PRICE));
                    $driver->update([
                        'update_price' => 1,
                    ]);
                }
            }
        }
        if ($request->hasFile('avatar'))
            uploadMedia('avatar', $request->avatar, $user);

        toast(t_('Updated Successfully'), 'success');

        return back();
    }
}
