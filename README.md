🚀 Guia de Instalação: Fábrica de Sites (SaaS Multitenant)
Este projeto utiliza o Laravel com a biblioteca stancl/tenancy para criar um ecossistema onde cada loja tem seu próprio banco de dados e identidade visual.

1. Pré-requisitos Técnicos
Antes de começar, você precisará de:

PHP 8.2+

Composer

Docker Desktop

Git

2. Instalação Passo a Passo
1. Clonar e Instalar Dependências
Abra o terminal e execute:

```php
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
composer install
```

2. Subir os Containers:
Abra o terminal na raiz do projeto e execute:

```bash
docker-compose up -d --build
```
Este comando baixa as imagens e inicia os serviços em segundo plano.

3. Configurar a Aplicação dentro do Container:

```bash
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
docker-compose exec app php artisan storage:link
```

3. Configuração do Ambiente (.env)
```bash
    APP_URL = http://localhost:8081
    DB_CONNECTION=mysql
    DB_HOST=(Nome do serviço no docker-compose)
    DB_DATABASE=multitenant_central
    DB_USERNAME=root
    DB_PASSWORD=root
```


5. Como testar a aplicação
Passo 1: O Painel Central
Acesse http://localhost:8081. Você verá o Dashboard Administrativo para listar e criar novos inquilinos.

Passo 2: Criar uma Loja
No formulário "Provisionar Novo Inquilino", digite um ID (ex: loja1). O sistema irá:

Criar um banco MySQL chamado tenant_loja1.

Criar um usuário administrador padrão (admin@loja.com).

Registrar o domínio loja1.localhost.

Passo 3: Personalizar a Loja
Acesse o link gerado (ex: http://loja1.localhost:8081). Vá em Configurações para escolher uma cor e uma logo. O tema da loja será atualizado instantaneamente via atributos dinâmicos do Model.

### Comandos Úteis
Limpar Cache: docker-compose exec app php artisan config:clear

Rodar Migrações dos Inquilinos: docker-compose exec app php artisan tenants:migrate

Ver Logs em tempo real: docker-compose logs -f app
