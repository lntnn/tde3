-- Script SQL para criar o banco de dados e tabela para o sistema de estoque
-- Execute este script no pgAdmin para criar a estrutura do banco

-- Criar o banco de dados (se não existir)
-- Nota: Você pode criar o banco manualmente no pgAdmin ou executar:
-- CREATE DATABASE petshop;

-- Usar o banco de dados
-- \c petshop;

-- Criar a tabela de produtos
DROP TABLE IF EXISTS produtos;
CREATE TABLE produtos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    categoria VARCHAR(100),
    preco NUMERIC(10,2) DEFAULT 0.00,
    quantidade INTEGER DEFAULT 0
);

-- Inserir dados de exemplo
INSERT INTO produtos (nome, categoria, preco, quantidade) VALUES
('Ração Premium para Gatos', 'Alimentos', 49.90, 15),
('Bola de Brinquedo para Cães', 'Brinquedos', 12.50, 32),
('Coleira com Guia', 'Acessórios', 35.00, 8),
('Xampú para Banho', 'Higiene', 28.90, 20),
('Vermífugo para Cães', 'Medicamentos', 19.50, 11);

-- Verificar os dados inseridos
SELECT * FROM produtos;