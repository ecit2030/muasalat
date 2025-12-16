@if($type == 'App\Notifications\UserNotification')


    @forelse($Notification->take(10) as $notify)

        <a href="#" class="d-flex p-3 border-bottom mark-as-read"
           data-id="{{ $notify->id }}">

            <div class="notifyimg bg-pink">
                <i class="la la-file-alt text-white"></i>
            </div>
            <div class="mr-3">
                <h5 class="notification-label mb-1"> {{ data_get('notification_name',$notify->data) }} </h5>
                <div class="notification-subtext">{{ $notify->created_at->diffForHumans() }}</div>
            </div>
            <div class="mr-auto">
                <i class="las la-angle-left text-left text-muted"></i>
            </div>
        </a>

    @empty
    @endforelse

@endif
