<x-form route="dashboard.general.administration.profile" :title="__('Admin Profile')" backRoute="dashboard.home">

    @foreach ( $errors->all() as $error )
    <div class="text-danger fs-3"> {{ $error }} *</div>
    @endforeach


    <div class="row">
        <div class="col-md-6">
            <x-form.input name="name" :label="__('name')" required />
        </div>
        <div class="col-md-6">
            <x-form.input name="email" :label="__('email')" required />
        </div>


        <x-form.password col_size="6" name="password" type="password" :label="__('password')" />

        <x-form.image name="avatar" :label="__('avatar')" />
    </div>


    @if (auth()->user()->hasRole('organization'))
        <div class="col-md-12 p-3">
            <div class="card border ">
                <div class="card-header  align-items-center">
                    <h1 class="pt-2 text-center">{{ t_('title setting') }}</h1>
                </div>
                <div class="card-body related_data">
                    <div class="row">
                        <div class="row">
                            <x-form.input col_size="6" name="talebat_price" type="number" step="0.01" icon="{{t_('SAR')}}" :label="t_('talebat price')" />
                            <x-form.input col_size="6" name="other_price" type="number" step="0.01" icon="{{t_('SAR')}}" :label="t_('other price')" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-form>
