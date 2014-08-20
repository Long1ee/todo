## Классы

http://php.net/manual/ru/language.oop5.php

1. Настройки доступа
2. Конструкторы, специальные методы
3. Наследование
4. Неймспейсы

http://php.net/manual/ru/language.namespaces.php

5. Использование

## Композер

1. Автозагрузка классов
2. Подключение сторонних пакетов

## Базы данных

1. Работа из консоли

http://habrahabr.ru/post/123636/

CREATE TABLE todo (
    id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(5) NOT NULL, 
    description TEXT, 
    createdAt DATETIME,
    dueAt DATETIME,
    isResolved TINYINT(1) DEFAULT 0,
    PRIMARY KEY(`id`), 
);

CREATE TABLE user (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR, 
    createdAt DATETIME,
    PRIMARY KEY(`id`),
);

2. [Пдо](http://habrahabr.ru/post/137664/)

## Приложение

http://silex.sensiolabs.org/

http://habrahabr.ru/post/136110/