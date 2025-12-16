<div class="tab-pane fade" id="active_user" role="tabpanel" aria-labelledby="active_user">

    <div class="row">
        <div class="form-group">
            <x-form.toggle type="checkbox" name="emails[active_user][active]" :value="data_get($emails, 'active_user.active',1)"
                           :label="t_('active user')"/>

        </div>
    </div>

    <div class="row">
        <x-form.input :value="data_get($emails, 'active_user.subject', 'active user')" :label="t_('subject')"
                      name="emails[active_user][subject]"/>
        <x-form.input type="textarea"
                      :value="data_get($emails, 'active_user.body', 'active user')"
                      :label="t_('body')"
                      name="emails[active_user][body]"/>
    </div>

</div>
