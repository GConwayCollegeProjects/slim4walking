
$(document).ready(function(){
  //
       $('.nav-tabs a').on('hide.bs.tab', function(e) {

           let origin = e.target.hash;
           let destination = e.relatedTarget.hash;

        let valid = true;
        switch(origin) {
            case "#routes":
                $("ul li").removeClass('active-tab').addClass('disabled-tab');
                break;
            case "#details":
                if(destination!=='#routes') {
                    let oRoute = document.getElementById('title');
                    let oDistance = document.getElementById('distance');
                    let oAscent = document.getElementById('ascent');
                    let oGridref = document.getElementById('gridref');
                    if (oRoute.value.length < 5) {
                        valid = false;
                    }
                    if (oDistance.value < 1) {
                        valid = false;
                    }
                    if (oAscent.value < 1) {
                        valid = false;
                    }

                    if (oGridref.value.length < 8) {
                        valid = false;
                    }
                }
                    break;

            case "#includes":
                valid = true;
                break;
        }

        if(valid===false) {
            e.preventDefault();
            document.getElementById('message').innerHTML = "Please complete all entries correctly - there are errors or omissions"
            setTimeout(() => { document.getElementById('message').innerHTML = ""; }, 3000);
        }
        else {
            document.getElementById('message').innerHTML = '';
            if(destination==='#routes') {
                $("ul li").removeClass('active-tab').addClass('disabled-tab');

            }

        }




    });


});

function showTab(tab){
    $("ul li").removeClass('disabled-tab').addClass('active-tab');
    $('.nav-tabs a[href="' + tab + '"]').tab('show');





}





function updateRightBox(x, y)
{
    console.log(y)

    let oRightBox = document.getElementById('routehome');

    oRightBox.innerHTML = "<h2 id='right_head' class='text-center'><strong>Text</strong> select / add</h2>\n"+

        "<div id='rightbox' style='max-height: 70%; max-width 70%; background-color: white;" +
        "font-size: x-small; overflow: auto; padding: 0 .5em; text-overflow: clip' ></div>"

    let oOutput = document.getElementById("rightbox");

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

    oReq.open("POST", "../app/helpers/includeHelper.php", true);
    oReq.send(oData);

}



