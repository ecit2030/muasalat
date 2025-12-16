<x-form route="dashboard.faqs.faqs"    :title="t_('faq')">

    @foreach ($errors->all() as $error)
        <div class="text-danger fs-3"> {{ $error }} *</div>
    @endforeach

    <div class="row">
        <x-form.input  col_size="6" name="question[en]" :value="$model?->getTranslation('question','en')" :label="t_('question in english')" />
        <x-form.input  col_size="6" name="question[ar]" :value="$model?->getTranslation('question','ar')" :label="t_('question in arabic')" />
    </div>

    <div class="row">
        <x-form.input  col_size="6" name="answer[en]" :value="$model?->getTranslation('answer','en')" :label="t_('answer in english')" />
        <x-form.input  col_size="6" name="answer[ar]" :value="$model?->getTranslation('answer','ar')" :label="t_('answer in arabic')" />
    </div>

</x-form>
