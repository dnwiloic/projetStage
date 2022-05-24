<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../dist/style.css">
    <title>Ouvrages</title>
</head>
<body>
    <div class="list">
    
        <h1 class="titre-tableau"> Liste des emprunts</h1>

        <button class="open-popup btn-ajouter" popup_to_open="p_form_visiteur">Ajouter</button>
        <div>
            <span >nombre d'elements: </span>
        </div> 
        <table>
            <tr>
                <th>Nom Ouvrage</th>
                <th>Nom abonne</th>
                <th>Date Emprunt</th>
                <th>D.Retour Prevu</th>
                <th>D.Retour Effectif</th>
                <th>Feelback</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
            </tr>
            <tr>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
            </tr>
            <tr>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
            </tr>
            <tr>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
            </tr>
        </table>
    </div>
    <div class="popup-back" popup_id="p_form_visiteur">
        <form action="" class="popup-form">
            <div class="form-header">
                <h2> SEED RECEPTION</h2>
                <br>
                <h3>Ajouter un emprunt</h3>
            </div>
            <label for="nom1" class="requis">Nom Ouvrage</label>
            <div >
                <input type="text" class="textfield" id="nom" placeholder="..." required>
            </div>
            <label for="nom2">Nom Abonne</label>
            <div >
                <input type="text" class="textfield" placeholder="...">
            </div>
            <label for="emprunt" class="requis">Date Emprunt</label>
            <div>
                <input type="date" class="textfield" id="cni" placeholder="..." required>
            </div>
            <label for="prevu" class="requis">D.Retour Prevu</label>
            <div>
                <input type="date" id="tel"class="textfield" disabled placeholder="..." required>
            </div>
            <label for="effectif">D.Retour Effectif</label>
            <div >
                <input type="date" class="textfield" disabled placeholder="...">
            </div>
            <label for="fellback">Feelback</label>
            <div >
                <input type="text" disabled class="textfield" placeholder="...">
            </div>

            <div class="form-footer">
                <div>
                    <input type="button" class="close-popup" popup_to_close="p_form_visiteur" value="Annuler">
                    <input type="submit" value="Ajouter">
                </div>
            </div>
            
        </form>
    </div>

    <script src="../../popup.js"></script>
</body>
</html>