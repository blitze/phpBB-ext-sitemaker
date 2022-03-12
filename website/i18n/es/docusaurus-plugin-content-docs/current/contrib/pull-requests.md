---
title: Enviando un Pull Request
sidebar_label: Pull Requests
---

`Pull requests le permite informar a otros sobre los cambios que ha introducido en una rama en un repositorio en GitHub. Una vez que un pull request está abierto, puede discutir y revisar los cambios potenciales con los colaboradores y añadir confirmaciones de seguimiento antes de que sus cambios se fusionen en la rama base.` [Leer más](https://help.github.com/articles/about-pull-requests/)

## Forking/Clonando

* Crea una cuenta de github si aún no tienes una
* Ve a https://github.com/blitze/phpBB-ext-sitemaker.git y haz clic en "Fork"

Clona tu fork del repositorio:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

Desde línea de comandos ir al directorio sitemaker:

    cd phpBB/ext/blitze/sitemaker

**Configurar git:**

Añada su nombre de usuario a Git en su sistema:

    git config --global user.name "Tu nombre aquí"

Añada su dirección de correo electrónico a Git en su sistema:

    git config --add username@phpbb.com user.email

Añade el control remoto (puedes cambiar 'upstream' a lo que quieras):

    git remote add upstream git://github.com/blitze/phpBB-ext-sitemaker.git

**Instalar vendedores**

    instalar composer

**Instalar paquetes NPM**

    npm install

También puedes usar [yarn](https://yarnpkg.com):

    instalar yarn

## Pull Requests

    # Crea una nueva rama para tu característica & cambia a ella
    git checkout -b feature/my-fancy-new-feature
    
    # crea una nueva rama para el problema en el que estás trabajando * cambia a ella (ticket # es desde github tracker)
    git checkout -b ticket/1234

Realiza tus cambios

    # Etapa los archivos
    git add <files> 
    
    # Commit staged files - por favor usa un mensaje de commit correcto
    git commit -m "mi mensaje de commit"

Enviar la rama de vuelta a GitHub git push origin feature/my-fancy-new-feature

Envía un [pull-request](https://github.com/blitze/phpBB-ext-sitemaker/pulls)
