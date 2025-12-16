<div class="row">

    <x-form.input col_size="12" :value="data_get($api_keys, 'google_api', 'api google')" :label="t_('Google Api')"
                  name="api_keys[google_api]"/>

    <x-form.input col_size="12" :value="data_get($api_keys, 'yandex_translation_api', 'yandex_translation_api')"
                  :label="t_('yandex translation api')" name="api_keys[yandex_translation_api]"/>

</div>
