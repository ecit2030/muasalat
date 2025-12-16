<x-tabs.vertical.layout :title="t_('settings')">

    <x-slot name="links">
        <x-tabs.vertical.inc.link href="general" :name="t_('general')" icon="brightness_low" :label="t_('general')"
            class=" {{ $errors->has('general.*') ? 'border-error active' : ($errors->isEmpty() ? 'active' : '') }}" />

        <x-tabs.vertical.inc.link href="price" :name="t_('price')" icon="lock_open" :label="t_('price')" :class="$errors->has('price.*') ? 'border-error active' : ''" />

        <x-tabs.vertical.inc.link href="numbers" :name="t_('emergency numbers')" icon="lock_open" :label="t_('emergency numbers')" :class="$errors->has('numbers.*') ? 'border-error active' : ''" />

        <x-tabs.vertical.inc.link href="media" :name="t_('media')" icon="lock_open" :label="t_('media')"
            :class="$errors->has('media.*') ? 'border-error active' : ''" />

        <x-tabs.vertical.inc.link href="social" :name="t_('social')" icon="lock_open" :label="t_('social')"
            :class="$errors->has('social.*') ? 'border-error active' : ''" />

        <x-tabs.vertical.inc.link href="api_keys_settings" :name="t_('Api keys')" icon="lock_open" :label="t_('Api keys')"
            :class="$errors->has('api_keys.*') ? 'border-error active' : ''" />
    </x-slot>

    <x-slot name="tabs">

        <x-tabs.vertical.inc.tab :title="t_('general')" href="general"
            class="{{ $errors->has('general.*') ? 'border-error active' : ($errors->isEmpty() ? 'active' : '') }} "
            :route='"{$route}.general-submit"'>
            @include('dashboard.settings.includes.general')
        </x-tabs.vertical.inc.tab>

        <x-tabs.vertical.inc.tab :title="t_('price')" href="price"
            class="{{ $errors->has('price.*') ? 'border-error active' : '' }} " :route='"{$route}.price-submit"'>
            @include('dashboard.settings.includes.price')
        </x-tabs.vertical.inc.tab>

        <x-tabs.vertical.inc.tab :title="t_('numbers')" href="numbers"
            class="{{ $errors->has('numbers.*') ? 'border-error active' :  '' }} "
            :route='"{$route}.numbers-submit"'>
            @include('dashboard.settings.includes.emergency')
        </x-tabs.vertical.inc.tab>

        <x-tabs.vertical.inc.tab :title="t_('media')" href="media" :class="$errors->has('media.*') ? 'border-error active' : ''" :route='"{$route}.media-submit"'>
            @include('dashboard.settings.includes.media')
        </x-tabs.vertical.inc.tab>

        <x-tabs.vertical.inc.tab :title="t_('Social')" href="social" :class="$errors->has('social.*') ? 'border-error active' : ''" :route='"{$route}.social-submit"'>
            @include('dashboard.settings.includes.social')
        </x-tabs.vertical.inc.tab>


        <x-tabs.vertical.inc.tab :title="t_('api keys')" href="api_keys_settings" :class="$errors->has('api_keys.*') ? 'border-error active' : ''" :route='"{$route}.api-keys-submit"'>

            @include('dashboard.settings.includes._api_keys_setting')
        </x-tabs.vertical.inc.tab>

    </x-slot>


    <x-slot name="styles">

        <link rel="stylesheet" href="{{ asset('dashboard/plugins/pickers/timezone/dist/styles/timezone-picker.css') }}">
        <link rel="stylesheet"
            href="{{ asset('dashboard/plugins/pickers/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}">

    </x-slot>


</x-tabs.vertical.layout>
