Yii 2 Modular Project Template
============================

Yii 2 Modular Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
rapidly creating modular projects.

The template based on [Yii 2 basic Project Template](https://github.com/yiisoft/yii2-app-basic).

DIRECTORY STRUCTURE
-------------------
	webroot/
		|--- assets/
		|--- commands/
		|--- config/
		|--- modules/
		|		|--- demo/
		|		|		|--- controllers/
		|		|		|--- views/
		|		|		|--- models/
		|		|--- ...
		|--- mail/
		|--- runtime/
		|--- tests/
		|--- vendor/
		|--- web/
		|--- .gitignore
		|--- composer.json
		|--- composer.lock
		...



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Install from an Archive File

Extract the archive file downloaded by click the [Download Zip](https://github.com/hustnaive/yii2-app-modular/archive/master.zip) to
a directory named `basic` that is directly under the Web root.

You can then access the application through the following URL:

~~~
http://localhost/basic/web/
~~~


### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
php composer.phar global require "fxp/composer-asset-plugin:~1.0.0"
php composer.phar create-project --prefer-dist --stability=dev hustnaive/yii2-app-modular basic
~~~

Now you should be able to access the application through the following URL, assuming `basic` is the directory
directly under the Web root.

~~~
http://localhost/basic/web/
~~~


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTE:** Yii won't create the database for you, this has to be done manually before you can access it.

Also check and edit the other files in the `config/` directory to customize your application.
