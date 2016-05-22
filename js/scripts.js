/**
 * if the aside is out, move it in, else move it out.
 */
function slider(button, sidebar) {

    if(document.defaultView.getComputedStyle(button).left == "320px") {
        button.style.left = "0"
        sidebar.style.left = "-320px";
    }
    else {
        button.style.left = "320px"
        sidebar.style.left = "0px";
    }
}

function setTab(id) {
    // set all the forms to display:none
    var forms = document.getElementsByClassName('form-container');
    for(var i = 0; i < forms.length; i++) {
        forms[i].style.display = "none";
    }
    
    //set the active form to display:block
    document.getElementById(id).style.display = "block";
}

function deleteRow(id) {
    var element = document.getElementById('deleteinput');
    element.value = id;
}