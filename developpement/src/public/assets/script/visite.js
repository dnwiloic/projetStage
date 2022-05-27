document.getElementById("nbr_elt").innerHTML=tab_json.length;
let select_visiteur=document.getElementById("visiteur");
let select_chaine="<option value='-1'>Nouveau<?option>";
// vst est un attribut que seul les entrer caracterisant un visiteur en possede
tab_json.forEach(elt=>{
    select_chaine+="<option value='"+elt.id_visiteur+"'>"+elt.nom+" "+elt.prenom+"</option>"
})
select_visiteur.innerHTML=select_chaine;
select_visiteur.addEventListener('change',function(event){
    console.log(select_visiteur.value);
    vsts=document.querySelectorAll("[vst]");
    if(select_visiteur.value=='-1')
    {
        vsts.forEach(elt=>{ elt.removeAttribute('disabled') })
    }
    else
    {
        vsts.forEach(elt=>{ elt.disabled=true});
    }
})

const remplir=(i)=>{
    inputs=document.querySelectorAll('input, #visiteur');
    inputs.forEach(input=>{
            if(input.id!='hf' && input.id!='idv'){input.disabled=true}
        })
    let raison=document.getElementById("raison");
    raison.disabled=true;
    raison.value=tab_json[i].raison;
    document.getElementById("hd").value=tab_json[i].heure_debut;
    document.getElementById("visiteur").value=tab_json[i].id_visiteur;
    
    document.getElementById("date").value=tab_json[i].date;
    document.getElementById("nom").value=tab_json[i].nom;
    document.getElementById("prenom").value=tab_json[i].prenom;
    document.getElementById("cni").value=tab_json[i].cni;
    document.getElementById("tel").value=tab_json[i].tel;
    document.getElementById("idv").value=parseInt(tab_json[i].id);
    document.querySelector("label[for='hf']").classList.add("requis");
    document.getElementById("hf").setAttribute("required","true");
}