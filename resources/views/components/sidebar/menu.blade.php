@props(['name','icon'=>'','items'=>[]])


<!--begin:Menu item-->
<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
    <!--begin:Menu link-->

    <span class="menu-link">
        @if($icon !== '')
            <span class="menu-icon">
                <!--begin::Svg Icon | path: icons/duotune/communication/com005.svg-->
                <span class="svg-icon svg-icon-2">
                    <i class="{{$icon}} la-2x ml-2"></i>
                </span>
                <!--end::Svg Icon-->
            </span>
        @endif
        <span class="menu-title">{{  $name  }}</span>
        <span class="menu-arrow"></span>
    </span>
    <!--end:Menu link-->
    <!--begin:Menu sub-->
    <div class="menu-sub menu-sub-accordion">
        <!--begin:Menu item-->
        @foreach($items as $item)
        @continue($item['permission'] !== '' && !auth()?->user()?->can($item['permission']))
            <x-sidebar.link
                    :name="$item['name']"
                    :icon="$item['icon']"
                    :url="$item['url']"
            />
    @endforeach

    <!--end:Menu item-->

    </div>
    <!--end:Menu sub-->
</div>
<!--end:Menu item-->

