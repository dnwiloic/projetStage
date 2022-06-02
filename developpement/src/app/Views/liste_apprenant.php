<?php
    include_once("entete.php");
?>

<body>
<script type="text/javascript">
        var tab_json = <?php print json_encode($tab_visiteurs) ?>;
        var tab_appr = <?php print json_encode($tab_appr) ?>;
        console.log(tab_json);
    </script>

    <?php include("navbar.php") ?>
    <div class="grid grid-cols-7">
        <div class="w-64">
            <?php include("sidebar.php") ?>
        </div>
        <div class="list col-span-6">

            <h1 class="titre-tableau"> Liste des Apprenants </h1>
            <button class="open-popup btn-ajouter" popup_to_open="p_form_visiteur">Ajouter</button>
            <div>
                <span>nombre d'elements: <span id="nbr_elt" class="text-blue-700"></span></span>
            </div>
            <table>
                <tr>
                    <th>Nom & prenom</th>
                    <th>Matricule</th>
                    <th>N CNI</th>
                    <th>Telephone</th>
                    <th>Actions</th>
                </tr>
                <?php
                foreach ($tab_visiteurs as $visiteur) {
                    if( in_array($visiteur['id'],$tab_appr)){
                ?>
                    <tr>
                        <td><?php echo $visiteur['nom'] . " " . $visiteur['prenom']; ?></td>
                        <td><?php echo $visiteur['matricule']; ?></td>
                        <td><?php echo $visiteur['cni']; ?></td>
                        <td><?php echo $visiteur['tel']; ?></td>
                        <td><a href='<?= base_url(); ?>/connexion/'></a></td>
                    </tr>
                <?php
                    }
                }
                ?>
            </table>
        </div>
        <div class="popup-back" popup_id="p_form_visiteur">
            <form action="<?= base_url(); ?>/apprenant/ajouter" method="POST" class="popup-form ">
                <div class="form-header">
                    <h2> SEED RECEPTION</h2>
                    <h3>Ajouter un visiteur</h3>
                </div>
                
                <label for="visiteur" class="inline w-min m-0">Visiteur</label>
                <select name="visiteur" id="visiteur" class="ring-1 rounded outlinee-none overflow-scroll focus:outline-0">

                </select>
                <!--  vst est un attribut que seul les entrer caracterisant un visiteur en possede -->
                <label for="nom" class="requis">Nom</label>
                <div>
                    <input type="text" vst class="textfield" name="nom" id="nom" placeholder="..." required>
                </div>
                <label for="prenom">Prenom</label>
                <div>
                    <input type="text" vst name="prenom" class="textfield" id='prenom' placeholder="...">
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
                        <button type="reset" class="close-popup" popup_to_close="p_form_visiteur" value="Annuler">Annuler</button>
                        <button type="submit">Ajouter</button>
                    </div>
                </div>

            </form>
        </div> 
    </div>

    <script src="assets/script/visite.js"></script>
    <script src="assets/script/popup.js"></script>
</body>

</html>