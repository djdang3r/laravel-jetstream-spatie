<!-- Conversations are loaded here -->
<div>
    <div class="direct-chat-messages">
        @if (empty($messages))
            <p class="text-center">No messages</p>
        @else
            @foreach ($messages as $message)
                @php
                    $isOutput = $message->message_method == 'OUTPUT';
                @endphp
    
                <div class="direct-chat-msg {{ $isOutput ? 'right' : '' }}" wire:key='message-{{ $message->message_id }}'>
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-timestamp float-{{ $isOutput ? 'left' : 'right' }}">{{ $message->created_at->format('d M h:i a') }}</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="{{ $isOutput ? 'https://adminlte.io/docs/3.1//assets/img/user3-128x128.jpg' : 'https://adminlte.io/docs/3.1//assets/img/user1-128x128.jpg' }}" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        {{ $message->message_content }}
                        @if ($isOutput)
                            <span class="float-right">
                                <sub>{{ $message->created_at->format('d M h:i a') }}
                                    @if ($message->delivered_at)
                                        @if ($message->readed_at)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-check-all" viewBox="0 0 16 16">
                                                <path d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486z"/>
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-all" viewBox="0 0 16 16">
                                                <path d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486z"/>
                                            </svg>
                                        @endif
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                        </svg>
                                    @endif
                                </sub>
                            </span>
                        @endif
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
            @endforeach
        @endif
    </div>
    <div class="card-footer">
        <form action="#" method="post">
            @csrf
            <div class="input-group">
                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                <span class="input-group-append">
                    <button type="button" class="btn btn-primary">Send</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /.card-footer-->
</div>

<!--/.direct-chat-messages-->
