<div class="row">

    @foreach ( $errors->all() as $error )
    <div class="text-danger fs-3"> {{ $error }} *</div>
    @endforeach


    <x-form.image name="media[white_site_logo]" col_size="6" :value="data_get($media,'white_site_logo.url')" :label="t_('white website logo')"/>
    <x-form.image name="media[dark_site_logo]" col_size="6" :value="data_get($media,'dark_site_logo.url')" :label="t_('dark website logo')"/>

    <x-form.image name="media[white_dashboard_logo]" col_size="6" :value="data_get($media,'white_dashboard_logo.url')"
                  :label="t_('white dashboard logo')"/>
    <x-form.image name="media[dark_dashboard_logo]" col_size="6" :value="data_get($media,'dark_dashboard_logo.url')"
                  :label="t_('dark dashboard logo')"/>

    <x-form.image name="media[white_email_logo]" col_size="6" :value="data_get($media,'white_email_logo.url')" :label="t_('white email logo')"/>
    <x-form.image name="media[dark_email_logo]" col_size="6" :value="data_get($media,'dark_email_logo.url')" :label="t_('dark email logo')"/>

    <x-form.image name="media[white_preloader]" col_size="6" :value="data_get($media,'white_preloader.url')"
                  :label="t_('white preloader logo')"/>
    <x-form.image name="media[dark_preloader]" col_size="6" :value="data_get($media,'dark_preloader.url')"
                  :label="t_('dark preloader logo')"/>

    <x-form.image name="media[white_fav_icon]" col_size="6" :value="data_get($media,'white_fav_icon.url')" :label="t_('white fav icon')"/>
    <x-form.image name="media[dark_fav_icon]" col_size="6" :value="data_get($media,'dark_fav_icon.url')" :label="t_('dark fav icon')"/>

    <x-form.image name="media[login_page_background]" col_size="6" :value="data_get($media,'login_page_background.url')"
                  :label="t_('login page background')"/>
</div>
