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

        if (document.querySelector('#upload img').src != NULL) {
            video.pause();
        }
}, false);


document.getElementById("screenshot").addEventListener("click", function() {
  var canvas = document.getElementById("canvas");
  context = canvas.getContext("2d");
  context.drawImage(video, 0, 0, 400, 300);
  var dataURL = canvas.toDataURL();

});


document.getElementById("delescreen").addEventListener("click", function() {
    var context = document.getElementById("canvas");
    context = canvas.getContext("2d");
     context.clearRect(0, 0, 400, 300);
});

var images = document.querySelectorAll('#mask img');
var dest = document.querySelector('#img img');
for(var x=0; x<images.length; x++)
{
images[x].addEventListener("click", function() {
  var src = this.src;
  console.log(src);
  dest.src = src;
});
}

function save() {
    var image = document.querySelector('#img img');
    var savein = document.querySelector('#photo');
    image.crossOrigin = "Anonymous";
    var canvas = document.getElementById("canvas");
    var context = canvas.getContext("2d");
    context.drawImage(image, 0,0);
    var url = canvas.toDataURL();
    console.log(url);
    var preview = document.querySelector('#preview');
    preview.src = url;
    savein.value = url;
};

function imageIsLoaded(e) {
    document.querySelector('#upload img').src = e.target.result;
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
    the_return.innerHTML = this.value;
    var reader = new FileReader();
    reader.onload = imageIsLoaded;
    reader.readAsDataURL(this.files[0]);
});
