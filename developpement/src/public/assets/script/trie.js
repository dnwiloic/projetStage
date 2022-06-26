// ce fichier ne contient pas de code pour trier mais facilite l'implementation des tries
var cols=document.querySelectorAll("th[nom_col]");
cols.forEach(element => {
    element.classList.add('relative');
    console.log(controler);
    var lienH="<a href='"+base_url+"/"+ controler +"/index/" + element.getAttribute('nom_col') + "/"+  "desc/" +"' class=''><img src='"+base_url+"/assets/image/button/tri/haut_orange.png' alt=''></a>";
    var lienB="<a href='"+base_url+"/"+ controler +"/index/" + element.getAttribute('nom_col') + "/"+ "asc/" + "' class=''><img src='"+base_url+"/assets/image/button/tri/bas_vert.png' img alt='' ></a>";
    var chaine="<span class='inline-block absolute right-2'> <div>"+lienH+"</div><div>"+lienB+"</div></span>";
    element.innerHTML+=chaine;
});