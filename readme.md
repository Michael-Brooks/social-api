# Social API
To begin, clone repo then run composer install.

Homestead has been added as default.

### Homestead installation
1. `vendor/bin/homestead make`
2. `vagrant up`

### Migrations and Seeds
1. `php artisan migrate`
2. `php artisan db:seed`

### Generate JWT secret
`php artisan jwt:generate`

# Contributing
If you see anything which can be added, improved upon or any bug fixes then
please feel free to send a pull request.
