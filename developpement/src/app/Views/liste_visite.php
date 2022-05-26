<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/dist/style.css">
    <title>Document</title>
</head>
<body>
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
                                <a href='<?=base_url();?>fin/'>fini</a>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
            <?php
                }
            ?>
        </table>
    </div>
    <div class="popup-back" popup_id="p_form_visite">
        <form action="" class="popup-form">
            <div class="relative">
                <button type="button"><img src="assets/image/button/fermer-la-croix.png" alt="fermer" class="close-popup absolute right-0 top-0 w-4 h-4"  popup_to_close="p_form_visite" ></button>
            </div>
            <div class="form-header">
                <h2> SEED RECEPTION</h2>
                <h3>Ajouter une visite</h3>
            </div>

            <div class="grid grid-cols-2 gap-4 my-2">
                <div>
                    <label for="nom" class="requis">Nom</label>
                    <input type="text" class="textfield" id="nom" autofocus placeholder="..." required>
                </div>
                <div>
                    <label for="prenom">Prenom</label>
                    <input type="text" class="textfield" placeholder="...">
                </div>
                <div>
                    <label for="cni" class="requis">Numero CNI</label>
                    <input type="text" class="textfield" id="cni" placeholder="..." required>
                </div>
                <div>
                    <label for="Tel" class="requis">Telphone</label>
                    <input type="number" id="tel"class="textfield"  placeholder="..." required>
                </div>
            </div>

            <div class="grid gap-2 grid-cols-3 my-2">
                <div>
                    <label for="date" class="requis">Date</label>
                    <input type="date" class="textfield" id="cni" placeholder="..." required>
                </div>
                <div>
                    <label for="hd" class="requis">Heure de debut</label>
                    <input type="time" id="tel"class="textfield"  placeholder="..." required>
                </div>
                <div>
                    <label for="hf">Heure de fin</label>
                    <input type="time" class="textfield" placeholder="...">
                </div>
            </div>
            <div class="my-2">
                <label for="raison">Raison</label>
                <textarea name="" id="" cols="20" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 focus:ring-1 focus:ring-blue-300 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            </div>

            <div class="form-footer">
                <div>
                    <input type="button" class="close-popup" popup_to_close="p_form_visite" value="Annuler">
                    <input type="submit" value="Ajouter">
                </div>
            </div>
            
        </form>
    </div>

    <script src="assets/script/popup.js"></script>
</body>
</html>