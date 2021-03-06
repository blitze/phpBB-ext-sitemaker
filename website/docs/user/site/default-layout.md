---
title: Setting a Default Layout
sidebar_position: 4
---

When you add a block, it is added to that specific page. It would, therefore, be a tedious task to set blocks for all the pages on your site.
You can set all the desired blocks for a particular page, then set that page as the default layout.
In others words, any page that does not have its own blocks, will inherit blocks from this page.

To set a default layout
* Go to the page that you'd like to set as default layout
* Click on `Settings` in the admin bar
* Click the `Set as default layout` button

Say we add blocks to a page (phpBB/index.php) with blocks in the sidebar and top positions, for example, and set it as our default layout.
This has the following effects for other pages:
* Any page that does not have its own blocks, will inherit the blocks from the default layout. See [Understanding Block Inheritance](/docs/user/site/block-inheritance) for exceptions.
* You may still inherit blocks from a default layout (index.php) but choose to not display blocks on some block positions or not display any blocks at all. To do this,
	* Go to the page that you don't want all/some blocks to display
	* Click on `Settings` in the admin bar
	* Select `Do not show blocks on this page` if you don't want to inherit/display any blocks on this page OR
	* Use CTRL + click to select the block positions (on the right) that you do not want to display blocks on
* In `edit mode`, a page that inherits blocks from the default layout, will not show any blocks, giving you the opportunity to add blocks to the page if you want to
* Any page that has its own blocks will not inherit from the default layout
