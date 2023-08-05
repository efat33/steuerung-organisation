<x-app-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="technical-offer"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Update Technical Offer'></x-navbars.navs.auth>
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

                        <form method='POST' action="<?= route('technical.update', $technicalOffer->id) ?>" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="grid-parent mb-4">
                                <div class="grid-item">
                                    <x-inputs.label for="nummer" value="Nummer" />
                                    <x-inputs.text id="nummer" type="text" value="{{ $technicalOffer->id }}" readonly/>
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="get_over" value="Erhalten über" />
                                    <x-select-box.select-box name="get_over" title="Select Option">
                                        <option value="" selected>Select Option</option>
                                        @foreach (App\Enums\GetOver::cases() as $item)
                                        <option value="{{ $item }}" {{ old('get_over') == $item || $technicalOffer->get_over == $item ? "selected" : "" }} >{{ App\Enums\GetOver::getLabel($item ) }}</option>
                                        @endforeach
                                    </x-select-box.select-box>
                                    <x-inputs.error :messages="$errors->get('get_over')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="cs_order_number" value="CS-Auftragsnummer" />
                                    <x-inputs.text id="cs_order_number" type="text" name="cs_order_number"
                                        value="{{ old('cs_order_number', $technicalOffer->cs_order_number) }}" />
                                    <x-inputs.error :messages="$errors->get('cs_order_number')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="received_date" value="Erhalten Am" />
                                    <x-inputs.text id="received_date" type="text" name="received_date"
                                        value="{{ old('received_date', $technicalOffer->received_date != '' ? date('d-m-Y', strtotime($technicalOffer->received_date)) : '') }}"
                                        placeholder="Wähle einen Datum" />
                                    <x-inputs.error :messages="$errors->get('received_date')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="received_from" value="Erhalten Von" />
                                    <x-inputs.text id="received_from" type="text" name="received_from"
                                        value="{{ old('received_from', $technicalOffer->received_from) }}" />
                                    <x-inputs.error :messages="$errors->get('received_from')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="customer_number" value="Debitor/Kundennummer" />
                                    <x-inputs.text id="customer_number" type="text" name="customer_number"
                                        value="{{ old('customer_number', $technicalOffer->customer_number) }}" />
                                    <x-inputs.error :messages="$errors->get('customer_number')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="technical_place" value="Technischer Platz" />
                                    <x-inputs.text id="technical_place" type="text" name="technical_place"
                                        value="{{ old('technical_place', $technicalOffer->technical_place) }}" />
                                    <x-inputs.error :messages="$errors->get('technical_place')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="technical_place_address" value="Technische Ortsadresse" />
                                    <x-inputs.textarea id="technical_place_address" type="text"
                                        name="technical_place_address"
                                        value="{{ old('technical_place_address', $technicalOffer->technical_place_address) }}" />
                                    <x-inputs.error :messages="$errors->get('technical_place_address')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="technical_postcode" value="Postleitzahl" />
                                    <x-inputs.text id="technical_postcode" type="text" name="technical_postcode"
                                        value="{{ old('technical_postcode', $technicalOffer->technical_postcode) }}" />
                                    <x-inputs.error :messages="$errors->get('technical_postcode')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="contact_person" value="Ansprechpartner" />
                                    <x-inputs.text id="contact_person" type="text" name="contact_person"
                                        value="{{ old('contact_person', $technicalOffer->contact_person) }}" />
                                    <x-inputs.error :messages="$errors->get('contact_person')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="contact_number" value="Gesprächspartner" />
                                    <x-inputs.text id="contact_number" type="text" name="contact_number"
                                        value="{{ old('contact_number', $technicalOffer->contact_number) }}" />
                                    <x-inputs.error :messages="$errors->get('contact_number')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="registered_by" value="Sachbearbeiter im Innendienst" />
                                    <x-select-box.select-box name="registered_by" title="Select Option">
                                        <option value="" selected>Select Option</option>
                                        @foreach ($users as $item)
                                        <option value="{{ $item->id }}" {{ old('registered_by')==$item->id || $technicalOffer->registered_by == $item->id ? "selected" : "" }}>{{
                                            $item->name }}</option>
                                        @endforeach
                                    </x-select-box.select-box>
                                    <x-inputs.error :messages="$errors->get('registered_by')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="status" value="Status" />
                                    <x-select-box.select-box name="status" title="Select Option">
                                        <option value="" selected>Select Option</option>
                                        @foreach (App\Enums\Status::cases() as $item)
                                        <option value="{{ $item }}" {{ old('status') == $item || $technicalOffer->status == $item ? "selected" :
                                            "" }} >{{ App\Enums\Status::getLabel($item ) }}</option>
                                        @endforeach
                                    </x-select-box.select-box>
                                    <x-inputs.error :messages="$errors->get('status')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="offer_type" value="Angebotsart" />
                                    <x-select-box.select-box name="offer_type" title="Select Option">
                                        <option value="" selected>Select Option</option>
                                        @foreach (App\Enums\OfferType::cases() as $item)
                                        <option value="{{ $item }}" {{ old('offer_type') == $item || $technicalOffer->offer_type == $item ? "selected"
                                            : "" }} >{{ App\Enums\OfferType::getLabel($item ) }}</option>
                                        @endforeach
                                    </x-select-box.select-box>
                                    <x-inputs.error :messages="$errors->get('offer_type')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="ktb_number" value="KTB-Nummer" />
                                    <x-inputs.text id="ktb_number" type="text" name="ktb_number"
                                        value="{{ old('ktb_number', $technicalOffer->ktb_number) }}" />
                                    <x-inputs.error :messages="$errors->get('ktb_number')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="quote_number" value="Angebotsnummer" />
                                    <x-inputs.text id="quote_number" type="text" name="quote_number"
                                        value="{{ old('quote_number', $technicalOffer->quote_number) }}" />
                                    <x-inputs.error :messages="$errors->get('quote_number')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="offer_date" value="Angebotsdatum" />
                                    <x-inputs.text id="offer_date" type="text" name="offer_date"
                                        value="{{ old('offer_date', $technicalOffer->offer_date != '' ? date('d-m-Y', strtotime($technicalOffer->offer_date)) : '') }}"
                                        placeholder="Wähle einen Datum" />
                                    <x-inputs.error :messages="$errors->get('offer_date')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="offer_amount" value="Angebotssumme" />
                                    <x-inputs.text id="offer_amount" type="text" name="offer_amount"
                                        value="{{ old('offer_amount', $technicalOffer->offer_amount) }}" />
                                    <x-inputs.error :messages="$errors->get('offer_amount')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="offer_follow_up" value="Angebotsnachfassung" />
                                    <x-inputs.text id="offer_follow_up" type="text" name="offer_follow_up"
                                        value="{{ old('offer_follow_up', $technicalOffer->offer_follow_up != '' ? date('d-m-Y', strtotime($technicalOffer->offer_follow_up)) : '') }}"
                                        placeholder="Wähle einen Datum" />
                                    <x-inputs.error :messages="$errors->get('offer_follow_up')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="conversation_status" value="Resultat Nach Dem Gespräch" />
                                    <x-select-box.select-box name="conversation_status" title="Select Option">
                                        <option value="" selected>Select Option</option>
                                        @foreach (App\Enums\ConversationStatus::cases() as $item)
                                        <option value="{{ $item }}" {{ old('conversation_status') == $item || $technicalOffer->conversation_status == $item ?
                                            "selected" : "" }} >{{ App\Enums\ConversationStatus::getLabel($item ) }}
                                        </option>
                                        @endforeach
                                    </x-select-box.select-box>
                                    <x-inputs.error :messages="$errors->get('conversation_status')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="order_number" value="Auftragsnummer" />
                                    <x-inputs.text id="order_number" type="text" name="order_number"
                                        value="{{ old('order_number', $technicalOffer->order_number) }}" />
                                    <x-inputs.error :messages="$errors->get('order_number')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="order_date" value="Auftragsdatum" />
                                    <x-inputs.text id="order_date" type="text" name="order_date"
                                        value="{{ old('order_date', $technicalOffer->order_date != '' ? date('d-m-Y', strtotime($technicalOffer->order_date)) : '') }}"
                                        placeholder="Wähle einen Datum" />
                                    <x-inputs.error :messages="$errors->get('order_date')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="order_amount" value="Auftragssumme" />
                                    <x-inputs.text id="order_amount" type="text" name="order_amount"
                                        value="{{ old('order_amount', $technicalOffer->order_amount) }}" />
                                    <x-inputs.error :messages="$errors->get('order_amount')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="execution_date" value="Durchführungsdatum" />
                                    <x-inputs.text id="execution_date" type="text" name="execution_date"
                                        value="{{ old('execution_date', $technicalOffer->execution_date != '' ? date('d-m-Y', strtotime($technicalOffer->execution_date)) : '') }}"
                                        placeholder="Wähle einen Datum" />
                                    <x-inputs.error :messages="$errors->get('execution_date')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="approval_date" value="Freigabe Zur Verrechnung" />
                                    <x-inputs.text id="approval_date" type="text" name="approval_date"
                                        value="{{ old('approval_date', $technicalOffer->approval_date != '' ? date('d-m-Y', strtotime($technicalOffer->approval_date)) : '') }}"
                                        placeholder="Wähle einen Datum" />
                                    <x-inputs.error :messages="$errors->get('approval_date')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="invice_amount" value="Fakturawert" />
                                    <x-inputs.text id="invice_amount" type="text" name="invice_amount"
                                        value="{{ old('invice_amount', $technicalOffer->invice_amount) }}" />
                                    <x-inputs.error :messages="$errors->get('invice_amount')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="notes" value="Notizen" />
                                    <x-inputs.textarea id="notes" type="text" name="notes"
                                        value="{{ old('notes', $technicalOffer->notes) }}" />
                                    <x-inputs.error :messages="$errors->get('notes')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="pdf_file" value="Aktualisieren Sie das PDF" />
                                    @if($technicalOffer->file_name)  
                                        <br>
                                        @foreach($filesArray as $item)
                                            {{ $loop->first ? '' : ', ' }}
                                            <span class="d-inline-block"><span class="material-icons delete-pdf-icon">delete</span> <x-anchors.anchor href="{{config('const.site.url')}}public/uploads/{{$item}}" data-name="{{$item}}" target="_blank" class="text-break">{{ $item }}</x-anchors.anchor></span>
                                        @endforeach
                                        <x-inputs.text id="files_to_delete" name="files_to_delete" type="hidden" />
                                        <p class="mb-0 mt-2"><x-inputs.label for="pdf_file" value="Neue hinzufügen" /></p>                                   
                                    @endif
                                    <x-inputs.text id="pdf_file" type="file" accept="application/pdf" name="pdf_file[]" value="{{ old('pdf_file') }}" multiple/>
                                    <x-inputs.error :messages="$errors->get('pdf_file')" />
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
        $('#received_date, #offer_date, #approval_date, #order_date').datepicker({
            dateFormat: "dd-mm-yy",
            minDate: "-1y",
            maxDate: 0,
            changeMonth: true,
            changeYear: true,
        });
        $('#execution_date, #offer_follow_up').datepicker({
            dateFormat: "dd-mm-yy",
            minDate: 0,
            maxDate: "1y",
            changeMonth: true,
            changeYear: true,
        });
        
        $('.delete-pdf-icon').on('click', function(e) {
            e.preventDefault();
            $(this).siblings().toggleClass('opacity-100 opacity-30');
            const filesName = $('.opacity-30').text();
            $('#files_to_delete').val(filesName);
        });     
    </script>
    @endpush
</x-app-layout>