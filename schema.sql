create table etablissement(
    id int not null AUTO_INCREMENT, 
    latitude float(15), 
    longitude float(15), 
    nom varchar(255), 
    adresse varchar(255),
    tel varchar(20),
    ville varchar(255),
    secteur varchar(255),
    chef varchar(255),
    chef_adj varchar(255),
    ddfpt varchar(255),
    ree varchar(255),
    mail varchar(255),
    site_web varchar(255),
    nature varchar(255),
    primary key (id)
)ENGINE=InnoDB;
CREATE table formations(
    id int not null AUTO_INCREMENT,
    id_etablissement int not null,
    nom varchar(255),
    primary key (id),
    foreign key (id_etablissement) references etablissement(id)
)ENGINE=InnoDB;
CREATE table users(
    username varchar(255) not null,
    passwd varchar(255) not null,
    role varchar(255),
    primary key (username),
)ENGINE=InnoDB;