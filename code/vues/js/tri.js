document.addEventListener('DOMContentLoaded', function () {
    var tri = getCookie("tri");

    if (tri != "") {
        var nbSelect = document.forms.formTri.triSelect.options.length
        for (var i = 0; i < nbSelect; i++) {
            if (document.forms.formTri.triSelect.options[i].value == tri) {
                document.forms.formTri.triSelect.options.selectedIndex = i;
            }
        }
    } else document.forms.formTri.triSelect.options.selectedIndex = 0;
})

function getCookie(cname) {
    var name = cname + "="; // variable à trouver
    var ca = document.cookie.split(';'); // on découpe la chaine de caractère pour récuperer les différents cookies
    for (var i = 0; i < ca.length; i++) { // on cherche le cookie voulu
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length); // si on trouve le cookie voulu, on le renvoi
        }
    }
    return "";
}

function triDynamique() {
    // if ($('#selectTri option:selected').length == 1){
    document.forms.formTri.submit();


}