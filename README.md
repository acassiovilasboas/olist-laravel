
# Olist Pax - Laravel

![Olist Pax](https://bit.ly/3gpfoF1)

## Teste aplicado a vaga para Olist Pax

Trata-se de uma API CRUD para manter produtos relacionados a categorias e ao consumo de um serviço externo, API do IBGE que lista todos estados brasileiros.

## Documentação POSTMAN
[Acesse a documentação no postman](https://bit.ly/3sCfrjc)

## Indices

* [Categoria](#categoria)

  * [/api/category](#1-apicategory)
  * [/api/category](#2-apicategory)
  * [/api/category/{id}](#3-apicategory{id})
  * [/api/category/{id}](#4-apicategory{id})
  * [/api/category/{id}](#5-apicategory{id})

* [Produtos](#produtos)

  * [/api/product](#1-apiproduct)
  * [/api/product](#2-apiproduct)
  * [/api/product/{id}](#3-apiproduct{id})
  * [/api/product/{id}](#4-apiproduct{id})
  * [/api/product/{id}](#5-apiproduct{id})

* [Services - Estados Brasileiros](#services---estados-brasileiros)

  * [/api/states-of-brazil](#1-apistates-of-brazil)
  * [/api/states-of-brazil](#2-apistates-of-brazil)
  * [/api/states-of-brazil/{id}](#3-apistates-of-brazil{id})


--------


## Categoria
Serviços responsável por manter as categorias dos produtos.
Com este serviço é possível:
- Incluir uma nova categoria
- Listar todas categorias
- Editar uma categoria
- Buscar uma categoria por ID e ver todos produtos relacionados
- Deletar uma categoria (todos produtos ligados a ela serão deletados também)



### 1. /api/category


## Listar todas categorias
Serviço responsável por listar todas categorias.


***Endpoint:***

```bash
Method: GET
Type: 
URL: localhost:8000/api/category
```



***More example Requests/Responses:***


##### I. Example Request: Listando todas categorias cadastradas.



##### I. Example Response: Listando todas categorias cadastradas.
```js
[
    {
        "id": 2,
        "name": "Alimentação",
        "created_at": "2021-04-20T01:50:48.000000Z",
        "updated_at": "2021-04-20T01:50:48.000000Z"
    },
    {
        "id": 3,
        "name": "Produtos de Limpeza",
        "created_at": "2021-04-20T01:56:06.000000Z",
        "updated_at": "2021-04-20T01:56:06.000000Z"
    }
]
```


***Status Code:*** 200

<br>



### 2. /api/category


## Inserir uma nova categoria
Serviço responsável por inserir novas categorias na base de dados.


***Endpoint:***

```bash
Method: POST
Type: RAW
URL: localhost:8000/api/category
```



***Body:***

```js        
{
    "name": "Produtos de Limpeza"
}
```



***More example Requests/Responses:***


##### I. Example Request: Criando uma categoria



***Body:***

```js        
{
    "name": "Produtos de Limpeza"
}
```



##### I. Example Response: Criando uma categoria
```js
{
    "result": {
        "status": "success",
        "message": "registro salvo com sucesso"
    }
}
```


***Status Code:*** 200

<br>



### 3. /api/category/{id}


## Editar categorias
Serviço responsável por editar uma categoria.


***Endpoint:***

```bash
Method: PUT
Type: RAW
URL: localhost:8000/api/category/2
```



***Body:***

```js        
{
    "name": "Produto Relacionados a Alimentação"
}
```



***More example Requests/Responses:***


##### I. Example Request: Atualizando uma categoria.



***Body:***

```js        
{
    "name": "Produto Relacionados a Alimentação"
}
```



##### I. Example Response: Atualizando uma categoria.
```js
{
    "result": {
        "status": "success",
        "message": "registro atualizado com sucesso"
    }
}
```


***Status Code:*** 200

<br>



##### II. Example Request: Tentando atualizar uma categoria que não existe no banco de dados.



***Body:***

```js        
{
    "name": "asda"
}
```



##### II. Example Response: Tentando atualizar uma categoria que não existe no banco de dados.
```js
{
    "result": {
        "status": "error",
        "message": "categoria inexistente"
    }
}
```


***Status Code:*** 404

<br>



### 4. /api/category/{id}


## Deletar uma categoria
Serviço responsável por deletar uma categoria.
**atenção:** Ao deletar uma categoria, todos os produtos pertencentes a esta categoria também serão deletados. Para listar os produtos de uma categoria antes de delete-la, utilize o serviço disponível em **/api/category/{id}**.


***Endpoint:***

```bash
Method: DELETE
Type: RAW
URL: localhost:8000/api/category/3
```



***More example Requests/Responses:***


##### I. Example Request: Tentando deletar uma categoria que não existe no banco de dados.



##### I. Example Response: Tentando deletar uma categoria que não existe no banco de dados.
```js
{
    "result": {
        "status": "error",
        "message": "registro inexistente"
    }
}
```


***Status Code:*** 404

<br>



##### II. Example Request: Deletando uma categoria com sucesso.



##### II. Example Response: Deletando uma categoria com sucesso.
```js
{
    "result": {
        "status": "success",
        "message": "registro excluído com sucesso"
    }
}
```


***Status Code:*** 200

<br>



### 5. /api/category/{id}


## Listar categoria e seus produtos relacionados
Serviço responsável por listar uma categoria por id e trazer todos produtos pertencentes a esta categoria.


***Endpoint:***

```bash
Method: GET
Type: RAW
URL: localhost:8000/api/category/1
```



***More example Requests/Responses:***


##### I. Example Request: Buscando uma categoria por id.



##### I. Example Response: Buscando uma categoria por id.
```js
{
    "category": "Alimentação",
    "products": [
        {
            "id": 2,
            "category": 2,
            "name": "Arroz",
            "price": 459,
            "quantity": 5,
            "created_at": "2021-04-20T01:50:52.000000Z",
            "updated_at": "2021-04-20T01:53:40.000000Z"
        },
        {
            "id": 4,
            "category": 2,
            "name": "Feijão",
            "price": 69,
            "quantity": 10,
            "created_at": "2021-04-20T01:59:03.000000Z",
            "updated_at": "2021-04-20T01:59:03.000000Z"
        }
    ]
}
```


***Status Code:*** 200

<br>



##### II. Example Request: Buscando uma categoria inexistente.



##### II. Example Response: Buscando uma categoria inexistente.
```js
{
    "result": {
        "status": "error",
        "message": "categoria inexistente"
    }
}
```


***Status Code:*** 404

<br>



## Produtos
Serviço responsável por manter os produtos na base de dados.
É possível:
- Listar todos produtos
- Inserir novos produtos
- Editar um produto
- Buscar um produto por id
- Deletar um produto



### 1. /api/product


## Listar todos produtos.
Serviço responsável por listar todos produtos.


***Endpoint:***

```bash
Method: GET
Type: 
URL: localhost:8000/api/product
```



***More example Requests/Responses:***


##### I. Example Request: Listando produtos



##### I. Example Response: Listando produtos
```js
[
    {
        "id": 1,
        "category": 1,
        "name": "Sabao em pó",
        "price": 246,
        "quantity": 10,
        "created_at": "2021-04-20T01:49:53.000000Z",
        "updated_at": "2021-04-20T01:53:34.000000Z",
        "category_name": "Produtos de Limpeza"
    },
    {
        "id": 2,
        "category": 2,
        "name": "Arroz",
        "price": 459,
        "quantity": 5,
        "created_at": "2021-04-20T01:50:52.000000Z",
        "updated_at": "2021-04-20T01:53:40.000000Z",
        "category_name": "Alimentação"
    }
]
```


***Status Code:*** 200

<br>



##### II. Example Request: Exemplo de requisição. Caso o banco de dados não possuir registros.



##### II. Example Response: Exemplo de requisição. Caso o banco de dados não possuir registros.
```js
{
    "result": {
        "status": "error",
        "message": "registros inexistentes"
    }
}
```


***Status Code:*** 404

<br>



### 2. /api/product


## Criar produtos
Serviço responsável por inserir novos produtos.


***Endpoint:***

```bash
Method: POST
Type: RAW
URL: localhost:8000/api/product
```



***Body:***

```js        
{
    "category": 3,
    "name": "Sabao em pó",
    "price": 24.60,
    "quantity": 10
}
```



***More example Requests/Responses:***


##### I. Example Request: Criando um produto



***Body:***

```js        
{
    "category": 1,
    "name": "Sabao em pó",
    "price": 24.60,
    "quantity": 10
}
```



##### I. Example Response: Criando um produto
```js
{
    "result": {
        "status": "success",
        "message": "registro salvo com sucesso"
    }
}
```


***Status Code:*** 200

<br>



##### II. Example Request: Exemplo de erro, inserindo um produto relacionado a uma categoria que nao existe.



***Body:***

```js        
{
    "category": 1,
    "name": "Sabao em pó",
    "price": 24.60,
    "quantity": 10
}
```



##### II. Example Response: Exemplo de erro, inserindo um produto relacionado a uma categoria que nao existe.
```js
{
    "result": {
        "status": "error",
        "message": "categoria inexistente"
    }
}
```


***Status Code:*** 404

<br>



### 3. /api/product/{id}


## Editar Produto
Serviço responsável por editar produto.
É possível editar o nome, a categoria, o preço e quantidade do produto.


***Endpoint:***

```bash
Method: PUT
Type: RAW
URL: localhost:8000/api/product/2
```



***Body:***

```js        
{
    "category" : 2
}
```



***More example Requests/Responses:***


##### I. Example Request: Alterando somente a categoria de um produto



***Body:***

```js        
{
    "category" : 2
}
```



##### I. Example Response: Alterando somente a categoria de um produto
```js
{
    "result": {
        "status": "success",
        "message": "registro atualizado com sucesso"
    }
}
```


***Status Code:*** 200

<br>



##### II. Example Request: Exemplo de edição de um produto que não existe na base de dados.



***Body:***

```js        
{
    "category" : 1,
    "name": "produto alteardo",
    "price": 6.50000,
    "quantity": 28
}
```



##### II. Example Response: Exemplo de edição de um produto que não existe na base de dados.
```js
{
    "result": {
        "status": "error",
        "message": "produto inexistente"
    }
}
```


***Status Code:*** 404

<br>



### 4. /api/product/{id}


## Excluindo um Produto
Serviço responsável por excluir um produto na base de dados.


***Endpoint:***

```bash
Method: DELETE
Type: RAW
URL: localhost:8000/api/product/3
```



***More example Requests/Responses:***


##### I. Example Request: Exemplo de exclusão de um produto que não existe na base de dados.



##### I. Example Response: Exemplo de exclusão de um produto que não existe na base de dados.
```js
{
    "result": {
        "status": "error",
        "message": "registro inexistente"
    }
}
```


***Status Code:*** 404

<br>



##### II. Example Request: Deletando um produto com sucesso.



##### II. Example Response: Deletando um produto com sucesso.
```js
{
    "result": {
        "status": "success",
        "message": "registro excluído com sucesso"
    }
}
```


***Status Code:*** 200

<br>



### 5. /api/product/{id}


## Buscar Produto por ID
Serviço responsável por buscar um produto correspondente ao ID informado como parâmetro na URI.


***Endpoint:***

```bash
Method: GET
Type: RAW
URL: localhost:8000/api/product/2
```



***More example Requests/Responses:***


##### I. Example Request: Buscando produtos por id.



##### I. Example Response: Buscando produtos por id.
```js
{
    "id": 2,
    "category": 2,
    "name": "Arroz",
    "price": 459,
    "quantity": 5,
    "created_at": "2021-04-20T01:50:52.000000Z",
    "updated_at": "2021-04-20T01:53:40.000000Z",
    "category_name": "Alimentação"
}
```


***Status Code:*** 200

<br>



##### II. Example Request: Tentando buscar um produto que não existe no banco de dados.



##### II. Example Response: Tentando buscar um produto que não existe no banco de dados.
```js
{
    "result": {
        "status": "error",
        "message": "produto inexistente"
    }
}
```


***Status Code:*** 404

<br>



## Services - Estados Brasileiros



### 1. /api/states-of-brazil


## Listar todos estados registrados no banco
Serviço responsável por listar todos estados registrados no banco de dados.


***Endpoint:***

```bash
Method: GET
Type: 
URL: localhost:8000/api/states-of-brazil
```



### 2. /api/states-of-brazil


## Inserir todos estados na base de dados
Serviço responsável por inserir todos estados brasileiros na base de dados local.
Este serviço consome recursos de uma API externa.


***Endpoint:***

```bash
Method: POST
Type: RAW
URL: localhost:8000/api/states-of-brazil
```



***Body:***

```js        
{
    "category" : 1,
        "name": "Brarbo",
        "price": 650,
        "quantity": 28
}
```



### 3. /api/states-of-brazil/{id}


## Buscar um estado por ID
Serviço responsável por trazer um estado específico, conforme o id informado na URI.


***Endpoint:***

```bash
Method: GET
Type: RAW
URL: localhost:8000/api/states-of-brazil/5
```



---
[Back to top](#olist-pax---laravel)
> Made with &#9829; by [thedevsaddam](https://github.com/thedevsaddam) | Generated at: 2021-04-20 00:05:37 by [docgen](https://github.com/thedevsaddam/docgen)
