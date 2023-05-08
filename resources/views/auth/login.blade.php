<x-app-layout bodyClass="bg-gray-200">

    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100"
            style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container mt-5">
                <div class="row signin-margin">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">{{ __('Sign in') }}
                                    </h4>
                                    <div class="row mt-3">
                                        <div class="col-2 text-center ms-auto">
                                            <a class="btn btn-link px-3" href="javascript:;">
                                                <i class="fa fa-facebook text-white text-lg"></i>
                                            </a>
                                        </div>
                                        <div class="col-2 text-center px-1">
                                            <a class="btn btn-link px-3" href="javascript:;">
                                                <i class="fa fa-github text-white text-lg"></i>
                                            </a>
                                        </div>
                                        <div class="col-2 text-center me-auto">
                                            <a class="btn btn-link px-3" href="javascript:;">
                                                <i class="fa fa-google text-white text-lg"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form role="form" method="POST" action="{{ route('login.store') }}" class="text-start">
                                    @csrf

                                    <!-- Session Status -->
                                    <x-auth-session-status class="alert-primary" :status="session('status')" />

                                    <x-input-group.wrapper>
                                        <x-input-group.label for="email" :value="__('Email')" />
                                        <x-input-group.text id="email" type="email" name="email" :value="old('email')"
                                            required />
                                    </x-input-group.wrapper>
                                    <x-input-group.error :messages="$errors->get('email')" />

                                    <x-input-group.wrapper>
                                        <x-input-group.label for="password" :value="__('Password')" />
                                        <x-input-group.text id="password" type="password" name="password" required />
                                    </x-input-group.wrapper>
                                    <x-input-group.error :messages="$errors->get('password')" />

                                    <x-inputs.checkbox-switch.wrapper class="d-flex my-3">
                                        <x-inputs.checkbox-switch.input id="rememberMe" name="remember" />
                                        <x-inputs.checkbox-switch.label for="rememberMe" :value="__('Remember me')" />
                                    </x-inputs.checkbox-switch.wrapper>

                                    <div class="text-center">
                                        <x-buttons.primary class="w-100 my-4 mb-2">Sign in</x-buttons.primary>
                                    </div>

                                    <p class="mt-4 text-sm text-center">
                                        {{ __("Don't have an account?") }}
                                        <a href="{{ route('register') }}"
                                            class="text-primary text-gradient font-weight-bold">{{ __('Sign up') }}</a>
                                    </p>
                                    <p class="text-sm text-center">
                                        {{ __("Forgot your password? Reset your password") }}
                                        <a href="{{ route('password.request') }}"
                                            class="text-primary text-gradient font-weight-bold">{{ __("here") }}</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        $(function() {

            var text_val = $(".input-group input").val();
            if (text_val === "") {
                $(".input-group").removeClass('is-filled');
            } else {
                $(".input-group").addClass('is-filled');
            }
        });
    </script>

</x-app-layout>