<x-app-layout bodyClass="">

    <div>
        <main class="main-content  mt-0">
            <section>
                <div class="page-header min-vh-100">
                    <div class="container">
                        <div class="row">
                            <div
                                class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                                <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center"
                                    style="background-image: url('{{ asset('assets') }}/img/illustrations/illustration-signup.jpg'); background-size: cover;">
                                </div>
                            </div>
                            <div
                                class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                                <div class="card card-plain">
                                    <div class="card-header">
                                        <h4 class="font-weight-bolder">Sign Up</h4>
                                        <p class="mb-0">Enter your name, email and password to register</p>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf

                                            <x-input-group.wrapper>
                                                <x-input-group.label for="name" :value="__('Name')" />
                                                <x-input-group.text id="name" type="text" name="name"
                                                    :value="old('name')" required />
                                            </x-input-group.wrapper>
                                            <x-input-group.error :messages="$errors->get('name')" />

                                            <x-input-group.wrapper>
                                                <x-input-group.label for="email" :value="__('Email')" />
                                                <x-input-group.text id="email" type="email" name="email"
                                                    :value="old('email')" required />
                                            </x-input-group.wrapper>
                                            <x-input-group.error :messages="$errors->get('email')" />

                                            <x-input-group.wrapper>
                                                <x-input-group.label for="password" :value="__('Password')" />
                                                <x-input-group.text id="password" type="password" name="password"
                                                    required />
                                            </x-input-group.wrapper>
                                            <x-input-group.error :messages="$errors->get('password')" />

                                            <x-input-group.wrapper>
                                                <x-input-group.label for="password_confirmation"
                                                    :value="__('Confirm Password')" />
                                                <x-input-group.text id="password_confirmation" type="password"
                                                    name="password_confirmation" required />
                                            </x-input-group.wrapper>
                                            <x-input-group.error :messages="$errors->get('password_confirmation')" />

                                            {{-- <x-inputs.checkbox-info.wrapper class="mt-3">
                                                <x-inputs.checkbox-info.input id="flexCheckDefault" checked />
                                                <x-inputs.checkbox-info.label for="flexCheckDefault">I agree the <a
                                                        href="javascript:;" class="text-dark font-weight-bolder">Terms
                                                        and Conditions</a></x-inputs.checkbox-info.label>
                                            </x-inputs.checkbox-info.wrapper> --}}

                                            <div class="text-center">
                                                <x-buttons.primary class="btn-lg w-100 mt-4 mb-0">Sign Up
                                                </x-buttons.primary>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                        <p class="mb-2 text-sm mx-auto">
                                            Already have an account?
                                            <a href="{{ route('login') }}"
                                                class="text-primary text-gradient font-weight-bold">Sign in</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

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