# ExpensesApp

Este projeto é uma aplicação web desenvolvida com [Laravel](https://laravel.com/) e [Vue.js](https://vuejs.org/) utilizando o [Quasar Framework](https://quasar.dev/). Ele oferece uma solução para gerenciamento de despesas.

## Pré-requisitos

Antes de iniciar, certifique-se de ter instalado em sua máquina:
- [PHP](https://www.php.net/) (versão compatível com Laravel)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/)
- [MySQL](https://www.mysql.com/)

## Configuração Inicial

Modifique eu .env com as seguinte variáveis:
```bash
APP_NAME=
APP_ENV=
APP_KEY=
 
DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD= 
QUEUE_CONNECTION=

MAIL_MAILER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
```

Instale todas as bibliotecas do seu projeto
```bash
php artisan install
php artisan migrate
npm run install
```

Agora rode sua aplicação rodando simultaneamente:
```bash
php artisan serve
npm run dev
```

## Referências para criação deste projeto:
- [Controller-Middleware](https://laravel.com/docs/10.x/controllers#controller-middleware) 
- [Autorization](https://laravel.com/docs/10.x/authorization)
- [Testing](https://laravel.com/docs/10.x/testing)
- [Form Request](https://laravel.com/docs/10.x/validation#creating-form-requests)
- [Install Quasar in Laravel](https://www.youtube.com/watch?v=nR_2EfV43-4&t=1161s&ab_channel=LaraPhant)
- [Quasar components](https://quasar.dev/)
