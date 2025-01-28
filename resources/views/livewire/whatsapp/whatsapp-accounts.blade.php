<div class="">
    @livewire('whatsapp.add-business-account')

    @foreach ($accounts as $account)
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Phone Numbers for {{ $account->whatsapp_business_id }}</h3>
            </div>
            @if (isset($account->phoneNumbers))
                @foreach ($account->phoneNumbers as $phoneNumber)
                    <div class="card-body box-profile">
                        <div class="user-block">
                            <img class="img-circle img-bordered-sm"
                                src="{{ $phoneNumber->businessProfile->profile_picture_url }}" alt="user image">
                            <span class="username">
                                <a href="#"
                                    wire:click.prevent="selectProfile({{ json_encode($phoneNumber->businessProfile) }})">{{ $phoneNumber->verified_name }}</a>
                            </span>
                            <span class="description">Phone number: +{{ $phoneNumber->display_phone_number }}</span>
                            <span class="description">Phone number ID:
                                {{ $phoneNumber->whatsapp_business_accounts_id }}</span>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="card-body box-profile">
                    <div class="user-block">
                        <span class="description">No phone numbers found for this account.</span>
                    </div>
                </div>
            @endif
        </div>
    @endforeach

    @if ($selectedProfile)
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Information</h3>
            </div>
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{ $selectedProfile->profile_picture_url }}"
                        alt="User profile picture">
                </div>

                <input type="hidden" name="whatsapp_business_accounts_id" id="whatsapp_business_accounts_id" value="{{ $selectedBusinessAccount->whatsapp_business_id }}">

                <h3 class="profile-username text-center">{{ $selectedProfile->phoneNumber->verified_name }}</h3>

                <p class="text-muted text-center">+{{ $selectedProfile->phoneNumber->display_phone_number }}</p>

                <strong><i class="fas fa-book mr-1"></i> Phone number ID</strong>
                <p class="text-muted">
                    {{ $selectedProfile->phoneNumber->phone_number_id }}
                </p>

                <strong><i class="fas fa-book mr-1"></i> Address</strong>
                <p class="text-muted">
                    {{ $selectedProfile->address }}
                </p>

                <strong><i class="fas fa-book mr-1"></i> Email</strong>
                <p class="text-muted">
                    {{ $selectedProfile->email }}
                </p>

                <strong><i class="fas fa-book mr-1"></i> Web sites</strong>
                <ul class="text-muted">
                    @foreach ($selectedProfile->websites as $website)
                        <li>
                            <a href="{{ $website->website }}" target="_blank">{{ $website->website }}</a>
                        </li>
                    @endforeach
                </ul>

                <strong><i class="fas fa-book mr-1"></i> Description</strong>
                <p class="text-muted">
                    {{ $selectedProfile->description }}
                </p>
            </div>
        </div>
    @endif

</div>
