<x-app-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="search-technical-offer"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Search Technical Offer"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <!-- Filter -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4 p-4">
                        <x-forms.search-filter action="{{ route('technical.search') }}" :users="$users" />
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
                            @include('partials.display-technical-offers')
                            </div>
                            {{-- pagination --}}
                            @if(isset($technicalOffers) && !$technicalOffers->isEmpty())
                                <div class="d-flex justify-content-center mt-3">
                                    {!! $technicalOffers->appends(Request::except('page'))->links() !!}
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