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
  image.crossOrigin = "Anonymous";
  var canvas = document.getElementById("canvas");
  var context = canvas.getContext("2d");
  context.drawImage(image, 0,0);
  var url = canvas.toDataURL();
  console.log(url);
  var preview = document.querySelector('#preview');
  preview.src = url;
};
