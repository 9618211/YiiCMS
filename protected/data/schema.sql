create database if not exists yiicms collate utf8_general_ci;

use yiicms;

create table if not exists yc_user (
    id integer not null primary key auto_increment,
    name nvarchar(256) not null,
    password nvarchar(256) not null,
    nickname nvarchar(256) not null,
    email nvarchar(256),
    url nvarchar(256),
    last_login_time datetime,
    create_user_id integer,
    create_time datetime,
    update_user_id integer,
    update_time datetime
) engine=InnoDB;
delete from yc_user where name='admin';
insert into yc_user (id,name,password,nickname,email,create_time,update_time,create_user_id,update_user_id) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','Administrator','admin@art.app',now(),now(),1,1);

create table if not exists yc_post (
    id integer not null primary key auto_increment,
    title nvarchar(256) not null,
    content text,
    type integer not null,
    status tinyint not null default 1,
    enable_comment bool not null default 1,
    create_user_id integer,
    create_time datetime,
    update_user_id integer,
    update_time datetime,
    foreign key (create_user_id) references yc_user (id) on update cascade on delete cascade,
    foreign key (update_user_id) references yc_user (id) on update cascade
) engine=InnoDB;

create table if not exists yc_tag (
    id integer not null primary key auto_increment,
    name nvarchar(256) not null
) engine=InnoDB;

create table if not exists rel_post_tag (
    post_id integer not null,
    tag_id integer not null,
    primary key (post_id,tag_id),
    foreign key (post_id) references yc_post (id) on update cascade on delete cascade,
    foreign key (tag_id) references yc_tag (id) on update cascade on delete cascade
) engine=InnoDB;

create table if not exists yc_comment (
    id integer not null primary key auto_increment,
    post_id integer not null,
    content text,
    author nvarchar(256),
    email nvarchar(256),
    url nvarchar(256),
    create_time datetime,
    create_user_id integer,
    update_time datetime,
    update_user_id integer,
    foreign key (post_id) references yc_post (id) on update cascade on delete cascade,
    foreign key (create_user_id) references yc_user (id) on update cascade on delete cascade,
    foreign key (update_user_id) references yc_user (id) on update cascade
) engine=InnoDB;

create table if not exists yc_sitelog (
    id integer not null primary key auto_increment,
    content text not null,
    create_user_id integer not null,
    create_time datetime,
    update_user_id integer not null,
    update_time datetime,
    foreign key (create_user_id) references yc_user (id) on update cascade on delete cascade,
    foreign key (update_user_id) references yc_user (id) on update cascade
) engine=InnoDB;

drop procedure if exists my_temp_proc;
delimiter //
create procedure my_temp_proc ()
begin
    if not exists (select 1 from information_schema.columns where table_name='yc_post' and column_name='status') then
        alter table yc_post add column status tinyint not null;
        update yc_post set status=1;
    end if;
end//
delimiter ;
call my_temp_proc();
drop procedure my_temp_proc;
