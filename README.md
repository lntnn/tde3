# Pet Shop Manager - CRUD em PHP Puro

Sistema de gerenciamento de produtos para pet shop. CRUD básico em PHP puro que utiliza um arquivo JSON como armazenamento. Criado para apresentação acadêmica e projetos educacionais.

## Características

✅ CRUD funcional e simples  
✅ Gerenciamento de produtos de pet shop  
✅ Armazenamento em JSON (sem banco de dados)  
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
- `data.json` → Armazenamento de dados em JSON
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

## Estrutura de Dados (JSON)

```json
[
  {
    "id": 1,
    "name": "Ração Premium para Gatos",
    "category": "Alimentos",
    "price": 49.90,
    "quantity": 15
  },
  {
    "id": 2,
    "name": "Bola de Brinquedo para Cães",
    "category": "Brinquedos",
    "price": 12.50,
    "quantity": 32
  }
]
```

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

