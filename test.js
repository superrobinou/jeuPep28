        var images = 10;
    var columns = 5;
    var space = 2;
    var startRow = 10;
    var startLine = 10;
    var ctx = document.getElementById('memorygame');
    for (var i = 1; i <= images * 2+1; i++) {
        loadFaceImage(startRow,startLine);    
        if ((i-1) % 5==0 && i-1!=0) {
            console.log(i-1);
            startLine = startLine + 128 + space;
            startRow = 10;
        }
        else {
            startRow = startRow + 128 + space;
        }
    }

    function loadFaceImage(startRow,startLine){
        img=new Image();
        img.onload=function () {
            var div=document.createElement("div");
            var img=document.createElement("img");
            img.src="face.jpg";
            img.id="img_"+i;
            img.naturalHeight=128;
            img.naturalWidth=128;
            img.width=128;
            img.height=128;
            div.appendChild(img);
            ctx.appendChild(div);
            img.addEventListener('click', function () { console.log('clicked') });
        }
        img.src = 'face.jpg';
    } 