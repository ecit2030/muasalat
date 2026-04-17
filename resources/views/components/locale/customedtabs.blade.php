@props(['description'=>true,'title'=>true,'content'=>false, "cont"=> null , 'title_label'=>t_('title'),'description_label'=>t_('description')])

<div class="row py-10">
    <div class="col-lg-12">
        <div class="card border-top border-bottom border-gray-500 shadow-xs">

            <div class="card-body">
                <ul class="nav nav-pills nav-pills-custom mb-3">

                    @forelse($languages as $k => $lang)

                        <li class="nav-item mb-3 me-3 me-lg-6 @error('*.'.$lang->code) border-error @enderror" id="tap_link_{{$lang->code}}">
                            <!--begin::Link-->
                            <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden
                                w-80px h-85px pt-5 pb-2 link_{{$lang->code}} {{$lang->code == get_current_lang() ? "active":""}}"
                               id="kt_stats_widget_16_tab_link_1"
                               data-bs-toggle="pill"
                               href="#tab_{{$lang->code}}">
                                <!--begin::Icon-->
                                <div class="nav-icon mb-3">

                                    <img src=" {{ asset($lang->flag) }} "
                                         style="width: 20px;">
                                </div>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">{{ $lang->name }}</span>
                                <!--end::Title-->
                                <!--begin::Bullet-->
                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                <!--end::Bullet-->
                            </a>
                            <!--end::Link-->
                        </li>

                    @empty
                        <li class="nav-item">
                            {{ t_('Dont_Found_Any_Language') }}
                        </li>
                    @endforelse
                </ul>
                <div class="tab-content" id="myTabContent">

                    @forelse($languages as $lang)
                    <div class="tab-pane fade show  {{$lang->code == get_current_lang() ? "active":""}}"
                        id="tab_{{$lang->code}}"
                        role="tabpanel">

                        @if($title)
                                <div class="row">
                                    <x-form.input title="title[{{$lang->code}}]"
                                                  label="{{$title_label??t_('title')}}"
                                                  id="title_{{$lang->code}}"
                                                  name="title[{{$lang->code}}]"
                                                  lang="{{$lang->code}}"
                                                  dir="{{$lang->direction}}"
                                                  value="{{locale_field('title',$lang->code)}}"
                                                  />

                                </div>
                            @endif

                            @if($description)
                                <div class="tinymce">
                                    <x-form.input type="textarea" name="description[{{$lang->code}}]"
                                                  label="{{$description_label??t_('description')}}"
                                                  id="description_{{$lang->code}}"
                                                  lang="{{$lang->code}}"
                                                  class="tinymce_textarea"
                                                  dir="{{$lang->direction}}"
                                                  value="{{locale_field('description',$lang->code)}}"/>

                                </div>
                            @endif

                            @if($content)
                                <div class=" tinymce">
                                    <x-form.input type="textarea" name="content[{{$lang->code}}]"
                                                  label="{{$content_label??t_('content')}}"
                                                  id="content_{{$lang->code}}"
                                                  lang="{{$lang->code}}"
                                                  class="tinymce_textarea"
                                                  dir="{{$lang->direction}}"
                                                  value="{{$cont?->content}}"
                                                  />

                                </div>
                            @endif

                            @if($seo_status??true)
                                {{--                                @include('admin.inc._general_form._seo_input_form')--}}
                            @endif
                        </div>

                    @empty
                        <div class="nav-item">
                            {{ t_('Dont_Found_Any_Language') }}
                        </div>
                    @endforelse


                </div>
            </div>
        </div>
    </div>
</div>
