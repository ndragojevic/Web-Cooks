///

let kategorije = []

const updateKategorije = () => {
    document.getElementById('kategorije').value = kategorije.join(',');
}

const ukloniTag = (tagIme) => {
    kategorije = kategorije.filter(el => el != tagIme);
    updateKategorije();
}

const dodajTag = (tagIme) => {
    if (kategorije.includes(tagIme)) return;
    kategorije.push(tagIme);
    $("#tags").append(`<div class="tag  alert alert-danger alter-dismissible fade show" role="alert"> ${tagIme} <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" onclick="ukloniTag('${tagIme}')">&times; </span> </button> </div>`);
    updateKategorije();
}

const pretraga = () => {
    let ime = document.getElementById('ime').value;
    let stringKategorije = kategorije.join(',');
    console.log(ime, stringKategorije);
}

const filterRecepiesByGroceries = () => {
    alert("Filtriraj recepte po namirnicama iz kuce")
}

const showFavorites = () => {
    alert("Prikazi omiljene recepte!");
} 

const oceni = (ocena, recept) => {
    let http = new XMLHttpRequest();
    const oceniNamirnicuURL = `/recepti/id=${recept}/ocena=${ocena}`;
    http.onreadystatechange  =  () => {
        let receptId;
        let zbirOcena;
        let brojOcena;
        if (http.readyState == 4) {
            let jsonResponse = JSON.parse(http.responseText);
            let receptId = jsonResponse.id;
            let zbirOcena = parseInt(jsonResponse.ZbirOcena);
            let brojOcena = parseInt(jsonResponse.BrojOcena);
            let prosek = parseFloat(zbirOcena / brojOcena).toFixed(2);
            if (prosek % 1 == 0) prosek = parseInt(prosek);
            $('#ocena'+receptId).html(`${prosek} /5 <i class='fa fa-star' style='color: #f3da35'></i>`);
        }
    };
    http.open("PATCH",oceniNamirnicuURL);
    http.send();
}

$(document).ready(() => {
    $('.zvezde').mouseenter((event) => 
    {
        let zvezdaId = event.target.id;
        $(`#${zvezdaId}`).addClass('checked');
        let  pozicija = $(`#${zvezdaId}`).attr('zvezda');
        let recept = $(`#${zvezdaId}`).attr('recept');
        for(let i = pozicija; i>= 0 ; --i) {
            let preostalaZvezdaId = `z${recept}${i}`;
            $(`#${preostalaZvezdaId}`).addClass('checked');
        }
    })

    $('.zvezde').mouseleave((event) => 
    {
        let zvezdaId = event.target.id;
        $(`#${zvezdaId}`).removeClass('checked');
        let  pozicija = $(`#${zvezdaId}`).attr('zvezda');
        let recept = $(`#${zvezdaId}`).attr('recept');
        for(let i = pozicija; i>= 0 ; --i) {
            let preostalaZvezdaId = `z${recept}${i}`;
            $(`#${preostalaZvezdaId}`).removeClass('checked');
        }
    })
})


