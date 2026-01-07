<div class="box justify-center text-center items-center">
    <h2 id="LoginTitle" class="text-2xl"></h2>
    <form action="/login/" method="post">
        <input type="text" name="username" id="usr" maxlength="50">
        <input type="password" id="pwd" name="password"  maxlength="50">
        <div class="checkbox" id="chkbx">
            <input type="checkbox" id="showpwd" name="showpwd">
            <lable for="showpwd" id="ShowPassWd">
            </lable>
        </div>

<!--        Captcha-->
        <div class="box">
            <p id="Captcha-title"></p>
            <img src="/Captcha/img" alt="captcha-image" class="img-captcha">
            <div class="captcha">
                <input type="text" name="captcha" id="captcha-input" maxlength="5">
                <button type="button" id="reload-captcha"></button>
            </div>
        </div>

        <button type="submit" id="Login-btn"></button>
    </form>
    <a id="NoAccount" href="/Signup/"></a>
</div>

<script src="/scripts/pwd.show.js"></script>
<script>
    $("#reload-captcha").click(function () {
        d = new Date();
        $("#captcha").attr("src", "/Captcha/img?"+d.getTime());
    })
</script>