# Sms-reg API SDK YII2 component
Компонент для запросов к API sms-reg.com

## Установка

Установка при помощи [Composer](https://getcomposer.org). Выполните команду в корневом каталоге проекта:

```
composer require victor78/yii2-sms-reg
```

## Настройка 
api_key необходимо получить в личном кабинете sms-reg.com
```php
return [
    //...
    'components' => [
        'smsreg' => [
            'class' => Victor78\SmsRegComponent\Requestor::class,
            'api_key' => 'xxxxxxxxxxxxxxxxxxxx',
            'dev_key' => 'xxxxxxxxxxxxxxxxxxxx', //опционально
            'validator' => \Victor78\SmsReg\Validation\EmptyValidator::class, //опционально - если нужно отключить превалидацию
        ],
    ]
];

## Использование

Все публичные методы компонента носят имена аутентичных методов API согласно документации https://sms-reg.com/docs/API.html

```php
<?php

$balance_response = Yii::$app->smsreg->getBalance();
$balance = (float) $balance_response['balance'];
$list_response = Yii::$app->smsreg->getList(1);
$services = $list_response['services'];
```

## Тесты

Выполнить команду 
```
vendor/bin/phpunit
```
 
Для проверки со своим API KEY, в phpunit.xml указать актуальное значение **PHPUNIT_SMSREG_APIKEY**. 