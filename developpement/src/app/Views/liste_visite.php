<?php
include_once("entete.php");
?>
<body>
    <script type="text/javascript">
        var tab_json = <?php print json_encode($tab_visiteur) ?>;
        var tab_visite = <?php print json_encode($visites) ?>;
        console.log(tab_json);
        var controler='visite';
        var base_url=<?php print json_encode(base_url()) ?>;
    </script>
    <?php include("navbar.php") ?>
    <div class="grid grid-cols-7">
        <div class="w-64">
            <?php include("sidebar.php") ?>
        </div>
        <div class="list col-span-6">

            <span class="titre-tableau"> Liste des visites</span>
            <!-- inclusion de la zone de recherche  -->
            <?php
            $controller = "visite";
            include("searchZone.php")
            ?>
            <button class="open-popup btn-ajouter" popup_to_open="p_form_visite">Ajouter</button>
            <div>
                <span>nombre d'elements: <span class="text-blue-600" id="nbr_elt"></span> </span>
            </div>
            <!-- <form class="my-8 h-fit" >
            <fieldset class="relative border-blue-400 border h-fit p-1 ">
                <legend>Filtre</legend>
                <butotn type="submit" class="cursor-pointer text-blue-600 w-16 font-bold text-center float-right">filtrer</butotn>
            </fieldset> 
        </form> -->
            <table class="">
                <tr>
                    <th nom_col='visiteur'>Visiteur </th>
                    <th nom_col='employer'>Employer</th>
                    <th nom_col='raison'>Raison</th>
                    <th nom_col='date'>Date</th>
                    <th nom_col='heure_debut'>Heure de Debut</th>
                    <th nom_col='heure_fin'>Heure de fin</th>
                    <th>Action</th>
                </tr>
                <?php
                $i = 0;
                foreach ($visites as $visite) {
                ?>
                    <tr>
                        <td><?php echo $visite['nom'] . " " . $visite['prenom']; ?></td>
                        <td><?php echo $visite['login']; ?></td>
                        <td><?php echo $visite['raison']; ?></td>
                        <td><?php echo $visite['date']; ?></td>
                        <td><?php echo $visite['heure_debut']; ?></td>
                        <td><?php echo $visite['heure_fin']; ?></td>
                        <td>
                            <?php
                            if ($visite['heure_fin'] == "") {
                            ?>
                                <a href='#' class="open-popup" popup_to_open="p_form_visite" onclick="remplir(<?php echo $i ?>)">terminé</a>
                            <?php

                            } else {
                            ?>
                                terminé
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </table>
        </div>
        <div class="popup-back" popup_id="p_form_visite">
            <form action="<?= base_url(); ?>/visite/ajouter" method="POST" class="popup-form">
                <div class="relative">
                    <button type="button"><img src="<?=base_url();?>/assets/image/button/fermer-la-croix.png" alt="fermer" class="close-popup absolute right-0 top-0 w-4 h-4" popup_to_close="p_form_visite"></button>
                </div>
                <div class="form-header">
                    <h2> SEED RECEPTION</h2>
                    <h3>Ajouter une visite</h3>
                </div>
                <input type="text" hidden id="idv" name="idv">
                <label for="visiteur" class="inline w-min m-0">Visiteur</label>
                <select name="visiteur" id="visiteur" class="ring-1 rounded outlinee-none overflow-scroll focus:outline-0">

                </select>
                <div class="grid grid-cols-2 gap-4 my-2">
                    <!--  vst est un attribut que seul les entrer caracterisant un visiteur en possede -->
                    <div>
                        <label for="nom" class="requis">Nom</label>
                        <input type="text" class="textfield" id="nom" name="nom" vst autofocus placeholder="..." required>
                    </div>
                    <div>
                        <label for="prenom">Prenom</label>
                        <input type="text" class="textfield" id="prenom" vst name="prenom" placeholder="...">
                    </div>
                    <div>
                        <label for="cni" class="requis">Numero CNI</label>
                        <input type="text" class="textfield" id="cni" vst name="cni" placeholder="..." required>
                    </div>
                    <div>
                        <label for="Tel" class="requis">Telphone</label>
                        <input type="number" id="tel" class="textfield" vst name="tel" placeholder="..." required>
                    </div>
                </div>

                <div class="grid gap-2 grid-cols-3 my-2">
                    <div>
                        <label for="date" class="requis">Date</label>
                        <input type="date" class="textfield" id="date" name="date" placeholder="..." required>
                    </div>
                    <div>
                        <label for="hd" class="requis">Heure de debut</label>
                        <input type="time" id="hd" name="hd" class="textfield" placeholder="..." required>
                    </div>
                    <div>
                        <label for="hf">Heure de fin</label>
                        <input type="time" class="textfield" name="hf" id="hf" placeholder="...">
                    </div>
                </div>
                <div class="my-2">
                    <label for="raison">Raison</label>
                    <textarea name="raison" id="raison" cols="20" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 focus:ring-1 focus:ring-blue-300 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>

                <div class="form-footer">
                    <div>
                        <button type="reset" class="close-popup" popup_to_close="p_form_visite" value="Annuler">Annuler<button>
                        <button type="submit" value="Ajouter">Ajouter</button>
                    </div>
                </div>

            </form>
        </div>
    </div>


    <script src="<?= base_url();?>/assets/script/popup.js"></script>
    <script src="<?= base_url();?>/assets/script/visite.js"></script>
    <script src="<?= base_url();?>/assets/script/trie.js"></script>

</body>

</html>