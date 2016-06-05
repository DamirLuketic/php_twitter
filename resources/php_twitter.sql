drop database if exists php_twitter;
create database php_twitter charset utf8;
use php_twitter;

create table users(
user_id int not null primary key auto_increment,
display_name varchar(100) not null,
nickname varchar(25) not null,
personal_data text,
email varchar(150) not null,
password char(32) not null,
terms boolean default 1
);

create unique index ui1 on users(email);
create unique index ui2 on users(nickname);

create table posts(
post_id int not null primary key auto_increment,
user int not null,
post_created datetime not null,
post_updated datetime,
post text
);

alter table posts add foreign key (user) references users(user_id);

create table follows(
follow_id int not null primary key auto_increment,
user int not null,
follow int not null,
follow_created datetime not null,
follow_deleted datetime,
active boolean not null default 1
);

alter table follows add foreign key (user) references users(user_id);
alter table follows add foreign key (follow) references users(user_id);

create table images(
image_id int not null primary key auto_increment,
user int not null,
profile_image varchar(250),
cover_image varchar(250)
);

alter table images add foreign key (user) references users(user_id);