<x-pages.datatable
        :title="__('messages.chats')"
        route="dashboard.user.users"
        :datatable="$dataTable"
        :filter="true"
        :parameters="['id'=>request('id')]"
>
    <x-slot name="prepend">
        @php
            $messageStatus = [
                "read" => __('messages.read'),
                "unread" => __('messages.unread'),
            ];
        @endphp
        <div id="accordion">
            <div class="card border border-primary mb-5 custom_filter">
                <a data-bs-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                   class="btn btn-primary collapsed" aria-expanded="false">
                    <i class="fas fa-filter"></i> {{t_('Filters')}}
                </a>
                <div id="collapseOne" class="panel-collapse in collapse">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <x-form.select col_size="3" :label="__('messages.messages status')" id="status"
                                           name="status" :options="$messageStatus" class="status"/>
                            <x-form.input col_size="3" name="username" id="username" :label="__('messages.username')"/>
                            <x-form.input col_size="3" name="phone" id="phone" :label="__('messages.mobile')"/>
                            <x-form.input col_size="3" name="email" id="email" :label="__('messages.email')"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

</x-pages.datatable>

<x-component.modal mark="activation" route="dashboard.user.user.activation" message="messages.r_u_sure"/>
