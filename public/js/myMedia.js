//==============================================================
// Save Media
// This function automates the saving of a 'new' media file from the users
// computer. It also updates the "to be used" fields for file and caption
//==============================================================
function saveMedia(x) {

    let oCaption = document.getElementById(x + "Caption");
    if (oCaption.value === "") {
        oCaption.style.borderStyle = "dotted";
        oCaption.style.borderColor = "red";
        oCaption.focus();
        return;
    } else {
        oCaption.style.borderStyle = 'solid';
        oCaption.style.borderWidth = 'thin';
        oCaption.style.borderColor = '#4e555b';
    }


    let oEntry = document.getElementById(x + 'Entry');

    let oFile = document.getElementById(x + "File");
    let oUpload = document.getElementById(x + "Upload");
    let oText1 = document.getElementById(x + "Text1");
    let oText2 = document.getElementById(x + "Text2");
    let oClear = document.getElementById(x + "Clear");


    oUpload.style.visibility = 'hidden';
    oEntry.style.visibility = 'hidden';


    let oOutput = document.getElementById(x + "Output");

    var oData = new FormData();

    oData.append('submit', 'submit');
    oData.append('file', oEntry.files[0]);
    oData.append('caption', oCaption.value);
    oData.append('type', x);


    var oReq = new XMLHttpRequest();


    oReq.onload = function () {
        if (oReq.status === 200 && oReq.readyState === 4) {
            oUpload.style.visibility = 'hidden';
            oEntry.style.visibility = 'hidden';
            oText1.style.visibility = 'hidden';
            oText2.style.visibility = 'hidden';
            oCaption.readOnly = true;
            oFile.value = oReq.response;
            switch(x) {
                case "i":
                    src = "../data/images/" + oFile.value;
                    oOutput.innerHTML = "<img style='z-index: 999' src='" + src + "'" + " height='200px'  alt=''> ";
                    break;
                case "v":
                    src = "../data/videos/" + oFile.value;
                    ext = oFile.value.split('.')[1];
                    oOutput.innerHTML = "<video height='200px'  preload='metadata'><source src='"+src+"' type='video/"+ext+"'></video>";
                    break;
                case "p":
                    src = "../data/pdfs/" + oFile.value;
                    oOutput.innerHTML = "<img style='z-index: 999' src='img/pdf.png' height='200px'  alt=''> ";
                    break;
                case "m":
                    src = "../data/maps/" + oFile.value;
                    oOutput.innerHTML = "<img style='z-index: 999' src='img/smiley.png' height='200px'  alt=''> ";
                    break;
            }
            oClear.style.visibility = 'visible';
        } else {
            oOutput.innerHTML = "Error " + oReq.status + " occurred when trying to upload your file. <br>";
        }
    };

    oReq.open("POST", "../app/helpers/mediaHandler.php", true);
    oReq.send(oData);

}

function showUpload(x, y) {
    let oUpload = document.getElementById((x + "Upload"));
    let oSelect = document.getElementById((x + "Select"));
    let oCaption = document.getElementById((x + "Caption"));
   oUpload.style.visibility = 'visible';
   oSelect.style.visibility = 'hidden';
    let z = y.substring(y.lastIndexOf('\\')+1);
    z = z.substring(0, z.lastIndexOf('.'))
    oCaption.value = z;
}


function useAjax(url, callback) {
    var oReq = new XMLHttpRequest();
    oReq.onreadystatechange = function () {
        if (oReq.status === 200 && oReq.readyState === 4) {
            callback(this);
        }

    };
    oReq.open("POST", url, true);
    oReq.send();
}


