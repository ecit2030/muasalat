<x-pages.datatable :title="t_('frequencytransmissions')" route="dashboard.trips.frequencytransmissions" :datatable="$dataTable">
    <x-slot:prepend>
        @php
            $status = request('status');
            $baseParams = request()->except(['page']);
            $isRtl = (bool) session('language.rtl');
            $tabs = [
                [
                    'key' => 'completed',
                    'label' => t_('finished trips'),
                ],
                [
                    'key' => 'driver_waiting',
                    'label' => t_('Pending driver'),
                ],
                [
                    'key' => 'driver_refused',
                    'label' => t_('Rejected by driver'),
                ],
                [
                    'key' => 'current',
                    'label' => t_('current trips'),
                ],
                [
                    'key' => 'scheduled',
                    'label' => t_('scheduled'),
                ],
                [
                    'key' => null,
                    'label' => t_('all trips'),
                ],
            ];
        @endphp

        <div class="d-flex flex-stack flex-wrap gap-4 mb-6 {{ $isRtl ? 'flex-row-reverse' : '' }}">
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard.trips.frequencytransmissions.create') }}" class="btn btn-sm btn-primary px-5">
                    <span class="svg-icon svg-icon-2 me-2 {{ $isRtl ? 'ms-2 me-0' : '' }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3" d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z" fill="currentColor"/>
                            <path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z" fill="currentColor"/>
                        </svg>
                    </span>
                    {{ t_('add frequencytransmission') }}
                </a>
            </div>

            <div class="{{ $isRtl ? 'text-end' : 'text-start' }}">
                <div class="fs-2 fw-bold text-gray-900">{{ t_('frequencytransmissions') }}</div>
                <div class="text-muted fw-semibold">{{ t_('frequencytransmissions manage') }}</div>
            </div>
        </div>

        <div class="card mb-6">
            <div class="card-body p-3">
                <ul class="nav nav-pills nav-fill flex-nowrap gap-2 bg-primary rounded-3 p-2">
                    @foreach($tabs as $tab)
                        @php
                            $isActive = ($tab['key'] === null && $status === null) || ($tab['key'] !== null && $status === $tab['key']);
                            $tabParams = $baseParams;
                            if ($tab['key'] === null) {
                                unset($tabParams['status']);
                            } else {
                                $tabParams['status'] = $tab['key'];
                            }
                        @endphp
                        <li class="nav-item">
                            <a class="nav-link rounded-3 {{ $isActive ? 'active bg-white shadow-sm fw-bold text-gray-900' : 'text-gray-700' }}"
                               href="{{ url()->current() . (count($tabParams) ? ('?' . http_build_query($tabParams)) : '') }}">
                                {{ $tab['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </x-slot:prepend>
</x-pages.datatable>