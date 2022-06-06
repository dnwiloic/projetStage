document.getElementById("nbr_elt").innerHTML=(document.querySelectorAll(".list tr")).length-1;
let select_visiteur=document.getElementById("visiteur");
let select_chaine="<option value='-1'>Nouveau<?option>";
// vst est un attribut que seul les entrer caracterisant un visiteur en possede
let tab_vsiteur_existant=Array();
tab_json.forEach((elt,key)=>{
    if(tab_vsiteur_existant.indexOf(elt.id_visiteur)==-1)
    {
        select_chaine+="<option value='"+elt.id_visiteur+"'>"+elt.nom+" "+elt.prenom+"</option>";
        tab_vsiteur_existant[key]=(elt.id_visiteur);
        console.log("11\n");
    }
    
})
select_visiteur.innerHTML=select_chaine;
select_visiteur.addEventListener('change',function(event){
    console.log(select_visiteur.value);
    vsts=document.querySelectorAll("[vst]");
    if(select_visiteur.value=='-1')
    {
        vsts.forEach(elt=>{ 
            elt.removeAttribute('disabled');
        })
    }
    else
    {
        vsts.forEach(elt=>{ 
            elt.disabled=true;
            elt.value=tab_json[tab_vsiteur_existant.indexOf(select_visiteur.value)][elt.id];
        });
    }
})

const remplir=(i)=>{
    inputs=document.querySelectorAll('input, #visiteur');
    inputs.forEach(input=>{
            if(input.id!='hf' && input.id!='idv'){input.disabled=true}
        })
    let raison=document.getElementById("raison");
    raison.disabled=true;
    raison.value=tab_visite[i].raison;
    document.getElementById("hd").value=tab_visite[i].heure_debut;
    document.getElementById("visiteur").value=tab_visite[i].id_visiteur;
    
    document.getElementById("date").value=tab_visite[i].date;
    document.getElementById("nom").value=tab_visite[i].nom;
    document.getElementById("prenom").value=tab_visite[i].prenom;
    document.getElementById("cni").value=tab_visite[i].cni;
    document.getElementById("tel").value=tab_visite[i].tel;
    document.getElementById("idv").value=parseInt(tab_visite[i].id);
    document.querySelector("label[for='hf']").classList.add("requis");
    document.getElementById("hf").setAttribute("required","true");
}