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

        $.get('/Space/api/1/', function(data) {
            $("#space_avatar").attr('src', `${data.space.avatar ?? '/uploads/jpeg/avatar'}`);
            $("#space_name").text(data.space.name)
            $("#member_count").text(data.users_count?.c ?? '0')
            $("#space_description").text(data.space.description)

            if (data.posts[0]) {
                (data.posts).forEach((post, id) => {
                    $(`
                        <div class="post">
                            <div class="post-head">
                                <img src="${data.posts[id].profile_picture ?? "/assets/default_pfp.svg"}" alt="">
                                <div>
                                    <h2>${data.posts[id].username}</h2>
                                    <small>${data.posts[id].created_at}</small>
                                </div>
                            </div>
                    
                            <h3>${data.posts[id].title}</h3>
                            <p>
                                ${data.posts[id].body}
                            </p>
                            <img src="/uploads/jpeg/cover" alt="media">
                            <div class="post-footer">
                                <div class="left"><a href="#">share</a> . 15 <a href="#">comment</a></div>
                                <div class="right"><a href="#" class="font-bold">upvote</a> 121 <a href="#">downvote</a></div>
                            </div>
                        </div>
                    `).appendTo("#posts-container");
                });
            } else {
                $("#posts-container").html("<h1 style='text-align: center; padding-top: 10px; font-weight: 400;'>No Posts</h1>");
            }
        });
    </script>
</body>
</html>