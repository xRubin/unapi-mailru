# Unapi MailRu
[![Build Status](https://travis-ci.org/xRubin/unapi-mailru.svg?branch=master)](https://travis-ci.org/xRubin/unapi-mailru)
[![Latest Stable Version](https://poser.pugx.org/unapi/mailru/v/stable)](https://packagist.org/packages/unapi/mailru)

Модуль для работы с Web интерфейсом почты [Mail.ru](https://mail.ru)

Являтся частью библиотеки [Unapi](https://github.com/xRubin/unapi)

### Установка
```bash
composer require unapi/mailru
```
### Получение токена авторизации
```php
use unapi\mailru\Service;
use unapi\mailru\Credentials;

$service = new Service();
$credentials = new Credentials('login@mail.ru', 'password');

$token = $service->getToken($credentials)->wait();
```

### Получение данных из интерфейса ящика

```php
use unapi\mailru\parser\Mailbox;

/** @var Mailbox $mailbox */
$mailbox = $service->getMailbox($credentials, $token)->wait();

var_dump($mailbox->getBody()->getFolders());
var_dump($mailbox->getBody()->getThreads());
```
