<div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    @livewire('whatsapp.whatsapp-accounts')
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#chats"
                                    data-toggle="tab">Whatsapp Chats</a></li>
                                <li class="nav-item"><a class="nav-link" href="#templates"
                                        data-toggle="tab">Templates</a></li>
                                <li class="nav-item"><a class="nav-link" href="#update-account" data-toggle="tab">Update
                                        Account</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="chats">
                                    <div class="row">
                                        <div class="col-4">
                                            <div
                                                class="card card-success direct-chat direct-chat-success direct-chat-contacts-open">
                                                <div class="card-header">
                                                    <h3 class="card-title">Asesores</h3>
                                                </div>
                                                <div class="card-body">
                                                    <!-- Contacts are loaded here -->
                                                    <div class="asesor-list">
                                                        <ul class="contacts-list">
                                                            <li>
                                                                <a href="#">
                                                                    <img class="contacts-list-img"
                                                                        src="https://adminlte.io/docs/3.1//assets/img/user1-128x128.jpg">
                                                                    <div class="contacts-list-info">
                                                                        <span class="contacts-list-name">
                                                                            Script Soport "Default"
                                                                            <small
                                                                                class="contacts-list-date float-right">2/28/2015</small>
                                                                        </span>
                                                                        <span class="contacts-list-msg" style="display: inline-flex; align-items: center;">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="16" height="16"
                                                                                fill="currentColor"
                                                                                class="bi bi-check-all"
                                                                                viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486z">
                                                                                </path>
                                                                            </svg>
                                                                            <span style="margin-left: 4px;">How have you been? I was...</span>
                                                                        </span>
                                                                        <span class="badge badge-success float-right">
                                                                            4
                                                                        </span>
                                                                    </div>
                                                                    <!-- /.contacts-list-info -->
                                                                </a>
                                                            </li>
                                                            <!-- End Contact Item -->
                                                        </ul>
                                                        <!-- /.contacts-list -->
                                                    </div>
                                                    <!-- /.direct-chat-pane -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            @livewire('chat.index')
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="templates">
                                    @livewire('whatsapp.templates')
                                </div>

                                <div class="tab-pane" id="update-account">

                                </div>

                                <div class="tab-pane" id="settings">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
