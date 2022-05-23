let open_modals=document.querySelectorAll(".open-popup");
let popup_backs=document.querySelectorAll(".popup-back");
let popup_forms=document.querySelectorAll(".popup-form");
let close_modals=document.querySelectorAll(".close-popup");

console.log("js");

const fActivePopup=event=>{
    document.querySelector(" div[popup_id='"+event.target.getAttribute("popup_to_open")+"']").classList.add("active");
};


open_modals.forEach( btn=>{btn.addEventListener('click', fActivePopup )}) ;

close_modals.forEach ( close=>{
    close.addEventListener('click',function(event){
        document.querySelector(" div[popup_id='"+event.target.getAttribute("popup_to_close")+"']").classList.remove("active");
    });
});

popup_backs.forEach( back=>{back.addEventListener('click', function(event){
    event.target.classList.remove("active");
})
}
);
popup_forms.forEach(form=>{form.addEventListener('click', function(e){ e.stopPropagation();})});






