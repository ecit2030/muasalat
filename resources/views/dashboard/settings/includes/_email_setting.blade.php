<div class="row">
    <x-form.input col_size="4" :value="data_get($emails, 'host', 'smtp.mailtrap.io')" :label="t_('host')" name="emails[host]"/>
    <x-form.input col_size="4" :value="data_get($emails, 'port', '587')" :label="t_('port number')" name="emails[port]"/>
    <x-form.input col_size="4" :value="data_get($emails, 'username', 'b657a77f38864b')" :label="t_('username')" name="emails[username]"/>
    <x-form.input col_size="4" :value="data_get($emails, 'password', 'b5456568542ad5')" :label="t_('password')" name="emails[password]"/>
    <x-form.input col_size="4" :value="data_get($emails, 'encryption', 'null')" :label="t_('Encryption')" name="emails[encryption]"/>
    <x-form.input col_size="4" :value="data_get($emails, 'from_address', 'admin@gmail.com')" :label="t_('From Address')"
                  name="emails[from_address]"/>
    <x-form.input col_size="4" :value="data_get($emails, 'from_name', 'admin')" :label="t_('From Name')" name="emails[from_name]"/>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="header_color">{{t_('Header background color')}}</label>
            <div class="input-group">
                <input id="header_color" type="text" class="form-control" name="emails[header_color]"
                       value="{{data_get($emails, 'header_color', '#00a65a')}}" required>
                <div class="input-group-append header_color">
                    <span class="input-group-text"><i class="fas fa-square"
                                                      style="color: {{data_get($emails, 'header_color', '#00a65a')}}"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="footer_color">{{t_('Footer background color')}}</label>
            <div class="input-group">
                <input id="footer_color" type="text" class="form-control" name="emails[footer_color]"
                       value="{{data_get($emails, 'footer_color', '#00a600')}}" required>
                <div class="input-group-append footer_color">
                    <span class="input-group-text"><i class="fas fa-square"
                                                      style="color:{{data_get($emails, 'footer_color', '#00a600')}}"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header card-header-stretch">

                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                        <li class="nav-item">
                            <a class="nav-link nav-link  btn btn-flex btn-active-light-info active" id="resetting_password_tab" data-bs-toggle="tab"
                               href="#resetting_password"
                               role="tab" aria-controls="resetting_password" aria-selected="true">
                                {{t_('Resetting Password')}}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link nav-link  btn btn-flex btn-active-light-info" id="active_user_tab" data-bs-toggle="tab"
                               href="#active_user"
                               role="tab" aria-controls="resetting_password" aria-selected="true">
                                {{t_('Active User')}}
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    @include('dashboard.settings.includes._email_setting_tab._resetting_password')
                    @include('dashboard.settings.includes._email_setting_tab._active_user')

                </div>
            </div>
        </div>
    </div>

</div>
<!-- \Email Settings -->
