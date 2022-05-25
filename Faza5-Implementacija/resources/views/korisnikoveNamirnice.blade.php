@extends('template_defined')

@section('customImports')
    <link rel="stylesheet" href="{{ asset('css/namirnice.css') }}">

    <script src="{{ asset('js/namirnice.js') }}"></script>
@endsection

@section('content')
<h4 class="center">
    ImeKorinsika namirnice:
</h4>
<table class="table table-stripped table-hover">
    <thead class="thead-dark">
        <tr>
            <th>Ime sastojka</th>
            <th>Kolicina(g)</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($namirnice as $namirnica)    
        <tr id="namirnica{{ $namirnica['NamId'] }}">
            <td>{{ $namirnica['Naziv'] }}</td>
            <td>{{ $namirnica['Kolicina'] }}</td>
            <td>
                <button class="btn btn-danger obrisi" id="{{ $namirnica['NamId'] }}">Obrisi</button>
            </td>
        </tr>
        @endforeach
        <tr id="mesto">
            <!-- Mesto za dodavanje namirnica-->
        </tr>
        <tr>
            <td>
                <input type="text" class="" placeholder="Ime namirnice" name="imeNamirnice">
            </td>
            <td>
                <input type="text" class="" placeholder="Kolicina namirnice" name="kolicinaNamirnice">
            </td>
            <td>
                <button class="btn btn-info dodaj" >Dodaj</button>
            </td>
        </tr>
    </tbody>
</table>

@endsection