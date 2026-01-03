-- Lookup Tables
-- items types
CREATE TABLE IF NOT EXISTS `types`
(
    `id`         INTEGER      NOT NULL AUTO_INCREMENT,
    `name`       VARCHAR(255) NOT NULL UNIQUE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

-- reports types
CREATE TABLE IF NOT EXISTS `report_types`
(
    `id`         INTEGER      NOT NULL AUTO_INCREMENT,
    `name`       VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

-- upvote and downvote
CREATE TABLE IF NOT EXISTS `reaction_types`
(
    `id`         INTEGER     NOT NULL AUTO_INCREMENT,
    `name`       VARCHAR(50) NOT NULL UNIQUE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

-- spaces categories
CREATE TABLE IF NOT EXISTS `categories`
(
    `id`         INTEGER      NOT NULL AUTO_INCREMENT,
    `name`       VARCHAR(255) NOT NULL UNIQUE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_category_name` (`name`)
);

-- main tables
-- users
CREATE TABLE IF NOT EXISTS `users`
(
    `id`                INTEGER      NOT NULL AUTO_INCREMENT,
    `admin`             BOOLEAN      NOT NULL DEFAULT False,
    `username`          VARCHAR(50)  NOT NULL UNIQUE,
    `password_hash`     VARCHAR(255) NOT NULL,
    `profile_picture`   VARCHAR(255),
    `bio`               VARCHAR(255),
    `two_factor_secret` VARCHAR(255),
    `created_at`        TIMESTAMP             DEFAULT CURRENT_TIMESTAMP,
    `updated_at`        TIMESTAMP             DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at`        TIMESTAMP    NULL     DEFAULT NULL,
    PRIMARY KEY (`id`),
    INDEX `idx_users_username` (`username`)
);

-- spaces aka groups
CREATE TABLE IF NOT EXISTS `spaces`
(
    `id`          INTEGER      NOT NULL AUTO_INCREMENT,
    `category_id` INTEGER,
    `name`        VARCHAR(255) NOT NULL,
    `description` TEXT,
    `cover_image` VARCHAR(255),
    `avatar`      VARCHAR(255),
    `created_at`  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at`  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_spaces_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
    INDEX `idx_spaces_name` (`name`)
);

-- posts on spaces
CREATE TABLE IF NOT EXISTS `posts`
(
    `id`         INTEGER      NOT NULL AUTO_INCREMENT,
    `user_id`    INTEGER      NOT NULL,
    `space_id`   INTEGER      NOT NULL,
    `title`      VARCHAR(255) NOT NULL,
    `body`       TEXT,
    `is_pinned`  BOOLEAN      NOT NULL DEFAULT False,
    `score`      INTEGER      NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP             DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP             DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP    NULL     DEFAULT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_posts_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_posts_space` FOREIGN KEY (`space_id`) REFERENCES `spaces` (`id`) ON DELETE CASCADE,
    FULLTEXT INDEX `idx_posts_search` (`title`, `body`)
);

-- comments and replays
CREATE TABLE IF NOT EXISTS `comments`
(
    `id`          INTEGER   NOT NULL AUTO_INCREMENT,
    `user_id`     INTEGER   NOT NULL,
    `post_id`     INTEGER   NOT NULL,
    `reply_to_id` INTEGER            DEFAULT NULL,
    `body`        TEXT      NOT NULL,
    `media_url`   VARCHAR(255),
    `score`       INTEGER   NOT NULL DEFAULT 0,
    `created_at`  TIMESTAMP          DEFAULT CURRENT_TIMESTAMP,
    `updated_at`  TIMESTAMP          DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at`  TIMESTAMP NULL     DEFAULT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_comments_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_comments_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_comments_reply` FOREIGN KEY (`reply_to_id`) REFERENCES `comments` (`id`) ON DELETE SET NULL,
    INDEX `idx_comments_post` (`post_id`)
);

-- reactions
CREATE TABLE IF NOT EXISTS `reactions`
(
    `user_id`        INTEGER NOT NULL,
    `react_type_id`  INTEGER NOT NULL,
    `entity_type_id` INTEGER NOT NULL,
    `ref_id`         INTEGER NOT NULL,
    `created_at`     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at`     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`user_id`, `entity_type_id`, `ref_id`),
    CONSTRAINT `fk_reacts_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_reacts_type` FOREIGN KEY (`react_type_id`) REFERENCES `reaction_types` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_reacts_entity` FOREIGN KEY (`entity_type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE
);

-- notifications
CREATE TABLE IF NOT EXISTS `notifications`
(
    `id`           INTEGER      NOT NULL AUTO_INCREMENT,
    `recipient_id` INTEGER      NOT NULL,
    `actor_id`     INTEGER      NOT NULL,
    `type_id`      INTEGER      NOT NULL,
    `ref_id`       INTEGER      NOT NULL,
    `title`        VARCHAR(255) NOT NULL,
    `body`         VARCHAR(255),
    `is_read`      BOOLEAN      NOT NULL DEFAULT False,
    `created_at`   TIMESTAMP             DEFAULT CURRENT_TIMESTAMP,
    `updated_at`   TIMESTAMP             DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_notif_recipient` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_notif_actor` FOREIGN KEY (`actor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_notif_entity` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE
);

-- uploads table
CREATE TABLE IF NOT EXISTS `uploads`
(
    `id`             INTEGER      NOT NULL AUTO_INCREMENT,
    `user_id`        INTEGER      NOT NULL,
    `filename`       VARCHAR(255) NOT NULL UNIQUE,
    `entity_type_id` INTEGER      NOT NULL,
    `ref_id`         INTEGER      NOT NULL,
    `created_at`     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at`     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_uploads_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_uploads_entity` FOREIGN KEY (`entity_type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE
);

-- reports
CREATE TABLE IF NOT EXISTS `reports`
(
    `id`             INTEGER NOT NULL AUTO_INCREMENT,
    `reporter_id`    INTEGER NOT NULL,
    `report_type_id` INTEGER NOT NULL,
    `entity_type_id` INTEGER NOT NULL,
    `ref_id`         INTEGER NOT NULL,
    `body`           TEXT    NOT NULL,
    `created_at`     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at`     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_reports_user` FOREIGN KEY (`reporter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_reports_type` FOREIGN KEY (`report_type_id`) REFERENCES `report_types` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_reports_entity` FOREIGN KEY (`entity_type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE
);

-- saved items
CREATE TABLE IF NOT EXISTS `saved_items`
(
    `user_id`        INTEGER NOT NULL,
    `entity_type_id` INTEGER NOT NULL,
    `ref_id`         INTEGER NOT NULL,
    `created_at`     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at`     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`user_id`, `entity_type_id`, `ref_id`),
    CONSTRAINT `fk_saved_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_saved_entity` FOREIGN KEY (`entity_type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE
);