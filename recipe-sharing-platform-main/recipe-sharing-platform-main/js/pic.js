









//////////////upload/////////////////

let img = document.getElementById('imginput') 

document.getElementById('imgContainer').addEventListener('click', function () { 
    imginput.click();       
});

//////////////////////////////img_display//////////////////////////////
imginput.addEventListener('change', function (event) {
    let reader = new FileReader();
    reader.readAsDataURL(event.target.files[0]);
    reader.onload = function() {
        imgContainer.innerHTML = '<img src="' + reader.result + '">';
    }

});

///////////////////////////////////////////
