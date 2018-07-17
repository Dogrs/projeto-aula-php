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
    uf_id int(11)  NOT NULL
);

Insert Into uf (sigla,nome) 
Values('AC','Acre'),  
('AL','Alagoas'),  
('AM','Amazonas'),
('AP','Amapá'),
('BA','Bahia'),
('CE','Ceará'),
('DF','Distrito Federal'),
('ES','Espírito Santo'),
('GO','Goiás'),
('MA','Maranhão'),
('MG','Minas Gerais'),
('MS','Mato Grosso do Sul'),
('MT','Mato Grosso'),
('PA','Pará'),
('PB','Paraíba'),
('PE','Pernambuco'),
('PI','Piauí'),
('PR','Paraná'),
('RJ','Rio de Janeiro'),
('RN','Rio Grande do Norte'),
('RO','Rondônia'),
('RR','Roraima'),
('RS','Rio Grande do Sul'),
('SC','Santa Catarina'),
('SE','Sergipe'),
('SP','São Paulo'),
('TO','Tocantins')




