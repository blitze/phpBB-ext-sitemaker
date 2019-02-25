---
id: blocks-inheritance
title: Understanding Block Inheritance
---
We have already seen that by setting a default layout, other pages that do not have blocks of their own will inherit the blocks from the default layout. There is, however, another type of block inheritance.

## Parent/Child Routes

In phpBB SiteMaker, we speak of nested routes in terms of real nested (sub) directories or virtually nested paths/routes. Please stay with me :). * Real Parent/Child routes: For example, the path /some_directory/sub_directory/index.php is a child of /some_directory/index.php * Virtual Parent/Child routes: For example, viewtopic.php is treated as a child of viewforum.php.

Here are some examples of parent/child routes:

| Parent             | Child                          |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/articles  | /app.php/articles/my-article   |

## Parent/Child Block Inheritance

For parent/child routes, the child route inherits the blocks of the parent route (if the parent has its own blocks) or from the default layout (if one has been set). In other words, even if there is a default layout, the child route will inherit blocks from its parent route if the parent route has its own blocks. But not all blocks from the parent route must be inherited.

## Controlling Block Inheritance

At a block level, you can control when a block can be inherited by child routes. We touched on this earlier in the [Editing Block Settings](./blocks-managing#editing-block-settings).

Consider the following real directory structure:

    - phpBB/
        - Movies/
            - Comedy/
                - index.php
            - index.php
            - page.php
        - index.php
    

For the purposes of inheriting blocks, we say: * The parent route of /phpBB/Movies/Comedy/index.php is /phpBB/Movies/index.php and not /phpBB/Movies/page.php * All pages in a sub directory relative to /phpBB/index.php is a child route of /phpBB/index.php. So /phpBB/Movies/index.php and /phpBB/Movies/page.php are all children of /phpBB/index.php and will therefore inherit its blocks if they do not have blocks of their own. In this case: * When a block on /phpBB/index.php is set to display on **Hide on child routes**, the block will show on /phpBB/index.php (parent route) but not on its child routes * When a block on /phpBB/index.php is set to display on **Show on child routes only**, it will display on /phpBB/Movies/index.php and /phpBB/Movies/page.php (child routes) but not on /phpBB/index.php (parent), nor /phpBB/Movies/Comedy/index.php (we only go one level deep) * When a block on /phpBB/index.php is set to display **always** (default), it will display on /phpBB/index.php (parent), /phpBB/Movies/index.php and /phpBB/page.php (child routes) but not on /phpBB/Movies/Comedy/index.php (we only go one level deep). In this case, /phpBB/Movies/Comedy/index.php will inherit from the default route (if it exists)

## Posible Future State

I'm really interested in your feedback in this area. Most phpBB users will not have real directories as outlined above. So I'm thinking of using the structure that is defined in a menu block as a virtual directory structure and apply this parent/child inheritance to it. I'm also considering going beyond one level deep. Please let me know if this will be useful to you.