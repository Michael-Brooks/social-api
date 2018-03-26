# Social API
To begin, clone the repo and then run composer install.

Copy .env.example to .env and edit the DINGO/API section as needed ensuring API_DOMAIN matches the name of your domain.

Homestead has been added as default, but you can use your own choice.

### Homestead installation
1. `vendor/bin/homestead make`
2. Edit Homestead.yaml file as needed
3. `vagrant up`

### Migrations and Seeds (Database setup required)
1. `php artisan migrate`
2. `php artisan db:seed`

### Generate JWT secret
`php artisan  jwt:secret`

# Contributing
If you see anything which can be added, improved upon or any bug fixes then
please feel free to send a pull request.
