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

                        <form method='POST' action="<?= route('maintenance.update', $maintenanceOffer->id) ?>" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="grid-parent mb-4">
                                <div class="grid-item">
                                    <x-inputs.label for="nummer" value="Nummer" />
                                    <x-inputs.text id="nummer" type="text" value="{{ $maintenanceOffer->id }}" readonly/>
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="get_over" value="Erhalten über" />
                                    <x-select-box.select-box name="get_over" title="Select Option">
                                        <option value="" selected>Select Option</option>
                                        @foreach (App\Enums\GetOver::cases() as $item)
                                        <option value="{{ $item }}" {{ old('get_over') == $item || $maintenanceOffer->get_over == $item ? "selected" : "" }} >{{ App\Enums\GetOver::getLabel($item ) }}</option>
                                        @endforeach
                                    </x-select-box.select-box>
                                    <x-inputs.error :messages="$errors->get('get_over')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="cs_order_number" value="CS-Auftragsnummer" />
                                    <x-inputs.text id="cs_order_number" type="text" name="cs_order_number"
                                        value="{{ old('cs_order_number', $maintenanceOffer->cs_order_number) }}" />
                                    <x-inputs.error :messages="$errors->get('cs_order_number')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="received_date" value="Erhalten am" />
                                    <x-inputs.text id="received_date" type="text" name="received_date"
                                        value="{{ old('received_date', $maintenanceOffer->received_date != '' ? date('d-m-Y', strtotime($maintenanceOffer->received_date)) : '') }}"
                                        placeholder="Wähle einen Datum" />
                                    <x-inputs.error :messages="$errors->get('received_date')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="received_from" value="Erhalten von" />
                                    <x-inputs.text id="received_from" type="text" name="received_from"
                                        value="{{ old('received_from', $maintenanceOffer->received_from) }}" />
                                    <x-inputs.error :messages="$errors->get('received_from')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="customer_number" value="Debitor/Kundennummer" />
                                    <x-inputs.text id="customer_number" type="text" name="customer_number"
                                        value="{{ old('customer_number', $maintenanceOffer->customer_number) }}" />
                                    <x-inputs.error :messages="$errors->get('customer_number')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="technical_place" value="Technischer Platz (Nummer)" />
                                    <x-inputs.text id="technical_place" type="text" name="technical_place"
                                        value="{{ old('technical_place', $maintenanceOffer->technical_place) }}" />
                                    <x-inputs.error :messages="$errors->get('technical_place')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="technical_place_address" value="Technischer Platz (Bezeichnung/Adress)" />
                                    <x-inputs.textarea id="technical_place_address" type="text"
                                        name="technical_place_address"
                                        value="{{ old('technical_place_address', $maintenanceOffer->technical_place_address) }}" />
                                    <x-inputs.error :messages="$errors->get('technical_place_address')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="technical_postcode" value="Postleitzahl" />
                                    <x-inputs.text id="technical_postcode" type="text" name="technical_postcode"
                                        value="{{ old('technical_postcode', $maintenanceOffer->technical_postcode) }}" />
                                    <x-inputs.error :messages="$errors->get('technical_postcode')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="contact_person" value="Ansprechpartner" />
                                    <x-inputs.text id="contact_person" type="text" name="contact_person"
                                        value="{{ old('contact_person', $maintenanceOffer->contact_person) }}" />
                                    <x-inputs.error :messages="$errors->get('contact_person')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="customer_email_address" value="E-Mail-Adresse des Kunden" />
                                    <x-inputs.text id="customer_email_address" type="text" name="customer_email_address"
                                        value="{{ old('customer_email_address', $maintenanceOffer->customer_email_address) }}" />
                                    <x-inputs.error :messages="$errors->get('customer_email_address')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="contact_number" value="Telefonnummer v. Ansprechpartner" />
                                    <x-inputs.text id="contact_number" type="text" name="contact_number"
                                        value="{{ old('contact_number', $maintenanceOffer->contact_number) }}" />
                                    <x-inputs.error :messages="$errors->get('contact_number')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="registered_by" value="Sachbearbeiter im Innendienst" />
                                    <x-select-box.select-box name="registered_by" title="Select Option">
                                        <option value="" selected>Select Option</option>
                                        @foreach ($users as $item)
                                        <option value="{{ $item->id }}" {{ old('registered_by')==$item->id || $maintenanceOffer->registered_by == $item->id ? "selected" : "" }}>{{
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
                                        <option value="{{ $item }}" {{ old('status') == $item || $maintenanceOffer->status == $item ? "selected" :
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
                                        <option value="{{ $item }}" {{ old('offer_type') == $item || $maintenanceOffer->offer_type == $item ? "selected"
                                            : "" }} >{{ App\Enums\OfferType::getLabel($item ) }}</option>
                                        @endforeach
                                    </x-select-box.select-box>
                                    <x-inputs.error :messages="$errors->get('offer_type')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="ktb_number" value="KTB-Nummer" />
                                    <x-inputs.text id="ktb_number" type="text" name="ktb_number"
                                        value="{{ old('ktb_number', $maintenanceOffer->ktb_number) }}" />
                                    <x-inputs.error :messages="$errors->get('ktb_number')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="quote_number" value="Angebotsnummer" />
                                    <x-inputs.text id="quote_number" type="text" name="quote_number"
                                        value="{{ old('quote_number', $maintenanceOffer->quote_number) }}" />
                                    <x-inputs.error :messages="$errors->get('quote_number')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="offer_date" value="Angebotsdatum" />
                                    <x-inputs.text id="offer_date" type="text" name="offer_date"
                                        value="{{ old('offer_date', $maintenanceOffer->offer_date != '' ? date('d-m-Y', strtotime($maintenanceOffer->offer_date)) : '') }}"
                                        placeholder="Wähle einen Datum" />
                                    <x-inputs.error :messages="$errors->get('offer_date')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="offer_amount" value="Angebotssumme" />
                                    <x-inputs.text id="offer_amount" type="text" name="offer_amount"
                                        value="{{ old('offer_amount', $maintenanceOffer->offer_amount) }}" />
                                    <x-inputs.error :messages="$errors->get('offer_amount')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="offer_follow_up" value="Angebotsnachfassung" />
                                    <x-inputs.text id="offer_follow_up" type="text" name="offer_follow_up"
                                        value="{{ old('offer_follow_up', $maintenanceOffer->offer_follow_up != '' ? date('d-m-Y', strtotime($maintenanceOffer->offer_follow_up)) : '') }}"
                                        placeholder="Wähle einen Datum" />
                                    <x-inputs.error :messages="$errors->get('offer_follow_up')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="conversation_status" value="Gesprächsresultat" />
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

                                <div class="grid-item">
                                    <x-inputs.label for="maintenance_contact" value="Wartungsvertrag/Kontrakt" />
                                    <x-inputs.text id="maintenance_contact" type="text" name="maintenance_contact"
                                        value="{{ old('maintenance_contact', $maintenanceOffer->maintenance_contact) }}" />
                                    <x-inputs.error :messages="$errors->get('maintenance_contact')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="contact_conclusion" value="Wartungsvertragsdatum" />
                                    <x-inputs.text id="contact_conclusion" type="text" name="contact_conclusion"
                                        value="{{ old('contact_conclusion', $maintenanceOffer->contact_conclusion != '' ? date('d-m-Y', strtotime($maintenanceOffer->contact_conclusion)) : '') }}"
                                        placeholder="Wähle einen Datum" />
                                    <x-inputs.error :messages="$errors->get('contact_conclusion')" />
                                </div>

                                <div class="grid-item">
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

                                <div class="grid-item">
                                    <x-inputs.label for="sum_per_year" value="Tatsächliche Summe des Wartungsvertrags pro Jahr" />
                                    <x-inputs.text id="sum_per_year" type="text" name="sum_per_year"
                                        value="{{ old('sum_per_year', $maintenanceOffer->sum_per_year) }}" />
                                    <x-inputs.error :messages="$errors->get('sum_per_year')" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="notes" value="Notizen" />
                                    <x-inputs.textarea id="notes" type="text" name="notes"
                                        value="{{ old('notes', $maintenanceOffer->notes) }}" />
                                    <x-inputs.error :messages="$errors->get('notes')" />
                                </div>

                                <div class="grid-item">
                                    @if($maintenanceOffer->file_name)
                                    <x-inputs.label for="pdf_file" value="Dateien" />  
                                        <br>
                                        @foreach($filesArray as $item)
                                            {{ $loop->first ? '' : ', ' }}
                                            <span class="d-inline-block"><span class="material-icons delete-pdf-icon">delete</span> <x-anchors.anchor href="{{config('const.site.url')}}public/uploads/{{$item}}" data-name="{{$item}}" target="_blank" class="text-break">{{ $item }}</x-anchors.anchor></span>
                                        @endforeach                                    
                                    @endif
                                    <x-inputs.text id="files_to_delete" name="files_to_delete" type="hidden" />
                                    <x-inputs.text id="files_not_previewed" name="files_not_previewed" type="hidden" />
                                    <p class="mb-0 mt-2"><x-inputs.label for="pdf_file" value="Datei hinzufügen" /></p>
                                    <div class="pdf-preview"></div>
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
        $('#received_date, #offer_date, #contact_conclusion').datepicker({
            dateFormat: "dd-mm-yy",
            minDate: "-1y",
            maxDate: 0,
            changeMonth: true,
            changeYear: true,
        });
        $('#offer_follow_up').datepicker({
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
        $("input:file").change(function (){
            $(".pdf-preview").html("");
            const pdfFiles = document.getElementById('pdf_file');
            for (let i = 0; i < pdfFiles.files.length; ++i) {
                let name = pdfFiles.files.item(i).name;
                $(".pdf-preview").append("<li class='pdf-preview-item'><span class='material-icons delete-pdf-icon-prev'>delete</span> <span>"+name+"</span></li>");
            }
        });
        $(document).on('click', '.delete-pdf-icon-prev', function(e) {
            e.preventDefault();
            $(this).siblings().toggleClass('opacity-30');
            const filesName = $('.opacity-30').text();
            $('#files_not_previewed').val(filesName);
        }); 
    </script>
    @endpush
</x-app-layout>