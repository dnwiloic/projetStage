<?php
include_once("entete.php");

?>

<body>

    <script type="text/javascript">
        var tab_emp = <?php print json_encode($tab_emprunt) ?>;
        var tab_abn = <?php print json_encode($tab_abn) ?>;
        var tab_livre = <?php print json_encode($tab_livre) ?>;
        console.log(tab_emp);
        console.log(tab_abn);
        console.log(tab_livre);

        var controler='emprunt';
        var base_url=<?php print json_encode(base_url()) ?>;
    </script>

    <?php include("navbar.php") ?>
    <div class="grid grid-cols-7 ">
        <div class="w-64">
            <?php include("sidebar.php") ?>
        </div>
        <div class="list col-span-6">

            <h1 class="titre-tableau"> Liste des emprunt</h1>
            <button class="open-popup btn-ajouter" popup_to_open="p_form_visiteur">Ajouter</button>
            <div>
                <span>nombre d'elements: <span id="nbr_elt" class="text-blue-700"></span></span>
            </div>
            <table>
                <tr>
                    <th nom_col='emprunteur'>Nom & prenom</th>
                    <th nom_col='livre'>titre du livre</th>
                    <th nom_col='date_emprunt'>Date emprunt</th>
                    <th nom_col='date_retour_prevu'>Date retour prevu</th>
                    <th nom_col='date_retour_effectif'>Date retour effectif</th>
                    <th nom_col='feelback'>Feelback</th>
                    <th>Actions</th>
                </tr>

                <?php
                foreach ($tab_emprunt as $emprunt) {
                    
                ?>
                    <tr>
                        <td><?php echo $emprunt['emprunteur']; ?></td>
                        <td><?php echo $emprunt['livre']; ?></td>
                        <td><?php echo $emprunt['date_emprunt']; ?></td>
                        <td><?php echo $emprunt['date_retour_prevu']; ?></td>
                        <td><?php echo $emprunt['date_retour_effectif']; ?></td>
                        <td><?php echo $emprunt['feelback']?></td>
                        <td><a href='<?= base_url(); ?>/connexion/'></a></td>
                    </tr>
                <?php
                }
                ?>

            </table>
        </div>
    </div>
    <div class="popup-back" popup_id="p_form_visiteur">
        <form action="<?= base_url(); ?>/emprunt/ajouter" method="POST" class="popup-form w-min">
            <div class="form-header">
                <h2> SEED RECEPTION</h2>
                <h3>Nouvel Emprunt</h3>
            </div>


            <div>
                <label for="abn" class="inline w-min m-0">Emprunteur</label>
                <select name="abn" id="abn" class="ring-1 rounded outlinee-none overflow-scroll focus:outline-0">

                </select>
            </div>
            <div>
                <label for="livre" class="inline w-min m-0">livre</label>
                <select name="livre" id="livre" class="ring-1 rounded outlinee-none overflow-scroll focus:outline-0">

                </select>
            </div>


            <label for="date_emp" class="requis">Date Emprunt</label>
            <input type="date" id="date_emp" name="date_emp" class="textfield" required>
            <div hidden>
                <label for="sate_retour" class="requis">Date inscription</label>
                <input type="date" id="date_retour" disabled name="date_retour" class="textfield" required>
            </div>
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
        let select_abn = document.getElementById("abn");
        let select_chaine = "<option></option>";
        tab_abn.forEach((elt, key) => {
            select_chaine += "<option value='" + elt.id_visiteur + "'>" + elt.prenom +" "+elt.nom+ "</option>";
        })
        select_abn.innerHTML = select_chaine;
        // remplissons le select des apprenants
        let select_livre = document.getElementById("livre");
        select_chaine = "<option></option>";
        tab_livre.forEach((elt, key) => {
            select_chaine += "<option value='" + elt.id + "'>" + elt.titre + " " + elt.nom_auteur + "</option>";
        })
        select_livre.innerHTML = select_chaine;
    </script>
</body>

</html>