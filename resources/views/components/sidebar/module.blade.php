@props(['name','iconType'=>'material-icons','showHeader'=>true,'icon','items','configData'])

@if($showHeader)
    <!--begin:Menu item-->
{{--    <div class="menu-item pt-5">--}}
{{--        <!--begin:Menu content-->--}}
{{--        <div class="menu-content">--}}
{{--            <span class="menu-heading fw-bold text-uppercase fs-7">{{ $name }}</span>--}}
{{--        </div>--}}
{{--        <!--end:Menu content-->--}}
{{--    </div>--}}
    <!--end:Menu item-->
@endif

@foreach($items as $item)
    @continue($item['permission'] !== '' && !auth()?->user()?->can($item['permission']))
    @if(isset($item['items']))
        <x-sidebar.menu
                :name="$item['name']"
                :icon="$item['icon']"
                :items="$item['items']"
        />
    @else
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="{{ $item['url'] }}">
                <span class="menu-icon">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->

                    @if(filled($item['icon']))
                        <span class="svg-icon svg-icon-2">
                            <i class="{{$item['icon']}} la-2x "></i>
                        </span>
                @endif


                <!--end::Svg Icon-->
                </span>
                <span class="menu-title">{{ $item['name'] }}</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->
    @endif
@endforeach



