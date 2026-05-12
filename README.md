# Pet Shop Manager - CRUD em PHP Puro

Sistema de gerenciamento de produtos para pet shop. CRUD básico em PHP puro que utiliza PostgreSQL como armazenamento. Criado para apresentação acadêmica e projetos educacionais.

## Características

✅ CRUD funcional e simples  
✅ Gerenciamento de produtos de pet shop  
✅ Armazenamento em PostgreSQL  
✅ Sem bibliotecas externas ou frameworks  
✅ Interface HTML básica e responsiva  
✅ Tema Pet Shop com cores personalizadas  
✅ Ideal para trabalho acadêmico

## Campos do Produto

- **ID** - Identificador único (gerado automaticamente)
- **Nome** - Nome do produto
- **Categoria** - Tipo de produto (Alimentos, Brinquedos, Acessórios, Higiene, Medicamentos)
- **Preço** - Valor do produto em R$
- **Quantidade** - Quantidade em estoque

## Estrutura de Arquivos

- `index.php` → Lista todos os produtos em tabela
- `create.php` → Cadastro de novo produto
- `edit.php` → Edição de produto existente
- `delete.php` → Exclusão de produto
- `functions.php` → Funções reutilizáveis de leitura/escrita e validação
- `header.php` / `footer.php` → Componentes de layout HTML
- `create_tables.sql` → Script para criar a tabela `produtos` no PostgreSQL
- `style.css` → Estilo simples e responsivo

## Como Rodar Localmente

1. Instale o XAMPP, Laragon ou outro servidor local com PHP 7.4+
2. Copie a pasta do projeto para a pasta `htdocs` (XAMPP) ou `www` (Laragon)
3. Inicie o servidor Apache
4. Acesse no navegador:
   ```
   http://localhost/tde3/index.php
   ```

## Funcionalidades

### 📝 Cadastrar Produto
- Acesso através do botão "Cadastrar" no menu
- Validação de campos obrigatórios
- Seleção de categoria via dropdown
- Validação de preço e quantidade (devem ser numéricos)

### 📋 Listar Produtos
- Visualização de todos os produtos em tabela
- Exibição de ID, Nome, Categoria, Preço e Quantidade
- Acesso rápido às ações (editar/excluir)

### ✏️ Editar Produto
- Atualização de dados do produto selecionado
- Validação de campos durante edição
- Confirmação antes de atualizar

### 🗑️ Excluir Produto
- Remoção de produto do estoque
- Confirmação de exclusão antes de executar

## Estrutura do Banco de Dados

O sistema usa a tabela `produtos` no PostgreSQL. O script `create_tables.sql` já contém a criação da tabela e dados de exemplo.

A tabela `produtos` possui as colunas:

- `id` (serial, chave primária)
- `nome` (texto)
- `categoria` (texto)
- `preco` (decimal)
- `quantidade` (inteiro)

## Observações Importantes

- ✅ Sem banco de dados SQL - armazenamento 100% em arquivo JSON
- ✅ PHP puro - sem dependências ou frameworks
- ✅ HTML básico e funcional - sem CSS elaborado, mas com design limpo
- ✅ Fácil de entender e explicar
- ✅ Pronto para apresentação acadêmica
- ✅ Totalmente responsivo e funcional

## Requisitos

- PHP 7.4 ou superior
- Servidor web com suporte PHP (Apache recomendado)
- Permissão de escrita na pasta para criar/editar `data.json`

## Segurança

- Todos os dados são escapados com `htmlspecialchars()` para prevenir XSS
- Validação de entrada em todos os formulários
- Uso de `urlencode()` para parameters na URL

