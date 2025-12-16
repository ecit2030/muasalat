<x-form route="dashboard.general.administration.roles" :title="t_('Roles')">

    <x-form.input name="name" required :label="t_('name')" :info="t_('pleas enter role name')"/>
    <div class="col-md-12 ">


        <div class="card card-shadow">
            <div class="card-header">
                <div class="card-title mg-b-0">
                    <h5 class="card-title">
                        {{t_('Permissions')}}
                    </h5>
                </div>
                <div class="card-toolbar">
                    <i class="mdi text-gray">
                        <a class="btn btn-danger btn-hover-rise float-right btn-sm deselect_all_modules"><i
                                    class="fa fa-times-circle"></i></a>
                        <a class="btn btn-primary btn-hover-rise float-right btn-sm select_all_modules"><i
                                    class="fa fa-check-square"></i></a>
                    </i>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    @foreach($modules as $module)
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">

                            <div class="card card-dashed card-outline">
                                <div class="card-header">

                                    <div class="card-title mg-b-0">
                                        <h5 class="card-title">{{t_($module['title'])}}</h5>
                                    </div>
                                    <div class="card-toolbar">
                                        <i class="mdi text-gray">
                                            <a class="btn btn-danger btn-hover-rise float-right btn-sm deselect_module"><i
                                                        class="fa fa-times-circle"></i></a>

                                            <a class="btn btn-primary btn-hover-rise float-right btn-sm select_module"><i
                                                        class="fa fa-check-square"></i></a>

                                            @error(dotted_string('permissions[]'))
                                            <div class="text-danger text-center">{{ $message }}</div>
                                            @enderror
                                        </i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-rounded table-hover table-flush">
                                                <thead>
                                                <tr class="fw-semibold fs-7 text-danger border-bottom border-gray-200 py-4">
                                                    <th scope="col">{{t_('name')}}</th>
                                                    <th scope="col">{{t_('key')}}</th>
                                                    <th scope="col">{{t_('status')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(data_get($module,'permissions') as    $K=> $permission)
                                                    <tr class="py-5 fw-semibold  border-bottom border-gray-300 fs-6">
                                                        <td>{!! Form::label(data_get($permission,'name'),t_(data_get($permission,'title')),['class'=> $errors->has(dotted_string('permissions[]')) ? 'text-danger' : '' ]) !!}
                                                        </td>
                                                        {{-- <td><small>{{data_get($permission,'name')}}</small></td> --}}
                                                        <td><small>{{ t_(''.$module['title']).' '.t_(''.str($permission['name'])->replaceFirst('_'.$module['title'],''))}}</small></td>
                                                        <td>

                                                            <label class="form-check form-switch form-check-custom form-check-solid"
                                                                   for="{{data_get($permission,'name')}}">
                                                                {!! Form::checkbox("permissions[]",data_get($permission,'id'),null,["class"=>"form-check-input",'id'=>data_get($permission,'name')]) !!}
                                                            </label>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <x-slot name="scripts">
        <script>
            (function ($) {

                "use strict";

                $('.select_all_modules').on('click', function () {
                    $('input[type=checkbox]').prop('checked', true);
                });

                $('.deselect_all_modules').on('click', function () {
                    $('input[type=checkbox]').prop('checked', false);
                });

                $('.select_module').on('click', function () {
                    $(this).parent().parent().parent().next('.card-body').find('input[type=checkbox]').prop('checked', true);

                });

                $('.deselect_module').on('click', function () {
                    $(this).parent().parent().parent().next('.card-body').find('input[type=checkbox]').prop('checked', false);
                });

            })(jQuery);

        </script>
    </x-slot>

</x-form>
