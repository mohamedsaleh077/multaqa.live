<div class="box">
    <h2 class="text-2xl">Join us now!</h2>
    <form action="/login/request" method="post">
        <input type="text" name="username" placeholder="username" maxlength="50" required id="usr">
        <input type="password" id="pwd" name="password" placeholder="password" maxlength="50" required>
        <div class="checkbox" id="chkbx">
            <input type="checkbox" id="showpwd" name="showpwd">
            <lable for="showpwd">
                show password
            </lable>
        </div>
        <div id="password-strength-status"></div>
        <ul class="pswd_info" id="passwordCriterion">
            <li data-criterion="length" class="invalid">more than 8 and less than 50 <strong>Characters</strong></li>
            <li data-criterion="capital" class="invalid">At least <strong>one capital letter</strong></li>
            <li data-criterion="small" class="invalid">At least <strong>one small letter</strong></li>
            <li data-criterion="number" class="invalid">At least <strong>one number</strong></li>
            <li data-criterion="special" class="invalid">At least <strong>one Specail Characters </strong></li>
        </ul>
        <button id="sbmt" disabled type="submit" class="disabled-btn">Sign Up</button>
    </form>
    <a href="/">I have already an account</a>
</div>

<script src="/scripts/pwd.show.js"></script>
<script>
    $('#pwd, #usr').keyup(function (event) {
        var password = $('#pwd').val(); /* your Password Field */
        let check = checkPasswordStrength(password);
        let usr = $('#usr').val();
        console.log(check);
        console.log(usr.length >= 3);
        if (check === 5 && usr.length >= 3) {
            $("#sbmt").prop("class", '');
            $("#sbmt").prop("disabled", false);
        } else {
            $("#sbmt").prop("class", 'disabled-btn');
            $("#sbmt").prop("disabled", true);
        }
    });
</script>