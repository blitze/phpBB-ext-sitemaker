---
id: пользовательские блоки
title: Пользовательский блок
---

Если доступные блоки не дают тебе нужную свободу, есть `Пользовательский блок` , который позволяет вам свободно отображать свой собственный контент с помощью BBcode или HTML. The block comes with a WYSIWYG editor (TinyMCE) and a scripts manager:

## Редактор

- Вы можете использовать редактор для создания HTML-контента
- Вы можете изменить исходный код, если вам нужен такой уровень контроля, нажав на значок `Исходный код` (`<>`) в редакторе
- The editor allows you to upload and modify images 
    - It creates a new folder in phpBB/images/sitemaker_uploads/ for every user who has access to it
    - You can view/manage all user folders
- Редактор фильтрует любые потенциально опасные скрипты, такие как javascript и т.д. Если вам нужно добавить контент как Google рекламу, javascript будет отфильтрован, но вы можете обойти это, сделав следующее: 
    - Добавить пользовательский блок в нужное место
    - Редактировать пользовательский блок, нажмите на вкладку `HTML` и вставьте ваш Javascript

## The Scripts Manager

The Custom Block also allows you to add custom CSS and Javascript files to your page. To do this:

- Add a `Custom Block` to any block position. The position does not matter unless you are also displaying content with the block
- Edit the block, click on the `Scripts` tab and add your CSS or Javascript files > Word of caution though: Adding to many scripts on your page can affect load times