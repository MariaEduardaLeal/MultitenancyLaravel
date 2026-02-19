🚀 Guia de Instalação: Fábrica de Sites (SaaS Multitenant)
Este projeto utiliza o Laravel com a biblioteca stancl/tenancy para criar um ecossistema onde cada loja tem seu próprio banco de dados e identidade visual.

1. Pré-requisitos Técnicos
Antes de começar, você precisará de:

PHP 8.2+

Composer

MySQL (XAMPP, WAMP, Laragon ou Docker)

Git

2. Instalação Passo a Passo
1. Clonar e Instalar Dependências
Abra o terminal e execute:

```php
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
composer install
```

2. Configurar o Ambiente (.env)
Copie o arquivo de exemplo e gere a chave da aplicação:

```bash
cp .env.example .env
php artisan key:generate
```


3. Configurar o Banco de Dados (MySQL)
Crie um banco de dados vazio chamado multitenant_central no seu MySQL.

No seu arquivo .env, ajuste as credenciais de banco:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=multitenant_central
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

4. Migrações e Storage
Rode as migrações do banco central e crie o link para as imagens:

```bash
php artisan migrate
php artisan storage:link
```

3. Rodando sem editar o arquivo hosts
Para facilitar a vida e não precisar editar o arquivo hosts do Windows, utilizaremos o domínio lvh.me, que aponta automaticamente para o seu localhost.

No seu .env, garanta que a URL base seja:

APP_URL=http://localhost:8000

Inicie o servidor do Laravel:

```bash
php artisan serve
```

4. Como testar a aplicação
Passo 1: O Painel da Eduarda
Acesse http://localhost:8000. Você verá o Dashboard Administrativo onde pode listar e criar novos clientes.

Passo 2: Criar uma Loja
No formulário "Provisionar Novo Inquilino", digite um nome (ex: loja1) e clique em criar. O sistema irá:

Criar um banco MySQL chamado tenant_loja1.

Criar um usuário administrador padrão para essa loja.

Registrar o domínio loja1.localhost.

Passo 3: Personalizar a Loja
Acesse o link gerado (ex: http://loja1.localhost:8000/).

Vá em Configurações e escolha uma cor e uma logo.

Volte para a Home e cadastre seu primeiro produto usando o modal.

