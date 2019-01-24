drop database if exists instruementosweb;
create database if not exists instrumentosweb;

use instrumentosweb;

drop table if exists tipos;
create table if not exists tipos(
	id_tipo tinyint unsigned primary key auto_increment,
    tip_nombre varchar(20)
    )engine=innodb;

drop table if exists instrumentos;
create table if not exists instrumentos(
	id_instrumento smallint unsigned primary key auto_increment,
    ins_nombre varchar(20) unique not null,
    ins_tipo_id tinyint unsigned not null,
    constraint fk_ins_id_tipo foreign key (ins_tipo_id) references tipos(id_tipo) on update cascade
    )engine=innodb;
    create unique index unique_ins_nombre on instrumentos(ins_nombre);

drop table if exists modelos;
create table if not exists modelos(
	  id_modelo char(10)  not null primary key,
    mod_nombre varchar(20)  not null,
    mod_descripcion varchar(140) not null,
    mod_precio decimal(9,2) not null,
    mod_existencia int unsigned not null default 0,
    mod_descuento tinyint unsigned null,
    mod_id_instrumento smallint unsigned not null,
    mod_ruta varchar (120) null,
    constraint fk_mod_id_instrumento foreign key (mod_id_instrumento) references instrumentos(id_instrumento) on update cascade
    )engine=innodb;

create unique index unique_id_modelo on modelos(id_modelo);
create unique index unique_mode_nombre on modelos(mod_nombre);

create table if not exists accesorios(
	id_accesorio smallint unsigned primary key auto_increment,
	acce_nombre varchar(20) not null,
    acce_caracteristicas varchar(140) not null,
    acce_precio decimal(9,2) not null,
    acce_existencia int unsigned not null default 0,
    acce_descuento int unsigned null,
    acce_foto mediumblob null
    )engine=innodb;
      create unique index unique_acce_nombre on accesorios(acce_nombre);

    create table if not exists accesorios_instrumentos(
    id_acce_ins_instrumento smallint unsigned ,
    id_acce_ins_accesorios smallint unsigned ,
    primary key(id_acce_ins_instrumento,id_acce_ins_accesorios),
	constraint fk_id_acce_ins_instrumento foreign key (id_acce_ins_instrumento) references instrumentos(id_instrumento),
    constraint fk_id_acce_inst_accesorios foreign key (id_acce_ins_accesorios) references accesorios(id_accesorio)
    )engine=innodb;
