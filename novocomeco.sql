CREATE DATABASE novocomeco;
USE novocomeco;
-- Tabela DOADOR
CREATE TABLE DOADOR (
    id_doador INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(15),
    cpf VARCHAR(14) NOT NULL UNIQUE,
    data_cadastro DATE NOT NULL,
    end_rua VARCHAR(100) NOT NULL,
    end_numero VARCHAR(10) NOT NULL,
    end_bairro VARCHAR(50) NOT NULL,
    end_cidade VARCHAR(50) NOT NULL,
    end_estado VARCHAR(2) NOT NULL,
    end_completento varchar(50)
);
-- Tabela ONG
CREATE TABLE ONG (
    id_ong INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    data_validacao DATE NOT NULL,
    data_cadastro DATE NOT NULL,
    cnpj VARCHAR(18) NOT NULL UNIQUE,
    status ENUM('ativo', 'inativo') DEFAULT 'ativo',
    constituicao VARCHAR(255) NOT NULL,
    comprobatorio VARCHAR(255) NOT NULL,
    estatuto_social VARCHAR(255) NOT NULL,
    end_rua VARCHAR(100) NOT NULL,
    end_numero VARCHAR(10) NOT NULL,
    end_bairro VARCHAR(50) NOT NULL,
    end_cidade VARCHAR(50) NOT NULL,
    end_estado VARCHAR(2) NOT NULL,
    end_completento varchar(50),
    banco VARCHAR(100) NOT NULL,
    agencia VARCHAR(10) NOT NULL,
    conta_corrente VARCHAR(20) NOT NULL,
    chave_pix VARCHAR(100) NOT NULL
);
-- Tabela DOACAO
CREATE TABLE DOACAO (
    id_doacao INT AUTO_INCREMENT PRIMARY KEY,
    id_ong INT,
    id_doador INT,
    valor_total DECIMAL(10, 2),
    valor_taxa DECIMAL(10, 2),
    data_hora DATETIME,
    status ENUM('pendente', 'confirmado', 'cancelado'),
    FOREIGN KEY (id_ong) REFERENCES ONG(id_ong) -- Definindo a chave estrangeira
);
-- Tabela ADMINISTRADOR
CREATE TABLE ADMINISTRADOR (
    id_administrador INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(15),
    end_rua VARCHAR(100) NOT NULL,
    end_numero VARCHAR(10) NOT NULL,
    end_bairro VARCHAR(50) NOT NULL,
    end_cidade VARCHAR(50) NOT NULL,
    end_estado VARCHAR(2) NOT NULL,
    end_completento varchar(50),
    cpf VARCHAR(14) UNIQUE
);
-- Tabela DOACOES_ACUMULADAS
CREATE TABLE DOACOES_ACUMULADAS (
    id_doacoes_acumuladas INT AUTO_INCREMENT PRIMARY KEY,
    id_administrador INT,
    id_doacao INT,
    mes_referencia VARCHAR(7) NOT NULL,
    total_doacoes DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_administrador) REFERENCES ADMINISTRADOR(id_administrador),
    FOREIGN KEY (id_doacao) REFERENCES DOACAO(id_doacao)
);
-- Tabela HISTORICO_DOACAO
CREATE TABLE HISTORICO_DOACAO (
    id_historico_doacao INT AUTO_INCREMENT PRIMARY KEY,
    id_doacao INT,
    nome_ong VARCHAR(100) NOT NULL,
    nome_doador VARCHAR(100) NOT NULL,
    valor_doado DECIMAL(10, 2) NOT NULL,
    valor_taxa DECIMAL(10, 2) NOT NULL,
    metodo_pagamento VARCHAR(30) NOT NULL,
    data_hora DATETIME NOT NULL,
    status ENUM('realizado', 'pendente', 'cancelado') DEFAULT 'pendente',
    FOREIGN KEY (id_doacao) REFERENCES DOACAO(id_doacao)
);
-- Tabela NOTIFICACAO
CREATE TABLE NOTIFICACAO (
    id_notificacao INT AUTO_INCREMENT PRIMARY KEY,
    id_doacao INT,
    tipo_notificacao VARCHAR(50) NOT NULL,
    destinatario VARCHAR(100) NOT NULL,
    data_hora DATETIME NOT NULL,
    FOREIGN KEY (id_doacao) REFERENCES DOACAO(id_doacao)
);
CREATE TABLE BOLETO (
    id_boleto INT AUTO_INCREMENT PRIMARY KEY,
    id_ong INT,
    id_administrador INT,
    valor_transferencia DECIMAL(10, 2) NOT NULL,
    data_emissao DATE NOT NULL,
    data_vencimento DATE NOT NULL,
    status_pagamento ENUM('realizado', 'pendente', 'cancelado') DEFAULT 'pendente',
    metodo_pagamento VARCHAR(50),
    FOREIGN KEY (id_ong) REFERENCES ONG(id_ong),
    FOREIGN KEY (id_administrador) REFERENCES ADMINISTRADOR(id_administrador)
);
-- Tabela HISTORICO_BOLETOS
CREATE TABLE HISTORICO_BOLETOS (
    id_historico_boletos INT AUTO_INCREMENT PRIMARY KEY,
    -- Identificador único do histórico
    id_boleto INT,
    -- Referência ao boleto
    id_ong INT NOT NULL,
    -- Referência à ONG
    id_administrador INT NOT NULL,
    -- Referência ao administrador
    valor_transferencia DECIMAL(10, 2) NOT NULL,
    -- Valor da transferência
    data_emissao DATE NOT NULL,
    -- Data de emissão do boleto
    data_pagamento DATE,
    -- Data efetiva do pagamento
    status ENUM('realizado', 'pendente', 'cancelado') DEFAULT 'pendente',
    -- Status do pagamento
    metodo_transferencia VARCHAR(30) NOT NULL,
    -- Método utilizado na transferência
    FOREIGN KEY (id_boleto) REFERENCES BOLETO(id_boleto),
    -- Chave estrangeira para a tabela BOLETO
    FOREIGN KEY (id_ong) REFERENCES ONG(id_ong),
    -- Chave estrangeira para a tabela ONG
    FOREIGN KEY (id_administrador) REFERENCES ADMINISTRADOR(id_administrador) -- Chave estrangeira para a tabela ADMINISTRADOR
);
-- Tabela CATEGORIA
CREATE TABLE CATEGORIA (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    categoria_status ENUM('ativa', 'inativa') DEFAULT 'ativa',
    descricao VARCHAR(300) NOT NULL,
    imagem VARCHAR(255)
);
CREATE TABLE contato_mensagens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    mensagem TEXT NOT NULL,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Tabela PARCEIRO
CREATE TABLE PARCEIRO (
    id_parceiro INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    email VARCHAR(80) NOT NULL,
    cpf VARCHAR(11) NOT NULL UNIQUE,
    end_numero VARCHAR(10) NOT NULL,
    end_bairro VARCHAR(50) NOT NULL,
    end_cidade VARCHAR(50) NOT NULL,
    end_estado VARCHAR(2) NOT NULL,
    end_logradouro VARCHAR(100) NOT NULL,
    id_ong INT,
    FOREIGN KEY (id_ong) REFERENCES ONG(id_ong)
);
-- Consultar os doadores
SELECT *
FROM doador;
SELECT *
FROM DOACAO
ORDER BY id_doacao DESC
LIMIT 10;