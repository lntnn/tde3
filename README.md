# CRUD Simples em PHP Puro

Este projeto é um CRUD básico em PHP puro que utiliza um arquivo JSON como armazenamento. Foi criado para apresentação acadêmica e TDE.

## Estrutura de arquivos

- `index.php` → lista os registros
- `create.php` → página de cadastro de novo registro
- `edit.php` → edição de registro existente
- `delete.php` → exclusão de registro
- `functions.php` → funções de leitura/escrita e validação
- `header.php` / `footer.php` → componentes de layout reutilizáveis
- `data.json` → banco de dados simples em JSON
- `style.css` → estilo responsivo e minimalista

## Como rodar localmente

1. Instale o XAMPP, Laragon ou outro servidor local com PHP.
2. Copie a pasta do projeto para a pasta `htdocs` do XAMPP ou para `www` do Laragon.
3. Inicie o servidor Apache.
4. Acesse no navegador:
   - `http://localhost/tde3/index.php` (ou caminho ajustado conforme o nome da pasta)

## Funcionamento

- Os dados são gravados no arquivo `data.json`.
- `index.php` mostra todos os registros em tabela.
- `create.php` adiciona um novo registro com validação de campos obrigatórios.
- `edit.php` atualiza o registro selecionado.
- `delete.php` remove o registro escolhido.

## Observações

- Não utiliza banco de dados SQL.
- Todos os dados são persistidos em `data.json`.
- Interface simples, limpa e fácil de apresentar.
