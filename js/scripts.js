/**
 * if the aside is out, move it in, else move it out.
 */
function slider(button, sidebar) {

    if(document.defaultView.getComputedStyle(button).left == "320px") {
        button.style.left = "0"
        sidebar.style.left = "-320px";
        setCookie('aside', '0');
    }
    else {
        button.style.left = "320px"
        sidebar.style.left = "0px";
        setCookie('aside', '1');
    }
}
/* set the tab shown on the aside */
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
    if(confirm('Are you sure you wish to delete this row?')) {
        var element = document.getElementById('deleteinput');
        element.value = id;
        return true;
    }
    return false;
}
/* show the login popup screen. */
function showLoginScreen() {
    document.getElementsByClassName('login-window')[0].style.display = "block";
    return;
}
/* show the are you sure popup screen, if yes logout. */
function showLogoutScreen() {
    if(confirm("are you sure you want to logout?")) {
        post('/', {query: 'logout'});
    }
}
/* send a post request to the server */
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

/* changes the buttons and target for the add/search form.
   it is done this way instead of 2 seperate forms to help with users accidentally typing in the wrong form.
*/
function setQueryFiled(text) {
    document.getElementById('add-search-query-field').value = text;
}

/* get cookies and set them on the site. */
function loadCookies() {
    document.getElementById('name').value = getCookie('name');
    document.getElementById('brand').selectedIndex = getCookie('brand');
    document.getElementById('Type').selectedIndex = getCookie('type');
    document.getElementById('target').selectedIndex = getCookie('target');
    document.getElementById('condition').selectedIndex = getCookie('condition');
    document.getElementById('location').selectedIndex = getCookie('location');
}

function setCookie(name, value, days)
{
  if (days)
  {
    var date = new Date();
    date.setTime(date.getTime()+days*24*60*60*1000); // ) removed
    var expires = "; expires=" + date.toGMTString(); // + added
  }
  else
    var expires = "";
  document.cookie = name+"=" + value+expires + ";path=/"; // + and " added
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}