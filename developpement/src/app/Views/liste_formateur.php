<?php
include_once("entete.php");
?>
    <script type="text/javascript">
        var tab_json = <?php print json_encode($tab_visiteurs) ?>;
        console.log(tab_json);

        var controler='formateur';
        var base_url=<?php print json_encode(base_url()) ?>;
    </script>

    <?php include("navbar.php") ?>
    <div class="grid grid-cols-7">
        <div class="w-64">
            <?php include("sidebar.php") ?>
        </div>
        <div class="list col-span-6">

            <h1 class="titre-tableau"> Liste des Enseignants </h1>
            <!-- inclusion de la zone de recherche  -->
            <?php
            $controller = "formateur";
            include("searchZone.php")
            ?>
            <button class="open-popup btn-ajouter" popup_to_open="p_form_visiteur">Ajouter</button>
            <div>
                <span>nombre d'elements: <span id="nbr_elt" class="text-blue-700"></span></span>
            </div>
            <table>
                <tr>
                    <th nom_col='nom'>Nom & prenom</th>
                    <th nom_col='cni'>N CNI</th>
                    <th nom_col='tel'>Telephone</th>
                    <th >Actions</th>
                </tr>
                <?php
                foreach ($tab_formt as $formateur) {
                    ?>
                        <tr>
                            <td><?php echo $formateur['nom'] . " " . $formateur['prenom']; ?></td>
                            <td><?php echo $formateur['cni']; ?></td>
                            <td><?php echo $formateur['tel']; ?></td>
                            <td><a href='<?= base_url(); ?>/connexion/'>connexion</a></td>
                        </tr>
                <?php
                    }
                ?>
            </table>
        </div>
        <div class="popup-back" popup_id="p_form_visiteur">
            <form action="<?= base_url(); ?>/formateur/ajouter" method="POST" class="popup-form ">
                <div class="form-header">
                    <h2> SEED RECEPTION</h2>
                    <h3>Ajouter un visiteur</h3>
                </div>

                <label for="visiteur" class="inline w-min m-0">Visiteur</label>
                <select name="visiteur" id="visiteur" class="ring-1 rounded outlinee-none overflow-scroll focus:outline-0">

                </select>
                <label for="nom" class="requis">Nom</label>
                <div>
                    <input type="text" vst class="textfield" id="nom" name="nom" autofocus placeholder="..." required>
                </div>
                <label for="prenom">Prenom</label>
                <div>
                    <input type="text" vst id="prenom" name="prenom" class="textfield" placeholder="...">
                </div>
                <label for="cni" class="requis">Numero CNI</label>
                <div>
                    <input type="text" vst class="textfield" id="cni" name="cni" placeholder="..." required>
                </div>
                <label for="Tel" class="requis">Telphone</label>
                <div>
                    <input type="number" vst id="tel" name="tel" class="textfield" placeholder="..." required>
                </div>

                <div class="form-footer">
                    <div>
                        <button type="button" class="close-popup" popup_to_close="p_form_visiteur" value="Annuler">Annuler</button>
                        <button type="submit" value="Ajouter">Ajouter</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script src="<?= base_url();?>/assets/script/trie.js"></script>
    <script src="<?= base_url();?>/assets/script/visite.js"></script>
    <script src="<?= base_url();?>/assets/script/popup.js"></script>
</body>

</html>