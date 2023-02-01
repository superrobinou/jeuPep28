window.onload = function () {
    let winCount = 0;
    var core = document.getElementById("sound_widget");
    if (core != null && core != undefined) {

        let winSound = core.getAttribute("data-winSound");
        let looseSound = core.getAttribute("data-looseSound");
        var buttons = document.getElementsByClassName("btn-choose");
        let guessAudio = document.getElementById("audioControls");
        let lifes=parseInt(core.getAttribute("data-life"));
        let maxLifes = parseInt(core.getAttribute("data-life"));
        console.log(lifes);
        if (buttons != null && buttons != undefined) {
            for (var btn of buttons){
            btn.addEventListener('click', event => {
                var btns = document.querySelectorAll(".btn-choose:not([data-guessing])");
                if(event.currentTarget.getAttribute("data-linked-audio")==guessAudio.src){
                    event.currentTarget.setAttribute('data-guessing',true);
                    var btns=document.querySelectorAll(".btn-choose:not([data-guessing])");
                    if(btns.length!=0){
                    var currentBtn=btns[Math.floor(Math.random()*btns.length)];
                    guessAudio.src=currentBtn.getAttribute("data-linked-audio");
                    }
                    else{
                     var win=document.getElementById("win");
                     win.style.display="block";
                    }
                    var audio=new Audio(winSound);
                    audio.play().then(function(){var audio2=new Audio(guessAudio.src);audio2.play()});
                    
                }
                else{
                    var currentBtn = btns[Math.floor(Math.random() * btns.length)];
                    guessAudio.src = currentBtn.getAttribute("data-linked-audio");
                    var looseAudio=new Audio(looseSound);
                    looseAudio.play().then(function () { var audio2 = new Audio(guessAudio.src); audio2.play() });
                    lifes=lifes-1;
                    var supertest=document.getElementById("hl");
                    supertest.innerHTML=lifes+"/"+maxLifes;
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