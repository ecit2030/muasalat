<x-pages.datatable :title="t_('frequencytransmissions')" route="dashboard.trips.frequencytransmissions" :datatable="$dataTable">
    <x-slot:prepend>
        @php
            $isRtl = (bool) session('language.rtl');
        @endphp

        <div class="d-flex flex-stack flex-wrap gap-4 mb-6 {{ $isRtl ? 'flex-row-reverse' : '' }}">
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('dashboard.trips.frequencytransmissions.index') }}" class="btn btn-sm btn-light px-5">
                    {{ t_('back') }}
                </a>
            </div>

            <div class="{{ $isRtl ? 'text-end' : 'text-start' }}">
                <div class="fs-2 fw-bold text-gray-900">{{ t_('frequencytransmissions') }}</div>
                <div class="text-muted fw-semibold">{{ t_('clients selected trips') }}</div>
            </div>
        </div>
    </x-slot:prepend>
</x-pages.datatable>

