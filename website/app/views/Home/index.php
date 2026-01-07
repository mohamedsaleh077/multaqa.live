<?php
$title = "Multaqa.live Home Page";
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/head.php';
?>
</head>
<body>
<div class="container">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/header.php'; ?>

    <div class="pagebody">
        <aside>
            <?php
            if (!isset($_SESSION['user'])) {
                require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/login.box.php';
            }
            ?>
        </aside>
        <article>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/landing.body.php'; ?>
        </article>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/footer.php'; ?>

</div>
</body>
</html>