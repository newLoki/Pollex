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

##Setup the database
Create a new database called pollex by typing
`mysql -u<username> -p<password> -e "CREATE DATABASE IF NOT EXISTS pollex"`
If the database is successfull created, you can bring your database schema to the max by typing:
`java -jar liquibase.jar --driver=com.mysql.jdbc.Driver \
      --classpath=databasedriver/mysql-connector-java-5.1.17-bin.jar \
      --changeLogFile=../data/sql/changelog.xml \
      --url="jdbc:mysql://127.0.0.1:3306/pollex" \
      --username=root \
      --password=root \
      migrate`