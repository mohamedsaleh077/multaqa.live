<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>-->
    <style type="text/tailwindcss">
        @theme {
            --primary-bg: #FA8843;
            --side-bg: #ffd960;
            --black-text: #000000;
            --white-text: #ffffff;
            --button-links: #e47900;
            --button-links-hover: #ffba65;
            --secound-bg: #FAF1DD;

        }
        .container {
            @apply max-w-screen-lg mx-auto bg-(--secound-bg);
        }

        header {
            @apply flex text-(--white-text) bg-(--primary-bg) p-5
        }

        h1 {
            @apply font-sans text-4xl font-bold
        }

        .header-links *{
            @apply text-xs text-(--white-text)
        }

        a {
            @apply hover:underline text-(--button-links)
        }

        .pagebody {
            @apply flex
        }

        aside {
            @apply bg-(--side-bg) p-5 m-2 w-96 flex-none
        }

        article {
            @apply p-2 m-2 flex-auto
        }

        .box {
            @apply p-2 flex flex-col bg-(--secound-bg) border-2 border-solid border-(--black-text)
            justify-center text-center items-center
        }

        input {
            @apply border-2 border-solid m-2 block bg-(--white-text) p-2 w-64
        }

        .checkbox {
            @apply flex text-left items-center cursor-pointer
        }

        .checkbox input {
            @apply w-auto flex-none
        }

        submit, button {
            @apply p-3 bg-(--button-links) m-4 block hover:bg-(--button-links-hover) active:bg-(--button-links) w-fit
            cursor-pointer text-(--white-text)
        }
    </style>
    <title>Multaqa.live</title>
</head>
<body>
<div class="container">
    <header>
        <div class="flex-auto">
            <h1>Multaqa.live</h1>
            <h2>forms is alive again!</h2>
        </div>
        <div class="header-links">
            <a href="">Login</a> |
            <a href="">Register</a> |
            <a href="">logout</a>
        </div>
    </header>
    <div class="pagebody">
        <aside>
            <div class="box">
                <h2 class="text-2xl">Let's Have Fun!</h2>
                <form action="" method="post">
                    <input type="text" name="username" placeholder="username" maxlength="50">
                    <input type="password" id="pwd" name="password" placeholder="password" maxlength="50">
                    <div class="checkbox" id="chkbx">
                        <input type="checkbox" id="showpwd" name="showpwd">
                        <lable for="showpwd">
                            show password
                        </lable>
                    </div>
                    <submit>Login</submit>
                </form>
                <a href="">Create an account</a>
            </div>
        </aside>
        <article>
            I am the master
        </article>
    </div>
</div>

<script>
    let checked = false;
    const checkBoxDiv = document.getElementById('chkbx');
    const checkBox = document.getElementById('showpwd');
    const pwd = document.getElementById('pwd');

    checkBoxDiv.addEventListener("click", function (){
        if (checked === false){
            checked = true;
            checkBox.checked = true;
            pwd.type = 'text';
        }else{
            checked = false;
            checkBox.checked = false;
            pwd.type = 'password';
        }
    })
</script>
</body>
</html>