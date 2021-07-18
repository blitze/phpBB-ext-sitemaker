---
id: разработчик-тема
title: Тематика
---

phpBB SiteMaker поставляет стили и цвета, сделанные для процветания. Вы можете перезаписать CSS, JS и HTML файлы, создав соответствующий файл в папке стиля.

# Создание JS/CSS файлов для вашего стиля

Примечание: * Для целей нижеследующих инструкций мы предположим, что у вас стиль, называемый моим.

Клонировать в phpBB/ext/blitze/sitemaker:

    git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

Из командной строки перейдите в каталог sitemaker:

    cd phpBB/ext/blitze/sitemaker
    

**Установить поставщиков**

    установка композитора
    

**Установить пакеты**

Для нижеследующих команд вы можете использовать npm или [yarn](https://yarnpkg.com)

    yarn установка
    

**Смотреть изменения**

    yarn start --theme мой стиль
    

**Сделать изменения**

* Сделайте изменения в файлах в папке phpBB/ext/blitze/sitemaker/develop.
* Посмотрите на phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss для переменных sass

**Сборка Активов**

    yarn build --theme мой стиль
    

**Развертывание**

Теперь вы можете скопировать сгенерированные файлы из phpBB/ext/blitze/sitemaker/styles/my-style и загрузить их на ваш производственный сервер.

> Это расширение использует jQuery UI для вкладок, диалогов и кнопок. Тема jQuery по умолчанию - 'плавность.' Вы можете использовать другую тему jQuery UI, которая лучше всего подходит для вашей темы. Вы можете указать тему jQuery UI, используя флаг --jq_ui_theme. Например:

    yarn build --theme my-style --jq_ui_theme ui-lightness