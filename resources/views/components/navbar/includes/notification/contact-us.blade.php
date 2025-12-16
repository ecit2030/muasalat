@if($type == 'App\Notifications\NewContact')

    <span
        class="dropdown-item dropdown-header">{{count($Notification) .' '.t_('Contact Notifications')}} </span>
    <div class="dropdown-divider"></div>
    @forelse($Notification->take(10) as $notify)

        <a href="{{route('admin.contact.index').'?id=row_'.data_get('id',$notify->data)}}" class="dropdown-item mark-as-read" data-id="{{ $notify->id }}">
            <div>  <i class="fas fa-joget mr-2"> {{ data_get('name',$notify->data) . " - " . data_get('subject',$notify->data) }} </i> </div>
            <span class="float-right text-muted text-sm">{{ $notify->created_at->diffForHumans() }}</span>
        </a>
        <div class="dropdown-divider"></div>

    @empty
    @endforelse

@endif
