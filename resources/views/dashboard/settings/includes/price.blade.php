<div class="row">


    @foreach ( $errors->all() as $error )
        <div class="text-danger fs-3"> {{ $error }} *</div>
    @endforeach


    <div class="row">
        <x-form.input col_size="6" type="number" :value="data_get($price, 'talebat_min', '1')" dir="ltr"
                      :label="t_('talebat min')" name="price[talebat_min]"/>
        <x-form.input col_size="6" type="number" :value="data_get($price, 'talebat_max', '10')" dir="ltr"
                      :label="t_('talebat max')" name="price[talebat_max]"/>
    </div>

    <div class="row">
        <x-form.input col_size="6" type="number" :value="data_get($price, 'other_min', '1')" dir="ltr"
                      :label="t_('other min')" name="price[other_min]"/>
        <x-form.input col_size="6" type="number" :value="data_get($price, 'other_max', '10')" dir="ltr"
                      :label="t_('other max')" name="price[other_max]"/>

        <x-form.input col_size="6" type="number" :value="data_get($price, 'discount_from_driver_when_cancel_trip', '10')" dir="ltr"
                      :label="__('messages.discount_from_driver_when_cancel_trip')" name="price[discount_from_driver_when_cancel_trip]"/>

        <x-form.input col_size="6" type="number" :value="data_get($price, 'discount_from_client_when_cancel_trip', '10')" dir="ltr"
                      :label="__('messages.discount_from_client_when_cancel_trip')" name="price[discount_from_client_when_cancel_trip]"/>


    </div>



</div>
