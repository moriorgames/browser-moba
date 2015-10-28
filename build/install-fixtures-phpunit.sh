#!/bin/bash

cd..

# Reinstall the database
php app/console doctrine:database:drop --force
php app/console doctrine:database:create
php app/console doctrine:schema:update --force

# Load Fixtures
php app/console doctrine:fixtures:load -n

# Launch php-cs-fixer
php build/php-cs-fixer.phar fix ../browser-moba --config=sf23

# Launch phpunit
php build/phpunit-4.8.9.phar
