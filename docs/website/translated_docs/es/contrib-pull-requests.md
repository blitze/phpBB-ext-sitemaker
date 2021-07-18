---
id: contrib-pull-requests
title: Enviando una Pull Request
sidebar_label: Pull Requests
---

`Las solicitudes de Pull te permiten informar a otros sobre los cambios que has empujado a una rama en un repositorio en GitHub. Una vez que se abre una pull request, puedes discutir y revisar los cambios potenciales con colaboradores y añadir confirmaciones de seguimiento antes de que tus cambios se fusionen en la rama base.` [Leer más](https://help.github.com/articles/about-pull-requests/)

## Forking/Cloning

* Crea una cuenta github si no tienes una
* Vaya a https://github.com/blitze/phpBB-ext-sitemaker.git y haga clic en "Fork"

Clonar el fork del repositorio:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

Desde la línea de comandos ir al directorio sitemaker:

    cd phpBB/ext/blitze/sitemaker
    

**Configurar git:**

Añade tu nombre de usuario a Git en tu sistema:

    git config --global user.name "Tu nombre aquí"
    

Añade tu dirección de correo electrónico a Git en tu sistema:

    git config --add user.email username@phpbb.com
    

Agrega el mando principal (puedes cambiar 'upstream' a lo que quieras):

    git remoto añadir git://github.com/blitze/phpBB-ext-sitemaker.git
    

**Instalar vendedores**

    instalación del compositor
    

**Instalar paquetes NPM**

    instalar npm
    

Alternativamente puedes usar [yarn](https://yarnpkg.com):

    instalación de yarn
    

## Pull Requests

    # Crear una nueva rama para su característica & cambiar a ella
    git checkout -b feature/my-fancy-new-feature
    
    # crear una nueva rama para el problema en el que está trabajando * cambiar a ella (ticket # es de github tracker)
    git checkout -b ticket/1234
    

Haz tus cambios

    # Etapa de los archivos
    git add <files> 
    
    # Commit staged files - por favor use un mensaje de confirmación correcto
    git commit -m "mi mensaje de confirmación"
    

Devuelve la rama a GitHub git función de origen push/mi-característica-nueva-elegante

Enviar una pull-request [](https://github.com/blitze/phpBB-ext-sitemaker/pulls)