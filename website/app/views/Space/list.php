<?php
$title = "All Spaces";
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/head.php';
?>
</head>
<body>
<div class="container">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/header.php'; ?>

    <div class="pagebody">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/general.aside.php'; ?>
        <article>
            <h1>Discover Spaces!</h1>
            <div class="spaces-list">
                AJAx would handle it/uploads/jpeg/test
                <div class="space-list-item">
                    <img src="/uploads/jpeg/test"
                         alt="space-icon">
                    <div class="">
                        <h2>Space name</h2>
                        <p>Members: 324</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam architecto asperiores
                            dolore dolorum ducimus ea esse et eveniet in iure laboriosam, nisi, nulla perferendis,
                            perspiciatis porro recusandae ullam voluptates voluptatibus!</p>
                    </div>
                    <button>Join</button>
                </div>
                <div class="space-list-item">
                    <img src="/uploads/jpeg/test"
                         alt="space-icon">
                    <div class="">
                        <h2>Space name</h2>
                        <p>Members: 324</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam architecto asperiores
                            dolore dolorum ducimus ea esse et eveniet in iure laboriosam, nisi, nulla perferendis,
                            perspiciatis porro recusandae ullam voluptates voluptatibus!</p>
                    </div>
                    <button>Join</button>
                </div>

                    <div class="space-list-item">
                        <img src="/uploads/jpeg/test"
                             alt="space-icon">
                        <div class="">
                            <h2><a href="/Space/details/1">Space name</a></h2>
                            <p>Members: 324</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam architecto asperiores
                                dolore dolorum ducimus ea esse et eveniet in iure laboriosam, nisi, nulla perferendis,
                                perspiciatis porro recusandae ullam voluptates voluptatibus!</p>
                        </div>
                        <button>Join</button>
                    </div>
            </div>
        </article>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/footer.php'; ?>

</div>
</body>
</html>