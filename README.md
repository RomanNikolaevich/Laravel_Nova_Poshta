Цель:
Реализовать и выполнить консольную команду парсинга (получения списка через API) городов и отделений Новой Почты с сохранением данных в БД. 
Сохранение данных должно учитывать мультиязычность.
Какие нужны таблицы в БД:
City-список городов (При парсинге добавить только первые 20 городов, из которых исключить такие города как: «Абрикосовка», «Агайманы», «Агрономичное», «Адамполь». 
Warehouse-список отделений в этих городах


Выполнение команд через консоль:
Запуск проекта:
sail up -d

миграции:
sail artisan migrate

запись в базу данных из API NovaPoshta:
sail artisan command:update-np-data



