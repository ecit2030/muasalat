<x-form route="modules.analyse.dashboard.analysis" class="row" :title="$model->title">

    <x-form.toggle col_size="3" readonly name="done" :label="t_('done')"/>
    <x-form.input col_size="3" readonly name="status" :label="t_('status')"/>
    <x-form.input col_size="3" readonly name="id" :label="t_('id')"/>
    <x-form.input col_size="3" readonly name="type" :label="t_('type')"/>

    <x-form.input type="textarea" col_size="4" readonly name="title" :label="t_('title')"/>
    <x-form.input type="textarea" col_size="4" readonly name="insightClass" :label="t_('insightClass')"/>
    <x-form.input type="textarea" col_size="4" readonly name="file" :label="t_('file')"/>
    <x-form.input type="textarea" col_size="4" readonly name="line" :label="t_('line')"/>
    <x-form.input type="textarea" col_size="4" readonly name="diff" :label="t_('diff')"/>
    <x-form.input type="textarea" col_size="4" readonly name="message" :label="t_('message')"/>

</x-form>
