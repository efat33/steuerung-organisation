<?php 
    $status_color = '#7b809a';
    if($technicalOffer->status != ''){
        $status_color = App\Enums\Status::getColor($technicalOffer->status);
    }
?>
<x-app-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="technical-offer"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Technical Offer'></x-navbars.navs.auth>
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

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Nummer" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->id }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Sachbearbeiter im Innendienst" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->user->name ?? 'Nicht zugeordnet' }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Debitor/ Kundennummer" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->customer_number }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Erhalten Von" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->received_from }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Erhalten über" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->get_over != '' ?
                                    App\Enums\GetOver::getLabel($technicalOffer->get_over) : '' }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="CS-Auftragsnummer" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->cs_order_number }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Erhalten Am" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->received_date != '' ? date('d-m-Y',
                                    strtotime($technicalOffer->received_date)) : '' }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Technischer Platz" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->technical_place }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Technische Ortsadresse" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->technical_place_address }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Postleitzahl" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->technical_postcode }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Ansprechpartner" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->contact_person }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Gesprächspartner" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0"><a href="tel:{{ $technicalOffer->contact_number }}">{{ $technicalOffer->contact_number }}</a></p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Status" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="mb-0" style="color: <?= $status_color ?>">{{ $technicalOffer->status != '' ?
                                    App\Enums\Status::getLabel($technicalOffer->status) : '' }}
                                </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Angebotsart" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{
                                    $technicalOffer->offer_type != '' ?
                                    App\Enums\OfferType::getLabel($technicalOffer->offer_type) : '' }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="KTB-Nummer" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->ktb_number }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Angebotsnummer" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->quote_number }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Angebotsdatum" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->offer_date != '' ? date('d-m-Y',
                                    strtotime($technicalOffer->offer_date)) : '' }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Angebotssumme" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->offer_amount }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Angebotsnachfassung" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->offer_follow_up != '' ? date('d-m-Y',
                                    strtotime($technicalOffer->offer_follow_up)) : '' }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Resultat Nach Dem Gespräch" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{
                                    $technicalOffer->conversation_status != '' ?
                                    App\Enums\ConversationStatus::getLabel($technicalOffer->conversation_status) : '' }}
                                </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Auftragsnummer" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->order_number }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Auftragsdatum" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->order_date != '' ? date('d-m-Y',
                                    strtotime($technicalOffer->order_date)) : '' }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Auftragssumme" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->order_amount }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Durchführungsdatum" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->execution_date != '' ? date('d-m-Y',
                                    strtotime($technicalOffer->execution_date)) : '' }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Freigabe Zur Verrechnung" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->approval_date != '' ? date('d-m-Y',
                                    strtotime($technicalOffer->approval_date)) : '' }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Fakturawert" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->invice_amount }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Notizen" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $technicalOffer->notes }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="PDF Datei" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                @if($technicalOffer->file_name)  
                                    @foreach($filesArray as $item)
                                        {{ $loop->first ? '' : ', ' }}
                                        <span class="d-inline-block">{{ $loop->iteration.'.' }} <x-anchors.anchor href="{{config('const.site.url')}}public/uploads/{{$item}}" target="_blank">{{ $item }}</x-anchors.anchor></span>
                                    @endforeach                                   
                                @endif                             
                            </div>
                        </div>

                    </div>
                </div>
            </div>



        </div>
        <x-footers.auth></x-footers.auth>
    </div>
</x-app-layout>