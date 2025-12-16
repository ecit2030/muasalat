<div class="row">

    @foreach ( $errors->all() as $error )
    <div class="text-danger fs-3"> {{ $error }} *</div>
    @endforeach


    <x-form.input col_size="6" dir="ltr" :value="data_get($social, 'phone', '+966508755187')" :label="t_('phone')" name="social[phone]"/>
    <x-form.input col_size="6" dir="ltr" :value="data_get($social, 'email1', 'test@gmail.com')" :label="t_('email1')" name="social[email1]"/>
    <x-form.input col_size="6" dir="ltr" :value="data_get($social, 'email2', 'denm@gmail.com')" :label="t_('email2')" name="social[email2]"/>
    <x-form.input col_size="6" dir="ltr" :value="data_get($social, 'facebook', 'facebook.com')" :label="t_('facebook')" name="social[facebook]"/>
    <x-form.input col_size="6" dir="ltr" :value="data_get($social, 'twitter', 'twitter.com')" :label="t_('twitter')" name="social[twitter]"/>
    <x-form.input col_size="6" dir="ltr" :value="data_get($social, 'instagram', 'instagram.com')" :label="t_('instagram')" name="social[instagram]"/>
    <x-form.input col_size="6" dir="ltr" :value="data_get($social, 'youtube', 'youtube.com')" :label="t_('youtube')" name="social[youtube]"/>
    <x-form.input col_size="6" dir="ltr" :value="data_get($social, 'linkedin', 'linkedin.com')" :label="t_('linkedin')" name="social[linkedin]"/>

</div>

