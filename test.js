let count = 0;
        var images = 10;
    let win=0;
    var columns = 5;
    var ctx = document.getElementById('memorygame');
    var clicked=false;
    for (var i = 1; i <= images * 2; i++) {
        var j=i;
        if(i>10){j=i-10;}
        
        loadFaceImage(j);
        
    }

    function loadFaceImage(j){
        var divBack = document.createElement("div");
        divBack.classList.add("divBack");
        imgBack=new Image();
        imgBack.src = "face.jpg";
        var linkBack = document.createElement("button");
        linkBack.appendChild(imgBack);
        divBack.appendChild(linkBack);
        ctx.appendChild(divBack);
        imgBack.setAttribute('data-realImage', "assets/title/title_" + j + ".jpg");
        imgBack.setAttribute('data-isShowed',"false");
        imgBack.addEventListener('click', function () {
            console.log(count+","+j);
            if (this.getAttribute('data-isShowed') == "false" && count <2) {
                this.src = this.getAttribute('data-realImage');
                this.setAttribute("data-isShowed", "true");
                this.setAttribute("data-id",j);
                this.setAttribute('data-counter',count);
                count=count+1;
                if(count==2){
                    setTimeout(() => {
                        this.src = "face.jpg";
                        var tabData=document.querySelectorAll('[data-counter="0"]');
                        tabData[0].src = "face.jpg";
                        if(tabData[0].getAttribute('data-id')==this.getAttribute('data-id')){
                            tabData[0].src ="assets/face/win.jpg";
                            this.src="assets/face/win.jpg";
                            win=win+1;
                            if(win==images){
                                console.log("vous avez gagné!");
                            }
                        }
                        console.log(tabData);
                        tabData[0].setAttribute('data-IsShowed', false);
                        tabData[0].removeAttribute("data-counter");
                        this.setAttribute("data-IsShowed", "false"); }, 500);
                        this.removeAttribute("data-counter");
                        count=0;

                }
            }

        });
        
        
    }