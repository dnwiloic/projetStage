<?php
include_once("entete.php");
?>

<body>

    <script type="text/javascript">
        var tab_arg = <?php print json_encode($tab) ?>;
        console.log(tab_arg);

        var controler='entree_argent';
        var base_url=<?php print json_encode(base_url()) ?>;
    </script>

    <?php include("navbar.php") ?>
    <div class="grid grid-cols-7 ">
        <div class="w-64">
            <?php include("sidebar.php") ?>
        </div>
        <div class="list col-span-6">

            <h1 class="titre-tableau">Liste des sorties d'argent</h1>
            <button class="open-popup btn-ajouter" popup_to_open="p_form_visiteur">Ajouter</button>
            <div>
                <span>nombre d'elements: <span id="nbr_elt" class="text-blue-700"></span></span>
            </div>
            <table>
                <tr>
                    <th nom_col='date'>Date</th>
                    <th nom_col='somme'>Montant</th>
                    <th nom_col='motif'>Motif</th>
                    <th>Actions</th>
                </tr>
                <?php
                foreach ($tab as $arg) {
                ?>
                    <tr>
                        <td><?php echo $arg['date'] ?></td>
                        <td><?php echo $arg['somme']; ?></td>
                        <td><?php echo $arg['motif']; ?></td>
                        
                        <td><a href='<?= base_url(); ?>/connexion/'></a></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
    <div class="popup-back" popup_id="p_form_visiteur">
        <form action="<?= base_url(); ?>/sortie_argent/ajouter" method="POST" class="popup-form ">
            <div class="form-header">
                <h2> SEED RECEPTION</h2>
                <h3>Enregistrer une sortie d'argent</h3>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="date" class="requis">Date</label>
                    <input type="date" id="date" name="date" class="textfield" required>
                </div>
                <div>
                    <label for="somme" class="requis">Montant</label>
                    <input type="number" id="somme" name="somme" step="1000" value="0" required class="textfield ">
                </div>
                <div>
                    <label for="motif" class="requis">Motif</label>
                    <input type="text"  class="textfield" name="motif" id="motif" placeholder="..." required>
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