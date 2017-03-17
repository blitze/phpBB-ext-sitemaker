# Changelog

## 3.0.0 - 2017-3-17

- Support for phpBB 3.2.x
- Ability to choose icon for 'Forum' in navbar
- Ability to hide phpBB's login, birthday, and who's online boxes on forum index in ACP
- Ability to choose default block type (simple, boxed, or borderless) in ACP
- Ability to choose block type (simple, boxed, or borderless) per block

## 2.0.4 - 2016-10-3

- Fix issue with massive topic icons and smiles
- Allow sub-folders as menu items
- Fix some drag & drop issues after deleting a block
- Only hide who is online on forum index if whois block is enabled
- Only hide birthday if birthday block is enabled
- Only hide stats if stats block is enabled
- Use codemirror instead of ace editor
- Add classes to show/hide blocks on small devices
- Fix relative paths in blocks contents returned via ajax
- Put main content before sidebar in html structure for better SEO
- Fix some issues with posting raw html content via ajax
- Force expand menu item if child items are unreachable
- Do not add session id to external URLs and directories
- Show last poster by default on Recent topics block
- Match phpBB's newest member in Recent Member block
- Fix issues with block display types for parent/child routes
- In edit mode, visually reveal blocks that will not be displayed outside of edit mode due to inactive status or no content

## 2.0.3 - 2016-07-28

- First release