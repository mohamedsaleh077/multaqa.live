<?php
$title = 'Signup';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templets/head.php';
?>

<link rel="stylesheet" href="/assets/csp/password-strength.css">

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

<!-- Password Strenth Script -->
<script type="text/javascript" src="/assets/csp/password-strength.js"></script>

</head>
<body>
<div class="container">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templets/header.php'; ?>

    <div class="pagebody">
        <aside>
            <div class="box text-left">
                <h2>Tips</h2>
                <ul class="list-disc p-2 m-2">
                    <li>Username must be between 3 and 50 characters, no special characters except _ </li>
                    <li>Password must be more than 8 and less than 15 characters and have Upper,
                        smaller, number and special character.</li>
                    <li>Password maximum is 255 char</li>
                    <li>We are working on emails for verifications and reset password as a future plan.</li>
                    <li>2FA codes are coming soon.</li>
                </ul>
            </div>
        </aside>
        <article>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templets/signup.box.php'; ?>
        </article>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templets/footer.php'; ?>

</div>
</body>
</html>