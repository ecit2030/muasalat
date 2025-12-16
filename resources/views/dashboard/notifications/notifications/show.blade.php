<x-pages.layout :title="t_('notification details')">
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <div class="billed-from">


                                <div class="row">

                                    <x-component.input :col_size="6"
                                        value="{{ $model?->data['title'][app()->getLocale()] ?? $model?->data['title']?? '' }}" :label="t_('title')" />
                                    <x-component.input :col_size="6" type="textarea"
                                        value="{{ $model?->data['message'][app()->getLocale()] ?? $model?->data['message'] ?? '' }}" :label="t_('message')" />
                                </div>


                                @if ($model->notifiable->is(auth()->user()))
                                    <x-component.menurapper>
                                        @foreach ($receivers as $key => $receiver)
                                            <x-component.notificationmenu :key="$key" :value="$receiver" />
                                        @endforeach
                                    </x-component.menurapper>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- Message Modal -->

</x-pages.layout>
