xmltranslateconver
==================
Convert translate files to xml.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist stivehu/yii2-translate2xml "*"
```

or add

```
"stivehu/yii2-translate2xml": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :
add config/console.php

```php
   [
    'modules' => [
        'translate2xml'=>[
            'class'=>\stivehu\translate2xml\commands\Translate2xmlController::class,
        ],
      ],
    ],
```

usage:

```
/yii translate2xml/convert2xml messages/hu_HU/messages.po hu-HU po output.xml
/yii translate2xml/convert2xml messages/hu_HU/messages.php hu-HU php output.xml
```