<x-pages.layout :title="t_('vehicle request details')">
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">{{ t_('information about') }}</h1>
                            <div class="billed-from">

                                <div class="p-3">{{ $model?->user?->name }}</div>

                                <div class="p-3 fs-4">{{ $model?->content }}</div>

                                <div class="p-3 fs-4">
                                    @if ($model?->status == 'approved')
                                    <x-ui.badge :value="__('Approved')" color="success"/>
                                    @elseif ($model?->status == 'rejected')
                                    <x-ui.badge :value="__('Rejected')" color="danger"/>
                                    @else
                                    <x-ui.badge :value="__('Pending')" color="warning"/>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- Message Modal -->

</x-pages.layout>
