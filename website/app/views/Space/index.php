<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/head.php';
?>
</head>
<body>
<div class="container">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/header.php'; ?>
    <div class="pagebody">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/general.aside.php'; ?>
        <article>
            <div class="space-title">
                <div class="space-title-header">
                    <div class="right">
                        <img src="/uploads/jpeg/avatar" id="space_avatar" alt="space-icon">
                        <div class="space-title-name">
                            <h1 id="space_name"></h1>
                            <p>Members: <span id="member_count"></span> <a href="#">Subscribe!</a></p>
                            <h3 id="space_description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam, labore.</h3>
                        </div>
                    </div>
                    <div class="left">
                        <button id="create-post-btn">Post</button>
                    </div>

                </div>
                <p></p>
            </div>
            <hr>
            <div class="box post-box" id="post-box">
                <form action="">
                    <input type="text" placeholder="Subject">
                    <textarea name="" id="" cols="30" rows="5"></textarea>
                    <input type="file" name="" id="" multiple
                           accept="image/jpeg image/png image/gif image/jpg image/webp video/mp4 video/webm ">
                    <button id="post-btn" type="submit">Post!</button>
                </form>
            </div>
            <hr>
            <div id="posts-container">
                
            </div>
        </article>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/footer.php'; ?>
</div>
    <script>
        $("#create-post-btn").click(function () {
            $("#post-box").toggle();
        })
    </script>
    <script src="/website/public/scripts/space-index.js"></script>
</body>
</html>