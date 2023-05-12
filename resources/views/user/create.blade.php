<x-app-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='New User'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="card card-body mx-3 mx-md-3 mt-4">
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        @if (session('status'))
                        <div class="row">
                            <x-auth-session-status class="alert-success" :status="session('status')" />
                        </div>
                        @endif

                        <form method='POST' action="<?= route('users.store') ?>">
                            @csrf

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="name" value="Name" />
                                    <x-inputs.text id="name" type="text" name="name" value="{{ old('name') }}"
                                        required />
                                    <x-inputs.error :messages="$errors->get('name')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="email" value="Email address" />
                                    <x-inputs.text id="email" type="email" name="email" value="{{ old('email') }}"
                                        required />
                                    <x-inputs.error :messages="$errors->get('email')" />
                                </div>

                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-12">
                                    <x-inputs.label for="user_type" value="User Role" />
                                    <x-inputs.radio.wrapper>

                                        @foreach (App\Enums\UserRole::cases() as $item)
                                        <x-inputs.radio.input id="{{ $item }}" name="user_type" value="{{ $item }}"
                                            :checked="old('user_type') == $item" />
                                        <x-inputs.radio.label for="{{ $item }}" @class(['me-3'=> !$loop->last])>{{
                                            App\Enums\UserRole::getLabel($item ) }}
                                        </x-inputs.radio.label>
                                        @endforeach

                                    </x-inputs.radio.wrapper>
                                    <x-inputs.error :messages="$errors->get('user_type')" />
                                </div>

                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="password" value="Password" />
                                    <x-inputs.text id="password" type="password" name="password" required />
                                    <x-inputs.error :messages="$errors->get('password')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="password_confirmation" value="Confirm Password" />
                                    <x-inputs.text id="password_confirmation" type="password"
                                        name="password_confirmation" required />
                                    <x-inputs.error :messages="$errors->get('password_confirmation')" />
                                </div>
                            </div>

                            <x-buttons.dark>Save</x-buttons.dark>
                        </form>

                    </div>
                </div>
            </div>



        </div>
        <x-footers.auth></x-footers.auth>
    </div>

</x-app-layout>