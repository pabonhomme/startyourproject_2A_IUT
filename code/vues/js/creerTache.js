var i= 0;
var cpt = 1;
let maxInput = 10 ;
let x  = 1;
let donne ;
let button =  document.getElementById('submit');
let cptSpan = 1;
let compteurButton = 0;


//fonction qui crée les inputs.
function html(i){
    var div = document.createElement("div");
    div.style.marginTop = ".25cm";



    // create input
    var input = document.createElement("input");
    input.name = "mailMembre[]";
    input.style.border = "1px solid #ced4da";
    input.style.borderRadius = ".25rem";
    input.style.backgroundClip = "padding-box";
    input.style.fontSize = "1rem";
    input.style.padding = ".375rem .75rem";
    input.id = "nvMembreTache" + i ;
    input.addEventListener("focusout", membre);

//create button remove
    var a = document.createElement("a");
    a.href = '#';
    a.id = "supprimer";
    a.style.marginLeft = "10px";
    a.textContent = "Supprimer";
    a.addEventListener("click",remove);

    // create span
    var span = document.createElement("span");
    if(cptSpan === 1) {
        cptSpan++;
        span.id = "ok" + cptSpan;

    }
    else {
        cptSpan++;
        span.id = "ok" + cptSpan;
    }
    span.style.marginLeft = "10px";


//Add to div
    div.append(input);
    div.append(a);
    div.append(span);

    return div;
}
//ajout d'input dynamiquement.
function ajout() {

    i++;

    donne = html(i);
    donne.append(document.createElement("br"));
    if(x <= maxInput){
        document.querySelector('#container').appendChild(donne);
        x++;
    }
}
//supprimer les inputs dynamiquement.

function remove() {

    document.querySelector('#container').lastChild.remove();
    x--;
    i--;
    cpt--;
    cptSpan--;
    compteurButton =0;
    disableButton();

}

// fonction de tests d'erreur.
function membre(){

    let inputs ;
    let ok;
    var j;



    let mail = document.getElementById('mailMembre').value;
    let idprojet = document.getElementById('idprojet').value;
    let membretache = new Array();
    membretache.push(mail);
    for(j=1; j<=i; j++ ) {
        membretache.push(document.getElementById('nvMembreTache' + j).value);
    }

   var r = new XMLHttpRequest();

    // callback
    r.onreadystatechange = function () {
        if (r.readyState === 4 && r.status === 200) {
            inputs = r.responseText.split(".");
            if (inputs[0] == 1) { //si pas d'erreur.
                ok = document.getElementById('ok' + cptSpan);
                ok.innerText = 'Cet e-mail existe';
            } else {
                ok = document.getElementById('ok' + cptSpan);
                ok.innerText = 'Cet e-mail existe pas';

            }
            disableButton();
        }
    };
    r.open("POST", "?action=AjouterMembreTache" , true);
    r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    r.send("idProjet="+idprojet + "&mailMembre[]=" + membretache);


}
// s'il y a au moins un message d'erreur, on disable le bouton d'ajout.
function disableButton() {
    let button =  document.getElementById('submit');

    for(let i= 1; i<= cptSpan; i++) {
        if(document.getElementById('ok' + i).innerText == 'Cet e-mail existe pas') {
            compteurButton++;
        }
    }
    if(compteurButton == 0) {
        button.disabled = false;
    }
    if(compteurButton >0) {
        button.disabled = true;

    }
}


/**
 * Fonction creer_tache() qui fait une requête
 */
function  creer_tache() {
    var r = new XMLHttpRequest();
    // callback
    r.onreadystatechange = function () {
        if (r.readyState === 4 && r.status === 200) {
            if(r.responseText == 0) {
                window.location.href = "index.php?action=AfficherErreur" ;
            }
            else {
                window.location.href = "index.php?action=AfficherPageProjet&idprojet=" + idprojet;
            }
        }
    }

    let idprojet = document.getElementById('idprojet').value;
    let nomtache = document.getElementById('nomtache').value;
    let membretache = new Array();

    membretache.push(document.getElementById('mailMembre').value);
    var j;

    for(j=1; j<=i; j++ ) {
        membretache.push(document.getElementById('nvMembreTache' + j).value);
    }

    let description = document.getElementById('description').value;
    let cout = document.getElementById('cout').value;
    let datedebut = document.getElementById('datedebut').value;
    let duree = document.getElementById('duree').value;

    r.open("POST", "?action=CreerTache" , true);
    r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    r.send("idProjet="+idprojet +"&nomtache=" + nomtache + "&mailMembre[]=" + membretache + "&description=" + description + "&cout=" + cout +" &duree=" + duree + "&datedebut=" + datedebut);
}