---
id: blok-özel
title: Özel Blok
---

If the available blocks do not give you the freedom you need, there is the `Custom Block` which allows you the freedom to display your own content using BBcode or HTML. Blok bir WYSIWYG editör (TİNYMCE) ve bir script yöneticisi ile birlikte gelir:

## The editor

- You can use the editor to create HTML content
- You can edit the source code if you need that level of control by clicking on the `Source code` icon (`<>`) in the editor
- Editör sizin görsel yüklemenize ve modifiye etmenize izin verir 
    - Ona erişimi olan her kullanıcı için phpBB/images/sitemaker_uploads/ içinde yeni bir klasör oluşturur
    - Tüm kullanıcıların klamsrlerini görebilir/yönetebilirsiniz
- The editor filters out any potentially dangerous scripts like javascript, etc. If you need to add content like google ads, the javascript will be filtered out, but you can get around that by doing the following: 
    - Add the Custom Block to desired location
    - Edit the Custom Block, click on the `HTML` tab and paste your Javascript

## Kod Yöneticisi

The Custom Block also allows you to add custom CSS and Javascript files to your page. To do this:

- Add a `Custom Block` to any block position. The position does not matter unless you are also displaying content with the block
- Edit the block, click on the `Scripts` tab and add your CSS or Javascript files > Word of caution though: Adding to many scripts on your page can affect load times