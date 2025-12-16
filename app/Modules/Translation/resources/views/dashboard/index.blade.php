<x-pages.layout :title="t_('translation')">
@php
    $api_keys       = setting('api_keys');
    $trans_api      = config("custom.YANDEX_TRANSLATION_API");
@endphp

<!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">

                <div class="card-header pb-0">


                    <div class="card-title mg-b-0">
                        <p class="tx-12 tx-gray-500 mb-2">
                            <x-form.toggle col_size="0" :label="t_('Update Table after change')" name="update_table" :value="false"/>
                        </p>
                    </div>

                    <div class="card-toolbar">
                        <div class="text-gray input-group">

                            <button class='btn btn-sm btn-success' id="generate_trans_file" onclick="generate_trans_file(this)">
                                <span class="indicator-label">{{t_('generate_trans_file')}}</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">{{t_('Please wait')}}...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>

                            {{--

                                                        <button class='btn btn-sm btn-success' id="create_translation_table" onclick="create_translation_table(this)">
                                                            <span class="indicator-label">{{t_('create_translation_table')}}</span>
                                                            <!--end::Indicator label-->
                                                            <!--begin::Indicator progress-->
                                                            <span class="indicator-progress">{{t_('Please wait')}}...
                                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                            <!--end::Indicator progress-->
                                                        </button>
                            --}}


                            <button class='btn btn-sm btn-success' id="translation" onclick="translation(this)">
                                <span class="indicator-label">{{t_('auto translation')}}</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">{{t_('Please wait')}}...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>

                            {{--                                            <button type="button" class="btn btn-light mb-2 mr-1">@lang(t_('Import'))</button>
                                                                        <button type="button" class="btn btn-light mb-2">@lang(t_('Export'))</button>--}}
                            <button onclick="addForm()" class='btn btn-sm btn-info'>
                                <i class="fa fa-plus-circle"></i>
                                <span class="indicator-label">{{t_('Add')}}</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">{{t_('Please wait')}}...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <div class="col-lg-12 table-responsive">
                        <table class="table table-bordered table-striped table-hover"
                               id="trans_table">
                            <thead>
                            <tr>

                                <th width="15">@lang(t_('#'))</th>
                                <th width="80">@lang(t_('Code'))</th>
                                <th width="80">@lang(t_('Default_Value'))</th>

                                @foreach($languages as $Lang)

                                    <th class="language" style="width: 200px;"
                                        data-code="{{$Lang->code}}"
                                        data-local="{{$Lang->local}}">
                                        <img src=" {{ asset($Lang->flag) }} "
                                             style="width: 30px; margin-right: 10px;">
                                        <span>  {{ $Lang->name }}   </span></th>

                                @endforeach

                                <th style="width: 85px;">{{t_('Actions')}}</th>

                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>

    <!-- end row -->

    @include('Translation::dashboard._form')

    <x-slot name="styles">
        @if(session('language.rtl'))
            <link href="{{ asset('dashboard/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
        @else
            <link href="{{asset('dashboard/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
        @endif
    </x-slot>

    <x-slot name="scripts">
        <script src="{{ asset('dashboard/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"
                type="text/javascript"></script>

        <script type="text/javascript">

            var table, save_method;
            $(function () {
                table = $('#trans_table').DataTable({
                    dom: `<'row'<'col-sm-6 d-flex align-items-center justify-conten-start'B>
             <'col-sm-6 d-flex align-items-center justify-content-end'f>>
              <'table-responsive'tr>
              <'row'<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'l - i >
              <'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>>`,
                    buttons: [
                        {
                            extend: 'copyHtml5',
                            text: '<i class="fas fa-copy"></i> {{t_("Copy")}} ',
                            titleAttr: 'Copy'
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel"></i> {{t_("Excel")}}',
                            titleAttr: 'Excel'
                        }
                    ],
                    /* "colVis": {
                         "buttonText": "Change columns"
                     },*/
                    // "scrollY":        "300px",
                    /*"scrollX":        true,
                    "scrollCollapse": false,

                    "paging":         false,*/
                    /*

                     "fixedColumns":   {
                         leftColumns: 2
                     },*/
                    "processing": true,
                    responsive: !0,
                    fixedHeader: true,
                    "ajax": {
                        "url": "{{ route('modules.translation.dashboard.data') }}",
                        "type": "GET"
                    },
                    "language": {
                        "sEmptyTable": '{{t_("No data available in table")}}',
                        "sInfo": '{{t_('Showing')}} _START_ {{t_('to')}} _END_ {{t_('of')}} _TOTAL_ {{t_('records')}}',
                        "sInfoEmpty": ' {{t_('Showing')}} 0 {{t_('to')}} 0 {{t_('of')}} 0 {{t_('records')}}',
                        "sInfoFiltered": "({{t_('filtered')}} {{t_('from')}} _MAX_ {{t_('total')}}  {{t_('records')}} )",
                        "sInfoPostFix": "",
                        "sInfoThousands": ",",
                        "sLengthMenu": '{{t_('Show')}} _MENU_ {{t_('records')}}',
                        "sLoadingRecords": '{{t_('loading...')}}',
                        "sProcessing": '{{t_('Processing...')}}',
                        "sSearch": '{{t_("search")}} : ',
                        "sZeroRecords": '{{t_('No matching records found')}}',
                        "oPaginate": {
                            "sFirst": '{{t_('First')}}',
                            "sLast": '{{t_('Last')}}',
                            "sNext": '{{t_('Next')}}',
                            "sPrevious": '{{t_('previous')}}'
                        },
                    }
                });


                $('#modal-form form').on('submit', function (e) {
                    if (!e.isDefaultPrevented()) {

                        url = "{{ route('modules.translation.dashboard.add') }}";


                        $.ajax({
                            xhr: function () {
                                var xhr = new window.XMLHttpRequest();
                                xhr.upload.addEventListener("progress", function (evt) {
                                    if (evt.lengthComputable) {
                                        var percentComplete = ((evt.loaded / evt.total) * 100);
                                        $(".progress-bar").width(percentComplete + '%');
                                        $(".progress-bar").html(percentComplete + '%');
                                    }
                                }, false);
                                return xhr;
                            },

                            type: 'POST',
                            url: url,
                            data: new FormData($(".form")[0]),
                            contentType: false,
                            cache: false,
                            processData: false,

                            beforeSend: function () {
                                $(".progress-bar").width('0%');
                                $('#uploadStatus').html('<img src="{{ asset('/admin/assets/images/sp-loading.gif') }}"/>');
                            },
                            success: function (resp) {

                                toastr.success("{{t_('Data_Saved_Successful')}}");

                                $('#modal-form').modal('hide');
                                $('.progress-bar').width('0%');
                                $(".progress-bar").html('');
                                $('#uploadStatus').html('');
                                table.ajax.reload();

                            },
                            error: function () {
                                toastr.error('لا يمكن حفظ البيانات !');
                                $('#uploadStatus').html(`<p style="color:#EA4335;">{{t_('File upload failed, please try again')}}</p>`);


                            }
                        });

                        return false;
                    }

                });
            });

            function addForm() {
                save_method = "add";
                $('input[name=_method]').val('POST');
                $('#modal-form').modal('show');
                $('#modal-form form')[0].reset();
                $("#Logo").val('');
                $('.modal-title').text("{{t_('add new translate')}}");
            }

            function generate_trans_file() {
                var Button = document.querySelector('#generate_trans_file');

                $.ajax({
                    url: '{{route('modules.translation.dashboard.generateLangFiles')}}',
                    type: "GET",
                    dataType: "JSON",
                    beforeSend: function () {
                        // Show loading indication
                        Button.setAttribute('data-kt-indicator', 'on');
                        // Disable button to avoid multiple click
                        Button.disabled = true;
                    },
                    success: function (res) {

                        if (res.success) {
                            toastr.success(res.message);
                        } else {
                            toastr.error('لا يمكن الوصول للبيانات !');
                        }
                        Button.removeAttribute('data-kt-indicator');
                        // Enable button
                        Button.disabled = false;
                    },
                    error: function () {
                        toastr.error('لا يمكن الوصول للبيانات !');
                    }
                });
            }

            function create_translation_table() {

                var Button = document.querySelector('#create_translation_table');

                $.ajax({
                    url: '{{route('modules.translation.dashboard.create.translation.table')}}',
                    type: "GET",
                    dataType: "JSON",
                    beforeSend: function () {
                        // Show loading indication
                        Button.setAttribute('data-kt-indicator', 'on');
                        // Disable button to avoid multiple click
                        Button.disabled = true;
                    },
                    success: function (res) {

                        if (res.success) {
                            toastr.success(res.message);
                        } else {
                            toastr.error('لا يمكن الوصول للبيانات !');
                        }
                        Button.removeAttribute('data-kt-indicator');
                        // Enable button
                        Button.disabled = false;
                    },
                    error: function () {
                        toastr.error('لا يمكن الوصول للبيانات !');
                    }
                });
            }

            function deleteData(id) {
                if (confirm("هل انت متأكد من حذف البيانات")) {
                    $.ajax({
                        url: '{{url('/')}}/modules/translation/dashboard/delete/' + id,
                        type: "GET",
                        data: {'_method': 'GET', '_token': $('meta[name=csrf-token]').attr('content')},
                        success: function (data) {
                            toastr.success('{{t_('data deleted success')}}');
                            table.ajax.reload();
                        },
                        error: function () {
                            toastr.error('{{t_('cant access data')}}');
                        }
                    });
                }
            }

            function translation() {
                new Promise(function () {
                    var Counter = 1;
                    var Countera = 1;
                    var Button = document.querySelector('#translation');
                    /*
                    Decomentation
                    https://yandex.com/dev/translate/doc/dg/reference/translate.html

                        https://translate.yandex.net/api/v1.5/tr.json/translate
                        ? [key=<API key>]
                        & [text=<text to translate>]
                        & [lang=<translation direction>]
                        & [format=<text format>]
                        & [options=<translation options>]
                        & [callback=<callback function name>]

                    */


                    $('textarea').each(function (index) {
                        // Show loading indication
                        Counter++
                        var elementId = $(this).attr("id");
                        var elementLang = $(this).attr("data-lang_local");
                        var element_trans_key = $(this).attr("data-trans_key");
                        var element_default_value = $(this).attr("data-default_value");
                        var elementValue = $(this).val();


                        if (elementValue === '') {
                            Countera++


                            //Call the Yandex API
                            $.ajax({
                                type: "GET",
                                url: "https://translate.yandex.net/api/v1.5/tr.json/translate",
                                dataType: 'jsonp',
                                cache: false,
                                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                                async: true,
                                data: {
                                    "key": '{{ $trans_api }}',
                                    "text": element_default_value,
                                    "lang": elementLang,
                                    "format": "plain",
                                },
                                beforeSend: function () {
                                    Button.setAttribute('data-kt-indicator', 'on');
                                    Button.disabled = true;
                                },
                                success: function (res) {
                                    if (res.code === 200) {

                                        $('#' + elementId).val(capitalizeFirstLetter(res.text[0])).change();
                                    } else {
                                        toastr.error(res.message + "{{ config('Translation.translation_api.yandex') }}");
                                    }
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                }
                            }).then(function () {
                                Button.removeAttribute('data-kt-indicator');
                                // Enable button
                                Button.disabled = false;
                            });
                        }
                    })
                });

            }


            // program to convert first letter of a string to uppercase
            function capitalizeFirstLetter(str) {

                // converting first letter to uppercase
                return str.charAt(0).toUpperCase() + str.slice(1);
            }

        </script>
        <script>

            $(document).on('change', '.Translation_Value', function (e) {
                var Lang = $(this).attr('data-lang_local');
                var Key = $(this).attr('data-trans_key');
                var Value = $(this).val();
                var updateTable = $('#toggle_update_table').is(':checked');

                $.ajax({
                    url: '{{ route('modules.translation.dashboard.update') }}',
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        lang_local: Lang,
                        translation_key: Key,
                        lang_local_value: Value,
                    },
                    success: function (res) {
                        if (res.success) {
                            toastr.success(res.message);

                            if (updateTable) {
                                table.ajax.reload();
                            }
                        } else {
                            toastr.error(res.message);
                        }

                    },
                    error: function (err) {

                        toastr.error('لا يمكن الوصول للبيانات !');
                    }
                });
            });

        </script>
    </x-slot>

</x-pages.layout>
