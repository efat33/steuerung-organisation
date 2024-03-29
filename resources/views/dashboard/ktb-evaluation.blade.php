<x-app-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="dashboard"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="card card-body mx-3 mx-md-3 mt-4">
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        <div class="mb-5">
                            <x-buttons.dashboard-nav activePage="ktb-evaluation" />
                        </div>

                        @if (session('status'))
                        <div class="row">
                            <x-auth-session-status class="alert-success" :status="session('status')" />
                        </div>
                        @endif

                        <form method='POST' action="<?= route('dashboard.ktb-evaluation') ?>">
                            @csrf

                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <x-inputs.label for="technical_ktb_number" value="Technisch KTB-Nummer" />
                                    <x-inputs.text id="technical_ktb_number" type="text" name="technical_ktb_number"
                                        value="{{ old('technical_ktb_number') }}" />
                                    <x-inputs.error :messages="$errors->get('technical_ktb_number')" />
                                </div>

                                <div class="mb-3 col-md-4">
                                    <x-inputs.label for="technisch_von" value="Technisch Von" />
                                    <x-inputs.text id="technisch_von" type="text" name="technisch_von"
                                        value="{{ old('technisch_von') }}" placeholder="Wähle ein Datum" />
                                    <x-inputs.error :messages="$errors->get('technisch_von')" />
                                </div>

                                <div class="mb-3 col-md-4">
                                    <x-inputs.label for="technisch_zu" value="Technisch Zu" />
                                    <x-inputs.text id="technisch_zu" type="text" name="technisch_zu"
                                        value="{{ old('technisch_zu') }}" placeholder="Wähle ein Datum" />
                                    <x-inputs.error :messages="$errors->get('technisch_zu')" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <x-inputs.label for="maintenance_ktb_number" value="Wartung KTB-Nummer" />
                                    <x-inputs.text id="maintenance_ktb_number" type="text" name="maintenance_ktb_number"
                                        value="{{ old('maintenance_ktb_number') }}" />
                                    <x-inputs.error :messages="$errors->get('maintenance_ktb_number')" />
                                </div>

                                <div class="mb-3 col-md-4">
                                    <x-inputs.label for="wartung_von" value="Wartung Von" />
                                    <x-inputs.text id="wartung_von" type="text" name="wartung_von"
                                        value="{{ old('wartung_von') }}" placeholder="Wähle ein Datum" />
                                    <x-inputs.error :messages="$errors->get('wartung_von')" />
                                </div>

                                <div class="mb-3 col-md-4">
                                    <x-inputs.label for="wartung_zu" value="Wartung Zu" />
                                    <x-inputs.text id="wartung_zu" type="text" name="wartung_zu"
                                        value="{{ old('wartung_zu') }}" placeholder="Wähle ein Datum" />
                                    <x-inputs.error :messages="$errors->get('wartung_zu')" />
                                </div>
                            </div>

                            <x-buttons.dark>Search</x-buttons.dark>
                        </form>

                        <div class="row">
                            <div class="col-md-6 col-12 mt-5">
                                <h6 class="font-weight-bolder mb-4">Technischer KTB Auswertung</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-6">
                                        <x-inputs.label class="fw-bold" value="KTB-Nummer" />
                                    </div>
                                    <div class="col-md-6 col-6">
                                        @if (isset($technicalKtbNumber))
                                            <p class="text-secondary mb-0">{{ $technicalKtbNumber }} </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-6">
                                        <x-inputs.label class="fw-bold" value="Anzahl der Angebote" />
                                    </div>
                                    <div class="col-md-6 col-6">
                                        @if (isset($technicalOffers))
                                            <p class="text-secondary mb-0">{{ $technicalOffers[0]->total_offer }} </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-6">
                                        <x-inputs.label class="fw-bold" value="Angebotssumme" />
                                    </div>
                                    <div class="col-md-6 col-6">
                                        @if (isset($technicalOffers))
                                            <p class="text-secondary mb-0">{{ $technicalOffers[0]->total_offer_amount }} </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-6">
                                        <x-inputs.label class="fw-bold" value="Anzahl der Aufträge" />
                                    </div>
                                    <div class="col-md-6 col-6">
                                        @if (isset($technicalOffers))
                                            <p class="text-secondary mb-0">{{ $technicalOrders[0]->total_order }} </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-6">
                                        <x-inputs.label class="fw-bold" value="Anftragssumme" />
                                    </div>
                                    <div class="col-md-6 col-6">
                                        @if (isset($technicalOffers))
                                            <p class="text-secondary mb-0">{{ $technicalOrders[0]->total_order_amount }} </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mt-5">
                                <h6 class="font-weight-bolder mb-4">Wartung KTB Auswertung</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-6">
                                        <x-inputs.label class="fw-bold" value="KTB-Nummer" />
                                    </div>
                                    <div class="col-md-6 col-6">
                                        @if (isset($maintenanceKtbNumber))
                                            <p class="text-secondary mb-0">{{ $maintenanceKtbNumber }} </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-6">
                                        <x-inputs.label class="fw-bold" value="Anzahl der Angebote" />
                                    </div>
                                    <div class="col-md-6 col-6">
                                        @if (isset($maintenanceOffers))
                                            <p class="text-secondary mb-0">{{ $maintenanceOffers[0]->total_offer }} </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-6">
                                        <x-inputs.label class="fw-bold" value="Angebotssumme" />
                                    </div>
                                    <div class="col-md-6 col-6">
                                        @if (isset($maintenanceOffers))
                                            <p class="text-secondary mb-0">{{ $maintenanceOffers[0]->total_offer_amount }} </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-6">
                                        <x-inputs.label class="fw-bold" value="Anzahl der Aufträge" />
                                    </div>
                                    <div class="col-md-6 col-6">
                                        @if (isset($maintenanceOders))
                                            <p class="text-secondary mb-0">{{ $maintenanceOders[0]->total_order }} </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-6">
                                        <x-inputs.label class="fw-bold" value="Anftragssumme" />
                                    </div>
                                    <div class="col-md-6 col-6">
                                        @if (isset($maintenanceOders))
                                            <p class="text-secondary mb-0">{{ $maintenanceOders[0]->total_order_amount }} </p>
                                        @endif
                                    </div>
                                </div>                                
                            </div>
                        </div>                       

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
        $('#technisch_von, #technisch_zu, #wartung_von, #wartung_zu').datepicker({
            dateFormat: "dd-mm-yy",
            minDate: "-100y",
            maxDate: "0",
            changeMonth: true,
            changeYear: true,
        });
    </script>

    @endpush
</x-app-layout>