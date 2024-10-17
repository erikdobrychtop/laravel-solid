# Solid API - Projeto Web API em Laravel

Este é um projeto de **Web API** desenvolvido com **Laravel**, seguindo os princípios **SOLID** para uma estrutura clara e organizada. A API gerencia um CRUD básico de **Produtos**, aplicando boas práticas de arquitetura de software.

## Pré-requisitos

- PHP >= 8.0
- Composer
- MySQL (ou outro banco de dados relacional configurado no `.env`)
- Extensões do PHP instaladas (ex: OpenSSL, PDO, Mbstring)

## Instalação

1. **Clone o repositório**:

    ```bash
    git clone https://github.com/seu-usuario/solid-api.git
    cd solid-api
    ```

2. **Instale as dependências** do Laravel:

    ```bash
    composer install
    ```

3. **Configure o ambiente**:
   
   Copie o arquivo `.env.example` para `.env` e configure suas credenciais de banco de dados:

    ```bash
    cp .env.example .env
    ```

    Abra o arquivo `.env` e modifique as seguintes linhas para refletir seu ambiente local:

    ```plaintext
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=solid_api
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4. **Gere a chave da aplicação**:

    ```bash
    php artisan key:generate
    ```

5. **Execute as migrações** para criar as tabelas no banco de dados:

    ```bash
    php artisan migrate
    ```

6. **Inicie o servidor de desenvolvimento**:

    ```bash
    php artisan serve
    ```

Agora, a API estará disponível em `http://localhost:8000`.

## Estrutura do Projeto

Este projeto segue os princípios **SOLID** e está estruturado de forma a separar as responsabilidades entre camadas e serviços. As principais pastas e arquivos incluem:

- **Controllers**: Controladores responsáveis por lidar com as requisições HTTP e delegar lógica de negócios aos serviços.
- **Services**: Camada responsável pela lógica de negócio, mantendo o Controller simples e focado apenas nas requisições.
- **Models**: Representações das tabelas do banco de dados.
- **Routes**: Definição das rotas da API no arquivo `api.php`.

## Rotas da API

A seguir, estão as rotas que você pode usar para testar a API de Produtos.

### 1. **Listar todos os produtos**

```bash
GET /api/products
```

Exemplo de resposta:

```json
[
    {
        "id": 1,
        "name": "Produto A",
        "price": "50.00",
        "quantity": 10,
        "created_at": "2023-10-10T00:00:00.000000Z",
        "updated_at": "2023-10-10T00:00:00.000000Z"
    },
    {
        "id": 2,
        "name": "Produto B",
        "price": "100.00",
        "quantity": 5,
        "created_at": "2023-10-10T00:00:00.000000Z",
        "updated_at": "2023-10-10T00:00:00.000000Z"
    }
]
```

### 2. **Criar um novo produto**

```bash
POST /api/products
Content-Type: application/json

{
    "name": "Produto A",
    "price": 50.00,
    "quantity": 10
}
```

Exemplo de resposta:

```json
{
    "id": 1,
    "name": "Produto A",
    "price": "50.00",
    "quantity": 10,
    "created_at": "2023-10-10T00:00:00.000000Z",
    "updated_at": "2023-10-10T00:00:00.000000Z"
}
```

### 3. **Atualizar um produto existente**

```bash
PUT /api/products/{id}
Content-Type: application/json

{
    "name": "Produto A Atualizado",
    "price": 60.00,
    "quantity": 5
}
```

Exemplo de resposta:

```json
{
    "id": 1,
    "name": "Produto A Atualizado",
    "price": "60.00",
    "quantity": 5,
    "created_at": "2023-10-10T00:00:00.000000Z",
    "updated_at": "2023-10-10T00:00:00.000000Z"
}
```

### 4. **Deletar um produto**

```bash
DELETE /api/products/{id}
```

Exemplo de resposta:

```bash
204 No Content
```

## Princípios SOLID Aplicados

1. **Single Responsibility Principle (SRP)**:
    - Cada classe no projeto tem uma única responsabilidade. O `ProductController` lida apenas com as requisições HTTP, enquanto o `ProductService` gerencia a lógica de negócios.

2. **Open/Closed Principle (OCP)**:
    - O `ProductService` está aberto para extensão. Podemos adicionar novos métodos sem modificar a lógica existente, por exemplo, adicionando cálculos de desconto ou estoque.

3. **Liskov Substitution Principle (LSP)**:
    - Se precisarmos estender o `ProductService` ou modificar a lógica de um produto, garantimos que o código substituto funcionará corretamente em todos os cenários onde a classe original é usada.

4. **Interface Segregation Principle (ISP)**:
    - Mantemos interfaces específicas em mente ao projetar os serviços. Para este exemplo, o `ProductService` lida com todas as responsabilidades de negócios relacionadas a produtos.

5. **Dependency Inversion Principle (DIP)**:
    - O controlador depende da abstração do `ProductService`, em vez de depender diretamente do modelo `Product`, facilitando futuras mudanças na lógica sem impactar o controlador.

## Testes

Para testar a API, você pode usar ferramentas como **Postman** ou **Insomnia** para enviar requisições às rotas descritas acima.