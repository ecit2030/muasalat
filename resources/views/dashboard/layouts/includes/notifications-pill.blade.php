    @php
    $user = auth()->guard(activeGuard())->user();
@endphp

@isset($user)
    @if($user)
        @php
            $Notifications = $user->unreadNotifications()->get();
        @endphp

        <div class="dropdown nav-item main-header-notification">
            <a class="new nav-link" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round" class="feather feather-bell">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
                @if(count($Notifications))
                    <span class=" pulse"></span>
                @endif
            </a>


            <div class="dropdown-menu">
                <div class="menu-header-content bg-primary text-right">
                    <div class="d-flex">
                        <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">{{t_('notifications')}}</h6>
                        @if(count($Notifications))
                            <button class="badge badge-pill mr-auto my-auto float-left text-dark btn btn-warning ">{{t_('mark all read')}}</button>
                        @endif

                    </div>
                    @if(count($Notifications))
                        <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">{{t_('you have :count unread notifications',['count'=>count($Notifications)])}}</p>
                    @endif
                </div>
                <div class="main-notification-list Notification-scroll">

                    @forelse($Notifications->groupBy('type') as $type =>  $Notification)

                        @include('dashboard.layouts.includes.notification.new-store')
                        @include('dashboard.layouts.includes.notification.contact-us')

                    @empty

                    @endforelse

                </div>
                <div class="dropdown-footer">
                    <small class="text-danger">{{t_('not have any notification')}}</small>

                    @if(count($Notifications))
                        <a href="#Notification">{{t_('VIEW ALL')}}</a>
                    @endif

                </div>
            </div>
        </div>

    @endif
@endisset


@push('scripts')

    <script>
        function sendMarkRequest(id = null) {
            return $.ajax("{{ route('dashboard.general.notification.mark') }}", {
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            });
        }

        $(function () {
            $('.mark-as-read').click(function () {
                let request = sendMarkRequest($(this).data('id'));
                console.log($(this).data('id'))
                request.done(() => {
                    $(this).parents('div.alert').remove();
                });
            });

            $('#mark-all').click(function () {
                let request = sendMarkRequest();
                request.done(() => {
                    $('div.alert').remove();
                })
            });
        });

    </script>

@endpush
