window.onload = function(){

  if (window.matchMedia("(max-width: 700px)").matches) {
    var tg = document.getElementById("toggle");
    var nav = document.getElementById("navigation");
    var content = document.querySelector('.container');
    tg.classList.toggle("on");
    content.classList.toggle("active");
    nav.classList.toggle("active");
  }

document.getElementById("toggle").addEventListener("click", function() {
  var tg = document.getElementById("toggle");
  var nav = document.getElementById("navigation");
  var content = document.querySelector('.container');
  tg.classList.toggle("on");
  content.classList.toggle("active");
  nav.classList.toggle("active");
}, false);


var open = document.querySelectorAll(".post .opencomments");
var content = document.querySelectorAll('.comments');

for(var x=0; x<open.length; x++)
{
open[x].addEventListener("click", function() {
  var parent = this.parentNode.parentNode.className;
  document.querySelector('this.comments').classList.toggle("active");
});

}

};
