window.onload=function(){
    let count = 0;
    var core=document.getElementById("memorygame");
    let win=core.getAttribute("data-win");
    let face=core.getAttribute("data-face");
    var buttons=document.getElementsByClassName("memory-button");
    for (var btn of buttons){
        btn.addEventListener('click', event => {
            console.log(count);
            if (event.target.getAttribute('data-isShowed') == "false" && count < 2) {
                console.log("e:"+event.target.getAttribute('data-realImage'));
                event.target.src = event.target.getAttribute('data-realImage');
                event.target.setAttribute("data-isShowed", "true");
                event.target.setAttribute('data-counter', count);
                count = count + 1;
                if (count == 2) {
                    setTimeout(() => {
                        event.target.src = face;
                        var tabData = document.querySelectorAll('[data-counter="0"]');
                        tabData[0].src = face;
                        if (tabData[0].getAttribute("data-realImage") == event.target.getAttribute("data-realImage")) {
                            tabData[0].src = win;
                            event.target.src = win;
                            event.target.removeAttribute("data-IsShowed");
                            tabData[0].removeAttribute('data-IsShowed');

                        }
                        else {
                            tabData[0].setAttribute('data-IsShowed', "false");

                            event.target.setAttribute("data-IsShowed", "false");

                        }
                        tabData[0].removeAttribute('data-counter');
                        event.target.removeAttribute("data-counter");
                        count = 0;
                    }, 500);


                }
            }
        });
    }
}



