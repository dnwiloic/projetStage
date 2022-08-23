<?php
include_once("entete.php");
?>

<body>
    <script type="text/javascript">
        var tab_json = <?php print json_encode($tab_formateur) ?>;
        console.log(tab_json);

        var controler='formation';
        var base_url=<?php print json_encode(base_url()) ?>;
    </script>

    <?php include("navbar.php") ?>
    <div class="grid grid-cols-7">
        <div class="w-64">
            <?php include("sidebar.php") ?>
        </div>
        <div class="list col-span-6">

            <h1 class="titre-tableau"> Formations </h1>
            <!-- inclusion de la zone de recherche  -->
            <?php
            $controller = "formation";
            include("searchZone.php")
            ?>
            <button class="open-popup btn-ajouter" popup_to_open="p_form_formation">Ajouter</button>
            <div>
                <span>nombre d'elements: <span id="nbr_elt" class="text-blue-700"></span></span>
            </div>

            <table>
                <tr>
                    <th nom_col='nom'>Formation</th>
                    <th nom_col='prix'>Prix</th>
                    <th nom_col='duree'>Durée</th>
                    <th nom_col='formateur'>Formateur</th>
                    <th nom_col='commentaire'>Commentaire</th>
                    <th>Actions</th>
                </tr>
                <?php
                    foreach($tab_formation as $formation)
                    {
                        
                        ?>
                                <tr>
                                    <td><?php echo $formation['nom']; ?></td>
                                    <td><?php echo $formation['prix']; ?></td>
                                    <td><?php echo $formation['duree']." "; ?>semaines </td>
                                    <td><?php echo $formation['nom_formateur'] . " " . $formation['prenom']; ?></td>
                                    <td><?php echo $formation['commentaire']; ?></td>
                                    <td><a href='<?= base_url(); ?>/connexion/'></a></td>
                                </tr>
                        <?php
                    }
                ?>
            </table>
        </div>
        <div class="popup-back" popup_id="p_form_formation">
            <form action="<?= base_url(); ?>/formation/ajouter" method="POST" class="popup-form">
                <div class="form-header">
                    <h2> SEED RECEPTION</h2>
                    <h3>Ajouter une formation</h3>
                </div>
                <label for="nom" class="requis">Nom</label>
                <div>
                    <input type="text" class="textfield" id="nomF" name="nomF" placeholder="..." required>
                </div>
                <label for="nomF" class="requis">Enseignant</label>
                <div>
                    <select class="textfield" id="formateur" name="formateur" required>

                    </select>
                </div>
                <label for="prix" class="requis">Prix</label>
                <div>
                    <input type="number" id="prix" name="prix" class="textfield" required step="1000" placeholder="...">
                </div>
                <label for="duree">Duree (en semaines)</label>
                <div>
                    <input type="number" class="textfield" class="requis" name="duree" id="duree" placeholder="..." required>
                </div>
                <label for="cmt">Commentaire</label>
                <div>
                    <textarea name="cmt" id="cmt" cols="30" rows="5" class="textfield">

                    </textarea>
                </div>


                <div class="form-footer">
                    <div>
                        <button type="reset" class="close-popup" popup_to_close="p_form_formation" value="Annuler">Annuler</button>
                        <button type="submit" value="Ajouter">Ajouter</button>
                    </div>
                </div>
            </form>
        </div>

        <script src="<?= base_url();?>/assets/script/trie.js"></script>
        <script src="<?= base_url();?>/assets/script/popup.js"></script>
        <script>
            document.getElementById("nbr_elt").innerHTML=(document.querySelectorAll(".list tr")).length-1;
            let select_formateur = document.getElementById("formateur");
            let select_chaine = "";
            tab_json.forEach((elt, key) => {
                select_chaine += "<option value='" + elt.id + "'>" + elt.prenom + " " + elt.nom + "</option>";
            })
            select_formateur.innerHTML = select_chaine;
        </script>
</body>

</html>