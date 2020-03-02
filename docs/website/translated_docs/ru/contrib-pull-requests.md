---
id: contrib-pull-requests
title: Отправка Pull Request
sidebar_label: Pull Requests
---

`Pull requests позволяет вам рассказать другим об изменениях, которые вы отправили в ветку в репозитории на GitHub. После того, как запрос на слияние будет открыт, вы можете обсудить и просмотреть возможные изменения с соавторами и добавить последующие коммиты, прежде чем ваши изменения будут объединены в базовую ветку.` [Подробнее](https://help.github.com/articles/about-pull-requests/)

## Форжинг/Клонирование

* Создайте аккаунт github, если у вас еще нет аккаунта
* Перейдите на https://github.com/blitze/phpBB-ext-sitemaker.git и нажмите на "Fork"

Клонировать форк репозитория:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

Из командной строки перейдите в каталог sitemaker:

    cd phpBB/ext/blitze/sitemaker
    

**Настроить git:**

Добавьте ваше имя пользователя в Git в вашей системе:

    git config --global user.name "Your Name Here"
    

Добавьте свой адрес электронной почты в Git в вашей системе:

    git config --add user.email username@phpbb.com
    

Добавить удаленный поток (вы можете изменить «вверх» на все, что вам нравится):

    git remote add upstream git://github.com/blitze/phpBB-ext-sitemaker.git
    

**Установить поставщиков**

    установка композитора
    

**Установка пакетов NPM**

    npm установка
    

Или вы можете использовать [ярлыков](https://yarnpkg.com):

    yarn установка
    

## Pull Requests

    # Создайте новую ветку для вашей функции & переключиться на нее
    git checkout -b feature/my-fancy-new-feature
    
    # создать новую ветку для проблемы, которую вы работаете * переключиться на нее (ticket # с github tracker)
    git checkout -b ticket/1234
    

Внести изменения

    # Этап добавления файлов
    git <files> 
    
    # Сохранение отложенных файлов - пожалуйста, используйте правильное сообщение коммита
    git commit -m "my commit message"
    

Перетащите ветку обратно в GitHub git push origin feature/my-fancy-new-feature

Отправить [pull-request](https://github.com/blitze/phpBB-ext-sitemaker/pulls)