# MasterDaWebAPI

Projeto realizado para teste full-stack da MasterDaWeb

---

## Intuito da aplicação

Pensando em uma API de carrinho de compras, onde o usuário consegue fazer pedidos e também ter acesso ao sistema administrativo para cadastro de produtos e visualização dos pedidos

## Como clonar o projeto?

No seu terminal, clone o projeto com o comando abaixo:

```bash
git clone https://github.com/NikolasOliveir4/cucohealth-api.git
```
---

# Backend

O backend do projeto foi feito em Laravel com banco de dados em MySQL.
Nele, foram utilizados:

-[Laravel](https://laravel.com/docs/10.x/installation) (para a construção do CRUD)


## Como rodar?
será necessário a instalação do Xamp:  
[Xamp](https://www.apachefriends.org/pt_br/download.html)

**Irá precisar também de um arquivo _.env_ com as seguintes variáveis:**  

DB_CONNECTION=mysql.  
DB_HOST=127.0.0.1.  
DB_PORT=<porta escolhida no xampp>  
DB_DATABASE= <nome do banco de dados>  
DB_USERNAME=root  
DB_PASSWORD=  

_rodar o comando "php artisan migrate" para criar banco de dados_

_roda o comando "php artisan serve" para rodar o servidor da api_

_Após os comandos, o projeto estará rodando na porta declarada no arquivo **.env** (http://localhost:<numero-da-porta>)_

### _Os endpoints do projeto estão no arquivo "postman collection", na pasta raiz_

---


Teste feito por Níkolas Oliveira.
