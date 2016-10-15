Yii 2 模块化应用模板
============================

这个项目是一个[Yii 2](http://www.yiiframework.com/)脚手架模板项目，用于快速创建模块化的Yii 2 Web应用。

本模板代码基于[Yii 2 Basic Project Template](https://github.com/yiisoft/yii2-app-basic)。

如果你的Web应用很简单，你可以参考[Yii 2 Basic Project Template](https://github.com/yiisoft/yii2-app-basic)的指示操作。同样，如果你觉得本项目依然无法满足的需求，你的项目预计会有前后端分离，并且项目非常复杂时，你可以参考[Yii 2 Advanced Project Template](https://github.com/yiisoft/yii2-app-advanced)。

目录结构
-------------------
	webroot/
		|--- assets/					包含Assets的定义
		|--- commands/					包含控制台命令
		|--- config/					配置文件（初始化环境时创建）
		|--- modules/					模块代码目录
		|		|--- demo/				示例模块（demo，开发环境下创建）
		|		|		|--- controllers/
		|		|		|--- views/
		|		|		|--- models/
		|		|		|--- Module.php	模块初始化类
		|		...
		|--- mail/
		|--- runtime/
		|--- tests/
		|--- vendor/					第三方扩展（初始化后才创建）
		|--- web/						Web根目录，请将document root 配到此目录
		|--- .gitignore
		|--- composer.json				composer依赖包
		|--- composer.lock				composer生成的lock文件，以确定是否安装正确的依赖
		...


系统要求
------------

同Yii2，最低要求PHP 5.4.0.


安装
------------

### 从压缩包安装

点击[Download Zip](https://github.com/hustnaive/yii2-app-modular/archive/master.zip)链接下载安装包，并解压到本地web根目录下的`basic`。

然后，你还需要执行以下命令安装vendor里面的依赖包：

	cd /path/to/basic
	composer global require "fxp/composer-asset-plugin:~1.1.1"
	composer install

如果你还没有安装[Composer](http://www.phpcomposer.com/), 你需要先依照[Composer安装文档](http://docs.phpcomposer.com/00-intro.html#Installation-*nix)的指示安装Composer。

如果你在国内，请参考[Composer中文镜像站](http://pkg.phpcomposer.com/)的指引配置Composer。

安装完依赖包之后，你还要执行一下以下初始化命令以将你的环境相关的配置代码正确初始化：

	cd /path/to/basic
	php init.php

然后，根据提示操作即可。

关于初始化环境可见『初始化环境』章节。

然后，你可以在浏览器中输入如下URL访问示例了。

	http://localhost/basic/web/

### 通过Composer安装

如果你已经安装了Composer，你可以通过执行如下命令安装:

	cd /path/to/webroot
	composer global require "fxp/composer-asset-plugin:~1.1.1"
	composer create-project --prefer-dist --stability=dev "hustnaive/yii2-app-modular:1.1" basic

同上，在代码下载安装完毕之后，你还需要初始化环境：

安装完依赖包之后，你还要执行一下以下初始化命令以将你的环境相关的配置代码正确初始化：

	cd /path/to/basic
	php init.php


然后，你可以在浏览器中输入如下URL访问示例了。

	http://localhost/basic/web/


初始化环境
-------------

这里，我们假设环境有'dev' - 本地开发环境、'prod'- 生产环境，当然，你也可以根据自己的需要增加其他的环境。

环境相关的文件放在environments目录里面，以环境名命名的目录。比如模板的environments目录结构如下：

	/path/to/basic
		|--- ...
		|--- environment/
				|--- dev/
						|--- ...
				|--- prod/
						|--- ...
				|--- initconf.php

当我们执行`php init.php`时，环境初始化代码会读取environment/initconf.php，并根据配置来讲当前代码环境切换为对应的环境配置。

initconf.php的配置示例如下：

	<?php
	return [
	    'Development' => [
	        'path' => 'dev',
	        'setWritable' => [
	            'runtime',
	            'web/assets',
	        ],
	        'setExecutable' => [
	            'yii',
	            'tests/codeception/bin/yii',
	        ],
	        'setCookieValidationKey' => [
	            'config/web.php',
	        ],
	    ],
	    'Production' => [
	        'path' => 'prod',
	        'setWritable' => [
	            'runtime',
	            'web/assets',
	        ],
	        'setExecutable' => [
	            'yii',
	            'tests/codeception/bin/yii',
	        ],
	        'setCookieValidationKey' => [
	            'config/web.php',
	        ],
	    ],
	];

里面是$enviroment => $envconf形式的数组，其中$envconf里面的path代表对应环境有关的代码文件的存储路径，初始化过程会把里面的代码文件拷贝到应用根目录并根据操作覆盖。

所以，对于与环境有关的代码，比如数据库配置等，你需要把文件按照根目录其的位置放在对应的环境目录里。

比如，范例的dev环境：
	
	environments/dev/
		|--- config/
		|--- web/
		|--- modules/

在初始化时，会依次新建/覆盖根目录下的对应文件，这样，当我们需要修改配置代码的时候，只需要对应修改环境代码即可。

>注意：这里，config,web,modules会放在.gitignore里，以避免你将其提交了。本章节的思想来源于[Yii 2 Advanced Project Template](https://github.com/yiisoft/yii2-app-advanced)，关于环境的分析见文章：[环境和配置文件](http://www.digpage.com/environment.html)。


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

提示在xx端口连接拒绝，这里，我们需要修改一下配置文件:

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
