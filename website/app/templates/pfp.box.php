<div class="pfp-box">
    <img src="<?= $_SESSION['pfp'] ?>" alt="pfp-image" class="pfp-img">
    <p class="username"><?= $_SESSION['username'] ?></p>
    <p class="user-bio"><?= $_SESSION['bio'] ?></p>
    <hr>
    <div class="user-rows">
        <p><span id="since"></span>
            <?php
            $created_since = $_SESSION['created_since'];
            if ($created_since->d !== 0) { ?>
                <?= $created_since->d; ?> <span id="days"></span>
            <?php } ?>
            <?php if ($created_since->m !== 0) { ?>
                <?= $created_since->m; ?> <span id="months"></span>
            <?php } ?>
            <?php if ($created_since->y !== 0) { ?>
                <?= $created_since->y; ?> <span id="years"></span>
            <?php } ?>
            <?php if ($created_since->d === 0 && $created_since->m === 0 && $created_since->y === 0) { ?>
                <span id="recently"></span>
            <?php } ?>
        </p>
        <p>Posts counter soon</p>
        <p>Comments counter soon</p>
        <p>joined spaced soon</p>
    </div>
    <hr>

</div>