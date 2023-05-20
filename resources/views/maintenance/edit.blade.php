<x-app-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="maintenance-offer"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Update Maintenance Offer'></x-navbars.navs.auth>
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

                        <form method='POST' action="<?= route('maintenance.update', $maintenanceOffer->id) ?>">
                            @csrf
                            @method('PUT')

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="get_over" value="Erhalten über" />
                                    <x-select-box.select-box name="get_over" title="Select Option">
                                        <option value="" selected>Select Option</option>
                                        @foreach (App\Enums\GetOver::cases() as $item)
                                        <option value="{{ $item }}" {{ old('get_over') == $item || $maintenanceOffer->get_over == $item ? "selected" : "" }} >{{ App\Enums\GetOver::getLabel($item ) }}</option>
                                        @endforeach
                                    </x-select-box.select-box>
                                    <x-inputs.error :messages="$errors->get('get_over')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="cs_order_number" value="CS-Auftragsnummer" />
                                    <x-inputs.text id="cs_order_number" type="text" name="cs_order_number"
                                        value="{{ old('cs_order_number', $maintenanceOffer->cs_order_number) }}" />
                                    <x-inputs.error :messages="$errors->get('cs_order_number')" />
                                </div>

                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="received_date" value="Erhalten Am" />
                                    <x-inputs.text id="received_date" type="text" name="received_date"
                                        value="{{ old('received_date', $maintenanceOffer->received_date != '' ? date('d-m-Y', strtotime($maintenanceOffer->received_date)) : '') }}"
                                        placeholder="Wähle einen Dake" />
                                    <x-inputs.error :messages="$errors->get('received_date')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="received_from" value="Erhalten Von" />
                                    <x-inputs.text id="received_from" type="text" name="received_from"
                                        value="{{ old('received_from', $maintenanceOffer->received_from) }}" />
                                    <x-inputs.error :messages="$errors->get('received_from')" />
                                </div>

                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="customer_number" value="Debitor/Kundennummer" />
                                    <x-inputs.text id="customer_number" type="text" name="customer_number"
                                        value="{{ old('customer_number', $maintenanceOffer->customer_number) }}" />
                                    <x-inputs.error :messages="$errors->get('customer_number')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="technical_place" value="Technischer Platz" />
                                    <x-inputs.text id="technical_place" type="text" name="technical_place"
                                        value="{{ old('technical_place', $maintenanceOffer->technical_place) }}" />
                                    <x-inputs.error :messages="$errors->get('technical_place')" />
                                </div>

                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="technical_place_address" value="Technische Ortsadresse" />
                                    <x-inputs.textarea id="technical_place_address" type="text"
                                        name="technical_place_address"
                                        value="{{ old('technical_place_address', $maintenanceOffer->technical_place_address) }}" />
                                    <x-inputs.error :messages="$errors->get('technical_place_address')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="technical_postcode" value="Postleitzahl" />
                                    <x-inputs.text id="technical_postcode" type="text" name="technical_postcode"
                                        value="{{ old('technical_postcode', $maintenanceOffer->technical_postcode) }}" />
                                    <x-inputs.error :messages="$errors->get('technical_postcode')" />
                                </div>

                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="status" value="Status" />
                                    <x-select-box.select-box name="status" title="Select Option">
                                        <option value="" selected>Select Option</option>
                                        @foreach (App\Enums\Status::cases() as $item)
                                        <option value="{{ $item }}" {{ old('status') == $item || $maintenanceOffer->status == $item ? "selected" :
                                            "" }} >{{ App\Enums\Status::getLabel($item ) }}</option>
                                        @endforeach
                                    </x-select-box.select-box>
                                    <x-inputs.error :messages="$errors->get('status')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="ktb_number" value="KTB-Nummer" />
                                    <x-inputs.text id="ktb_number" type="text" name="ktb_number"
                                        value="{{ old('ktb_number', $maintenanceOffer->ktb_number) }}" />
                                    <x-inputs.error :messages="$errors->get('ktb_number')" />
                                </div>
                            
                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="quote_number" value="Angebotsnummer" />
                                    <x-inputs.text id="quote_number" type="text" name="quote_number"
                                        value="{{ old('quote_number', $maintenanceOffer->quote_number) }}" />
                                    <x-inputs.error :messages="$errors->get('quote_number')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="offer_date" value="Angebotsdatum" />
                                    <x-inputs.text id="offer_date" type="text" name="offer_date"
                                        value="{{ old('offer_date', $maintenanceOffer->offer_date != '' ? date('d-m-Y', strtotime($maintenanceOffer->offer_date)) : '') }}"
                                        placeholder="Wähle einen Dake" />
                                    <x-inputs.error :messages="$errors->get('offer_date')" />
                                </div>

                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="offer_amount" value="Angebotssumme" />
                                    <x-inputs.text id="offer_amount" type="text" name="offer_amount"
                                        value="{{ old('offer_amount', $maintenanceOffer->offer_amount) }}" />
                                    <x-inputs.error :messages="$errors->get('offer_amount')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="offer_follow_up" value="Angebotsnachfassung" />
                                    <x-inputs.text id="offer_follow_up" type="text" name="offer_follow_up"
                                        value="{{ old('offer_follow_up', $maintenanceOffer->offer_follow_up != '' ? date('d-m-Y', strtotime($maintenanceOffer->offer_follow_up)) : '') }}"
                                        placeholder="Wähle einen Dake" />
                                    <x-inputs.error :messages="$errors->get('offer_follow_up')" />
                                </div>

                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="conversation_status" value="Resultat Nach Dem Gespräch" />
                                    <x-select-box.select-box name="conversation_status" title="Select Option">
                                        <option value="" selected>Select Option</option>
                                        @foreach (App\Enums\ConversationStatus::cases() as $item)
                                        <option value="{{ $item }}" {{ old('conversation_status') == $item || $maintenanceOffer->conversation_status == $item ?
                                            "selected" : "" }} >{{ App\Enums\ConversationStatus::getLabel($item ) }}
                                        </option>
                                        @endforeach
                                    </x-select-box.select-box>
                                    <x-inputs.error :messages="$errors->get('conversation_status')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="maintenance_contact" value="Wartungsvertrag/Kontrakt" />
                                    <x-inputs.text id="maintenance_contact" type="text" name="maintenance_contact"
                                        value="{{ old('maintenance_contact', $maintenanceOffer->maintenance_contact) }}" />
                                    <x-inputs.error :messages="$errors->get('maintenance_contact')" />
                                </div>

                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="contact_conclusion" value="Abschluss des Wartungsvertrags" />
                                    <x-inputs.text id="contact_conclusion" type="text" name="contact_conclusion"
                                        value="{{ old('contact_conclusion', $maintenanceOffer->contact_conclusion != '' ? date('d-m-Y', strtotime($maintenanceOffer->contact_conclusion)) : '') }}"
                                        placeholder="Wähle einen Dake" />
                                    <x-inputs.error :messages="$errors->get('contact_conclusion')" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <x-inputs.label for="package" value="Paket" />
                                    <x-select-box.select-box name="package" title="Select Option">
                                        <option value="" selected>Select Option</option>
                                        @foreach (App\Enums\Package::cases() as $item)
                                        <option value="{{ $item }}" {{ old('package') == $item || $maintenanceOffer->package == $item ?
                                            "selected" : "" }} >{{ App\Enums\Package::getLabel($item ) }}
                                        </option>
                                        @endforeach
                                    </x-select-box.select-box>
                                    <x-inputs.error :messages="$errors->get('package')" />
                                </div>

                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-12">
                                    <x-inputs.label for="sum_per_year" value="Tatsächliche Summe des Wartungsvertrags pro Jahr" />
                                    <x-inputs.text id="sum_per_year" type="text" name="sum_per_year"
                                        value="{{ old('sum_per_year', $maintenanceOffer->sum_per_year) }}" />
                                    <x-inputs.error :messages="$errors->get('sum_per_year')" />
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
    @endpush

    @push('js')
    <script src="{{ asset('assets') }}/js/plugins/jquery-ui.min.js"></script>
    <script>
        $('#received_date, #offer_date, #offer_follow_up, #contact_conclusion').datepicker({
            dateFormat: "dd-mm-yy",
            minDate: "-1y",
            maxDate: 0,
            changeMonth: true,
            changeYear: true,
        });
    </script>
    @endpush
</x-app-layout>