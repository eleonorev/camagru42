window.addEventListener("DOMContentLoaded", function() {
        // Grab elements, create settings, etc.
        var canvas = document.getElementById("canvas"),
                context = canvas.getContext("2d"),
                video = document.getElementById("video"),
                videoObj = { "video": true },
                errBack = function(error) {
                        console.log("Video capture error: ", error.code);
                };

        // Put video listeners into place
        if(navigator.getUserMedia) { // Standard
                navigator.getUserMedia(videoObj, function(stream) {
                        video.src = stream;
                        video.play();
                }, errBack);
        } else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
                navigator.webkitGetUserMedia(videoObj, function(stream){
                        video.src = window.URL.createObjectURL(stream);
                        video.play();
                }, errBack);
        }
        else if(navigator.mozGetUserMedia) { // Firefox-prefixed
                navigator.mozGetUserMedia(videoObj, function(stream){
                        video.src = window.URL.createObjectURL(stream);
                        video.play();
                }, errBack);
        }
}, false);


document.getElementById("screenshot").addEventListener("click", function() {
  var canvas = document.getElementById("canvas");
  var canvas2 = document.querySelector("#img");
  var savein = document.querySelector('#photo');
  context = canvas.getContext("2d");
  context.drawImage(video, 0, 0, 400, 300);
  var dataURL = canvas.toDataURL();
  savein.value = dataURL;
  document.querySelector("#screenshot").classList.add("disable");
document.querySelector("#delescreen").classList.remove("disable");
document.querySelector("#saveimg").classList.remove("disable");

});


document.getElementById("delescreen").addEventListener("click", function() {
    var context = document.getElementById("canvas");
    context = canvas.getContext("2d");
     context.clearRect(0, 0, 400, 300);
     document.querySelector("#delescreen").classList.add("disable");
       document.querySelector("#screenshot").classList.remove("disable");
       document.querySelector("#saveimg").classList.add("disable");

});

var images = document.querySelectorAll('#mask img');
var dest = document.querySelector('#img img');
for(var x=0; x<images.length; x++)
{
images[x].addEventListener("click", function() {
  var canvas = document.querySelector("#img");
  var savein2 = document.querySelector('#maskdata');
  context = canvas.getContext("2d");
  context.clearRect(0, 0, 400, 300);
  context.drawImage(this, 0, 0, this.width * 4,this.height * 4);
  var dataURL2 = canvas.toDataURL();
  var src = this.src;
  dest.src = src;
  savein2.value = dataURL2;
  document.querySelector("#screenshot").classList.remove("disable");
});
}

function imageIsLoaded(e) {
    var context = document.getElementById("canvas");
    var savein = document.querySelector('#photo');

    context = canvas.getContext("2d");
  var upload = document.querySelector('#upload img')
  upload.src = e.target.result;
    context.drawImage(upload, 0,0);
    var url2 = canvas.toDataURL();
    savein.value = url2;
};

document.querySelector("html").classList.add('js');

var fileInput  = document.querySelector( ".input-file" ),
    button     = document.querySelector( ".input-file-trigger" ),
    the_return = document.querySelector(".file-return");

button.addEventListener( "keydown", function(event) {
    if (event.keyCode == 13 || event.keyCode == 32) {
        fileInput.focus();
    }
});

button.addEventListener( "click", function(event) {
    fileInput.focus();
    return false;
});

fileInput.addEventListener( "change", function(event) {
    var reader = new FileReader();
    reader.onload = imageIsLoaded;
    reader.readAsDataURL(this.files[0]);
});
