<x-pages.layout :title="t_('contact Details')">
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">{{ t_('information about') }}</h1>
                            <div class="billed-from">
                                <h6>{{ $user->name }}</h6>
                                <p>
                                    {{-- {{ t_('Tel No') }}: {{ $user->phone }} <br> --}}
                                    {{ t_('Email') }}: {{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <div class="col-md-6">
                                <label class="tx-gray-600">{{ t_('address') }}</label>
                                @if($user->addresses)
                                    @foreach($user->addresses as $address)
                                        <p class="invoice-info-row">

                                            {{$address->address}}
                                        </p>
                                        <br>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- Message Modal -->

</x-pages.layout>
