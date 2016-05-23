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

function showLoginScreen() {
    document.getElementsByClassName('login-window')[0].style.display = "block";
    return;
}

function showLogoutScreen() {
    if(confirm("are you sure you want to logout?")) {
        post('/', {query: 'logout'});
    }
}

function post(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();
}