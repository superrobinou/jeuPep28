//le js est chargé au chargement de la page.
window.onload=function(){
    //count compte le nombre de cartes retourné en même temps (max:2) et winCount le nombre d'images trouvés
    //document est utilisé pour lire les propriétés de l'html formatté par le php (lire l'html pour mieux comprendre)
    let count = 0;
    let winCount=0;  
    var core=document.getElementById("memorygame");
    if(core!=null && core!=undefined){
    let win=core.getAttribute("data-win");
    let face=core.getAttribute("data-face");
    var buttons=document.getElementsByClassName("memory-button");
    //nombre d'images a retourner pour gagner;
    let winEnds=buttons.length;
    //rafraîchissement de la page si le joueur rafraîchit la page.
    var winButton=document.getElementById("replay");
    winButton.addEventListener('click',event=>{
        window.location.reload();
    });
    //on tourne une fonction a chaque clic sur chaque image pour la retourner
    if(btn!=null && btn!=undefined){
    for (var btn of buttons){
        btn.addEventListener('click', event => {
            //on vérifie que le joueur peut retourner les cartes avant de faire quoi que ce soit
            if (event.target.getAttribute('data-isShowed') == "false" && count < 2) {
                //l'image réelle remplace l'image retourné
                event.target.src = event.target.getAttribute('data-realImage');
                //on change les attributs html pour expliquer que la carte est affiché et si c'est la premiére ou la deuxiéme carte retourné
                event.target.setAttribute("data-isShowed", "true");
                event.target.setAttribute('data-counter', count);
                //on incrémente la variable permettant de compter de carte retourné.
                count = count + 1;
                //on regarde si deux cartes sont retournés
                if (count == 2) {
                    //on attend un peu de retourner les cartes.
                    setTimeout(() => {
                        //on remplace l'image par une image de face pour l'image qui a été appuyé par le joueur et l'image selectionné en premier
                        event.target.src = face;
                        var tabData = document.querySelectorAll('[data-counter="0"]');
                        tabData[0].src = face;
                        //si les deux images selectionnés sont les mêmes, le joueur a gagné
                        if (tabData[0].getAttribute("data-realImage") == event.target.getAttribute("data-realImage")) {
                            //on change les images des cartes par l'image qu'il faut
                            tabData[0].src = win;
                            event.target.src = win;
                            //on supprime l'attribut permettant de savoir si la carte est affiché puisque la carte n'a plus a être retourné
                            event.target.removeAttribute("data-IsShowed");
                            tabData[0].removeAttribute('data-IsShowed');
                            //on augmente de 2 le nombre de carte gagné et on vérifie si c'est les derniéres cartes avant de gagner
                            winCount=winCount+2;
                            if(winCount==winEnds){
                             var display=document.getElementById("win");
                             //on affiche le message pour montrer aux joueurs qu'il a joué
                             display.style.display="block";
                            }

                        }
                        //si les deux cartes ne sont pas les deux mêmes, on les remets a l'envers
                        else {
                            tabData[0].setAttribute('data-IsShowed', "false");

                            event.target.setAttribute("data-IsShowed", "false");

                        }
                        //on remet a zéro le compteur puisque deux cartes ont été retourné.
                        tabData[0].removeAttribute('data-counter');
                        event.target.removeAttribute("data-counter");
                        count = 0;
                    }, 500);


                }
            }
        });
    }}}
}



