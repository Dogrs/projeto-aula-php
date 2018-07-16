CREATE TABLE pessoa (
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome varchar(255) DEFAULT NULL,
    email varchar(255) DEFAULT NULL,
    sexo varchar(1) DEFAULT NULL,
    data_nascimento timestamp NOT NULL,
    uf varchar(255) DEFAULT NULL,
    cidade varchar(255) DEFAULT NULL
);

CREATE TABLE uf(
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome varchar(255) NOT NULL,
    sigla varchar(2)  NOT NULL
);

CREATE TABLE cidade(
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome varchar(255)  NOT NULL,
    uf_id varchar(2)  NOT NULL
)