function clearMedia(x) {
    let oEntry = document.getElementById(x + 'Entry');
    let oCaption = document.getElementById(x + "Caption");
    let oFile = document.getElementById(x + "File");
    let oUpload = document.getElementById(x + "Upload");
    let oSelect = document.getElementById(x + "Select");
    let oClear = document.getElementById(x + "Clear");
    let oText1 = document.getElementById(x + "Text1");
    let oText2 = document.getElementById(x + "Text2");
    let oOutput = document.getElementById(x + "Output");
    oFile.value = "";
    oCaption.value = "";
    oEntry.value = "";
    oUpload.style.visibility = 'hidden';
    oEntry.style.visibility = 'visible';
    oText1.style.visibility = 'visible';
    oText2.style.visibility = 'visible';
    oSelect.style.visibility = 'visible';
    oClear.style.visibility = 'hidden';
    oOutput.innerHTML = "";
}
// ===============================================================================================================
function fetchMedia(x) {

    let oEntry = document.getElementById(x + "Entry");
    let oCaption = document.getElementById(x + "Caption");
    let oFile = document.getElementById(x + "File");
    let oUpload = document.getElementById(x + "Upload");
    let oSelect = document.getElementById(x + "Select");
    let oClear = document.getElementById(x + "Clear");
    let oText1 = document.getElementById(x + "Text1");
    let oText2 = document.getElementById(x + "Text2");
    let oText3 = document.getElementById(x + "Text3");
    let oOutput = document.getElementById(x + "Output");
    oFile.value = "";
    oCaption.value = "";
    oEntry.value = "";
    oUpload.style.visibility = 'hidden';
    oEntry.style.visibility = 'hidden';
    oText1.style.visibility = 'hidden';
    oText2.style.visibility = 'hidden';
    oText3.style.visibility = 'hidden';
    oClear.style.visibility = 'hidden';
    oOutput.innerHTML = "";


    let oData = new FormData();
    oData.append('submit', 'submit');
    oData.append('type', x);
    let oReq = new XMLHttpRequest();
    oReq.onload = function () {
        if (oReq.status === 200 && oReq.readyState === 4) {
           oCaption.readOnly = true;
            oOutput.innerHTML = oReq.response;
            oSelect.style.visibility = 'hidden';
        } else {
            oOutput.innerHTML = "Error " + oReq.status + " occurred when trying to upload your file. <br>";
        }
    };
    if (x==='v'){
        oOutput.innerHTML = "Loading - please wait!";
    }
    oReq.open("POST", "../app/helpers/fetchMedia.php", true);
    oReq.send(oData);
}
//=====================================================================================================================
function getCaption(value) {
    x = value.substr(0,1);
    id = value.substr(1);
    let oFile = document.getElementById(x + "File");
    let oCaption = document.getElementById(x + "Caption");
    let oClear = document.getElementById(x + "Clear");
    let oOutput = document.getElementById(x + "Output");
    let oText3 = document.getElementById(x + "Text3");
    let oData = new FormData();
    oData.append('submit', 'submit');
    oData.append('id', id);
    oData.append('type', x);
    let oReq = new XMLHttpRequest();
    oReq.onload = function () {
        if (oReq.status === 200 && oReq.readyState === 4) {
           oText3.style.visibility = 'hidden';
           oCaption.readOnly = false;
            oCaption.value = oReq.response;
          oClear.style.visibility = 'visible'
          oFile.value = id;
            switch(x) {
                case "i":
                    src = "../data/images/" + oFile.value;
                    oOutput.innerHTML = "<img  src='" + src + "'" + " height='200px'  alt=''> ";
                    break;
                case "v":
                    src = "../data/videos/" + oFile.value;
                    oOutput.innerHTML = "<video  src='" + src + "'" + " height='200px' preload='metadata' ><source src='.$src.' type='.$vidtype.'></video>";
                    break;
                case "p":
                    src = "../data/pdfs/" + oFile.value;
                    oOutput.innerHTML = "<img  src='img/pdf.png'" + " height='200px'  alt=''> ";
                    break;
                case "m":
                    src = "../data/maps/" + oFile.value;
                    oOutput.innerHTML = "<img  src='img/smiley.png'" + " height='200px'  alt=''> ";
                    break;
            }
        } else {
            oOutput.innerHTML = oOutput.innerHTML+"Error " + oReq.status + " occurred when trying to upload your file. <br>";
        }
    };
    if (x==='v'){
        oOutput.innerHTML = oOutput.innerHTML+"Loading - please wait!";
    }
    oReq.open("POST", "../app/helpers/fetchCaption.php", true);
    oReq.send(oData);
}
