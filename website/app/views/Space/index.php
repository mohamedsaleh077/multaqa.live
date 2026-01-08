<?php
$data['name'] = ucfirst($data['name']);
$data['avatar'] = $data['avatar'] ?? "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fstatic.zerochan.net%2FKasane.Teto.full.4077055.jpg&f=1&nofb=1&ipt=71a75ef842321dce37c26a08f7afabc86da1b41be75a078beb4df64c06cb3aef";
$title = $data['name'] . " Space";
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
                        <img src="<?= $data['avatar'] ?>" alt="space-icon">
                        <div class="space-title-name">
                            <h1><?= $data['name'] ?> Space!</h1>
                            <p>Members: 324 <a href="#">Subscribe!</a></p>
                        </div>
                    </div>
                    <div class="left">
                        <button id="create-post-btn">Post</button>
                    </div>
                    <script>
                        $("#create-post-btn").click(function () {
                            $("#post-box").toggle();
                        })
                    </script>
                </div>
                <p><?= $data['description'] ?></p>
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
            <div class="post">
                <div class="post-head">
                    <img src="/assets/default_pfp.svg" alt="">
                    <div>
                        <h2>username</h2>
                        <small>2025-2-23 19:23:21</small>
                    </div>
                </div>
                <h3>Post Subject</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut commodi, dolore et excepturi minus
                    quia unde. Asperiores consectetur, culpa cum dolores eos esse et itaque nam numquam quisquam, quod
                    rerum.
                </p>
                <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fstatic.zerochan.net%2FKasane.Teto.full.4077055.jpg&f=1&nofb=1&ipt=71a75ef842321dce37c26a08f7afabc86da1b41be75a078beb4df64c06cb3aef" alt="media">
                <div class="post-footer">
                    <div class="left"><a href="#">share</a> . 15 <a href="#">comment</a></div>
                    <div class="right"><a href="#" class="font-bold">upvote</a> 121 <a href="#">downvote</a></div>
                </div>
            </div>
        </article>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/footer.php'; ?>

</div>
</body>
</html>