 <!-- Contacts are loaded here -->
 <div class="direct-chat-contacts"
    x-data=""
 >


    <ul class="contacts-list">
        @if ($conversations_contacts)
            @foreach ($conversations_contacts as $contact)
                <li>
                    <a href="#"  wire:click.prevent="selectContact({{ json_encode($contact) }})">
                        <img class="contacts-list-img" src="https://adminlte.io/docs/3.1//assets/img/user1-128x128.jpg">
                        <div class="contacts-list-info">
                            <span class="contacts-list-name">
                                @if(isset($contact->first_name) && isset($contact->last_name))
                                    {{ $contact->first_name }} {{ $contact->last_name }}
                                @else
                                    {{ $contact->contact_name }} ({{ '+'.$contact->country_code }} {{ $contact->phone_number }})
                                @endif
                                <small class="contacts-list-date float-right">
                                    {{ Carbon\Carbon::parse($contact->latestMessage()->first()->created_at)->format('m/d/Y') }}
                                    ({{ Carbon\Carbon::parse($contact->latestMessage()->first()->created_at)->diffForHumans() }})
                                </small>
                            </span>
                            <span class="contacts-list-msg" style="display: inline-flex; align-items: center;">
                                @if ($contact->latestMessage()->first()->readed_at)
                                <span class="contacts-list-date">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-all" viewBox="0 0 16 16">
                                        <path d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486z"/>
                                    </svg>
                                </span>
                                @else
                                <span class="contacts-list-date">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                    </svg>
                                </span>
                                @endif
                                <span class="contacts-list-date">
                                    {{ $contact->latestMessage()->first()->message_content }}
                                </span>
                            </span>
                            @if ($contact->unreadMessagesCountByContact() > 0)
                                <span class="badge badge-success float-right">
                                    {{ $contact->unreadMessagesCountByContact() }}
                                </span>
                            @endif
                        </div>
                        <!-- /.contacts-list-info -->
                    </a>
                </li>
            @endforeach
        @else
            <li>No Conversatrions</li>
        @endif
    </ul>
    <!-- /.contacts-list -->
</div>
<!-- /.direct-chat-pane -->
