function addMessage(x){
    let message = document.getElementById("message");
    x="<br>"+x;
    message.innerHTML = message.innerHTML.concat(x);
}


function fillRightbox(x)
{
    var right = document.getElementById("right-container");
    var left =  document.getElementById("left-container");
    $.ajax({
        type: 'POST',
        url: '../private/src/Rightbox.php',
        data: {
            'val': x,
        },
        success: function(r){
            if(x===3) {
                left.innerHTML = "";
                left.style.backgroundColor = '#ffffff';
               left.style.visibility = 'hidden';
            }
            if (r!=="blank") {

                right.innerHTML = r;
            }
        }
    });

}

function fillLeftbox(x)
{
    var left = document.getElementById("left-container");
    $.ajax({
        type: 'POST',
        url: '../private/src/Leftbox.php',
        data: {
            'val': x,
        },
        success: function(l){
                if(x===2) {
                    left.value = "";
                    left.style.backgroundColor = 'none'
                    left.style.visibility = 'hidden';
                }
                    else {
                    left.innerHTML = l;
                    left.style.visibility = 'visible';
                }

                if (1!==null){
                    left.style.backgroundColor = '#f2f2f2';
                    }
                    array = [8, 13, 14, 15, 16,17, 18];
                    if (array.includes(x)) {
                        initTiny();
                }
            }

    });
}

function load_ifrm() {
    var site = "app/u/loadCropper.php"
    var ifrm = document.getElementsByName('cropper')[0]
    ifrm.height = '600px'
    ifrm.width = '800px'
    ifrm.src = site
    ifrm.style.zindex = '999'
    ifrm.style.border = 'solid'

}

function close_ifrm() {
    var site = ""
    var ifrm = document.getElementsByName('cropper')[0]
    ifrm.height = ''
    ifrm.width = ''
    ifrm.src = site
    ifrm.style.zindex = '999'
    ifrm.style.border = 'none'
    reload();
}

function initTiny(){
    tinymce.init({
        selector: '#tiny',
        width: 420,
        height: 420,
        plugins: 'advlist',
        content_css: '../ass/res/css/mycss.css'
    })
}
function goHome(){

    location.reload()
}


function reload() {

   location.reload()

}



function hello3() {
    console.log("hello3");
    //location.href = '/test';
    return  "";
}

function getTest(id) {

    location.href = '/test';
    return location.href;

}



function getOption(id) {
 
    console.log(id);

    const url = "/" + id;

    return location.href = url ;



}


// Manipulation of Boostrap Toggleable Tabs ============================================================================
// Identifies actions based on tab clicked
$(document).on( 'shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    var target = $(e.target).attr("href");
    let tiny2 = document.getElementById('tiny2');
    let tiny3 = document.getElementById('tiny3');
    var text = tinyMCE.activeEditor.getContent();
    if (target !== '#Text' && target !== '#HTML') {
        tiny3.value = text;
        tiny2.value = text;
                }
            else{
        if (target === '#HTML') {
          tiny2.value = text;
          tiny3.value = text;
        }
            else{
            text = tiny3.value;
            tinyMCE.activeEditor.setContent(text);

        }

    }

});

function htmlSave(){
    let tiny2 = document.getElementById('tiny2');
    let tiny3 = document.getElementById('tiny3');
    tiny3.value = tiny2.value;


}

// Gets image from the image library - may use for galleries
function getImage(){
      $("select").imagepicker({
        hide_select : true,
        show_label  : false
    })
}

function getSelect() {
    var file=document.getElementById('xyz')
    file.click();

} false;

function getStored(i) {
    alert('clicked');

}

$("img").click(function(){
     var image = $(this).attr("id");
  var input =  document.getElementById('stored');
  input.value = image;
});

function testUpdate() {
    var input =  document.getElementById('ifile');
    input.value = 'updated';

}

function pasteLink(x) {

    let oOutput = document.getElementById(x);
    let text = navigator.clipboard.readText()
    alert(text);
}

