<x-app-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="technical-offer"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="New Technical Offer"></x-navbars.navs.auth>
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

                        <form method='POST' action="<?= route('technical.store') ?>">
                            @csrf

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="get_over" value="Erhalten über" />
                                    <x-select-box.select-box name="get_over" title="Select Option">
                                        <option value="" selected>Select Option</option>
                                        @foreach (App\Enums\GetOver::cases() as $item)
                                        <option value="{{ $item }}" {{ old('get_over')==$item ? "selected" : "" }}>{{
                                            App\Enums\GetOver::getLabel($item ) }}</option>
                                        @endforeach
                                    </x-select-box.select-box>
                                    <x-inputs.error :messages="$errors->get('get_over')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="cs_order_number" value="CS-Auftragsnummer" />
                                    <x-inputs.text id="cs_order_number" type="text" name="cs_order_number"
                                        value="{{ old('cs_order_number') }}" />
                                    <x-inputs.error :messages="$errors->get('cs_order_number')" />
                                </div>

                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="received_date" value="Erhalten Am" />
                                    <x-inputs.text id="received_date" type="text" name="received_date"
                                        value="{{ old('received_date') }}" placeholder="Wähle einen Dake" />
                                    <x-inputs.error :messages="$errors->get('received_date')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="received_from" value="Erhalten Von" />
                                    <x-inputs.text id="received_from" type="text" name="received_from"
                                        value="{{ old('received_from') }}" />
                                    <x-inputs.error :messages="$errors->get('received_from')" />
                                </div>

                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="customer_number" value="Debitor/Kundennummer" />
                                    <x-inputs.text id="customer_number" type="text" name="customer_number"
                                        value="{{ old('customer_number') }}" />
                                    <x-inputs.error :messages="$errors->get('customer_number')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="technical_place" value="Technischer Platz" />
                                    <x-inputs.text id="technical_place" type="text" name="technical_place"
                                        value="{{ old('technical_place') }}" />
                                    <x-inputs.error :messages="$errors->get('technical_place')" />
                                </div>



                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="technical_place_address" value="Technische Ortsadresse" />
                                    <x-inputs.textarea id="technical_place_address" type="text"
                                        name="technical_place_address" value="{{ old('technical_place_address') }}" />
                                    <x-inputs.error :messages="$errors->get('technical_place_address')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="technical_postcode" value="Postleitzahl" />
                                    <x-inputs.text id="technical_postcode" type="text" name="technical_postcode"
                                        value="{{ old('technical_postcode') }}" />
                                    <x-inputs.error :messages="$errors->get('technical_postcode')" />
                                </div>

                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="status" value="Status" />
                                    <x-select-box.select-box name="status" title="Select Option">
                                        <option value="" selected>Select Option</option>
                                        @foreach (App\Enums\Status::cases() as $item)
                                        <option value="{{ $item }}" {{ old('status')==$item ? "selected" : "" }}>{{
                                            App\Enums\Status::getLabel($item ) }}</option>
                                        @endforeach
                                    </x-select-box.select-box>
                                    <x-inputs.error :messages="$errors->get('status')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="offer_type" value="Angebotsart" />
                                    <x-select-box.select-box name="offer_type" title="Select Option">
                                        <option value="" selected>Select Option</option>
                                        @foreach (App\Enums\OfferType::cases() as $item)
                                        <option value="{{ $item }}" {{ old('offer_type')==$item ? "selected" : "" }}>{{
                                            App\Enums\OfferType::getLabel($item ) }}</option>
                                        @endforeach
                                    </x-select-box.select-box>
                                    <x-inputs.error :messages="$errors->get('offer_type')" />
                                </div>

                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="ktb_number" value="KTB-Nummer" />
                                    <x-inputs.text id="ktb_number" type="text" name="ktb_number"
                                        value="{{ old('ktb_number') }}" />
                                    <x-inputs.error :messages="$errors->get('ktb_number')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="quote_number" value="Angebotsnummer" />
                                    <x-inputs.text id="quote_number" type="text" name="quote_number"
                                        value="{{ old('quote_number') }}" />
                                    <x-inputs.error :messages="$errors->get('quote_number')" />
                                </div>

                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="offer_date" value="Angebotsdatum" />
                                    <x-inputs.text id="offer_date" type="text" name="offer_date"
                                        value="{{ old('offer_date') }}" placeholder="Wähle einen Dake" />
                                    <x-inputs.error :messages="$errors->get('offer_date')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="offer_amount" value="Angebotssumme" />
                                    <x-inputs.text id="offer_amount" type="text" name="offer_amount"
                                        value="{{ old('offer_amount') }}" />
                                    <x-inputs.error :messages="$errors->get('offer_amount')" />
                                </div>

                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="offer_follow_up" value="Angebotsnachfassung" />
                                    <x-inputs.text id="offer_follow_up" type="text" name="offer_follow_up"
                                        value="{{ old('offer_follow_up') }}" placeholder="Wähle einen Dake" />
                                    <x-inputs.error :messages="$errors->get('offer_follow_up')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="conversation_status" value="Resultat Nach Dem Gespräch" />
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

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="order_number" value="Auftragsnummer" />
                                    <x-inputs.text id="order_number" type="text" name="order_number"
                                        value="{{ old('order_number') }}" />
                                    <x-inputs.error :messages="$errors->get('order_number')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="order_date" value="Auftragsdatum" />
                                    <x-inputs.text id="order_date" type="text" name="order_date"
                                        value="{{ old('order_date') }}" placeholder="Wähle einen Dake" />
                                    <x-inputs.error :messages="$errors->get('order_date')" />
                                </div>

                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="order_amount" value="Auftragssumme" />
                                    <x-inputs.text id="order_amount" type="text" name="order_amount"
                                        value="{{ old('order_amount') }}" />
                                    <x-inputs.error :messages="$errors->get('order_amount')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="execution_date" value="Durchführungsdatum" />
                                    <x-inputs.text id="execution_date" type="text" name="execution_date"
                                        value="{{ old('execution_date') }}" placeholder="Wähle einen Dake" />
                                    <x-inputs.error :messages="$errors->get('execution_date')" />
                                </div>

                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="approval_date" value="Freigabe Zur Verrechnung" />
                                    <x-inputs.text id="approval_date" type="text" name="approval_date"
                                        value="{{ old('approval_date') }}" placeholder="Wähle einen Dake" />
                                    <x-inputs.error :messages="$errors->get('approval_date')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="invice_amount" value="Fakturawert" />
                                    <x-inputs.text id="invice_amount" type="text" name="invice_amount"
                                        value="{{ old('invice_amount') }}" />
                                    <x-inputs.error :messages="$errors->get('invice_amount')" />
                                </div>

                            </div>

                            <div class="row">

                                <div class="mb-3 col-12">
                                    <x-inputs.label for="notes" value="Notizen" />
                                    <x-inputs.textarea id="notes" type="text" name="notes" value="{{ old('notes') }}" />
                                    <x-inputs.error :messages="$errors->get('notes')" />
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

    @push('css')
    <link rel="stylesheet" href="{{ asset('assets') }}/css/jquery-ui.min.css">
    <style>
        .form-select:focus {
            border-color: #d2d6da
        }
    </style>
    @endpush

    @push('js')
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> -->
    <!-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->

    <script src="{{ asset('assets') }}/js/plugins/jquery-ui.min.js"></script>
    <script>
        $('#received_date, #offer_date, #offer_follow_up, #approval_date, #order_date').datepicker({
            dateFormat: "dd-mm-yy",
            minDate: "-1y",
            maxDate: 0,
            changeMonth: true,
            changeYear: true,
        });
        $('#execution_date').datepicker({
            dateFormat: "dd-mm-yy",
            minDate: 0,
            maxDate: "1y",
            changeMonth: true,
            changeYear: true,
        });
        // .datepicker("setDate", new Date());
    </script>

    @endpush
</x-app-layout>