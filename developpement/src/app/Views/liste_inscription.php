<?php
include_once("entete.php");
?>

<body>
    <script type="text/javascript">
        var tab_json = <?php print json_encode($tab_inscription) ?>;
        var tab_formation = <?php print json_encode($tab_formation) ?>;
        var tab_appr = <?php print json_encode($tab_appr) ?>;
        console.log(tab_json);
        console.log(tab_formation);
        console.log(tab_appr);

        var controler='inscription';
        var base_url=<?php print json_encode(base_url()) ?>;
    </script>

    <?php include("navbar.php") ?>
    <div class="grid grid-cols-7">
        <div class="w-64">
            <?php include("sidebar.php") ?>
        </div>
        <div class="list col-span-6">

            <h1 class="titre-tableau"> Inscriptions </h1>
            <button class="open-popup btn-ajouter" popup_to_open="p_form_visiteur">Ajouter</button>
            <div>
                <span>nombre d'elements: <span id="nbr_elt" class="text-blue-700"></span></span>
            </div>
            <table>
                <tr>
                    <th nom_col='prenom'>Nom & prenom</th>
                    <th nom_col='nomF'>Formation</th>
                    <th nom_col='montant_paye'>Mantant payé</th>
                    <th nom_col='nom'>Mantant restant</th>
                    <th nom_col='date_inscription'>date d'inscription</th>
                    <th nom_col='date_debut'>date de debut</th>
                    <th nom_col='date_fin'>date de fin</th>
                    <th nom_col='commentaire'>Commentaire</th>
                    <th>Actions</th>
                </tr>
                <?php

                foreach ($tab_inscription as $inscription) {
                ?>
                    <tr>
                        <td><?php echo $inscription['prenom']." ".$inscription['nomV']; ?></td>
                        <td><?php echo $inscription['nomF']; ?></td>
                        <td><?php echo $inscription['montant_paye']; ?></td>
                        <td><?php echo $inscription['montant_restant'] ?></td>
                        <td><?php echo $inscription['date_inscription']; ?></td>
                        <td><?php echo $inscription['date_debut']; ?></td>
                        <td><?php echo $inscription['date_fin']; ?></td>
                        <td><?php echo $inscription['commentaire']; ?></td>
                        <td><a href='<?= base_url(); ?>/connexion/'></a></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
    <div class="popup-back" popup_id="p_form_visiteur">
        <form action="<?= base_url(); ?>/inscription/ajouter" method="POST" class="popup-form ">
            <div class="form-header">
                <h2> SEED RECEPTION</h2>
                <h3>Nouvel inscription</h3>
            </div>

            <div class="grid grid-cols-2 mb-4 gap-4 ">
                <div>
                    <label for="apprnant" class="requis inline  m-0">Apprenant</label>
                    <select name="apprenant" required  id="apprenant" class="ring-1 w-full rounded outlinee-none overflow-scroll focus:outline-0">

                    </select>
                </div>
                <div>
                    <label for="formation" class="requis inline  m-0">Formation</label>
                    <select name="formation" required id="formation" class="ring-1 rounded outlinee-none overflow-scroll w-full focus:outline-0">

                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4   mb-4">
                <div>
                    <label for="mv" class="requis">Montant versé</label> <!-- mv: montant verse-->
                    <input type="number" class="textfield" name="mv" step='1000' id="mv" placeholder="..." required>
                </div>
                <div>
                    <label for="ct">cout total ( frais d'inscription compris) </label> <!-- mv: montant verse-->
                    <input type="number" name="ct" class="textfield" id='ct' step='1000' disabled placeholder="...">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label for="date_ins" class="requis">Date d'inscription</label>
                    <input type="date" class="textfield" id="date_ins" name="date_ins" placeholder="..." required>
                </div>
                <div>
                    <label for="date_debut" class="requis">Date de debut</label>
                    <input type="date" class="textfield" id="date_debut" name="date_debut" placeholder="..." required>
                </div>
                <!-- <div>
                    <label for="date_fin" class="requis">Date de fin</label>
                    <input type="date" class="textfield" id="date_fin" name="date_fin" disabled placeholder="..." required>
                </div> -->
            </div>

            <label for="cmt">Commentaire</label>
            <textarea name="cmt" id="cmt" cols="30" class="textfield" rows="4"></textarea>

            <div class="form-footer">
                <div>
                    <button type="reset" class="close-popup" popup_to_close="p_form_visiteur" value="Annuler">Annuler</button>
                    <button type="submit">Ajouter</button>
                </div>
            </div>

        </form>
    </div>

    <script src="<?= base_url();?>/assets/script/trie.js"></script>
    <script src="<?= base_url();?>/assets/script/popup.js"></script>
    <script type="text/javascript">
        document.getElementById("nbr_elt").innerHTML = (document.querySelectorAll(".list tr")).length - 1;
        // remplissons le select des formations
        let select_formation = document.getElementById("formation");
        let select_chaine = "<option></option>";
        tab_formation.forEach((elt, key) => {
            select_chaine += "<option value='" + elt.id + "'>" + elt.nom + "</option>";
        })
        select_formation.innerHTML = select_chaine;
        // remplissons le select des apprenants
        let select_appr = document.getElementById("apprenant");
        select_chaine = "<option></option>";
        tab_appr.forEach((elt, key) => {
            select_chaine += "<option value='" + elt.id + "'>" + elt.prenom + " " + elt.nom + "</option>";
        })
        select_appr.innerHTML = select_chaine;

        //evenement qui ratache le cout total a la formation choisi
        let forms = new Array();
        tab_formation.forEach(elt => {
            forms[elt.id] = elt;
            forms[elt.id].prix = parseInt(elt.prix) + 5000;
        })
        select_formation.addEventListener('change', function(event) {
            document.getElementById('ct').value = parseInt(forms[event.target.value].prix);
        })
        //evenement qui li la date de debut a la date de fin
        document.getElementById("date_debut").addEventListener('change', function(event) {
            date = new Date(event.target.value);
            // la duree des formation es en semaine ainsi en la converti en milliseconde
            duree = parseInt(forms[document.getElementById('formation').value].duree) * 7 * 24 * 3600 * 1000; //en milisemaines
            date.setTime(date.getTime() + duree);
            document.getElementById("date_fin").value = date.getTimestamp.format("yyyy-MM-dd");
        })
    </script>

</body>

</html>