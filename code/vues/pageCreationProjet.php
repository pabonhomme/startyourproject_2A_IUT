<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <title>Start Your Project</title>

    <!-- CSS Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link href="vues/css/style.css" rel="stylesheet">

    <script src="vues/js/afficherMasquer.js" type="text/javascript"></script>
    <script src="vues/js/creerTache.js" type="text/javascript"></script>
</head>

<body>
<header>
    <a href="index.php"><img src="vues/media/ImageLogo.png"></a>
    <nav>
        <ul class="nav_lien">
            <li><a href="index.php?action=AfficherPageMesProjets">MesProjets</a></li>
            <li><a href="#">Aide</a></li>
            <li><a href="#">Crédit</a></li>
        </ul>
    </nav>
    <?php
    if ($isUtilisateur) {
        ?>
        <a class="btn btn-primary rounded-pill boutonnav" href="index.php?action=Deconnecter">Se deconnecter</a>
        <?php
    } else { ?>
        <a class="btn btn-primary rounded-pill boutonnav" href="index.php?action=AfficherConnexion">Se connecter</a>
        <?php
    }
    ?>
</header>

<div class="container">
    <form method="post" action="index.php?action=AjouterProjet">
        <div class="container mt-5">
            <h4>Création de Projet</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Entrez le nom du projet</label>
                    <input name="nomProjet" type="text" class="form-control" placeholder="Nom du projet" required/>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Entrez la description du projet</label>
                    <input name="descriptionProjet" class="form-control" placeholder="Description du projet" required/>
                </div>
            </div>

            <div class="mb-3">
                <label>Adresse-mail des personnes à ajouter <span class="text-muted">(Optionnel)</span></label>
                <div id="container">
                    <div class="form-inline">
                        <input name="mailMembre[]" id="mailMembre" class="form-control" onfocusout="membre(this)" required placeholder="Membre de la tâche">
                        <a href="#" id="ajouter" class="ml-2" onclick="ajout()">Ajouter</a>
                    </div>
                </div>

            </div>
            <div class="mb-3">
                <div class="switch">
                    <div class="custom-control custom-switch d-inline-flex">
                        <input type="checkbox" id="budgetSwitch" class="custom-control-input"
                               onclick="afficherMasquerElement('1')" checked/>
                        <label class="custom-control-label" for="budgetSwitch">Budget sur le projet </label>
                        <input id="1" name="budgetProjet" type="number" class="ml-2"/>
                    </div>
                </div>
            </div>
            <div class="mb-3 mt-5">
                <div class="switch">
                    <div class="custom-control custom-switch d-inline-flex">
                        <input type="checkbox" class="custom-control-input" id="dateSwitch"
                               onclick="afficherMasquerElement('2')" checked/>
                        <label class="custom-control-label" for="dateSwitch">Date de début <span class="text-muted">(Sinon date d'aujourd'hui)</span>
                        </label>
                        <input type="date" id="2" name="dateDebut" class="ml-2">

                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-primary">Ajouter le projet</button>
        </div>

        <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">

            function sendEmail() {
                var name = "test";
                var email = $("#mailMembre");
                var subject = "Invitation"
                var body = "test d'envoie mail";

                if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(subject) && isNotEmpty(body)) {
                    $.ajax({
                        url: 'sendEmail.php',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            name: name.val(),
                            email: email.val(),
                            subject: subject.val(),
                            body: body.val()
                        }, success: function (response) {
                            $('#myForm')[0].reset();
                            $('.sent-notification').text("Message Sent Successfully.");
                        }
                    });
                }
            }

            function isNotEmpty(caller) {
                if (caller.val() == "") {
                    caller.css('border', '1px solid red');
                    return false;
                } else
                    caller.css('border', '');

                return true;
            }
        </script>


    </form>
</body>
</html>
