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
                                            <div class="chat-log__item chat-log__item--own" data-message-id="{{ $message->id }}">
                                                <h3 class="chat-log__author">{{$message->created_at->format('Y-m-d')}}
                                                    <small>{{$message->created_at->format('H:i')}}</small></h3>
                                                <div class="chat-log__message">{{$message->message}}</div>
                                            </div>
                                        @else
                                            <div class="chat-log__item" data-message-id="{{ $message->id }}">
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
                                <input type="hidden" id="chatId" value="{{ $model->chat?->id }}">
                                <input type="hidden" id="pusherKey" value="{{ config('broadcasting.connections.pusher.key') }}">
                                <input type="hidden" id="pusherCluster" value="{{ env('PUSHER_APP_CLUSTER', 'eu') }}">
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
            (function () {
                const authId = $('#authId').val();
                const chatId = $('#chatId').val();
                const pollUrl = '{{ route('dashboard.chat.chats.messages', $model->chat?->id) }}';
                const replyUrl = '{{ route('dashboard.chat.chats.reply', [$model->chat?->id, $model->id]) }}';
                const csrfToken = '{{ csrf_token() }}';
                const displayedIds = new Set();

                function getLastMessageId() {
                    let lastId = 0;
                    $('.chat-log [data-message-id]').each(function () {
                        const id = parseInt($(this).attr('data-message-id'), 10);
                        if (id > lastId) lastId = id;
                    });
                    return lastId;
                }

                function scrollChatToBottom() {
                    const chatLog = $('.chat-log');
                    chatLog.animate({ scrollTop: chatLog.prop('scrollHeight') }, 300);
                }

                function escapeHtml(text) {
                    return $('<div>').text(text).html();
                }

                function appendMessage(msg, isOwn) {
                    if (!msg || !msg.id || displayedIds.has(msg.id)) return;
                    displayedIds.add(msg.id);

                    const ownClass = isOwn ? ' chat-log__item--own' : '';
                    const html = `
                        <div class="chat-log__item${ownClass}" data-message-id="${msg.id}">
                            <h3 class="chat-log__author">${escapeHtml(msg.messageDate || '')}
                                <small>${escapeHtml(msg.messageTime || '')}</small></h3>
                            <div class="chat-log__message">${escapeHtml(msg.message || '')}</div>
                        </div>`;
                    $('.chat-log').append(html);
                    scrollChatToBottom();
                }

                function handleIncomingMessage(msg) {
                    if (!msg || !msg.id) return;
                    const isOwn = String(msg.user_id) === String(authId);
                    appendMessage(msg, isOwn);
                }

                function pollNewMessages() {
                    if (!chatId) return;
                    $.get(pollUrl, { after_id: getLastMessageId() }, function (res) {
                        (res.messages || []).forEach(function (msg) {
                            handleIncomingMessage(msg);
                        });
                    });
                }

                function sendMessage() {
                    const input = $('#sendMessageInput');
                    const message = input.val().trim();
                    const button = $('.sendMessageButton');
                    if (!message) return;

                    button.prop('disabled', true);
                    $.ajax({
                        url: replyUrl,
                        type: 'POST',
                        data: { message: message, _token: csrfToken },
                        dataType: 'JSON',
                        success: function (res) {
                            handleIncomingMessage(res.data);
                            input.val('');
                        },
                        complete: function () {
                            button.prop('disabled', false);
                        }
                    });
                }

                function initPusher() {
                    const pusherKey = $('#pusherKey').val();
                    const pusherCluster = $('#pusherCluster').val();
                    if (!pusherKey || !chatId || typeof Pusher === 'undefined') return;

                    const pusher = new Pusher(pusherKey, {
                        cluster: pusherCluster,
                        encrypted: true
                    });
                    const channel = pusher.subscribe('chat.' + chatId);
                    channel.bind('App\\Events\\ChatEvent', function (data) {
                        if (data && data.message) {
                            handleIncomingMessage(data.message);
                        }
                    });
                }

                $(document).ready(function () {
                    $('.chat-log [data-message-id]').each(function () {
                        displayedIds.add(parseInt($(this).attr('data-message-id'), 10));
                    });

                    scrollChatToBottom();
                    initPusher();
                    setInterval(pollNewMessages, 4000);

                    $('.sendMessageButton').on('click', sendMessage);
                    $('#sendMessageInput').on('keydown', function (e) {
                        if (e.key === 'Enter' && !e.shiftKey) {
                            e.preventDefault();
                            sendMessage();
                        }
                    });
                });
            })();
        </script>
    </x-slot>

</x-pages.layout>
