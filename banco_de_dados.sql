CREATE TABLE pessoa (
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    primeiro_nome varchar(255) NOT NULL,
    segundo_nome varchar(255) NOT NULL,
    email varchar(255) NOT NULL UNIQUE KEY,
    cpf varchar(14) NOT NULL UNIQUE KEY,
    endereco varchar(255) NOT NULL,
    bairro varchar(255) NOT NULL,
    numero VARCHAR(255) NOT NULL,
    cep VARCHAR(9) NOT NULL,
    cidade_id int NOT NULL,
    data_nascimento timestamp NOT NULL,
    tipo int (1) NOT NULL,
    data_criacao timestamp NOT NULL DEFAULT NOW(),
    data_alteracao timestamp NOT NULL DEFAULT NOW(),
    FOREIGN KEY pessoa_cidade_id (cidade_id) REFERENCES cidade(id)
)



CREATE TABLE uf(
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome varchar(255) NOT NULL,
    sigla varchar(2)  NOT NULL
);

CREATE TABLE cidade(
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome varchar(255)  NOT NULL,
    uf_id int(11)  NOT NULL,
    FOREIGN KEY (uf_id) REFERENCES uf(id)
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


/* Adiciona coluna uf_id como inteiro NAO NULLO na tabela cidade */
/* ALTER TABLE cidade ADD COLUMN uf_id int NOT NULL; */

/* Adiciona uma chave estrangeira (com o nome cidade_uf_id) 
referenciando a coluna uf_id da tabela cidade, 
com a coluna id da tabela UF.
 */
ALTER TABLE cidade ADD FOREIGN KEY cidade_uf_id (uf_id) 
    REFERENCES uf(id);

/* APAGAR CHAVE ESTRANGEIRA */
/* ALTER TABLE cidade DROP FOREIGN KEY cidade_uf_id; */

/* REMOVER COLUNAS */
/* ALTER TABLE cidade DROP COLUMN uf_id; */


INSERT INTO cidade (nome, uf_id)
values("Caxias do Sul", 23);



/*
CREATE TABLE cidade (
    id int NOT NULL AUTO_INCREMENT,
    nome varchar(2),
    uf_id int not null,
    PRIMARY KEY (id),
    FOREIGN KEY (uf_id) REFERENCES uf(id)
)
Criar a coluna cidade_id em pessoa para ser nossa chave estrangeira para a tabela cidade:
ALTER TABLE pessoa ADD COLUMN cidade_id int;
Criar a chave estrangeira:
ALTER TABLE pessoa ADD FOREIGN KEY (cidade_id) REFERENCES cidade(id);
*/


