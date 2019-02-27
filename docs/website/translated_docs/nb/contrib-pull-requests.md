---
id: contrib-pull-requests
title: Submitting a Pull Request
sidebar_label: Pull Requests
---
`Pull requests let you tell others about changes you've pushed to a branch in a repository on GitHub. Once a pull request is opened, you can discuss and review the potential changes with collaborators and add follow-up commits before your changes are merged into the base branch.` [Read more](https://help.github.com/articles/about-pull-requests/)

## Forking/Cloning

* Create a github account if you don't already have one
* Go to https://github.com/blitze/phpBB-ext-sitemaker.git and click on "Fork"

Clone your fork of the repository:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

From command line go to sitemaker directory:

    cd phpBB/ext/blitze/sitemaker
    

**Configure git:**

Add your Username to Git on your system:

    git config --global user.name "Your Name Here"
    

Add your E-mail address to Git on your system:

    git config --add user.email username@phpbb.com
    

Add the upstream remote (you can change ‘upstream’ to whatever you like):

    git remote add upstream git://github.com/blitze/phpBB-ext-sitemaker.git
    

**Install vendors**

    composer install
    

**Install NPM packages**

    npm install
    

Alternatively you may use [yarn](https://yarnpkg.com):

    yarn install
    

## Pull Requests

    # Create a new branch for your feature & switch to it
    git checkout -b feature/my-fancy-new-feature
    
    # create a new branch for the issue you are working on * switch to it (ticket # is from github tracker)
    git checkout -b ticket/1234
    

Make your changes

    # Stage the files
    git add <files> 
    
    # Commit staged files - please use a correct commit message
    git commit -m "my commit message"
    

Push the branch back to GitHub git push origin feature/my-fancy-new-feature

Submit a [pull-request](https://github.com/blitze/phpBB-ext-sitemaker/pulls)