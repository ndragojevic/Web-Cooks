@extends('template_defined')

@section('content')
<h2>{{ $vest->naslov }}</h2>
<h3>{{ $vest->autor }}</h3>
{{ $vest->sadrzaj }}
@endsection

