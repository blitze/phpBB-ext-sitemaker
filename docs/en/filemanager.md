# Responsive Filemanager

As of version 3.1.0, phpBB SiteMaker supports the [Responsive Filemanager](http://responsivefilemanager.com)

* The filemanager is used as a tinymce pluging (WYSIWYG editor) when editing custom blocks
* It is currently configured to creat separate folders for each user, except the user with a_sm_filemanager permission (Can see/manage other users' folders), which allows them access to view/manage all upload folders.

## Installation

* Download the responsive filemanager [here](http://responsivefilemanager.com/index.php#sthash.5UrnhjX2.dpbs)
* Extract it, and upload the files to your phpBB root folder. The file structure should be as below:
```
- root
  - phpBB
    - ...
    - images
    - includes
    - ...
    - ResponsiveFilemanager
      - filemanager
        - config
          - .htaccess
          - config.php
```

## Activation

* Go to ACP > Extensions > SiteMaker > Settings
* Enable Filemanager feature
* Save changes
* Update user permissions (Misc tab) to determine who can use this feature [Can use File Manager]
* Update admin permissions (Misc tab) to determine who can manager user folders [Can see/manage other users’ folders in File Manager]
