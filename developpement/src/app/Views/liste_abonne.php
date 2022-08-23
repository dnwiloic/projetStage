<?php
include_once("entete.php");
?>

<body>

    <script type="text/javascript">
        var tab_json = <?php print json_encode($tab_visiteurs) ?>;
        var tab_abn = <?php print json_encode($tab_abn) ?>;
        console.log(tab_json);

        var controler='abonne';
        var base_url=<?php print json_encode(base_url()) ?>;
    </script>

    <?php include("navbar.php") ?>
    <div class="grid grid-cols-7 ">
        <div class="w-64">
            <?php include("sidebar.php") ?>
        </div>
        <div class="list col-span-6">

            <h1 class="titre-tableau"> Liste des abonnés </h1>
            <!-- inclusion de la zone de recherche  -->
            <?php
            $controller = "abonne";
            include("searchZone.php")
            ?>
            <button class="open-popup btn-ajouter" popup_to_open="p_form_visiteur">Ajouter</button>
            <div>
                <span>nombre d'elements: <span id="nbr_elt" class="text-blue-700"></span></span>
            </div>
            <table>
                <tr>
                    <th nom_col='nom'>Nom & prenom</th>
                    <th nom_col='montant_verse'>Montant versé</th>
                    <th nom_col='cout_abonnement'>Coût de l'abonnement</th>
                    <th nom_col='date_inscription'>Date inscription</th>
                    <th nom_col='date_expiration'>Date expiration</th>
                    <th nom_col='carte_membre_genere'>carte membre</th>
                    <th>Actions</th>
                </tr>
                <?php
                foreach ($tab_abn as $abonne) {
                ?>
                    <tr>
                        <td><?php echo $abonne['nom'] . " " . $abonne['prenom']; ?></td>
                        <td><?php echo $abonne['montant_verse']; ?></td>
                        <td><?php echo $abonne['cout_abonnement']; ?></td>
                        <td><?php echo $abonne['date_inscription']; ?></td>
                        <td><?php echo $abonne['date_expiration']; ?></td>
                        <td><?php  if($abonne['carte_membre_genere']) echo"OUI";
                                    else echo"NON"
                             ?></td>
                        <td><a href='<?= base_url(); ?>/connexion/'></a></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
    <div class="popup-back" popup_id="p_form_visiteur">
        <form action="<?= base_url(); ?>/abonne/ajouter" method="POST" class="popup-form ">
            <div class="form-header">
                <h2> SEED RECEPTION</h2>
                <h3>Ajouter un abonné</h3>
            </div>

            <label for="visiteur" class="inline w-min m-0">Visiteur</label>
            <select name="visiteur" id="visiteur" class="ring-1 rounded outlinee-none overflow-scroll focus:outline-0">

            </select>
            <!--  vst est un attribut que seul les entrer caracterisant un visiteur en possede -->
            <div class="grid grid-cols-2 gap-4 ">
                <div>
                    <label for="nom" class="requis">Nom</label>
                    <input type="text" vst class="textfield" name="nom" id="nom" placeholder="..." required>
                </div>
                <div>
                    <label for="prenom">Prenom</label>
                    <input type="text" vst name="prenom" class="textfield" id='prenom' placeholder="...">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="cni" class="requis">Numero CNI</label>
                    <input type="text" vst class="textfield" id="cni" name="cni" placeholder="..." required>
                </div>
                <div>
                    <label for="Tel" class="requis">Telphone</label>
                    <input type="number" vst id="tel" name="tel" class="textfield" placeholder="..." required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 ">
                <div>
                    <label for="montant_verse" class="requis">Montant versé</label>
                    <input type="number" id="montant_verse" name="montant_verse" step="1000" value="0" required class="textfield ">
                </div>
                <div>
                    <label for="cout_total" class="requis">Coût de l'abonnement</label>
                    <input type="number" id="cout_total" name="cout_total" step="1000" value="15000" disabled required class="textfield ">
                    <button type="button" class="text-blue-700 cursor-pointer relative -top-3 float-right" id="b_cout_total">Modifier</button>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="sate_ins" class="requis">Date inscription</label>
                    <input type="date" id="date_ins" name="date_ins" class="textfield" required>
                </div>
                <div>
                    <label for="cmg">Carte Membre généré ? </label>
                    <div class="grid grid-cols-2 gap-8 textfield">
                        <span>
                            <input type="radio" name="cmg" id="cmg" value="0">Non
                        </span>
                        <span>
                            <input type="radio" name="cmg" id="cmg" value="1">Oui
                        </span>
                    </div>
                </div>
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
    <script src="<?= base_url();?>/assets/script/visite.js"></script>
    <script src="<?= base_url();?>/assets/script/popup.js"></script>
    <script type="text/javascript">
        document.getElementById("b_cout_total").addEventListener('click', function(event) {
            console.log("click");
            document.getElementById("cout_total").removeAttribute('disabled');
        });
    </script>
</body>

</html>