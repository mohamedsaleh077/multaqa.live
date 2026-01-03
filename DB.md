# multaqa documentation
## Summary

- [Introduction](#introduction)
- [Database Type](#database-type)
- [Table Structure](#table-structure)
	- [types](#types)
	- [report_types](#report_types)
	- [categories](#categories)
	- [reaction_types](#reaction_types)
	- [user](#user)
	- [spaces](#spaces)
	- [posts](#posts)
	- [comments](#comments)
	- [reports](#reports)
	- [notifications](#notifications)
	- [uploads](#uploads)
	- [saved](#saved)
	- [reacts_on_posts](#reacts_on_posts)
- [Relationships](#relationships)
- [Database Diagram](#database-diagram)

## Introduction

## Database type

- **Database system:** MySQL
## Table structure

### types

| Name        | Type          | Settings                      | References                    | Note                           |
|-------------|---------------|-------------------------------|-------------------------------|--------------------------------|
| **id** | INTEGER | 🔑 PK, not null, unique, autoincrement | fk_types_id_uploads | |
| **name** | VARCHAR(255) | not null, unique |  | | 


### report_types

| Name        | Type          | Settings                      | References                    | Note                           |
|-------------|---------------|-------------------------------|-------------------------------|--------------------------------|
| **id** | INTEGER | 🔑 PK, not null, unique, autoincrement | fk_report_types_id_reports | |
| **type** | VARCHAR(255) | null |  | | 


### categories

| Name        | Type          | Settings                      | References                    | Note                           |
|-------------|---------------|-------------------------------|-------------------------------|--------------------------------|
| **id** | INTEGER | 🔑 PK, not null, unique, autoincrement | fk_categories_id_spaces | |
| **name** | VARCHAR(255) | null |  | | 


#### Indexes
| Name | Unique | Fields |
|------|--------|--------|
| categories_index_0 |  | name |
### reaction_types

| Name        | Type          | Settings                      | References                    | Note                           |
|-------------|---------------|-------------------------------|-------------------------------|--------------------------------|
| **id** | INTEGER | 🔑 PK, not null, unique, autoincrement |  | |
| **name** | VARCHAR(255) | null |  | | 


### user

| Name        | Type          | Settings                      | References                    | Note                           |
|-------------|---------------|-------------------------------|-------------------------------|--------------------------------|
| **id** | INTEGER | 🔑 PK, not null, unique, autoincrement |  | |
| **admin** | BOOLEAN | not null, default: False |  | |
| **username** | VARCHAR(50) | not null, unique |  | |
| **password_hash** | VARCHAR(50) | not null |  | |
| **profile_picture** | VARCHAR(255) | null |  | |
| **bio** | VARCHAR(255) | null |  | |
| **2FA** | VARCHAR(255) | null |  |future plan | 


#### Indexes
| Name | Unique | Fields |
|------|--------|--------|
| user_index_0 |  | username |
### spaces

| Name        | Type          | Settings                      | References                    | Note                           |
|-------------|---------------|-------------------------------|-------------------------------|--------------------------------|
| **id** | INTEGER | 🔑 PK, not null, unique, autoincrement |  | |
| **category_id** | INTEGER | null |  | |
| **name** | VARCHAR(255) | not null |  | |
| **describtion** | TEXT(65535) | null |  | |
| **cover_image** | VARCHAR(255) | null |  | |
| **avatar** | VARCHAR(255) | null |  | | 


#### Indexes
| Name | Unique | Fields |
|------|--------|--------|
| spaces_index_0 |  | name, describtion |
### posts

| Name        | Type          | Settings                      | References                    | Note                           |
|-------------|---------------|-------------------------------|-------------------------------|--------------------------------|
| **id** | INTEGER | 🔑 PK, not null, unique, autoincrement |  | |
| **user_id** | INTEGER | not null | fk_posts_user_id_user | |
| **space_id** | INTEGER | not null | fk_posts_space_id_spaces | |
| **title** | VARCHAR(255) | not null |  | |
| **body** | TEXT(65535) | null |  | |
| **pinned** | BOOLEAN | not null, default: False |  | |
| **score** | INTEGER | not null |  | | 


#### Indexes
| Name | Unique | Fields |
|------|--------|--------|
| posts_index_0 |  | body, title |
### comments

| Name        | Type          | Settings                      | References                    | Note                           |
|-------------|---------------|-------------------------------|-------------------------------|--------------------------------|
| **id** | INTEGER | 🔑 PK, not null, unique, autoincrement | fk_comments_id_user | |
| **user_id** | INTEGER | not null |  | |
| **post_id** | INTEGER | not null | fk_comments_post_id_posts | |
| **body** | TEXT(65535) | not null |  | |
| **media** | VARCHAR(255) | null |  | |
| **replay_on** | INTEGER | null |  | |
| **score** | INTEGER | not null |  | | 


#### Indexes
| Name | Unique | Fields |
|------|--------|--------|
| comments_index_0 |  | body |
### reports

| Name        | Type          | Settings                      | References                    | Note                           |
|-------------|---------------|-------------------------------|-------------------------------|--------------------------------|
| **id** | INTEGER | 🔑 PK, not null, unique, autoincrement |  | |
| **reported_item_id** | INTEGER | not null | fk_reports_reported_item_id_types | |
| **report_about_id** | INTEGER | not null |  | |
| **ref_id** | INTEGER | not null |  | |
| **user_id** | INTEGER | not null | fk_reports_user_id_user | |
| **body** | TEXT(65535) | not null |  | | 


#### Indexes
| Name | Unique | Fields |
|------|--------|--------|
| reports_index_0 |  | body |
### notifications

| Name        | Type          | Settings                      | References                    | Note                           |
|-------------|---------------|-------------------------------|-------------------------------|--------------------------------|
| **id** | INTEGER | 🔑 PK, not null, unique, autoincrement |  | |
| **type_id** | INTEGER | not null | fk_notifications_type_id_types | |
| **user_id** | INTEGER | not null | fk_notifications_user_id_user | |
| **auther_id** | INTEGER | not null | fk_notifications_auther_id_user | |
| **ref_id** | INTEGER | not null |  | |
| **title** | VARCHAR(255) | not null |  | |
| **body** | VARCHAR(255) | null |  | |
| **read** | BOOLEAN | not null |  | | 


### uploads

| Name        | Type          | Settings                      | References                    | Note                           |
|-------------|---------------|-------------------------------|-------------------------------|--------------------------------|
| **id** | INTEGER | 🔑 PK, not null, unique, autoincrement |  | |
| **filename** | VARCHAR(255) | not null, unique |  | |
| **type_id** | INTEGER | not null |  | |
| **ref_id** | INTEGER | not null |  | |
| **user_id** | INTEGER | not null | fk_uploads_user_id_user | | 


### saved

| Name        | Type          | Settings                      | References                    | Note                           |
|-------------|---------------|-------------------------------|-------------------------------|--------------------------------|
| **type_id** | INTEGER | 🔑 PK, not null | fk_saved_type_id_types | |
| **ref_id** | INTEGER | 🔑 PK, not null |  | |
| **user_id** | INTEGER | 🔑 PK, not null | fk_saved_user_id_user | | 


#### Indexes
| Name | Unique | Fields |
|------|--------|--------|
| saved_index_0 | ✅ | type_id, ref_id, user_id |
### reacts_on_posts

| Name        | Type          | Settings                      | References                    | Note                           |
|-------------|---------------|-------------------------------|-------------------------------|--------------------------------|
| **user_id** | INTEGER | 🔑 PK, not null | fk_reacts_on_posts_user_id_user | |
| **react_type_id** | INTEGER | 🔑 PK, not null | fk_reacts_on_posts_react_type_id_reaction_types | |
| **type_id** | INTEGER | 🔑 PK, not null | fk_reacts_on_posts_type_id_types | |
| **ref_id** | INTEGER | 🔑 PK, not null |  | | 


#### Indexes
| Name | Unique | Fields |
|------|--------|--------|
| reacts_on_posts_index_0 | ✅ | user_id, type_id, ref_id, react_type_id |
## Relationships

- **types to uploads**: one_to_many
- **categories to spaces**: one_to_many
- **posts to spaces**: many_to_one
- **posts to user**: many_to_one
- **comments to user**: one_to_one
- **comments to posts**: many_to_one
- **report_types to reports**: one_to_many
- **reports to user**: many_to_one
- **reports to types**: many_to_one
- **notifications to user**: many_to_one
- **notifications to user**: many_to_one
- **notifications to types**: many_to_one
- **saved to types**: many_to_one
- **saved to user**: many_to_one
- **reacts_on_posts to user**: one_to_one
- **reacts_on_posts to types**: one_to_one
- **reacts_on_posts to reaction_types**: one_to_one
- **uploads to user**: many_to_one

## Database Diagram

```mermaid
erDiagram
	types ||--o{ uploads : references
	categories ||--o{ spaces : references
	posts }o--|| spaces : references
	posts }o--|| user : references
	comments ||--|| user : references
	comments }o--|| posts : references
	report_types ||--o{ reports : references
	reports }o--|| user : references
	reports }o--|| types : references
	notifications }o--|| user : references
	notifications }o--|| user : references
	notifications }o--|| types : references
	saved }o--|| types : references
	saved }o--|| user : references
	reacts_on_posts ||--|| user : references
	reacts_on_posts ||--|| types : references
	reacts_on_posts ||--|| reaction_types : references
	uploads }o--|| user : references

	types {
		INTEGER id
		VARCHAR(255) name
	}

	report_types {
		INTEGER id
		VARCHAR(255) type
	}

	categories {
		INTEGER id
		VARCHAR(255) name
	}

	reaction_types {
		INTEGER id
		VARCHAR(255) name
	}

	user {
		INTEGER id
		BOOLEAN admin
		VARCHAR(50) username
		VARCHAR(50) password_hash
		VARCHAR(255) profile_picture
		VARCHAR(255) bio
		VARCHAR(255) 2FA
	}

	spaces {
		INTEGER id
		INTEGER category_id
		VARCHAR(255) name
		TEXT(65535) describtion
		VARCHAR(255) cover_image
		VARCHAR(255) avatar
	}

	posts {
		INTEGER id
		INTEGER user_id
		INTEGER space_id
		VARCHAR(255) title
		TEXT(65535) body
		BOOLEAN pinned
		INTEGER score
	}

	comments {
		INTEGER id
		INTEGER user_id
		INTEGER post_id
		TEXT(65535) body
		VARCHAR(255) media
		INTEGER replay_on
		INTEGER score
	}

	reports {
		INTEGER id
		INTEGER reported_item_id
		INTEGER report_about_id
		INTEGER ref_id
		INTEGER user_id
		TEXT(65535) body
	}

	notifications {
		INTEGER id
		INTEGER type_id
		INTEGER user_id
		INTEGER auther_id
		INTEGER ref_id
		VARCHAR(255) title
		VARCHAR(255) body
		BOOLEAN read
	}

	uploads {
		INTEGER id
		VARCHAR(255) filename
		INTEGER type_id
		INTEGER ref_id
		INTEGER user_id
	}

	saved {
		INTEGER type_id
		INTEGER ref_id
		INTEGER user_id
	}

	reacts_on_posts {
		INTEGER user_id
		INTEGER react_type_id
		INTEGER type_id
		INTEGER ref_id
	}
```