document.onselectstart = function () {
    return false; };

let initialX = null;
let initialY = null;
let endX = null;
let endY = null;
let diffX = null;
let diffY = null;



let demo = document.getElementById('content');



demo.addEventListener('mousedown', (e) => {
    initialX = e.pageX;
    initialY = e.pageY;
});


demo.addEventListener('mouseup', (e) => {

    endX = e.pageX;
    endY = e.pageY;
    diffX = 0;
    diffY = 0;

    diffX = initialX - endX;
    if (diffX<0) {
        diffX=diffX*-1;}
    diffY = initialY - endY;
    if (diffY<0) {
        diffY=diffY*-1;}

    if (diffX<10&&diffY<10) {
        var  x = e.target.id;
        var y = "details";
        showData(x, y);
    } else {
        if (diffX <= diffY) {
            //    Horizontal
            diffX = initialX - endX;
            if (diffX < 0) {
                //      alert("Swiped down")
            } else {
                //       alert("Swiped up")
            }
        } else {
            //    Vertical
            diffY = initialY - endY;
            if (diffY < 0) {
                // alert("Swiped left");
                //  e.preventDefault();
            } else {
                // alert("Swiped right");
                //  e.preventDefault();
            }
        }
    }

});  // end Mouseup


demo.addEventListener('touchstart', (e) => {
    initialX = e.touches[0].clientX;
    initialY = e.touches[0].clientY;
});



demo.addEventListener('touchend', (e) => {
    endX = e.changedTouches[0].clientX;
    endY = e.changedTouches[0].clientY;
    diffX = 0;
    diffY = 0;

    diffX = initialX - endX;
    if (diffX<0) {
        diffX=diffX*-1;
    }
    diffY = initialY - endY;
    if (diffY<0) {
        diffY=diffY*-1;
    }

    if (diffX<5&&diffY<5) {
        alert(e.target.id);
        e.preventDefault();
    } else {
        if (diffX <= diffY) {
            //    Vertical
            diffX = initialX - endX;
            if (diffX < 0) {
                //       alert("Swiped down")
            } else {
                //      alert("Swiped up")
            }
        } else {
            //    Horizontal
            diffY = initialY - endY;
            if (diffY < 0) {
                //  alert("Swiped left")
                // e.preventDefault();
            } else {
                //   alert("Swiped right")
                //  e.preventDefault();
            }
        }
    }

});

function showData(x, y)
{

        let oOutput = document.getElementById("content");
        //oOutput.innerHTML = "";
        let oData = new FormData();
        oData.append('id', x);
        oData.append('type', y);
        let oReq = new XMLHttpRequest();
        oReq.onload = function () {
            if (oReq.status === 200 && oReq.readyState === 4) {
                oOutput.innerHTML = oReq.response;
            } else {
                oOutput.innerHTML = "Error " + oReq.status + " occurred . <br>";
            }
        };

        oReq.open("POST", "../private/helpers/homeHelper.php", true);
        oReq.send(oData);

}
