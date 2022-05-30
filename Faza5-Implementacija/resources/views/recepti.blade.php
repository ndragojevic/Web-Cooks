@extends('template_defined')

@section('customImports')
    <link rel="stylesheet" href="{{ asset('css/recepti.css') }}">


    <script src="{{ asset('js/recepti.js') }}"></script>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="row-line">
                    <form name="filter" action=" {{ route('filtrirajRecepte')}}" method="post" class="form-inline">
                            @csrf
                            <input type="text" class="form-control mr-sm-2" type="search" placeholder="Pretrazi po imenu" aria-label="Search" id="naziv" name="naziv" />
                            <input type="text"  id="kategorije" name="kategorije" value="" style="display: none" />
                            <button type="submit" class="btn btn-primary" >
                            Pretrazi
                            </button>
                    </form>
</form>
                    <div>  

                        <button class="btn btn-warning" onclick="showFavorites()">
                            Prikazi omiljene
                        </button>
                        <p>
                            (samo reg korinsik)
                        </p>

                    </div>
                    <div>
                        <form name="filter" action=" {{ route('generisiReceptePoNamirnicamaKorinsika',['id' => '1'])}}" method="post">
                            <button type="submit" class="btn btn-secondary" >
                                Recepti za namirnice iz kuce
                            </button>
                            <p>
                                (samo reg korinsik)
                            </p>
                        </form>

                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Kategorije
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#" onclick="dodajTag(this.innerText)">Salate</a>
                        <a class="dropdown-item" href="#" onclick="dodajTag(this.innerText)">Torte i kolaci</a>
                        <a class="dropdown-item" href="#" onclick="dodajTag(this.innerText)">Supe i corbe</a>
                        <a class="dropdown-item" href="#" onclick="dodajTag(this.innerText)">Morski plodovi</a>
                        <a class="dropdown-item" href="#" onclick="dodajTag(this.innerText)">Glavno jelo</a>
                    </div>
                </div>
                <div id="tags">
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($recepti as $recept)    
                <div class="col-sm-12 col-md-4">
                    <div class="card text-center">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">Opis</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Komentari</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Postupak pravljenja jela</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title space">
                                <div class="align-col">
                                    {{ $recept['Naziv']}}
                                    <div style="display:none">
                                        @if ($recept['TezinaIzrade'] == 'tesko')
                                            {{$boja = 'red'}}
                                        @else
                                            @if ($recept['TezinaIzrade'] == 'lako')
                                            {{$boja = 'green'}}
                                            @else
                                                {{$boja = 'yellow'}}
                                            @endif
                                        @endif
                                    </div>
                                    <font color="{{ $boja }}" size="4px">
                                        ({{ $recept['TezinaIzrade']}})
                                    </font>
                                </div>
                                <div class="rating" id="ocena{{$recept['ReceptId']}}">
                                    @if ($recept['BrojOcena'] != 0)
                                        {{ round($recept['ZbirOcena'] / $recept['BrojOcena'],2)}} /5
                                    @else
                                        Nema ocena
                                    @endif
                                    <i class='fa fa-star' style='color: #f3da35'></i>
                                </div>
                            </h5>
                            <img class="card-img-top" src="../slike/spagete.jpg" alt="Card image cap">
                            <div class="card-text space">
                                <div class="korisnik">
                                    Korisnicko ime
                                </div>
                                <div class="date">
                                    {{ $recept['Datum'] }}
                                </div>
                            </div>
                            <a class="btn btn-primary" data-toggle="collapse" href="#collapseId" role="button"
                                aria-expanded="false" aria-controls="collapseId">Prikazi sastojke</a>
                            <div class="collapse" id="collapseId">
                                <table class="table table-stripped table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Ime sastojka</th>
                                            <th>Kolicina</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Meso</td>
                                            <td>200g</td>
                                        </tr>
                                        <tr>
                                            <td>Paradajz</td>
                                            <td>50g</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="grade">
                            Oceni:
                            @for ($i = 1; $i <= 5; $i++)
                            <i onclick="oceni({{ $i }}, {{ $recept['ReceptId'] }})" class='fa fa-star zvezde' id="z{{ $recept['ReceptId'] }}{{ $i}}" recept="{{ $recept['ReceptId'] }}" zvezda={{ $i }}></i>
                            @endfor
                        </div>
                        <a href="">Dodaj u omiljene</a>
                        <button class="btn btn-danger">Obrisi recept(admin samo)</button>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="card text-center">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Opis</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">Komentari</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Postupak pravljenja jela</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body">
                                    <blockquote class="blockquote mb-0">
                                        <p>Najbolji recept</p>
                                        <footer class="blockquote-footer">Korisnik 1</footer>
                                        <button class="btn btn-danger">Obrisi(admin samo) </button>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <blockquote class="blockquote mb-0">
                                        <p>Najgori recept...</p>
                                        <footer class="blockquote-footer">Korisnik 2</footer>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Napisi komentar"
                                    aria-label="Enter comment" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="button">Dodaj komentar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="card text-center">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Opis</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Komentari</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">Postupak pravljenja jela</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                {{ $recept['Postupak'] }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
    </div>

    <nav aria-label="Page navigation example" class="center">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Prvi</a></li>
            <li class="page-item"><a class="page-link" href="#">Prethodni</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Sledeci</a></li>
            <li class="page-item"><a class="page-link" href="#">Poslednji</a></li>
        </ul>
    </nav>
@endsection