<x-pages.layout :title="__('messages.show message')">

    <x-slot name="styles">
        <style>
            .page-header {
                background: #323248;
                margin: 0;
                padding: 20px 0 10px;
                color: #FFFFFF !important;
                width: 100%;
                z-index: 1
            }

            .main {
                height: 100vh;
                padding-top: 70px;
            }

            .chat-log {
                padding: 40px 0 114px;
                height: 100%;
                overflow-y: scroll;
            }

            .chat-log__item {
                background: #fafafa;
                padding: 10px;
                margin: 0 auto 20px;
                max-width: 80%;
                float: left;
                border-radius: 4px;
                box-shadow: 0 1px 2px rgba(0, 0, 0, .1);
                clear: both;
                color: #000;
            }

            .chat-log__item.chat-log__item--own {
                float: right;
                background: #DCF8C6;
                text-align: right;
            }

            .chat-form {
                padding: 40px 0;
                bottom: 0;
                width: 100%;
            }

            .chat-log__author {
                margin: 0 auto .5em;
                font-size: 12px;
                color: #000;
            }
            .chat-log__message{
                font-size: 16px;
                font-weight: 500;
            }
            .sendMessageButton{
                height: 63px;
                background: #1e1e2d;
                border: 1px solid #474747;
            }
        </style>

    </x-slot>
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <div class="row">
                                <x-component.input :col_size="3" value="{{ $model?->chat?->sender?->name }}"
                                                   :label="__('messages.username')"/>
                                <x-component.input :col_size="3" value="{{ $model?->chat?->sender?->phone }}"
                                                   :label="__('messages.mobile')"/>
                                <x-component.input :col_size="3" value="{{ $model?->chat?->sender?->email }}"
                                                   :label="__('messages.email')"/>
                                <x-component.input :col_size="3" value="{{ $model?->message }}"
                                                   :label="__('messages.last message')"/>
                                <x-component.input :col_size="3" value="{{ $model?->created_at->format('Y-m-d H:i') }}"
                                                   :label="__('messages.last message date')"/>
                            </div>
                        </div>
                        <header class="page-header">
                            <div class="container">
                                <h2 style="color: #fff;">{{$model?->chat?->sender?->name }}</h2>
                            </div>
                        </header>
                        <div class="main">
                            <div class="container h-100">
                                <div class="chat-log">
                                    @forelse($model->chat?->messages as $message)
                                        @if($message->user_id == auth('dashboard')->id())
                                            <div class="chat-log__item chat-log__item--own">
                                                <h3 class="chat-log__author">{{$message->created_at->format('Y-m-d')}}
                                                    <small>{{$message->created_at->format('H:i')}}</small></h3>
                                                <div class="chat-log__message">{{$message->message}}</div>
                                            </div>
                                        @else
                                            <div class="chat-log__item">
                                                <h3 class="chat-log__author">{{$message->created_at->format('Y-m-d')}}
                                                    <small>{{$message->created_at->format('H:i')}}</small></h3>
                                                <div class="chat-log__message">{{$message->message}}</div>
                                            </div>
                                        @endif
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="chat-form">
                            <div class="container ">
                                <div class="row">
                                    <div class="col-sm-10 col-xs-8">
                                        <textarea style="resize: none;" name="message" type="text" class="form-control" id="sendMessageInput"
                                                  placeholder="{{__('messages.message')}}"></textarea>
                                    </div>
                                    <div class="col-sm-2 col-xs-4">
                                        <button type="submit"
                                                class="btn btn-success btn-block sendMessageButton">@lang('messages.reply')</button>
                                    </div>
                                </div>

                                <input type="hidden" id="authId" value="{{auth('dashboard')->id()}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- COL-END -->
        </div>
    </div>
    <!-- Message Modal -->

    <x-slot name="scripts">
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script>

            document.addEventListener('DOMContentLoaded', function () {
                $('.chat-log').animate({
                    scrollTop: $('.chat-log').prop("scrollHeight")
                }, 500);

                var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                    cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
                    encrypted: true
                });
                var channel = pusher.subscribe('chat.{{ $model->chat?->id }}');
                channel.bind('App\\Events\\ChatEvent', function(data) {
                    let chatLog = $('.chat-log')
                    if($('#authId').val() != data.message.user_id){
                        chatLog.append(`
                               <div class="chat-log__item">
                                    <h3 class="chat-log__author">${data.message.messageDate}
                                        <small>${data.message.messageTime}</small></h3>
                                    <div class="chat-log__message">${data.message.message}</div>
                                </div>`);
                        $('.chat-log').animate({
                            scrollTop: $('.chat-log').prop("scrollHeight")
                        }, 500);
                    }
                });
            });

            $(document).ready(function () {
                $('.sendMessageButton').on('click', function () {
                $(this).hide();
                    let message = $('#sendMessageInput').val()
                    $.ajax({
                        url: '{{route('dashboard.chat.chats.reply',[$model->chat?->id,$model->id])}}',
                        type: "POST",
                        data: {message:message},
                        dataType: "JSON",
                        success: function (res) {
                            let chatLog = $('.chat-log')
                            chatLog.append(`
                                <div class="chat-log__item chat-log__item--own">
                                    <h3 class="chat-log__author">{{now()->format('Y-m-d')}}
                                    <small>{{now()->format('H:i')}}</small></h3>
                                    <div class="chat-log__message">${message}</div>
                                </div>`);
                            $('.chat-log').animate({
                                scrollTop: $('.chat-log').prop("scrollHeight")
                            }, 500);

                            $('#sendMessageInput').val('')
                            $('.sendMessageButton').show();
                        },
                        error: function (res) {
                        $('.sendMessageButton').show();}
                    });
                })
            })
        </script>
    </x-slot>

</x-pages.layout>
