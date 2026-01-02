<div class="box justify-center text-center items-center">
    <h2 id="LoginTitle" class="text-2xl"></h2>
    <form action="/login/" method="post">
        <input type="text" name="username" placeholder="username" maxlength="50">
        <input type="password" id="pwd" name="password" placeholder="password" maxlength="50">
        <div class="checkbox" id="chkbx">
            <input type="checkbox" id="showpwd" name="showpwd">
            <lable for="showpwd" id="ShowPassWd">
            </lable>
        </div>
        <button type="submit" id="Login-btn"></button>
    </form>
    <a id="NoAccount" href="/Signup/"></a>
</div>

<script src="/scripts/pwd.show.js"></script>