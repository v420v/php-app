
create table if not exists `todos` (
    `id` mediumint not null auto_increment,
    `content` varchar(255),
    `created_at` timestamp not null default current_timestamp,
    `updated_at` timestamp not null default current_timestamp on update current_timestamp,
    `deleted_at` datetime null default null,
    primary key(`id`)
);




