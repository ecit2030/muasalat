<x-pages.layout :title="t_('contact_us_details')">
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <div class="billed-from">
                                <div class="d-flex flex-column  justify-center gap-3">


                                    <x-component.input :value="$ContactUs->name" :label="t_('name')" />
                                    <x-component.input :value="$ContactUs->email" :label="t_('email')" />
                                    <x-component.input :value="$ContactUs->message" :label="t_('message')" />


                                    @if ($ContactUs->is_replied)
                                        <x-component.input :value="$ContactUs->reply" :label="t_('reply')" />
                                    @else
                                        <form id="form" class="side_image"
                                            action="{{ route('dashboard.general.contact-us.reply') }}" method="post">
                                            @csrf

                                            <div class="row">
                                                <div class="mb-3">
                                                    <label for="reply" class="form-label">{{ t_('reply') }}</label>
                                                    <input required type="text" class="form-control" name="reply"
                                                        value="{{ old('reply') }}" id="reply">
                                                </div>



                                                <input type="hidden" name="contact_us_id" value={{ $ContactUs->id }}  >


                                                <button type="submit"
                                                    class="btn btn-primary my-2  col-md-4 col-sm-6 col-xs-12">{{ t_('send') }}</button>



                                        </form>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- Message Modal -->

</x-pages.layout>
