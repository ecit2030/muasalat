<x-pages.layout :title="t_('admin details')">
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">


                            <div class="billed-from">
                                <div class="d-flex justify-center gap-3 pt-5" style="font-size:30px">
                                    @if ($model?->is_active)
                                        <x-ui.badge :class="'fs-2'" :value="t_('active')" color="success" />
                                    @else
                                        <x-ui.badge :class="'fs-2'" :value="t_('not active')" color="danger" />
                                    @endif
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <x-component.image :col_size="6" value="{{ $model?->getFirstMediaUrl('avatar') }}"
                                    :label="t_('avatar')" />
                            </div>

                            <div class="row">
                                <x-component.input :col_size="4" value="{{ $model?->name }}" :label="t_('name')" />
                                <x-component.input :col_size="4" value="{{ $model?->email }}" :label="t_('email')" />
                                <x-component.input :col_size="4" value="{{ $model?->phone }}" :label="t_('phone')" />
                            </div>

                            <div class="row">
                                <x-component.input :col_size="6" value="{{ $model?->login_count }}" :label="t_('login count')" />
                                <x-component.input :col_size="6" value="{{ $model?->last_login?->diffForHumans() }}" :label="t_('last login')" />
                            </div>




                        </div>
                    </div>
                </div>
            </div><!-- COL-END -->
        </div>
        <!-- Message Modal -->

</x-pages.layout>
