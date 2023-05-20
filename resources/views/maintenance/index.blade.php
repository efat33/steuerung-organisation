<x-app-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="maintenance-offer"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Maintenance Offer"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class=" me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="{{ route('maintenance.create') }}"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Maintenance Offer</a>
                        </div>

                        <div class="card-body px-0 pb-2">
                            @if (session('status'))
                            <x-auth-session-status class="alert-success mx-3" :status="session('status')" />
                            @endif
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase px-2 text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                <span class="px-2">Registriert durch</span>
                                            </th>
                                            <th
                                                class="text-uppercase px-2 text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                <span class="px-2">Erhalten Von</span>
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Debitor/Kundennummer</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Erhalten am</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($maintenanceOffers as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 flex-column justify-content-center">
                                                    <h6 class="mb-0">{{ $item->user->name }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 flex-column justify-content-center">
                                                    <h6 class="mb-0">{{ $item->received_from }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-secondary mb-0">{{ $item->cs_order_number }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-secondary mb-0">{{ ($item->received_date) }} </p>
                                            </td>
                                            <td class="align-middle">

                                                <x-anchors.view href="{{ route('maintenance.view', $item->id) }}"
                                                    data-original-title="" title=""></x-anchors.view>

                                                <x-anchors.edit href="{{ route('maintenance.edit', $item->id) }}"
                                                    data-original-title="" title=""></x-anchors.edit>

                                                <x-buttons.deleteConfirm.wrapper
                                                    action="{{ route('maintenance.destroy', $item->id)  }}">
                                                    <x-buttons.deleteConfirm.button></x-buttons.deleteConfirm.button>
                                                </x-buttons.deleteConfirm.wrapper>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                            {{-- pagination --}}
                            <div class="d-flex justify-content-center mt-3">
                                {!! $maintenanceOffers->links() !!}
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>

</x-app-layout>