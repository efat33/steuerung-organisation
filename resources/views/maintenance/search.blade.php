<x-app-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="search-maintenance-offer"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Search Maintenance Offer"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <!-- Filter -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4 p-4">
                        <form method='GET' action="<?= route('maintenance.search') ?>">
                            @csrf
                            <div class="grid-parent mb-4">
                                <div class="grid-item">
                                    <x-inputs.label for="keyword" value="Stichwort" />
                                    <x-inputs.text id="keyword" name="keyword" value="{{ old('keyword') }}" />
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="registered_by" value="Sachbearbeiter" />
                                    <x-select-box.select-box name="registered_by" title="Select Option">
                                        <option value="" selected>Select Option</option>
                                        @foreach ($users as $item)
                                        <option value="{{ $item->id }}" {{ old('registered_by')==$item->id ? "selected" : "" }}>{{ $item->name }}</option>
                                        @endforeach
                                    </x-select-box.select-box>
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="get_over" value="Erhalten über" />
                                    <x-select-box.select-box name="get_over" title="Select Option">
                                        <option value="" selected>Select Option</option>
                                        @foreach (App\Enums\GetOver::cases() as $item)
                                        <option value="{{ $item }}" {{ old('get_over')==$item ? "selected" : "" }}>{{
                                            App\Enums\GetOver::getLabel($item ) }}</option>
                                        @endforeach
                                    </x-select-box.select-box>
                                </div>
                                
                                <div class="grid-item">
                                    <x-inputs.label for="status" value="Status" />
                                    <x-select-box.select-box name="status" title="Select Option">
                                        <option value="" selected>Select Option</option>
                                        @foreach (App\Enums\Status::cases() as $item)
                                        <option value="{{ $item }}" {{ old('status')==$item ? "selected" : "" }}>{{
                                            App\Enums\Status::getLabel($item ) }}</option>
                                        @endforeach
                                    </x-select-box.select-box>
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="conversation_status" value="Gesprächsresultat" />
                                    <x-select-box.select-box name="conversation_status" title="Select Option">
                                        <option value="" selected>Select Option</option>
                                        @foreach (App\Enums\ConversationStatus::cases() as $item)
                                        <option value="{{ $item }}" {{ old('conversation_status')==$item ? "selected"
                                            : "" }}>{{ App\Enums\ConversationStatus::getLabel($item ) }}</option>
                                        @endforeach
                                    </x-select-box.select-box>
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="offer_type" value="Angebotsart" />
                                    <x-select-box.select-box name="offer_type" title="Select Option">
                                        <option value="" selected>Select Option</option>
                                        @foreach (App\Enums\OfferType::cases() as $item)
                                        <option value="{{ $item }}" {{ old('offer_type')==$item ? "selected" : "" }}>{{
                                            App\Enums\OfferType::getLabel($item ) }}</option>
                                        @endforeach
                                    </x-select-box.select-box>
                                </div>

                                <div class="grid-item">
                                    <x-inputs.label for="package" value="Paket" />
                                    <x-select-box.select-box name="package" title="Select Option">
                                        <option value="" selected>Select Option</option>
                                        @foreach (App\Enums\Package::cases() as $item)
                                        <option value="{{ $item }}" {{ old('package')==$item ? "selected" : "" }}>{{
                                            App\Enums\Package::getLabel($item ) }}</option>
                                        @endforeach
                                    </x-select-box.select-box>
                                    <x-inputs.error :messages="$errors->get('package')" />
                                </div>
                            </div>

                            <x-buttons.dark>Filter</x-buttons.dark>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Filter -->

        <div class="container-fluid py-4 search-results">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-body px-0 pb-2">
                            @if (isset($status))
                            <x-auth-session-status class="alert-warning mx-3" :status=$status />
                            @endif
                            <div class="table-responsive p-0">
                            @include('partials.display-maintenance-offers')
                            </div>
                            {{-- pagination --}}
                            @if(isset($maintenanceOffers) && !$maintenanceOffers->isEmpty())
                                <div class="d-flex justify-content-center mt-3">
                                    {!! $maintenanceOffers->appends(Request::except('page'))->links() !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>        
    </main>
    @push('js')
    <script>
        $(document).ready(function(){
            const isFormSubmit = '{{$is_form_submit}}';
            if(isFormSubmit){
                $('html, main').animate({scrollTop:$('.search-results').offset().top}, 'slow');;
            }
        });
    </script>
    @endpush
</x-app-layout>