document.addEventListener('DOMContentLoaded', function () {// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
    var firebaseConfig = {
        apiKey: "AIzaSyCfkOmN2-dUuSCRK6cR9FA_O9Gw1m19yP4",
        authDomain: "startyourproject-40dce.firebaseapp.com",
        projectId: "startyourproject-40dce",
        storageBucket: "startyourproject-40dce.appspot.com",
        messagingSenderId: "513154244819",
        appId: "1:513154244819:web:fff590747c626a12cb3426",
        measurementId: "G-S3K91EFSNL"
    };
// Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();

    let idProjet = document.getElementById("idProjet").value;
// on écoute pour des potentiels messages entrants
    firebase.database().ref("messagesProjet" + idProjet).on("child_added", function (snapshot) {
        let html = "";
        let email = document.getElementById("email").value;
        if (snapshot.val().email == email) {
            html = '<li style="width:100%" class="message-li" id="message-' + snapshot.key + '">' +
                '<div class="message-r macro couleurBlockMessage">' +
                '<div class="text text-r text-white">' +
                '<p>' + snapshot.val().prenom + " " + snapshot.val().nom + " : " + encodageHtml(snapshot.val().message) + '</p>' +
                '<button type="submit" class="btn btn-danger" id="btn-supp" data-id="' + snapshot.key + '" onclick="supprimerMessage(this);">\n' +
                '<img id="bin" src="vues/media/bin.png">\n' +
                '</button>' +
                '<p><small>' + snapshot.val().date + '</small></p>' +
                '</div>' +
                '</div>' +
                '</li>';
        } else {
            html = '<li style="width:100%;" id="message-' + snapshot.key + '">' +
                '<div class="message-l macro bg-secondary">' +
                '<div class="text text-l text-white">' +
                '<p>' + snapshot.val().prenom + " " + snapshot.val().nom + " : " + encodageHtml(snapshot.val().message) + '</p>' +
                '<p><small>' + snapshot.val().date + '</small></p>' +
                '</div>' +
                '</li>';
        }


        document.getElementById("messages").innerHTML += html;
        updateScrollBar();
    });

    /**
     * Encode en JS
     */
    function encodageHtml(text) {
        var textArea = document.createElement('textarea');
        textArea.innerText = text;
        return textArea.innerHTML;
    }


// on écoute dès qu'un message est supprimé on notifie la vue
    firebase.database().ref("messagesProjet" + idProjet).on("child_removed", function (snapshot) {
        document.getElementById("message-" + snapshot.key).innerHTML = '<div class="text-center">' + '<p>' + snapshot.val().prenom + ' a supprimé son message' + '</p>' + '</div>';
    });
});

/**
 * envoie d'un message dans firebase
 * @returns {boolean}
 */
function envoyerMessage() {
    // on récupère le message
    let message = document.getElementById("message").value;
    if (message.trim() != "") {
        let email = document.getElementById("email").value;

        let prenom = document.getElementById("prenom").value;
        let nom = document.getElementById("nom").value;
        let idProjet = document.getElementById("idProjet").value;
        let date = recupDateJour(new Date());
        // on l'envoie dans la base de donnée
        firebase.database().ref("messagesProjet" + idProjet).push().set({
            "message": message,
            "nom": nom.toUpperCase(),
            "prenom": strUcFirst(prenom),
            "email": email,
            "date": date
        });
        document.getElementById("message").value = "";
    }
    return false;
}

/**
 * supprime un message voulue par l'utilisateur
 * @param self
 */
function supprimerMessage(self) {
    let idProjet = document.getElementById("idProjet").value;
    let messageId = self.getAttribute("data-id");
    firebase.database().ref("messagesProjet" + idProjet).child(messageId).remove();
}

/**
 * Renvoie la chaine de caractère avec la première lettre en majuscule
 * @param string chaine à convertir
 * @returns {string}
 */
function strUcFirst(string) {
    return (string + '').charAt(0).toUpperCase() + string.substr(1);
}

/**
 * récupère la date du jour et l'heure
 * @param date
 * @returns {string}
 */
function recupDateJour(date) {
    let year = date.getFullYear();
    let month = date.getMonth() + 1;
    let day = date.getDate();
    let hours = date.getHours();
    let minutes = date.getMinutes();
    month = month < 10 ? '0' + month : month;
    day = day < 10 ? '0' + day : day;
    minutes = minutes < 10 ? '0' + minutes : minutes;
    return hours + ':' + minutes + '  ' + day + '/' + month + '/' + year;
}


/**
 * fonction qui permet de redesscendre la scroll bar en fonction de où l'utilisateur se trouve
 */
function updateScrollBar() {
    messages = document.getElementById('messages');

    let moitieDoc = messages.scrollHeight / 2 // récupère la taille de tous les messages même ceux non-affichés et la divise par 2
    if (messages.scrollTop >= moitieDoc) { // si la scroll bar se situe en dessous de la moitié de tous les messages
        messages.scrollTop = messages.lastChild.offsetTop; // on descend la scroll bar tout en bas
    }
}
