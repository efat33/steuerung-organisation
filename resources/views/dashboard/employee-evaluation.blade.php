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
                            <x-buttons.dashboard-nav activePage="employee-evaluation" />
                        </div>

                        @if (session('status'))
                        <div class="row">
                            <x-auth-session-status class="alert-success" :status="session('status')" />
                        </div>
                        @endif

                        <x-forms.dashboard-filter action="{{ route('dashboard.employee-evaluation') }}" />

                        <div class="row mt-5">
                            <div class="col-md-6 col-12 mt-5">
                                <h6 class="font-weight-bolder mb-4">Technischer Mitarbeiterauswertung</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-6">
                                        <x-inputs.label class="fw-bold" value="Benutzer" />
                                    </div>
                                    <div class="col-md-3 col-3">
                                        <x-inputs.label class="fw-bold" value="Angebot" />
                                    </div>
                                    <div class="col-md-3 col-3">
                                        <x-inputs.label class="fw-bold" value="Befehl" />
                                    </div>
                                </div> 
                                @if (isset($technicalOffersOrders) && !$technicalOffersOrders->isEmpty())
                                @foreach ($technicalOffersOrders as $item)
                                <div class="row mb-3">
                                    <div class="col-md-6 col-6">
                                        <p class="text-secondary mb-0">{{ $item->user->name }}</p>
                                    </div>
                                    <div class="col-md-3 col-3">
                                        <p class="text-secondary mb-0">{{ $item->total_offer }} </p>
                                    </div>
                                    <div class="col-md-3 col-3">
                                        <p class="text-secondary mb-0">{{ $item->total_order }} </p>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <div class="col-md-6 col-12 mt-5">
                                <h6 class="font-weight-bolder mb-4">Wartung Mitarbeiterauswertung</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-6">
                                        <x-inputs.label class="fw-bold" value="Benutzer" />
                                    </div>
                                    <div class="col-md-3 col-3">
                                        <x-inputs.label class="fw-bold" value="Angebot" />
                                    </div>
                                    <div class="col-md-3 col-3">
                                        <x-inputs.label class="fw-bold" value="Befehl" />
                                    </div>
                                </div> 
                                @if (isset($maintenanceOffersOrders) && !$maintenanceOffersOrders->isEmpty())
                                @foreach ($maintenanceOffersOrders as $item)
                                <div class="row mb-3">
                                    <div class="col-md-6 col-6">
                                        <p class="text-secondary mb-0">{{ $item->user->name }}</p>
                                    </div>
                                    <div class="col-md-3 col-3">
                                        <p class="text-secondary mb-0">{{ $item->total_offer }} </p>
                                    </div>
                                    <div class="col-md-3 col-3">
                                        <p class="text-secondary mb-0">{{ $item->total_order }} </p>
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