# Contributing to phpBB SiteMaker

## Forking/Cloning

* Create a github account
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

    php composer.phar install

**Install packages**

	npm install -g gulp bower
	npm install

Alternatively you may use [yarn](https://yarnpkg.com):

	yarn global add gulp bower
	yarn install

## Collaborate

* Create a issue in the [tracker](https://github.com/blitze/phpBB-ext-sitemaker/issues)
* Note the restrictions for [branch names](https://wiki.phpbb.com/Git#Branch_Names) and [commit messages](https://wiki.phpbb.com/Git#Commit_Messages) are similar to phpBB3
* Submit a [pull-request](https://github.com/blitze/phpBB-ext-sitemaker/pulls)

## Pull Requests

	git checkout -b feature/my-fancy-new-feature # Create a new branch for your feature & switch to it
	git checkout -b ticket/1234 # create a new branch for the issue you are working on * switch to it (ticket # is from github tracker)
	# Make your changes
	git add <files> # Stage the files
	git commit # Commit staged files - please use a correct commit message
	# Make more changes & commits
	git push origin feature/my-fancy-new-feature # Push the branch back to GitHub
