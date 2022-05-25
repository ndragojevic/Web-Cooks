@extends('template_defined')

@section('content')
<form action="{{ route('pretraga') }}" method="GET">
    Pretraga: <input type="text" name="pretraga">
    <br>
    <input type="submit" name="Trazi" value="Trazi">
</form>

<h3>
@if (empty($trazeno))
Sve vesti
@else
Rezultati pretrage {{$trazeno}}
@endif    
</h3>


<table>
    <tr>
        <th>Naslov</th>
        <th>Autor</th>
        <th>Detaljnije</th>
    </tr>
    @foreach ( $vesti as $vest )
    <tr>
        <td>
            {{ $vest->naslov }}
        </td>
        <td>
            {{ $vest->autor }}
        </td>
        <td>
            <a href="{{ route('vest', ['id' => $vest->id ]) }}">Link</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection

