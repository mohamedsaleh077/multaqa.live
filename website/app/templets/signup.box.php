<div class="box">
    <h2 id="SignupTitle" class="text-2xl"></h2>
    <form action="/login/request" method="post">
        <input type="text" name="username" placeholder="username" maxlength="50" required id="usr">
        <input type="password" id="pwd" name="password" placeholder="password" maxlength="50" required>
        <div class="checkbox" id="chkbx">
            <input type="checkbox" id="showpwd" name="showpwd">
            <lable id="ShowPassWd" for="showpwd">
            </lable>
        </div>
        <div id="password-strength-status"></div>
        <ul class="pswd_info" id="passwordCriterion">
            <li id="charLenForPwd" data-criterion="length" class="invalid"></li>
            <li id="UpperLetterPwd" data-criterion="capital" class="invalid"></li>
            <li id="LowerLetterPwd" data-criterion="small" class="invalid"></li>
            <li id="NumPwd" data-criterion="number" class="invalid"></li>
            <li id="SpCharPwd" data-criterion="special" class="invalid"></li>
        </ul>


<!--        Captcha-->
        <div class="box">
            <p id="Captcha-title"></p>
            <img src="/Captcha/img" alt="captcha-image" class="img-captcha">
            <div class="captcha">
                <input type="text" name="captcha" id="captcha-input" maxlength="5">
                <button type="button" id="reload-captcha"></button>
            </div>
        </div>

        <button id="signup-btn" disabled type="submit" class="disabled-btn"></button>
    </form>
    <a id="accountAlready" href="/"></a>
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
            $("#signup").prop("class", '');
            $("#signup").prop("disabled", false);
        } else {
            $("#signup").prop("class", 'disabled-btn');
            $("#signup").prop("disabled", true);
        }
    });


    $("#reload-captcha").click(function () {
        d = new Date();
        $("#captcha").attr("src", "/Captcha/img?"+d.getTime());
    })

</script>