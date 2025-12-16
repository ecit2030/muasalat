<x-form route="dashboard.general.administration.admins" :title="t_('Admins')">

    @foreach ( $errors->all() as $error )
    <div class="text-danger fs-3"> {{ $error }} *</div>
    @endforeach

<div class="row">
        <div class="col-md-6">
            {{-- <x-form.toggle type="checkbox" name="is_active" :label="t_('Active')"/> --}}
        </div>
        <div class="col-md-6">
            <x-form.image name="avatar" :label="t_('Avatar')"/>
        </div>
    </div>
    <x-form.input name="name" :label="t_('Name')"/>
    <x-form.input name="email" type="email" :label="t_('Email')"/>

    <x-form.password col_size="6" name="password" type="password" :label="t_('Password')"/>

    <x-form.select id="roles" name="roles[]" :options="$roles" :selected="$selected ?? [] " :label="t_('Roles')"/>

    <div id="org_info" style="display: none;">
        <x-form.input name="talebat_price" type="number" :label="t_('talebat price')"/>
        <x-form.input name="other_price" type="number"  :label="t_('other price')"/>
    </div>
    @push('scripts')
        <script>
            $(function(){
                $("#roles").on('change',function (e){
                    var selected = $(this).val();
                    if(selected === "organization"){
                        $('#org_info').css("display", "block");
                    }
                    else{
                        $('#org_info').css("display", "none");
                    }
                });
            });
        </script>
    @endpush
</x-form>
