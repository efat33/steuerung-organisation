<?php 
    $status_color = '#7b809a';
    if($maintenanceOffer->status != ''){
        $status_color = App\Enums\Status::getColor($maintenanceOffer->status);
    }
?>
<x-app-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="maintenance-offer"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Maintenance Offer'></x-navbars.navs.auth>
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
                                <x-inputs.label class="fw-bold" value="Registriert durch" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $maintenanceOffer->user->name }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Debitor/ Kundennummer" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $maintenanceOffer->customer_number }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Erhalten Von" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $maintenanceOffer->received_from }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Erhalten über" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $maintenanceOffer->get_over != '' ?
                                    App\Enums\GetOver::getLabel($maintenanceOffer->get_over) : '' }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="CS-Auftragsnummer" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $maintenanceOffer->cs_order_number }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Erhalten Am" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $maintenanceOffer->received_date != '' ? date('d-m-Y',
                                    strtotime($maintenanceOffer->received_date)) : '' }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Technischer Platz" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $maintenanceOffer->technical_place }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Technische Ortsadresse" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $maintenanceOffer->technical_place_address }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Postleitzahl" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $maintenanceOffer->technical_postcode }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Status" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="mb-0" style="color: <?= $status_color ?>">{{ $maintenanceOffer->status != '' ?
                                    App\Enums\Status::getLabel($maintenanceOffer->status) : '' }}
                                </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="KTB-Nummer" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $maintenanceOffer->ktb_number }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Angebotsnummer" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $maintenanceOffer->quote_number }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Angebotsdatum" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $maintenanceOffer->offer_date != '' ? date('d-m-Y',
                                    strtotime($maintenanceOffer->offer_date)) : '' }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Angebotssumme" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $maintenanceOffer->offer_amount }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Angebotsnachfassung" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $maintenanceOffer->offer_follow_up != '' ? date('d-m-Y',
                                    strtotime($maintenanceOffer->offer_follow_up)) : '' }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Resultat Nach Dem Gespräch" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{
                                    $maintenanceOffer->conversation_status != '' ?
                                    App\Enums\ConversationStatus::getLabel($maintenanceOffer->conversation_status) : '' }}
                                </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Wartungsvertrag/Kontrakt" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $maintenanceOffer->maintenance_contact }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Abschluss des Wartungsvertrags" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $maintenanceOffer->contact_conclusion != '' ? date('d-m-Y',
                                    strtotime($maintenanceOffer->contact_conclusion)) : '' }} </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Paket" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{
                                    $maintenanceOffer->package != '' ?
                                    App\Enums\Package::getLabel($maintenanceOffer->package) : '' }}
                                </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-12">
                                <x-inputs.label class="fw-bold" value="Tatsächliche Summe des Wartungsvertrags pro Jahr" />
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <p class="text-secondary mb-0">{{ $maintenanceOffer->sum_per_year }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>



        </div>
        <x-footers.auth></x-footers.auth>
    </div>
</x-app-layout>