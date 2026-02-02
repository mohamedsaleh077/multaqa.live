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
                        <img src="${post.profile_picture ?? "/assets/default_pfp.svg"}" alt="">
                        <div>
                            <h2>${post.username}</h2>
                            <small>${post.created_at}</small>
                        </div>
                    </div>
                
                    <h3>${post.title}</h3>
                    <p>
                        ${post.body}
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