<?php

namespace App\Support\Sidebar;

use App\Support\Sidebar\Components\SidebarGenerator;
use App\Support\Sidebar\Components\SidebarLink;
use App\Support\Sidebar\Components\SidebarMenu;
use function route;

class Sidebar
{
    public function __invoke()
    {
        $generator = SidebarGenerator::create();

        if (activeGuard('dashboard')) {
            $generator->addModule(t_('dashboard'), 'icon-home', false)->push($this->dashboard());
            $generator->addModule(t_('general'), 'icon-home')->push($this->general());
            // $generator->addModule(t_('area'), 'icon-home')->push($this->area());
            $generator->addModule(t_('user'), 'icon-home')->push($this->user());
            $generator->addModule(t_('chats'), 'icon-rocketchat')->push($this->chats());
            $generator->addModule(t_('notification'), 'icon-home')->push($this->notification());
            $generator->addModule(t_('organization'), 'icon-home')->push($this->organization());
            $generator->addModule(t_('captain'), 'icon-home')->push($this->captain());
            $generator->addModule(t_('vehicle'), 'icon-home')->push($this->vehicle());
            $generator->addModule(t_('driver'), 'icon-home')->push($this->driver());
            $generator->addModule(t_('track'), 'icon-home')->push($this->track());
            $generator->addModule(t_('trip'), 'icon-home')->push($this->trip());
            $generator->addModule(t_('setting'), 'icon-home')->push($this->setting());
            $generator->addModule(t_('wallet'), 'icon-home')->push($this->wallet());
        }

        return $generator->toArray();
    }

    public function dashboard()
    {
        return [
            SidebarLink::to(
                t_('dashboard'),
                route('dashboard.home'),
                'las la-tachometer-alt  ',
                'line-awesome'
            ),
        ];
    }

    public function vehicle()
    {
        $adminList = [
            SidebarLink::to(t_('vehicle index'), route('modules.vehicle.dashboard.vehicle-brand.index'), '', permission: 'view_vehicle'),
            SidebarLink::to(t_('index vehicle request'), route('modules.vehicle.dashboard.vehicle-request.index'), '', permission: 'view_vehicle_request'),
            SidebarLink::to(t_('org vehicle index'), route('modules.vehicle.dashboard.user-vehicle.index'), '', permission: 'view_user_vehicle'),
            SidebarLink::to(t_('create vehicle request'), route('modules.vehicle.dashboard.vehicle-request.create'), '', permission: 'create_vehicle_request'),
        ];
        return [
            SidebarMenu::create(t_('vehicles manage'), 'fas fa-car', permission: 'view_user_vehicle')
                ->push($adminList),
        ];
    }


    public function page()
    {
        $adminList = [
            SidebarLink::to(t_('Pages'), route('dashboard.general.pages.index'), 'las la-file-alt ', 'line-awesome', permission: 'view_static_page'),
        ];
        return [
            SidebarMenu::create(t_('page'), 'las la-paper', permission: 'view_static_page')->push($adminList),
        ];
    }


    public function notification()
    {
        $adminList = [
            SidebarLink::to(t_('notification index'), route('dashboard.notifications.notifications.index'), 'las la-file-alt ', 'line-awesome', permission: 'view_notification'),
            SidebarLink::to(t_('add notification'), route('dashboard.notifications.notifications.create'), 'las la-file-alt ', 'line-awesome', permission: 'create_notification'),
        ];
        return [
            SidebarMenu::create(t_('notifications manage'), 'las la-bell', permission: 'view_notification')->push($adminList),
        ];
    }

    public function area()
    {
        $adminList = [
            SidebarLink::to(t_('Areas'), route('dashboard.general.areas.index'), 'las la-globe ', 'line-awesome', permission: 'view_area'),
        ];
        return [
            SidebarMenu::create(t_('Areas'), 'las la-globe', permission: 'view_area')->push($adminList),
        ];
    }


    public function general()
    {
        $adminList = [
            SidebarLink::to(t_('admins'), route('dashboard.general.administration.admins.index'), 'fa-solid fa-user-tie', permission: 'view_administration'),
            SidebarLink::to(t_('role'), route('dashboard.general.administration.roles.index'), "fa-solid fa-person-circle-question", permission: 'view_role'),
        ];
        return [
            SidebarMenu::create(t_('admins'), 'fa-solid fa-user-tie', permission: 'view_administration')
                ->push($adminList),

        ];
    }

