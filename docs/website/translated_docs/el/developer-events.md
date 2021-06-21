---
id: προγραμματιστής-εκδηλώσεις
title: Εκδηλώσεις του phpBB SiteMaker
---

Μπορείτε να τροποποιήσετε τη συμπεριφορά του phpBB SiteMaker χρησιμοποιώντας το σύστημα γεγονότων του phpBB.

## Συμβάντα PHP

# blitze.sitemaker.acp_add_bulk_menu_options

- Τοποθεσία: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
- Από: 3.1.0
- Σκοπός: Προσθήκη μαζικών επιλογών μενού στο μενού acp

# blitze.sitemaker.acp_display_settings_form

- Τοποθεσία: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- Από: 3.1.0
- Σκοπός: μορφή ρυθμίσεων acp οθόνης (sitemaker)

# blitze.sitemaker.acp_save_settings

- Τοποθεσία: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- Από: 3.1.0
- Σκοπός: Αποθήκευση ρυθμίσεων acp (sitemaker)

# blitze.sitemaker.admin_bar.set_assets

- Τοποθεσία: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
- Από: 3.0.1-RC1
- Σκοπός: Προσθήκη στοιχείων για τα διαθέσιμα μπλοκ σε λειτουργία επεξεργασίας

# blitze.sitemaker.modify_block_positions

- Τοποθεσία: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- Από: 3.0.1-RC1
- Σκοπός: Τροποποίηση θέσεων μπλοκ

# blitze.sitemaker.modify_rendered_block

- Τοποθεσία: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- Από: 3.0.1-RC1
- Σκοπός: Τροποποίηση ενός αποτυπωμένου μπλοκ

## Συμβάντα Προτύπου

# blitze_sitemaker_acp_settings

- Τοποθεσία: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
- Από: 3.1.0
- Σκοπός: Προσθέστε πεδία φόρμας για τις ρυθμίσεις sitemaker

# blitze_sitemaker_admin_bar_append

- Τοποθεσία: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- Από: 3.1.0
- Σκοπός: Προσθήκη στοιχείων μενού στη γραμμή διαχείρισης

# blitze_sitemaker_admin_bar_templates

- Τοποθεσία: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- Από: 3.1.0
- Σκοπός: Προσθήκη αρχείων προτύπου που θα χρησιμοποιηθούν στο JS για προβολές μπλοκ, κλπ

## Συμβάντα Javascript

# blitze_sitemaker_layout_saved

- Τοποθεσία: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
- Από: 3.1.2
- Σκοπός: Γεγονός που επιτρέπει σε άλλες επεκτάσεις να κάνουν κάτι όταν αποθηκεύονται οι αλλαγές διάταξης

# blitze_sitemaker_render_block_before

- Τοποθεσία: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Από: 3.1.2
- Σκοπός: Το συμβάν που επιτρέπει σε άλλες επεκτάσεις να κάνουν κάτι πριν το μπλοκ αποδοθεί ή αποτρέψει την επανεμφάνιση του

# blitze_sitemaker_render_block_after

- Τοποθεσία: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Από: 3.1.2
- Σκοπός: Το συμβάν επιτρέπει σε άλλες επεκτάσεις να κάνουν κάτι μετά την απόδοση του μπλοκ

# blitze_sitemaker_save_block_before

- Τοποθεσία: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
- Από: 3.1.2
- Σκοπός: Γεγονός που επιτρέπει σε άλλες επεκτάσεις να τροποποιήσουν τα δεδομένα του block πριν αποθηκευτεί

# blitze_sitemaker_show_all_block_positions

- Τοποθεσία: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Από: 3.1.2
- Σκοπός: Γεγονός που επιτρέπει σε άλλες επεκτάσεις να κάνουν κάτι όταν εμφανίζονται όλες οι θέσεις μπλοκ

# blitze_sitemaker_hide_empty_block_positions

- Τοποθεσία: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Από: 3.1.2
- Σκοπός: Το συμβάν επιτρέπει σε άλλες επεκτάσεις να κάνουν κάτι όταν είναι κρυμμένες οι κενές θέσεις

# blitze_sitemaker_layout_εκκαθαρίστηκε

- Τοποθεσία: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Από: 3.1.2
- Σκοπός: Γεγονός που επιτρέπει σε άλλες επεκτάσεις να κάνουν κάτι όταν η διάταξη εκκαθαριστεί

# blitze_sitemaker_layout_updated

- Τοποθεσία: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Από: 3.1.2
- Σκοπός: Γεγονός που επιτρέπει σε άλλες επεκτάσεις να κάνουν κάτι όταν ενημερώνεται η διάταξη

# blitze_sitemaker_tinymce_options

- Τοποθεσία: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
- Από: 3.3.0
- Σκοπός: Γεγονός για να επιτρέψετε σε άλλες επεκτάσεις να τροποποιήσουν τις επιλογές tinymce