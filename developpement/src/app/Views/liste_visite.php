<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/dist/style.css">
    <script></script>
    <title>Document</title>
</head>
<body>
    <script type="text/javascript">
        var tab_json=<?php print json_encode($visites)?>;
        console.log(tab_json);
    </script>
    <div class="list">
    
        <h1 class="titre-tableau"> Liste des visites</h1>

        <button class="open-popup btn-ajouter" popup_to_open="p_form_visite">Ajouter</button>
        <div>
            <span >nombre d'elements: </span>
        </div> 
        <table>
            <tr>
                <th>Visiteur</th>
                <th>Employer</th>
                <th>Raison</th>
                <th>Date</th>
                <th>Heure de Debut</th>
                <th>Heure de fin</th>
                <th>Action</th>
            </tr>
            <?php
            $i=0;
                foreach($visites as $visite)
                {
                    ?>
                    <tr>
                        <td><?php echo $visite['visiteur'];?></td>
                        <td><?php echo $visite['employer'];?></td>
                        <td><?php echo $visite['raison'];?></td>
                        <td><?php echo $visite['date'];?></td>
                        <td><?php echo $visite['heure_debut'];?></td>
                        <td><?php echo $visite['heure_fin'];?></td>
                        <td>
                            <?php
                            if($visite['heure_fin']=="") 
                            {
                                ?>
                                <a href='#' class="open-popup" popup_to_open="p_form_visite" 
                                                onclick="remplir(<?php echo $i ?>)">terminé</a>
                                <?php
                                
                            }
                            else
                            {
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
        <form action="<?=base_url();?>/visite/ajouter" method="POST" class="popup-form">
            <div class="relative">
                <button type="button"><img src="assets/image/button/fermer-la-croix.png" alt="fermer" class="close-popup absolute right-0 top-0 w-4 h-4"  popup_to_close="p_form_visite" ></button>
            </div>
            <div class="form-header">
                <h2> SEED RECEPTION</h2>
                <h3>Ajouter une visite</h3>
            </div>
                <input type="text" hidden id="idv" name="idv">
            <div class="grid grid-cols-2 gap-4 my-2">
                <div>
                    <label for="nom" class="requis">Nom</label>
                    <input type="text" class="textfield" id="nom" name="nom" autofocus placeholder="..." required>
                </div>
                <div>
                    <label for="prenom">Prenom</label>
                    <input type="text" class="textfield" id="prenom" name="prenom" placeholder="...">
                </div>
                <div>
                    <label for="cni" class="requis">Numero CNI</label>
                    <input type="text" class="textfield" id="cni" name="cni" placeholder="..." required>
                </div>
                <div>
                    <label for="Tel" class="requis">Telphone</label>
                    <input type="number" id="tel" class="textfield" name="tel" placeholder="..." required>
                </div>
            </div>

            <div class="grid gap-2 grid-cols-3 my-2">
                <div>
                    <label for="date" class="requis">Date</label>
                    <input type="date" class="textfield" id="date" name="date" placeholder="..." required>
                </div>
                <div>
                    <label for="hd" class="requis">Heure de debut</label>
                    <input type="time" id="hd" name="hd" class="textfield"  placeholder="..." required>
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

    <script src="assets/script/popup.js"></script>
    <script type="text/javascript">
        const remplir=(i)=>{
            inputs=document.querySelectorAll('input');
            inputs.forEach(input=>{
                    if(input.id!='hf' && input.id!='idv'){input.disabled=true}
                })
            let raison=document.getElementById("raison");
            raison.disabled=true;
            raison.value=tab_json[i].raison;
            document.getElementById("hd").value=tab_json[i].heure_debut;
            document.getElementById("date").value=tab_json[i].date;
            document.getElementById("nom").value=tab_json[i].nom;
            document.getElementById("prenom").value=tab_json[i].prenom;
            document.getElementById("cni").value=tab_json[i].cni;
            document.getElementById("tel").value=tab_json[i].tel;
            document.getElementById("idv").value=parseInt(tab_json[i].id);
            document.querySelector("label[for='hf']").classList.add("requis");
            document.getElementById("hf").setAttribute("required","true");
        }
    </script>
</body>
</html>