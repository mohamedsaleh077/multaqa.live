<?php
$title = 'Signup';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/head.php';
?>

<link rel="stylesheet" href="/assets/csp/password-strength.css">

<!-- Password Strenth Script -->
<script type="text/javascript" src="/assets/csp/password-strength.js"></script>

</head>
<body>
<div class="container">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/header.php'; ?>

    <div class="pagebody">
        <aside>
            <div class="box text-left">
                <h2 id="Tips"></h2>
                <ul class="list-disc p-2 m-2">
                    <li id="usernameTips"></li>
                    <li id="passwordTips"></li>
                    <li id="passwordMaxTips"></li>
                    <li id="emailComeSoonTips"></li>
                    <li id="towFAcomeSoonTips"></li>
                </ul>
            </div>
        </aside>
        <article>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/signup.box.php'; ?>
        </article>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/footer.php'; ?>

</div>
</body>
</html>