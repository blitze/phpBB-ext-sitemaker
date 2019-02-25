---
id: blocks-managing
title: Mananaging Blocks
---
To manage blocks in phpBB SiteMaker, you must be in [Edit Mode](./blocks-overview#edit-mode).

> When a block does not display any content, it will not be displayed, except in edit mode. That way, you can either give it content (in the case of the Custom block) or change its settings.
> 
> In edit mode, the somewhat transparent blocks are blocks that will otherwise not be displayed but are only being displayed because we are in edit mode

## Adding blocks

You can add blocks to any front-facing page, except the User Control Panel and Moderator Control Panel pages. To add a block, you will need to: * click on **Blocks** in the Admin bar. This will display a list of available blocks * Drag and drop the desired block to any block position

## Editing blocks

### Adding a block icon

To the left of the block title (prosilver), there is a box for the block icon. Click on this box to get the icon picker. You can select the icon size, color, float, rotation, etc.

### Editing the Block Title

phpBB SiteMaker blocks will have a default, translated title but if the title does not meet your needs, you can change it. To edit the block title, * Click on the block title to get an inline edit form * Change the title to whatever you want * Remove focus from the field or hit enter to submit changes

> Your modified block title is not translated
> 
> To revert to the default title, simple delete the title and hit enter

### Editing block settings

When you hover over a block, a cog icon will appear to the right of the block that can be used to edit the block. In the edit block dialog, you can: - Enable/disable a block [Status] - Choose when the block should/should not be displayed [Display]. This only applies in cases where you have nested pages (see [Understanding Block Inheritance](./blocks-inheritance.md)): - **Always**: Always display the block - **Hide on child routes**: Only show this block on the parent route - **Show on child routes only**: Only show this block on a child route - Choose which groups of users can view the block [Viewable by]. Use CTRL + click to select multiple groups. - Set custom classes to modify the appearance of the block or items (lists, images, background, etc) within the block [CSS Class] - Show/hide the block title [Hide block title?] - Select the block view [Block view]. You can select a default block view when new blocks are added in ACP. - **Default / Simple**: uses the prosilver panel class to wrap the block in a padded container - **Basic**: block does not have any container wrapping it - **Boxed**: uses the prosilver forabg class to wrap the block in a box - Set / Update block specific settings - If you have the same block with same settings across multiple pages, you can update all of them at once by checking the **Update blocks with similar settings**

## Deleting blocks

- Hover over the block you'd like to delete
- Click on the **x** icon and confirm that you wish to delete the block
- Go up to the admin bar and click on `Save Changes`