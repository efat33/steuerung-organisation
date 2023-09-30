@props(['action', 'users'])

<form method='GET' action="{{ $action }}">
    @csrf
    <div class="grid-parent mb-4">
        <div class="grid-item">
            <x-inputs.label for="keyword" value="Stichwort" />
            <x-inputs.text id="keyword" name="keyword" value="{{ old('keyword') }}" />
        </div>

        <div class="grid-item">
            <x-inputs.label for="registered_by" value="Sachbearbeiter" />
            <x-select-box.select-box name="registered_by" title="Select Option">
                <option value="" selected>Select Option</option>
                @foreach ($users as $item)
                <option value="{{ $item->id }}" {{ old('registered_by')==$item->id ? "selected" : "" }}>{{ $item->name }}</option>
                @endforeach
            </x-select-box.select-box>
        </div>

        <div class="grid-item">
            <x-inputs.label for="get_over" value="Erhalten über" />
            <x-select-box.select-box name="get_over" title="Select Option">
                <option value="" selected>Select Option</option>
                @foreach (App\Enums\GetOver::cases() as $item)
                <option value="{{ $item }}" {{ old('get_over')==$item ? "selected" : "" }}>{{
                    App\Enums\GetOver::getLabel($item ) }}</option>
                @endforeach
            </x-select-box.select-box>
        </div>

        <div class="grid-item">
            <x-inputs.label for="status" value="Status" />
            <x-select-box.select-box name="status" title="Select Option">
                <option value="" selected>Select Option</option>
                @foreach (App\Enums\Status::cases() as $item)
                <option value="{{ $item }}" {{ old('status')==$item ? "selected" : "" }}>{{
                    App\Enums\Status::getLabel($item ) }}</option>
                @endforeach
            </x-select-box.select-box>
        </div>

        <div class="grid-item">
            <x-inputs.label for="offer_type" value="Angebotsart" />
            <x-select-box.select-box name="offer_type" title="Select Option">
                <option value="" selected>Select Option</option>
                @foreach (App\Enums\OfferType::cases() as $item)
                <option value="{{ $item }}" {{ old('offer_type')==$item ? "selected" : "" }}>{{
                    App\Enums\OfferType::getLabel($item ) }}</option>
                @endforeach
            </x-select-box.select-box>
        </div>
        
        <div class="grid-item">
            <x-inputs.label for="conversation_status" value="Gesprächsresultat" />
            <x-select-box.select-box name="conversation_status" title="Select Option">
                <option value="" selected>Select Option</option>
                @foreach (App\Enums\ConversationStatus::cases() as $item)
                <option value="{{ $item }}" {{ old('conversation_status')==$item ? "selected"
                    : "" }}>{{ App\Enums\ConversationStatus::getLabel($item ) }}</option>
                @endforeach
            </x-select-box.select-box>
            <x-inputs.error :messages="$errors->get('conversation_status')" />
        </div>
    </div>
    
    <x-buttons.dark>Filter</x-buttons.dark>
</form>