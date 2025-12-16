<x-form route="dashboard.wallet.wallet" :title="t_('withdraw request')">

    @if ($wallet)
    <div class="frame d-flex flex-column align-items-center justify-content-center">
        <h4 > {{ t_("available balance") }}</h1>
        <p class="fs-2"> {{ $balance }}</p>
    </div>
    @endif

    @foreach ($errors->all() as $error)
        <div class="text-danger fs-3"> {{ $error }} *</div>
    @endforeach

    <x-form.input col_size="12" name="balance" :label="t_('balance')" />

</x-form>


<style>
    .frame{
        width: fit-content ;
        height: 100px ;
        padding: 10px ;
        border: 2px solid grey ;
        border-radius: 15px

        /* background: grey; */
    }
</style>
