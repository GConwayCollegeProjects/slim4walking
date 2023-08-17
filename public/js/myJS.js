
document.onselectstart = function() { return false; };

/*
window.onload = function() {
    let hello = document.getElementById('routelist')
    hello.addEventListener('click', function () {
       alert("clicked");
    });
}
*/


let rubbish = document.getElementById('rubbish');
isSwiping = false;

rubbish.addEventListener("touchend", moveTouch, false);

// Swipe Up / Down / Left / Right
var initialX = null;
var initialY = null;
var endX = null;
var endY = null;
var diffX = null;
var diffY = null;
let diff = 30;

function startTouch(e) {
    initialX = e.touches[0].clientX;
    initialY = e.touches[0].clientY;
    alert("touched");
}

function moveTouch(e) {
    if (initialX === null) {
        return;
    }

    if (initialY === null) {
        return;
    }

    endX = e.touches[0].clientX;
    endY = e.touches[0].clientY;

   diffX = initialX - endX;
   diffY = initialY - endY;



       alert("DiffX = "+diffX+"DiffY = "+diffY);



    if (Math.abs(diffX) > Math.abs(diffY)) {
        // sliding horizontally
        if (diffX > 0) {
            // swiped left

            if (document.body.style.backgroundColor === 'pink') {
                document.body.style.backgroundColor = 'lightblue';
            } else {
                document.body.style.backgroundColor = 'lightgreen';
            }
        }
        else {
            // swiped right

            if (document.body.style.backgroundColor === 'lightgreen') {
                document.body.style.backgroundColor = 'lightblue';
            } else {
                document.body.style.backgroundColor = 'pink';
            }


        }

    }

    initialX = null;
    initialY = null;

    e.preventDefault();
}

document.onselectstart = function() { return false; };


let demo = document.getElementById('list');
isSwiping = false;

demo.addEventListener('mousedown', (e) => {

    this.isSwiping = false;

});


demo.addEventListener('mousemove', (e) => {

    this.isSwiping = true;

});

demo.addEventListener('mouseup', (e) => {
    if (this.isSwiping && e.button === 0) {
        demo.innerHTML='SWIPED';

    } else {
        alert(e.target.id);

    }

    this.isSwiping = false;
});


demo.addEventListener('touchstart', (e) => {
    this.isSwiping = false;
});

demo.addEventListener('touchmove', (e) => {
    this.isSwiping = true;
});

demo.addEventListener('touchend', (e) => {
    if (this.isSwiping && e.button === 0) {
        demo.innerHTML='SWIPED';

    } else {
        alert(e.target.id);

    }
    this.isSwiping = false;
});
