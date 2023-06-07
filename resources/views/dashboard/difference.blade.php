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
                            <x-buttons.dashboard-nav activePage="difference" />
                        </div>

                        @if (session('status'))
                        <div class="row">
                            <x-auth-session-status class="alert-success" :status="session('status')" />
                        </div>
                        @endif
                        
                        <x-forms.dashboard-filter action="{{ route('dashboard.difference') }}" />

                        <div class="row">
                            <div class="col-md-6 col-12 mt-5">
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
                            <div class="col-md-6 col-12 mt-5">
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