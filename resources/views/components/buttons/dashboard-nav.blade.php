@props(['activePage'])

<a href="{{ route('dashboard.success') }}" class="d-inline-block me-1 my-1 dash-btn {{ $activePage == 'success' ? ' dash-btn-active' : '' }}">Erfolgsquote</a>
<a href="{{ route('dashboard.quote-time') }}" class="d-inline-block me-1 my-1 dash-btn {{ $activePage == 'quote-time' ? ' dash-btn-active' : '' }}">Angebotszeiten</a>
<a href="{{ route('dashboard.employee-evaluation') }}" class="d-inline-block me-1 my-1 dash-btn {{ $activePage == 'employee-evaluation' ? ' dash-btn-active' : '' }}">Mitarbeiterauswertung</a>
<a href="{{ route('dashboard.ktb-evaluation') }}" class="d-inline-block me-1 my-1 dash-btn {{ $activePage == 'ktb-evaluation' ? ' dash-btn-active' : '' }}">KTB Auswertung</a>
<a href="{{ route('dashboard.difference') }}" class="d-inline-block me-1 my-1 dash-btn {{ $activePage == 'difference' ? ' dash-btn-active' : '' }}">Differenz</a>
<a href="{{ route('dashboard.evaluation-received-via') }}" class="d-inline-block me-1 my-1 dash-btn {{ $activePage == 'evaluation-received-via' ? ' dash-btn-active' : '' }}">Auswertung Erhalten über</a>
<a href="{{ route('dashboard.evaluation-result-after-interview') }}" class="d-inline-block me-1 my-1 dash-btn {{ $activePage == 'evaluation-result-after-interview' ? ' dash-btn-active' : '' }}">Auswertung: Resultat nach dem Gespräch</a>