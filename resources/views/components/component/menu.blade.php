@props(["model"=> null])

<div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
    <!--begin:Menu link-->

    <span class="menu-link">
        <span class="menu-icon">

            {{-- <span class="svg-icon svg-icon-2">
                <i class="las la-bell la-2x ml-2"></i>
            </span> --}}

        </span>
        <span class="menu-title">{{ $model['client']['name'] }}</span>
        <span class="menu-arrow"></span>
    </span>

    <div class="menu-sub menu-sub-accordion ">
        <div class="menu-item">

            <div class="row">
                <x-component.input col_size="6" value="{{ $model->rate }}" :label="t_('rate')" />
            </div>
            <div class="row">
                <x-component.input col_size="6" value="{{ $model->track['origin']['location'] }}" :label="t_('start point')" />
                <x-component.input col_size="6" value="{{ $model->track['destination']['location'] }}" :label="t_('end point')" />
            </div>


            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->

    </div>
    <!--end:Menu sub-->
</div>
