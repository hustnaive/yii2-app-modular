Yii 2 模块化应用模板
============================

这个项目是一个[Yii 2](http://www.yiiframework.com/)脚手架模板，用于创建模块化的web应用。

本模板基于[Yii 2 basic Project Template](https://github.com/yiisoft/yii2-app-basic)。

目录结构
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
		|		|		|--- Module.php
		|		...
		|--- mail/
		|--- runtime/
		|--- tests/
		|--- vendor/
		|--- web/
		|--- .gitignore
		|--- composer.json
		|--- composer.lock
		...


要求
------------

同Yii2，最低要求PHP 5.4.0.


安装
------------

### 从压缩包安装

点击[Download Zip](https://github.com/hustnaive/yii2-app-modular/archive/master.zip)链接下载安装包，并解压到本地web根目录下的`basic`。

然后，你还需要执行以下命令安装vendor里面的扩展包：

	cd /path/to/basic
	composer install

如果你还没有安装[Composer](http://getcomposer.org/), 你需要先依照[Composer安装文档](http://docs.phpcomposer.com/00-intro.html#Installation-*nix)安装Composer。

然后，你可以在浏览器中输入如下URL访问示例了。

~~~
http://localhost/basic/web/
~~~


### 通过Composer安装

如果你已经安装了Composer，你可以通过执行如下命令安装:

~~~
cd /path/to/basic
composer global require "fxp/composer-asset-plugin:~1.0.0"
composer create-project --prefer-dist --stability=dev hustnaive/yii2-app-modular basic
~~~

然后，你可以在浏览器中输入如下URL访问示例了。

~~~
http://localhost/basic/web/
~~~


配置
-------------

### Database

编辑 `config/db.php`，将里面的配置修改为真实的数据，例如:


	return [
	    'class' => 'yii\db\Connection',
	    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
	    'username' => 'root',
	    'password' => '1234',
	    'charset' => 'utf8',
	];


新建模块
----

* 在modules目录创建一个模块名命名的目录，比如`admin`
* 仿照demo的样子，在`admin`下新建`Module.php`（可以从demo中拷贝过来，但是namespace等需要修改为你自己的）
* 仿照demo的样子，在`admin`下新建controller,views,models目录用于存储本模块的控制器，模板，模型代码。
* 在`config/modules.php`中，仿照demo的样子新建一个指向`admin`的配置项


运行测试
---

tests就是框架默认创建的测试代码目录，里面有框架提供的一些测试的例子，你可以按如下步骤测试一下：

* `cd basic/tests/` 进入CodeCeption测试用例所在目录
* `codecept build`  将构建测试用例（根据cept生成tester）   
* `codecept run`    运行测试用例

如果你终端提示codecept命令未知，请执行以下命令安装codeception扩展：

	composer global require "codeception/codeception=2.0.*"
	composer global require "codeception/specify=*"
	composer global require "codeception/verify=*"
	composer require --dev yiisoft/yii2-faker:*

正常安装后，再执行`codecept run`时，如果看到类似如下的报错：

	1) Failed to ensure that about works in [1mAboutCept[22m (D:\php\basic\tests\codeception\acceptance\AboutCept.php)
	Can't be on page "/index-test.php?r=site%2Fabout":
	GuzzleHttp\Exception\ConnectException: cURL error 7: Failed to connect to localhost port 8080: Connection refused

提示在8080端口连接拒绝，这里，我们需要修改一下配置文件:

* 修改`basic/tests/codeception.yml`里面的`config/test_entry_url`配置，为你实际的项目入口地址
* 修改`basic/tests/codeception/acceptance.suite.yml`里面的`modules/config/PhpBrowser`配置为你实际的地址

完成后，再执行`codecept run`，你应该可以看到终端没有报错了。

我们来看看tests目录的结构：

	webroot/basic/tests
		|--- codeception/
		|		|--- _output/
		|		|--- _pages/
		|		|--- acceptance/
		|		|--- bin/
		|		|--- config/
		|		|--- fixtures/
		|		|--- functional/
		|		|--- templates/
		|		|--- unit
		|		|--- _bootstrap.php
		|		|--- acceptance.suite.yml
		|		|--- functional.suite.yml
		|		|--- unit.suite.yml
		|--- codeception.yml

其实，这里acceptance、functional、unit是Yii2默认为我们创建的三个suite，顾名思义，分别用于验收，功能，单元测试。

而执行`codecept run`时，会依次将codeception目录的所有suite运行，故，你可以通过`codecept run suitename`的方式制定执行某个suite；同理，可以执行`codecept run suitename testname`的方式执行某个test。

你可以仿照functional，unit，acceptance里面的例子写你自己的测试用例。
