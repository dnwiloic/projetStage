<?php
include_once("entete.php");
?>

<body>
    <script type="text/javascript">
        var tab_livre = <?php print json_encode($tab_livre) ?>;
        console.log(tab_livre);

        var controler='ouvrage';
        var base_url=<?php print json_encode(base_url()) ?>;
    </script>

    <?php include("navbar.php") ?>
    <div class="grid grid-cols-7">
        <div class="w-64">
            <?php include("sidebar.php") ?>
        </div>
        <div class="list col-span-6">

            <h1 class="titre-tableau"> Liste des livres </h1>
            <!-- inclusion de la zone de recherche  -->
            <?php
            $controller = "ouvrage";
            include("searchZone.php")
            ?>
            <button class="open-popup btn-ajouter" popup_to_open="p_form_formation">Ajouter</button>
            <div>
                <span>nombre d'elements: <span id="nbr_elt" class="text-blue-700"></span></span>
            </div>

            <table>
                <tr>
                    <th nom_col='titre'>Titre</th>
                    <th nom_col='nom_auteur'>Nom de L'auteur</th>
                    <th nom_col='edition'>Edition</th>
                    <th nom_col='nombre_de_page'>Nombre de pages</th>
                    <th >Actions</th>
                </tr>
                <?php
                foreach ($tab_livre as $livre) {

                ?>
                    <tr>
                        <td><?php echo $livre['titre']; ?></td>
                        <td><?php echo $livre['nom_auteur']; ?></td>
                        <td><?php echo $livre['edition']; ?> </td>
                        <td><?php echo $livre['nombre_de_page']; ?></td>
                        <td><a href='<?= base_url(); ?>/emprunter/'>Emprunter</a></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
        <div class="popup-back" popup_id="p_form_formation">
            <form action="<?= base_url(); ?>/ouvrage/ajouter" method="POST" class="popup-form">
                <div class="form-header">
                    <h2> SEED RECEPTION</h2>
                    <h3>Ajouter un livre</h3>
                </div>
                <label for="titre" class="requis">Titre</label>
                <div>
                    <input type="text" class="textfield" id="titre" name="titre" placeholder="..." required>
                </div>
                <label for="nom_auteur" class="requis">Auteur</label>
                <div>
                    <input type="text" class="textfield" id="nom_auteur" name="nom_auteur" placeholder="..." required>
                </div>
                <label for="edition">Edition</label>
                <div>
                    <input type="text" id="edition" name="edition" class="textfield" placeholder="...">
                </div>
                <label for="nombre_de_page">Nombre de pages</label>
                <div>
                    <input type="number" class="textfield" name="nombre_de_page" id="nombre_de_page" placeholder="...">
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
            document.getElementById("nbr_elt").innerHTML = (document.querySelectorAll(".list tr")).length - 1;
        </script>
        
</body>

</html>