// Get the modal
var modal = document.getElementsByClassName('modal');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    for (index = 0; index < modal.length; ++index) {
        if (event.target == modal[index]) {
            modal[index].style.display = "none";
        }
    }
}
