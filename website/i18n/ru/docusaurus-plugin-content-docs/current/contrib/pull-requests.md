---
title: Отправка Pull Request
sidebar_label: Запросы на слияние
---

`Pull requests позволяют рассказать другим о изменениях, внесенных вами в ветку в репозиторий на GitHub. После открытия Pull Request вы можете обсудить и просмотреть потенциальные изменения с соавторами и добавить коммиты, прежде чем ваши изменения будут объединены в базовую ветку.` [Читать больше](https://help.github.com/articles/about-pull-requests/)

## Форкинг/Клонирование

* Создайте аккаунт github, если у вас еще нет его
* Перейдите на https://github.com/blitze/phpBB-ext-sitemaker.git и нажмите на "Fork"

Клонировать ваш форк репозитория:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

Из командной строки перейдите в директорию sitemaker:

    cd phpBB/ext/blitze/sitemaker

**Настроить git:**

Добавьте ваше имя пользователя в Git в вашу систему:

    git config --global user.name "Ваше имя здесь"

Добавьте ваш адрес электронной почты в Git в системе:

    git config --add user.email username@phpbb.com

Добавьте вверх (вы можете изменить «вверх» на то, что вам нравится):

    git remote add upstream git://github.com/blitze/phpBB-ext-sitemaker.git

**Установить поставщиков**

    установка исполнителя

**Установить пакеты NPM**

    npm install

Кроме того, вы можете использовать [yarn](https://yarnpkg.com):

    Установка yarn

## Запросы на слияние

    # Создайте новую ветку для вашей функции & переключитесь на нее
    git checkout -b feature/my-fancy-new-feature
    
    # создать новую ветку для проблемы, над которой вы работаете * переключатель (тикет # из github tracker)
    git checkout -b ticket/1234

Внести изменения

    # Этап файлов
    git add <files> 
    
    # Зафиксировать staged файлы - пожалуйста, используйте сообщение о подтверждении
    git commit -m "мое сообщение о подтверждении"

Отправка ветки обратно в GitHub git push origin feature/my-fancy-new-feature

Отправить [pull-request](https://github.com/blitze/phpBB-ext-sitemaker/pulls)
