# test-app

Requirements:
-------------

* PHP 7.2.5 or higher
* Composer
* Node.js
* MySQL

Installation proecss:
---------------------

```composer install```

```yarn install```

```yarn dev```

### Configure DATABASE_URL in .env then run:

```php bin/console doctrine:migrations:migrate```

### Load fixtures if needed:

```php bin/console doctrine:fixtures:load```

### Run tests:

```php bin/phpunit```
