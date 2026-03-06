<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Rodando o projeto

## 1. Requisitos
- PHP 8.2 ou superior.
- Composer.
- Docker (para o Redis).
- XAMPP (para mysql e apache).

## 2. Config do projeto

#### 1. Clonar o repositório.
````aiignore
git clone https://github.com/DRAVINCK/catalogo-api-nge.git
````

#### 2. Instalar depend do PHP.
````aiignore
composer install
````

#### 3. Instalar depend do Front(se necessario)
````aiignore
npm install
````

#### 4. Crie o arquivo .env baseado no .env.example e configurar a conexão com o banco(MySql), Cache(predis) e keys para AWS S3.


## 3. Outros ajustes

### Foi utilizado o php instalado na maquina, foi necessário fazer alguns ajustes no php.ini

- **Certificado SSL (AWS S3):** Baixe o arquivo cacert.pem, salve em uma pasta de sua preferência e aponte no php.ini:

```bash
curl.cainfo = "C:\caminho\para\o\cacert.pem"

openssl.cafile = "C:\caminho\para\o\cacert.pem"
````

- **Redis via Docker**: utilizei um container para o redis via docker, lembre-se de subir antes de rodar o projeto:
```bash
docker run --name biblioteca-redis -p 6379:6379 -d redis:alpine
```

## 4. Rodando

- Suba as migrations
````bash
php artisan migrate
````

- Inicia o serviço
```bash
php artisan serve
```

# Rotas Principais
#### O sistema utiliza rotas de recursos (``Route::resource``), as principais URLs são:

- **/livros**: Listagem com filtros, cadastro e edição de livros.
- **/Usuarios**: Listagem, cadastro e edição de usuários.
- **/locacoes/relatorio**: Ranking dos 10 livros mais locados (com Cache Redis).
- **/locacoes/generate**: Gera PDF do ranking de locações.

# Testes
- Os testes utilizam SQLite (em memória ou arquivo) Lembre-se de criar seu (``.env.testing``) para usar o SQLite.
  Para rodar os testes:

```bash
php artisan test
```
