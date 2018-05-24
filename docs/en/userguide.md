# phpBB SiteMaker Userguide

Below you will find some information on how to perform common tasks in phpBB SiteMaker

## Table of Contents

- [Introduction](#introduction)
- [Blocks](#blocks)
  * [Managing blocks](#managing-blocks)
    + [Adding blocks](#adding-blocks)
    + [Editing blocks](#editing-blocks)
      - [Adding a block icon](#adding-a-block-icon)
      - [Editing the Block Title](#editing-the-block-title)
      - [Editing block settings](#editing-block-settings)
      - [Deleting blocks](#deleting-blocks)
    + [Custom Block](#custom-block)
  * [Managing Layouts](#managing-layouts)
    + [Setting a Default Start page](#setting-a-default-start-page)
    + [Setting a Default Layout](#setting-a-default-layout)
    + [Understanding Block Inheritance](#understanding-block-inheritance)
      - [Parent/Child Routes](#parent-child-routes)
      - [Block Inheritance](#block-inheritance)
- [Layouts](#layouts)
    + [Block Positions](#block-positions)
    + [Site Layout](#site-layout)
- [Menus](#menus)
  * [Managing Menus](#managing-menus)
    + [Creating Menus](#creating-menus)
    + [Editing Menus](#editing-menus)
    + [Deleting Menus](#deleting-menus)
  * [Managing Menu Items](#managing-menu-items)
    + [Adding Menu items](#adding-menu-items)
      - [Adding single menu items](#adding-single-menu-items)
      - [Adding multiple items](#adding-multiple-items)
    + [Reorder the menu items](#reorder-the-menu-items)
    + [Rebuilding the menu items](#rebuilding-the-menu-items)
  * [Displaying Menus](#displaying-menus)
    + [Links Block](#links-block)
    + [Menus Block](#menus-block)
    + [Navigation bar](#navigation-bar)

## Introduction

phpBB SiteMaker seeks to transform your phpBB board into a CMS/portal. It does so by providing you with blocks and menus to help you customize your site to your liking. There are or will be other SiteMaker extensions that provide additional functionality to meet this goal. It also allows you to define a landing page when your site is accessed. So if you don't want visitors to your site to immediately see the phpBB forum when they go to www.your-site.com, you can define your own start page.

## Blocks
Blocks are little pieces of content that you can place in different pre-defined areas (block positions) on your site.
With the proper permissions, you can add, edit, delete blocks, set default layouts, or add a default start page for your site.
To get started, you will need to switch to "edit mode" by clicking on the pencil icon on the top right of your site.
This will display the "Admin bar" with "Blocks" and "Layouts" menu items. This is referred to as being in 'edit mode'.

### Managing blocks

**Please note:**
* When a block does not display any content, it will not be displayed, except in edit mode. That way, you can either give it content (in the case of the Custom block) or change its settings.
* In edit mode, the somewhat transparent blocks are blocks that will otherwise not be displayed but are only being displayed because we are in edit mode

#### Adding blocks
You can add blocks to any front-facing page, except the User Control Panel and Moderator Control Panel pages. 
To add a block, you will need to:
* click on **Blocks** in the Admin bar. This will display a list of available blocks
* Drag and drop the desired block to any block position

#### Editing blocks
##### Adding a block icon
To the left of the block title (prosilver), there is a box for the block icon.
Click on this box to get the icon picker.
You can select the icon size, color, float, rotation, etc.

##### Editing the Block Title
phpBB SiteMaker blocks will have a default, translated title but if the title does not meet your needs, you can change it.
To edit the block title,
* Click on the block title to get an inline edit form
* Change the title to whatever you want
* Remove focus from the field or hit enter to submit changes

Please note:
* Your modified block title is not translated
* To revert to the default title, simple delete the title and hit enter

##### Editing block settings
When you hover over a block, a cog icon will appear to the right of the block that can be used to edit the block.
In the edit block dialog, you can:
- Enable/disable a block [Status]
- Choose when the block should/should not be displayed [Display]. This only applies in cases where you have nested pages (see **Understanding Block Inheritance** below):
	- **Always**: Always display the block
	- **Hide on child routes**: Only show this block on the parent route
	- **Show on child routes only**: Only show this block on a child route
- Choose which groups of users can view the block [Viewable by]. Use CTRL + click to select multiple groups.
- Set custom classes to modify the appearance of the block or items (lists, images, background, etc) within the block [CSS Class]
- Show/hide the block title [Hide block title?]
- Select the block view [Block view]. You can select a default block view when new blocks are added in ACP.
	- Default / Simple: uses the prosilver panel class to wrap the block in a padded container
	- Basic: block does not have any container wrapping it
	- Boxed: uses the prosilver forabg class to wrap the block in a box
- Set / Update block specific settings
- If you have the same block with same settings across multiple pages, you can update all of them at once by checking the **Update blocks with similar settings**

##### Deleting blocks
- Hover over the block you'd like to delete
- Click on the **x** icon and confirm that you wish to delete the block
- Go up to the admin bar and click on save changes

#### Custom Block
If the available blocks do not give you the freedom you need, there is the Custom Block which allows you the freedom to display your own content using BBcode or HTML.
The block comes with a WYSIWYG editor (Tinymce) and a [Filemanager](./filemanager.md):

**The editor:**
* You can use the editor to create HTML content
* You can edit the source code if you need that level of control by clicking on the **Source code** icon (**<>**) in the editor
* The editor allows you to upload and modify images
* The editor filters out any potentially dangerous scripts like javascript, etc. If you need to add content like google ads, the javascript will be filtered out, but you can get around that by doing the following:
	* Add the Custom Block to desired location
	* Edit the Custom Block, click on the **Source** tab and paste your Javascript 

**The File manager:**

The Custom Block also comes with a [File Manager](./filemanager.md) as a tinymce pluglin
* It creates a new folder in phpBB/images/sitemaker_uploads/ for every user who has access to it
* You can view/manage all user folders
* You can edit images using aviary online editor

### Managing Layouts

#### Setting a Default Start page
phpBB SiteMaker allows you to choose any front controller (pages accessed via app.php/...) as your default start page (the page that will be shown when someone visits your site) instead of the board index.
To do this:
* Go to the page that you want to set as default start page
* Click on **Layout** in the admin bar. If it is an eligible page, you will see a **Set as start page** button
* Click on the **Set as start page** button

#### Setting a Default Layout
When you add a block, it is added to that specific page. We understand therefore that it would be a tedious task to set blocks for all the pages on your site.
You can set all the desired blocks for a particular page, then set that page as the default layout.

To set a default layout
* Go to the page that you'd like to set as default layout
* Click on **Layout** in the admin bar
* Click the **Set as default layout** button

Say we add blocks to a page (phpBB/index.php) with blocks in the sidebar and top positions, for example, and set it as our default layout. This has the following consequence:
* Any page that does not have its own blocks, will inherit the blocks from the default layout. See **Understanding Block Inheritance** below for exceptions.
* You may still inherit blocks from a default layout (index.php) but choose to not display blocks on some block positions or not display any blocks at all. To do this,
	* Go to the page that you don't want all/some blocks to display
	* Click on **Layout** in the admin bar
	* Select **Do not show blocks on this page** if you don't want to inherit/display any blocks on this page OR
	* Use CTRL + click to select the block positions (on the right) that you do not want to display blocks on
* In edit mode, a page that inherits blocks from the default layout, will not show any blocks, giving you the opportunity to add blocks to the page if you want to
* Any page that has its own blocks will not inherit from the default layout

#### Understanding Block Inheritance

##### Parent/Child Routes
In phpBB SiteMaker, we speak of nested routes in terms of real nested (sub) directories or virtually nested paths/routes. Please stay with me :).
* Real Parent/Child routes: For example, /some_dir/sub/index.php is a child of /some_dir/index.php
* Virtual Parent/Child routes: For example, viewtopic.php is treated as a child of viewforum.php.

Here are some examples of parent/child routes:

|Parent	                  |Child                           |
|-------------------------|--------------------------------|
|/index.php               |/viewforum.php, /dir/index.php  |
|/viewforum.php?f=2       |/viewtopic.php?f=2&t=1          |
|/app.php/articles        |/app.php/articles/my-article    |

##### Block Inheritance
Let's assume the following real directory structure:

	- example.com/phpBB/index.php
	- example.con/phpBB/dir/index.php
	- example.con/phpBB/dir/page.php
	- example.com/phpBB/dir/sub/index.php

For the purposes of displaying blocks, we say: 
* The parent route of example.com/phpBB/dir/sub/index.php is example.com/phpBB/dir/index.php and not example.com/phpBB/dir/page.php
* All pages in a sub directory relative to example.com/phpBB/index.php is a child route of example.com/phpBB/index.php. So example.com/phpBB/dir/index.php and example.com/phpBB/dir/page.php are all children of example.com/phpBB/index.php and will therefore inherit its blocks if they do not have blocks of their own. In this case:
	* When a block on example.com/phpBB/index.php is set to display on parent route only, the block will show on example.com/phpBB/index.php (parent route) but not on its child routes
	* When a block on example.com/phpBB/index.php is set to display on child route only, it will display on example.com/phpBB/dir/index.php and example.com/phpBB/dir/page.php but not on example.com/phpBB/index.php nor example.com/phpBB/dir/sub/index.php (we only go one level deep)
	* When a block on example.com/phpBB/index.php is set to display all, it will display on example.com/phpBB/index.php, example.com/phpBB/dir/index.php and example.com/phpBB/page.php but not on example.com/phpBB/dir/sub/index.php


## Layouts

#### Block Positions
Block positions are predefined areas on your site where blocks can exist.
The available block positions are determined by the template style that you are using.
For prosilver, phpBB SiteMaker comes with the following block positions:
* panel: full width across the top
* sidebar: left/right depending on layout below
* subcontent: similar to sidebar just larger
* top_hor: horizontal blocks across the top, flanking above sidebar/subcontent depending on layout
* top: above main content
* box: equal width, horizontal blocks below main content
* bottom: below main content
* bottom_hor: horizontal blocks across the bottom, flanking the sidebar/subcontent depending on layout
* footer: horizontal blocks in the footer

You can add more block positions in your own style templates by copying and modifying the corresponding phpBB SiteMaker templates

#### Site Layout
You can choose the layout for your site in ACP (Extensions > Sitemaker > Settings):
* Blog: subcontent and sidebar next to each other, pushed to the right, top_hor/botom_hor flank subcontent
* Holy Grail: equal width sidebar and subcontent on opposite sides, top_hor/botom_hor flank subcontent
* Portal: sidebar on left, subcontent on the right, top_hor/botom_hor flank subcontent
* Portal Alt: subcontent on left, sidebar on the right, top_hor/botom_hor flank sidebar


## Menus

You can create menus in ACP that you can then display using the Menus or the Links blocks or displayed as a horizontal navbar.

### Managing Menus

To manage menus, go to ACP > Extensions > Sitemaker > Menu

#### Creating Menus
To create a new menu (group), click on the **Add Menu** button.
A new menu group will be created with a randomly generated name.
The new menu will also be selected so you can begin adding menu items to it.

#### Editing Menus
If you want a more meaningful menu name,
* hover over the menu name and click on the cog icon
* enter the new menu name and hit enter to update it

#### Deleting Menus
To delete a menu, and its items,
* Hover over the menu name and click on the **x** icon
* If the menu item has no child items, you will need to confirm your choice to delete the item
* If the menu item has child items, you will need to indicate if you want to delete only the item and move its children up or if you want to delete the entire branch

### Managing Menu Items

#### Adding Menu items
You can add menu items one item at a time, or you can add multiple menu items at ones.

##### Adding single menu items
To add a single menu item,
* click on the **Add Menu Item** button
* Fill in the required information and hit **Save**

##### Adding multiple items
To add multiple menu items at once,
* Click on the ▼ icon next to **Add Menu Item**
* You can manually add items by placing each item on a new line and using the tab character nest items or
* You can click on one of the provided options at the bottom of the textarea to automatically fill in the menu items

#### Reorder the menu items
You can drag and drop the menu items up/down to set their display order, or drag them left/right to set the desired hierarchy.

#### Rebuilding the menu items
If you find that the menu items are not displaying correctly, click on the **Rebuild Tree** button to rebuild the menu items.

### Displaying Menus
You can display menus in several ways:

#### Links Block
You can use this block to display a flat or nested list of menu items.
This block is not intended to be used for navigation i.e. it will not show a current page or anything like that.
It is intended for a list of items, including external links.

#### Menus Block
This block is intended for site navigation. It does some additional computations to determine current location and is not intended to be a very large list.

#### Navigation bar
Similar to the Menus block, the navigation bar will display menu items as a responsive dropdown menu intended for site navigation.
You can enable this in ACP > Extensions > Sitemaker > Settings > Select menu
