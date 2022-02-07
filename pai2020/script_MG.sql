create table users
(
    id       serial
        constraint users_pk
            primary key,
    email    varchar(255) not null,
    password varchar(255) not null
);

create unique index users_id_uindex
    on users (id);

create table slopes
(
    id_slope          serial
        constraint slopes_pk
            primary key,
    title             varchar(100)          not null,
    district          varchar(100),
    locality          varchar(100),
    mountain_name     varchar(100),
    slope_status_info boolean default false not null,
    trail_info        text,
    other_info        text,
    trivia_info       text,
    image             varchar(255),
    description       text
);

create unique index slopes_id_slope_uindex
    on slopes (id_slope);

create table my_list_slopes
(
    id_my_list_slopes serial
        constraint my_list_slopes_pk
            primary key,
    id_slope          integer               not null
        constraint id_slopes___fk
            references slopes
            on update cascade on delete cascade,
    name              varchar(100)          not null,
    favourite         boolean default false not null,
    id_user           integer default 1     not null
        constraint my_list_slopes_users_id_fk
            references users
            on update cascade on delete cascade,
    constraint my_list_slopes_pk_2
        unique (id_slope, id_user)
);

create unique index my_list_slopes_id_my_list_slopes_uindex
    on my_list_slopes (id_my_list_slopes);

create table profiles
(
    id_profile            serial
        constraint profiles_pk
            primary key,
    name                  varchar(100),
    surname               varchar(100),
    nickname              varchar(100),
    snowboard_skills_info varchar(255),
    skiing_skills_info    varchar(255),
    id_user               integer not null
        constraint profiles_users_id_fk
            references users
            on update cascade on delete cascade
);

create unique index profiles_id_profile_uindex
    on profiles (id_profile);

create unique index profiles_id_user_uindex
    on profiles (id_user);

create table comments
(
    id_coment serial
        constraint comments_pk
            primary key,
    content   text                    not null,
    id_profil integer                 not null
        constraint comments_profiles_id_profile_fk
            references profiles
            on update cascade on delete cascade,
    id_slope  integer                 not null
        constraint comments_slopes_id_slope_fk
            references slopes
            on update cascade on delete cascade,
    add_time  timestamp default now() not null
);

create unique index comments_id_coment_uindex
    on comments (id_coment);

create table session
(
    id_session  uuid      default gen_random_uuid()              not null
        constraint session_pk
            primary key,
    data_expire timestamp default (now() + '01:00:00'::interval) not null,
    id_user     integer                                          not null
        constraint session_users_id_fk
            references users
            on update cascade on delete cascade
);

create unique index session_id_session_uindex
    on session (id_session);

create unique index session_id_user_uindex
    on session (id_user);

create procedure adduser(aemail character varying, apassword character varying, aname character varying,
                         asurname character varying, anickname character varying)
    language plpgsql
as
$$
declare
    idUser int;
begin
    INSERT INTO users ("email", "password")
    VALUES (aemail, apassword);
    select id into idUser from users WHERE "email" = aemail;
    INSERT INTO profiles ("name", "surname", "nickname", "id_user")
    VALUES (aname, asurname, anickname, idUser);

end;
$$;

create function session_start(aemail character varying) returns uuid
    language plpgsql
as
$$
declare
    idUser         int;
    declare result uuid;
begin
    SELECT id INTO idUser FROM users WHERE email = aemail;
    DELETE FROM session WHERE id_user = idUser;
    INSERT INTO session(id_user) VALUES (idUser);
    SELECT id_session INTO result FROM session WHERE id_user = idUser;
    return result;
end;
$$;