    public function user()
    {

        $adminList = [
            SidebarLink::to(t_('users index'), route('dashboard.user.users.index')),
        ];

        return [
            SidebarMenu::create(t_('users manage'), 'las la-users ', permission: 'view_user')
                ->push($adminList),
        ];
    }
    public function chats()
    {

        $adminList = [
            SidebarLink::to(__('messages.chats'), route('dashboard.chat.chats.index')),
        ];

        return [
            SidebarMenu::create(__('messages.manage chats'), 'las la-comment ', permission: 'view_user')
                ->push($adminList),
        ];
    }

    public function organization()
    {

        $adminList = [
            SidebarLink::to(t_('organizations index'), route('dashboard.organization.organization.index'), permission: 'view_organization'),
            SidebarLink::to(t_('organizations request'), route('dashboard.organization.organizationRequest.index'), permission: 'view_organization_request'),
        ];

        return [
            SidebarMenu::create(t_('organizations manage'), 'las la-building', permission: 'view_organization')
                ->push($adminList),
        ];
    }

    public function captain()
    {

        $adminList = [
            SidebarLink::to(t_('captains index'), route('dashboard.captain.captain.index'), permission: 'view_captain'),
            SidebarLink::to(t_('captains request'), route('dashboard.captain.captainRequest.index'), permission: 'view_captain_request'),
        ];

        return [
            SidebarMenu::create(t_('captains manage'), 'fas fa-helmet-safety', permission: 'view_captain')
                ->push($adminList),
        ];
    }
    public function driver()
    {
        $admin = auth()->user()->hasRole("admin");
        $adminList = [
            SidebarLink::to(t_('drivers index'), route('dashboard.driver.driver.index'), permission: 'view_driver'),
        ];
        if(!$admin){
            $adminList[] = SidebarLink::to(t_('add driver'), route('dashboard.driver.driver.create'), permission: 'create_driver');
        }

        return [
            SidebarMenu::create(t_('drivers manage'), 'fas fa-id-card ', permission: 'view_driver')
                ->push($adminList),
        ];
    }


    public function track()
    {
        $adminList = [
            SidebarLink::to(t_('tracks index'), route('dashboard.track.track.index'), permission: 'view_track'),
            SidebarLink::to(t_('add track'), route('dashboard.track.track.create'), permission: 'create_track'),
        ];

        return [
            SidebarMenu::create(t_('tracks manage'), 'las la-map', permission: 'view_track')
                ->push($adminList),
        ];
    }

    public function trip()
    {
        $adminList = [
            SidebarLink::to(t_('trips index'), route('dashboard.trips.trips.index')),
//            SidebarLink::to(t_('trips by track index'), route('dashboard.trips.trips.indextrack')),
        ];

        return [
            SidebarMenu::create(t_('trips manage'), 'las la-map', permission: 'view_trip')
                ->push($adminList),
        ];
    }

    public function wallet()
    {
        $adminList = [
            SidebarLink::to(t_('wallet withdraw order'), route('dashboard.wallet.wallet.create') , permission: 'create_user_withdraw'  ),
            SidebarLink::to(t_('wallet pending'), route('dashboard.wallet.wallet.index' , ["status=pending" ])),
            SidebarLink::to(t_('wallet accepted'), route('dashboard.wallet.wallet.index' , ["status=accepted" ])),
            SidebarLink::to(t_('wallet declined'), route('dashboard.wallet.wallet.index' , ["status=declined" ])),
        ];

        return [
            SidebarMenu::create(t_('wallet manage'), 'las la-map', permission: 'view_user_withdraw')
                ->push($adminList),
        ];
    }

    public function setting()
    {
        $adminList = [
            SidebarLink::to(t_('Settings'), route('dashboard.setting.index'), 'las la-cogs ', 'line-awesome', permission: 'view_setting'),
            SidebarLink::to(t_('faqs'), route('dashboard.faqs.faqs.index'), 'las la-globe ', 'line-awesome', permission: 'view_faq'),
            SidebarLink::to(t_('pages index'), route('dashboard.general.pages.index'), permission: 'view_static_page'),
            SidebarLink::to(t_('ContactUs'), route('dashboard.general.contact-us.index'), 'fa-regular fa-address-card ', 'line-awesome', permission: 'view_contact_us'),
        ];

        return [
            SidebarMenu::create(t_('setting'), 'las la-cogs', permission: 'view_setting')
                ->push($adminList),
        ];
    }

    public function pages()
    {
        $adminList = [
            SidebarLink::to(t_('pages index'), route('dashboard.general.pages.index')),
        ];

        return [
            SidebarMenu::create(t_('pages manage'), 'las la-file-alt', permission: 'view_page')
                ->push($adminList),
        ];
    }
}
