<x-form route="dashboard.user.users" :title="t_('User')">

    <x-form.toggle type="checkbox" name="is_active" :label="t_('Active')"/>
    {{-- <x-form.image name="avatar" :value="$avatar" :label="t_('Avatar')"/> --}}
    <x-form.input name="name" :label="t_('Name')"/>
    <x-form.input name="phone" :value="$phone" type="text" :label="t_('Phone')"/>
    <x-form.input name="email" type="email" :label="t_('Email')"/>
    <x-form.input name="password" type="password" :label="t_('Password')"/>
    <x-form.input name="password_confirmation" type="password"
                  :label="t_('Password Confirmation')"/>

</x-form>
