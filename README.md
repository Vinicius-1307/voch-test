<h1> Sistema Teste - Voch Tech </h1>

Bem-vindo. Esse sistema foi feito para fim de avaliação a pedido da empresa Voch Tech.

**Requisitos:**

```PHP 8.2 ou superior```

**Configuração:**

Antes de começar a usar o sistema, siga as etapas a seguir para configurar o ambiente:

1.	Clonar o repositório:

     ```bash
    git clone https://github.com/Vinicius-1307/voch-test.git
     ```

2.	Instalar dependências:	
    ```bash
    composer install
    ```

3.	Configurar Variáveis de Ambiente:
Copie o arquivo ```.env.example``` para ```.env``` e configure as seguintes variáveis de ambiente:

    - ```DB_CONNECTION```: Defina a conexão com o banco de dados (por exemplo, mysql).
  	
    - ```DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD```: Configure as informações do banco de dados.

5.	Execute o seguinte comando para gerar uma Chave de Aplicativo: </br>
       ```bash
    php artisan key:generate
       ```

6.	Para criar as tabelas do banco de dados execute o seguinte comando:

     ```bash
    php artisan migrate
       ```
      
8. Para popular o banco de dados, execute o seguinte comando:
   
      ```bash
    php artisan db:seed
      ```

10.	Iniciar o servidor de desenvolvimento:

     ```bash
    php artisan serve
       ```

<br>

**Contato:**
Se você tiver alguma dúvida ou precisar de assistência, entre em contato pelo [E-mail](viniciusjose9@outlook.com).

---

Desenvolvido por [Vinicius José](https://github.com/Vinicius-1307) 🚀


	
