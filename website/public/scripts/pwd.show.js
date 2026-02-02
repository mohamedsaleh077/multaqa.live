let checked = false;
const checkBoxDiv = document.getElementById('chkbx');
const checkBox = document.getElementById('showpwd');
const pwd = document.getElementById('pwd');

checkBoxDiv.addEventListener("click", function () {
    if (checked === false) {
        checked = true;
        checkBox.checked = true;
        pwd.type = 'text';
    } else {
        checked = false;
        checkBox.checked = false;
        pwd.type = 'password';
    }
})

