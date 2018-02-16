
create table users(
    id integer not null,
	name_ varchar(30),
    email varchar(30) not null,
    password varchar(99) NOT NULL,
    primary key(id)
);