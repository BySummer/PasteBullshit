Тестовое задание для одной из вакансий, аналог PasteBin.

Для запуска понадобится Docker, вот конкретная инструкция:
1. Разверните окружение, введя команду ```sudo docker-compose up -d```
2. Установите пакеты composer командой ```sudo docker exec -ti paste_bullshit_php composer install```
3. Установите ассеты symfony, используя команду ```sudo docker exec -ti paste_bullshit_php bin/console asset:install```
5. Примените миграции командой ```sudo docker exec -ti paste_bullshit_php bin/console d:m:m```

Готово! Теперь можно зайти по локальному адресу и создать пасту на главной странице.
