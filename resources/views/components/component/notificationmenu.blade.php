@props(['key' => null, 'value' => null])

<div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
    <!--begin:Menu link-->

    <span class="menu-link">
        <span class="menu-icon">

            {{-- <span class="svg-icon svg-icon-2">
                <i class="las la-bell la-2x ml-2"></i>
            </span> --}}

        </span>
        <span class="menu-title fs-5 fw-bold">{{t_($key)}}</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion ">
        <div class="menu-item">

            <div class="row">
                <label class="fs-5" >{{t_('notified user')}}</label>
                @foreach ($value as $val)
                    <x-component.input col_size="3" value="{{ $val['name'] }}"  />
                @endforeach
            </div>


            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->

    </div>
    <!--end:Menu sub-->
</div>
