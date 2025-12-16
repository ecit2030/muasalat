<div class="app-sidebar__user clearfix">

    <div class="dropdown user-pro-body">

        <div class="">
            <img alt="user-img" class="avatar avatar-xl brround" src="{{auth(activeGuard())->user()?->avatar}}"><span
                    class="avatar-status profile-status bg-green"></span>
        </div>
        <div class="user-info">
            <h4 class="font-weight-semibold mt-3 mb-0">{{auth(activeGuard())->user()?->name}}</h4>
        </div>

    </div>
</div>
