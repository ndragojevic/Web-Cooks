///


$(document).ready(() => {
});

$(document).on("click",".obrisi",  (event) => {
   let id = event.target.id;
   $("#namirnica"+id).attr('hidden','true');
   let http = new XMLHttpRequest();
   const obrisiNamirniceURL = `/namirnice/ukloni/${id}`
   http.open("DELETE",obrisiNamirniceURL);
   http.send();
});

$(document).on("click",".dodaj",  (event) => {
    let imeNamirnice = document.getElementsByName('imeNamirnice')[0].value;
    let kolicinaNamirnice = document.getElementsByName('kolicinaNamirnice')[0].value;
    if (!imeNamirnice || !kolicinaNamirnice) {
        alert("Unesite oba polja!");
        return;
    }
    document.getElementsByName('imeNamirnice')[0].value="";
    document.getElementsByName('kolicinaNamirnice')[0].value="";
    let http = new XMLHttpRequest();
    const dodajNamirnicuURL = `/namirnice/id=1/naziv=${imeNamirnice}/Kolicina=${kolicinaNamirnice}`;
    http.onreadystatechange  =  () => {
        let noviId;
        if (http.readyState == 4) {
            noviId = JSON.parse(http.responseText).id;
            $('#mesto').before(`<tr id='namirnica${noviId}'>
                    <td>${ imeNamirnice }</td>
                    <td>${ kolicinaNamirnice }</td>
                    <td>
                        <button class="btn btn-danger obrisi" id='${noviId}' }}">Obrisi</button>
                    </td>
                </tr>`);
        }
    };
    http.open("POST",dodajNamirnicuURL);
    http.send();
});