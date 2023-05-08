<div class="card-header pb-0 p-3">
    <div class="row">
        <div class="col-md-8 d-flex align-items-center">
            <h6 class="mb-3">Update Password</h6>
        </div>
    </div>
</div>
<div class="card-body p-3">
    @if (session('status'))
    <div class="row">
        <x-auth-session-status class="alert-success" :status="session('status')" />
    </div>
    @endif

    <form method='POST' action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="row">

            <div class="mb-3 col-md-12">
                <x-inputs.label for="current_password" value="Current Password" />
                <x-inputs.text id="current_password" type="password" name="current_password" required />
                <x-inputs.error :messages="$errors->updatePassword->get('current_password')" />
            </div>
        </div>

        <div class="row">

            <div class="mb-3 col-md-6">
                <x-inputs.label for="password" value="New Password" />
                <x-inputs.text id="password" type="password" name="password" required />
                <x-inputs.error :messages="$errors->updatePassword->get('password')" />
            </div>

            <div class="mb-3 col-md-6">
                <x-inputs.label for="password_confirmation" value="Confirm Password" />
                <x-inputs.text id="password_confirmation" type="password" name="password_confirmation" required />
                <x-inputs.error :messages="$errors->updatePassword->get('password_confirmation')" />
            </div>
        </div>

        <x-buttons.dark>Save</x-buttons.dark>
    </form>

</div>