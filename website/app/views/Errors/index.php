<?php
header("HTTP/1.1 404 Not Found");
$title = "Error";
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/head.php';
?>
</head>
<body>
<div class="container">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/header.php'; ?>

    <div class="pagebody">
        <article>
            <?php if ($data === '404') { ?>
                <h1 id="err404"></h1>
            <?php } ?>
        </article>
    </div>
</div>
</body>
</html>