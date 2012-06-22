Actuall this project is only an unfinished API documentation.
But the goal is to bring it up to a generic tool for creating and analyzing polls.
Because of the fact, that this project is only a __RESTfull__ interface we need
some help from peoples which have ideas for nice frontend.
In the mockups folder, in gh-pages branch, are mockups for most of the actions you can perform on this API,
so the first client should be simple to realize, which meens, you are free to do this ;)
The full documentation, wrapped in a nice design, is availeaable under (http://newloki.github.com/Pollex).

[![Build Status](https://secure.travis-ci.org/newLoki/Pollex.png?branch=master)](http://travis-ci.org/newLoki/Pollex)

##Get started
_Pollex_ is a huge fan of composer, so you should use it to manage dependencies.
This means you have to type `php composer.phar install` to install all needed packages.

##Snippet for using Doctrine2 with Silex

###Working with models
`$article = new MyWebsite\Entity\Article();
 $article->setContent('Hello world!');
 $app['db.orm.em']->persist($article);
 $app['db.orm.em']->flush();`
[Source](http://martinsikora.com/silex-doctrine2-orm)

###Working with custom queries
`$app['db.orm.em']->createQuery('SELECT a FROM MyWebsite\Entity\Article a');`
[Source](http://martinsikora.com/silex-doctrine2-orm)

##Setup the database
Create a new database called pollex by typing
`mysql -u<username> -p<password> -e "CREATE DATABASE IF NOT EXISTS pollex"`
If the database is successfull created, you can bring your database schema to the max by typing:
`java -jar build/liquibase.jar --driver=com.mysql.jdbc.Driver \
      --classpath=build/databasedriver/mysql-connector-java-5.1.17-bin.jar \
      --changeLogFile=data/sql/changelog.xml \
      --url="jdbc:mysql://127.0.0.1:3306/pollex" \
      --username=root \
      --password=root \
      migrate`

#Testing
If you want to run the tests, there are certain steps to do before:
* Load composer, if not done yet (`wget http://getcomposer.org/composer.phar`)
* Install all dependencies (`php composer.phar install`)
* Create a test database (`mysql -u<username> -p<password> -e 'create database pollex;'`)
* Load testing data into database
`java -jar build/liquibase.jar \
    --driver=com.mysql.jdbc.Driver \
    --classpath=build/databasedriver/mysql-connector-java-5.1.17-bin.jar \
    --changeLogFile=data/sql/changelog.xml \
    --url="jdbc:mysql://127.0.0.1:3306/pollex" \
    --username=<username> \
    --password=<password> \
    --contexts="test" \
migrate`
* Run unittests (`phpunit`)

#Ideas
Validating POST|PUT request against json schemata with [justinrainbow/json-schema](https://github.com/justinrainbow/json-schema)

#ToDo
* toJSON for entities
    * validate against json-schema
* Group rights on polls
    * table
    * entity
* implement logging
* answers
    * table
    * entity
