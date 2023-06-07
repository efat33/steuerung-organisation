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
                            <a href="{{ route('dashboard.success') }}"
                                class="d-inline-block me-1 my-1 dash-btn">Erfolgsquote</a>
                            <a href="{{ route('dashboard.quote-time') }}"
                                class="d-inline-block me-1 my-1 dash-btn dash-btn-active">Angebotszeiten</a>
                            <a href="{{ route('dashboard.employee-evaluation') }}"
                                class="d-inline-block me-1 my-1 dash-btn">Mitarbeiterauswertung</a>
                            <a href="{{ route('dashboard.ktb-evaluation') }}"
                                class="d-inline-block me-1 my-1 dash-btn">KTB Auswertung</a>
                            <a href="{{ route('dashboard.difference') }}"
                                class="d-inline-block me-1 my-1 dash-btn">Differenz</a>
                            <a href="{{ route('dashboard.evaluation-received-via') }}"
                                class="d-inline-block me-1 my-1 dash-btn">Auswertung Erhalten über</a>
                            <a href="{{ route('dashboard.evaluation-result-after-interview') }}"
                                class="d-inline-block me-1 my-1 dash-btn">Auswertung: Resultat nach dem Gespräch</a>
                        </div>

                        @if (session('status'))
                        <div class="row">
                            <x-auth-session-status class="alert-success" :status="session('status')" />
                        </div>
                        @endif

                        <form method='POST' action="<?= route('dashboard.quote-time') ?>">
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

                        <div class="row mt-5">
                            <div class="col-6">
                                <h6 class="font-weight-bolder mb-4">Technischer Angebotszeiten</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-sm-12">
                                        <x-inputs.label class="fw-bold" value="Angebotsnummer" />
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <x-inputs.label class="fw-bold" value="Angebotszeiten" />
                                    </div>
                                </div>
                                @if (isset($technicalOffers) && !$technicalOffers->isEmpty())
                                @foreach ($technicalOffers as $item)
                                <div class="row mb-3">
                                    <div class="col-md-6 col-sm-12">
                                        <p class="text-secondary mb-0"><a class="text-decoration-underline"
                                                href="{{ route('technical.view', $item->id) }}">{{ $item->quote_number
                                                ?? "Abwesend" }}</a></p>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <p class="text-secondary mb-0">{{ $item->days }} @choice("Tag|Tage",
                                            $item->days)</p>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <div class="col-6">
                                <h6 class="font-weight-bolder mb-4">Wartung Angebotszeiten</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-sm-12">
                                        <x-inputs.label class="fw-bold" value="Angebotsnummer" />
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <x-inputs.label class="fw-bold" value="Angebotszeiten" />
                                    </div>
                                </div>
                                @if (isset($maintenanceOffers) && !$maintenanceOffers->isEmpty())
                                @foreach ($maintenanceOffers as $item)
                                <div class="row mb-3">
                                    <div class="col-md-6 col-sm-12">
                                        <p class="text-secondary mb-0"><a class="text-decoration-underline"
                                                href="{{ route('maintenance.view', $item->id) }}">{{ $item->quote_number
                                                ?? "Abwesend" }}</a></p>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <p class="text-secondary mb-0">{{ $item->days }} @choice("Tag|Tage",
                                            $item->days)</p>
                                    </div>
                                </div>
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