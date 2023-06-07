@props(['action'])

<form method='POST' action="{{ $action }}"> 
    @csrf

    <div class="row">
        <div class="mb-3 col-md-6">
            <x-inputs.label for="technisch_von" value="Technisch Von" />
            <x-inputs.text id="technisch_von" type="text" name="technisch_von"
                value="{{ old('technisch_von') }}" placeholder="Wähle ein Datum" required/>
        </div>
        <div class="mb-3 col-md-6">
            <x-inputs.label for="technisch_zu" value="Technisch Zu" />
            <x-inputs.text id="technisch_zu" type="text" name="technisch_zu"
                value="{{ old('technisch_zu') }}" placeholder="Wähle ein Datum" required/>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-6">
            <x-inputs.label for="wartung_von" value="Wartung Von" />
            <x-inputs.text id="wartung_von" type="text" name="wartung_von"
                value="{{ old('wartung_von') }}" placeholder="Wähle ein Datum" required/>
        </div>
        <div class="mb-3 col-md-6">
            <x-inputs.label for="wartung_zu" value="Wartung Zu" />
            <x-inputs.text id="wartung_zu" type="text" name="wartung_zu"
                value="{{ old('wartung_zu') }}" placeholder="Wähle ein Datum" required/>
        </div>
    </div>

    <x-buttons.dark>Search</x-buttons.dark>
</form>