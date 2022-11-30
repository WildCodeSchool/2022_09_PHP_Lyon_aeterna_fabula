function preventBack() { window.history.forward(); } setTimeout("preventBack()", 0); window.onunload = function () { null };


// Show historic detail on click
const accordion = document.getElementsByClassName('container');

for (i=0; i<accordion.length; i++) {
  accordion[i].addEventListener('click', function () {
    this.classList.toggle('active')
  })
}
