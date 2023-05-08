<div class="card-header pb-0 p-3">
    <div class="row">
        <div class="col-md-8 d-flex align-items-center">
            <h6 class="mb-3">Profile Information</h6>
        </div>
    </div>
</div>
<div class="card-body p-3">
    @if (session('status_update_profile'))
    <div class="row">
        <x-auth-session-status class="alert-success" :status="session('status_update_profile')" />
    </div>
    @endif

    <form method='POST' action="<?= route('profile.update') ?>">
        @csrf
        @method('patch')

        <div class="row">

            <div class="mb-3 col-md-6">
                <x-inputs.label for="name" value="Name" />
                <x-inputs.text id="name" type="text" name="name" value="{{ old('name',
                auth()->user()->name) }}" required />
                <x-inputs.error :messages="$errors->get('name')" />
            </div>

            <div class="mb-3 col-md-6">
                <x-inputs.label for="email" value="Email address" />
                <x-inputs.text id="email" type="email" name="email" value="{{ old('email',
                auth()->user()->email) }}" required />
                <x-inputs.error :messages="$errors->get('email')" />
            </div>

        </div>
        <x-buttons.dark>Save</x-buttons.dark>
    </form>

</div>