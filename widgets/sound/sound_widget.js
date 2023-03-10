window.onload = function () {
    let winCount = 0;
    var core = document.getElementById("sound_widget");
    if (core != null && core != undefined) {

        let winSound = core.getAttribute("data-winSound");
        let looseSound = core.getAttribute("data-looseSound");
        var buttons = document.getElementsByClassName("btn-choose");
        let guessAudio = document.getElementById("audioControls");
        guessAudio.addEventListener('click',event=>{
            var audio = new Audio(event.currentTarget.getAttribute("data-src"));
        audio.play();
        });
        let lifes=parseInt(core.getAttribute("data-life"));
        let maxLifes = parseInt(core.getAttribute("data-life"));
        console.log(lifes);
        if (buttons != null && buttons != undefined) {
            for (var btn of buttons){
            btn.addEventListener('click', event => {
                var btns = document.querySelectorAll(".btn-choose:not([data-guessing])");
                if(event.currentTarget.getAttribute("data-linked-audio")==guessAudio.getAttribute("data-src")){
                    event.currentTarget.setAttribute('data-guessing',true);
                    var btns=document.querySelectorAll(".btn-choose:not([data-guessing])");
                    if(btns.length!=0){
                    var currentBtn=btns[Math.floor(Math.random()*btns.length)];
                    guessAudio.setAttribute("data-src",currentBtn.getAttribute("data-linked-audio"));
                    }
                    else{
                     var win=document.getElementById("win");
                     win.style.display="block";
                    }
                    var audio=new Audio(winSound);
                    audio.onended = function () { var audio2 = new Audio(guessAudio.getAttribute("data-src")); audio2.play() };
                    audio.play();
                    
                }
                else{
                    var currentBtn = btns[Math.floor(Math.random() * btns.length)];
                    guessAudio.src = currentBtn.getAttribute("data-linked-audio");
                    lifes = lifes - 1;
                    var looseAudio=new Audio(looseSound);
                    looseAudio.onended = function () { if(lifes!=0){var audio2 = new Audio(guessAudio.getAttribute("data-src")); audio2.play();} };
                    looseAudio.play();
                    var supertest=document.getElementById("hl");
                    supertest.innerHTML="Vies: "+lifes+"/"+maxLifes;
                    if(lifes==0){
                        var loose=document.getElementById("loose");
                        loose.style.display="block";
                    }
                }
            });
        }
        }
    }
}