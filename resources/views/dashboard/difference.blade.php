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
                            <a href="{{ route('dashboard.success') }}" class="d-inline-block me-1 my-1 dash-btn">Erfolgsquote</a>
                            <a href="{{ route('dashboard.quote-time') }}" class="d-inline-block me-1 my-1 dash-btn">Angebotszeiten</a>
                            <a href="{{ route('dashboard.employee-evaluation') }}" class="d-inline-block me-1 my-1 dash-btn">Mitarbeiterauswertung</a>
                            <a href="{{ route('dashboard.ktb-evaluation') }}" class="d-inline-block me-1 my-1 dash-btn">KTB Auswertung</a>
                            <a href="{{ route('dashboard.difference') }}" class="d-inline-block me-1 my-1 dash-btn dash-btn-active">Differenz</a>
                            <a href="{{ route('dashboard.evaluation-received-via') }}" class="d-inline-block me-1 my-1 dash-btn">Auswertung Erhalten über</a>
                            <a href="{{ route('dashboard.evaluation-result-after-interview') }}" class="d-inline-block me-1 my-1 dash-btn">Auswertung: Resultat nach dem Gespräch</a>
                        </div>

                        @if (session('status'))
                        <div class="row">
                            <x-auth-session-status class="alert-success" :status="session('status')" />
                        </div>
                        @endif

                        <form method='POST' action="<?= route('dashboard.difference') ?>">
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
                                <h6 class="font-weight-bolder mb-4">Technischer Angebotspreisunterschied</h6>
                                @if (isset($technicalOffers) && !$technicalOffers->isEmpty())
                                <table class="table table-hover mt-2">
                                    <thead>
                                        <tr>
                                            <th scope="col">Angebotsnummer</th>
                                            <th scope="col">Unterschied</th>
                                            <th scope="col">Prozentsatz</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                   
                                    @foreach ($technicalOffers as $item)  
                                        <tr>
                                            <td class="text-center"><a class="text-decoration-underline" href="{{ route('technical.view', $item->id) }}">{{ $item->quote_number ?? "Abwesend" }}</a></td>
                                            <td class="text-center">{{ $item->difference }} €</td>
                                            <td class="text-center">{{ $item->percent }} %</td>
                                        </tr>
                                    @endforeach                   
                                    </tbody>
                                </table>
                                @endif
                            </div>
                            <div class="col-6">
                                <h6 class="font-weight-bolder mb-4">Preisunterschied im Wartungsangebot</h6>
                                @if (isset($maintenanceOffers) && !$maintenanceOffers->isEmpty())
                                <table class="table table-hover mt-2">
                                    <thead>
                                        <tr>
                                            <th scope="col">Angebotsnummer</th>
                                            <th scope="col">Unterschied</th>
                                            <th scope="col">Prozentsatz</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                  
                                    @foreach ($maintenanceOffers as $item)  
                                        <tr>
                                            <td class="text-center"><a class="text-decoration-underline" href="{{ route('maintenance.view', $item->id) }}">{{ $item->quote_number ?? "Abwesend" }}</a></td>
                                            <td class="text-center">{{ $item->difference }} €</td>
                                            <td class="text-center">{{ $item->percent }} %</td>
                                        </tr>
                                    @endforeach                                                           
                                    </tbody>
                                </table>   
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