@extends('template_defined')

@section('content')
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

