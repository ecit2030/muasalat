<div class="tab-pane fade show active" id="resetting_password" role="tabpanel" aria-labelledby="resetting_password">

    <div class="row">
        <div class="form-group">
            <x-form.toggle type="checkbox" name="emails[reset_password][active]"
                           :value="data_get($emails, 'reset_password.active',1)"
                           :label="t_('reset password')"/>
        </div>
    </div>

    <div class="row">
        <x-form.input :value="data_get($emails, 'reset_password.subject', 'reset password')" :label="t_('subject')"
                      name="emails[reset_password][subject]"/>
        <x-form.input type="textarea"
                      :value="data_get($emails, 'reset_password.body', 'reset password')"
                      :label="t_('body')"
                      name="emails[reset_password][body]"/>
    </div>

</div>
