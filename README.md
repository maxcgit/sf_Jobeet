# Jobeet Tutorial with Symfony2 

http://www.ens.ro/2012/03/21/jobeet-tutorial-with-symfony2/

http://symfony.in.ua/symfony2-jobeet-tutorial.html

###Day1

Create project

console|info 
---|---
`curl -sS https://getcomposer.org/installer : php`|install composer
`php composer.phar update`|composer update
`php composer.phar create-project symfony/framework-standard-edition path/ 2.5.0`|install symfony
`php bin/console generate:bundle --namespace=Max/JobeetBundle --format=annotation`|generate bundle
`php bin/console cache:clear`|cache clear


###Day2

Collect User Case

###Day3

Generate - Entity, Tables in DB, CRUD

console|info 
---|---
`php bin/console doctrine:database:create`|database create
`php bin/console doctrine:generate:entities MaxJobeetBundle`|generate entities
`php bin/console doctrine:schema:update --force`|create tables in database
`php bin/console doctrine:fixtures:load`|load fixtures(doctrine/doctrine-fixtures-bundle)
`php bin/console doctrine:generate:crud --entity=MaxJobeetBundle:Job --route-prefix=max_job --with-write --format=annotation`|generate crud

###Day4

View

console|info 
---|---
`php bin/console assetic:dump`|assetic dump to web folder

###Day5

Routing

console|info 
---|---
`php bin/console router:debug` or `php bin/console r:de`|list all routs

###Day6

Models, EntityRepository

###Day7

Category, Paginate

Update DB
`
php bin/console doctrine:database:drop --force

php bin/console doctrine:database:create

php bin/console doctrine:schema:update --force

php bin/console doctrine:fixtures:load
`

###Day8

Unit test

console|info 
---|---
`phpunit -c .`|Test