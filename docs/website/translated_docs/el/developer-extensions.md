---
id: επεκτάσεις προγραμματιστή
title: Επέκταση phpBB SiteMaker
---

You can extend/modify phpBB SiteMaker using [service replacement](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [service decoration](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration), and [phpBB event system](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). Μπορείτε να βρείτε μια λίστα με τις υποστηριζόμενες εκδηλώσεις [εδώ](./developer-events.md).

## Δημιουργία μπλοκ Κατασκευαστή SiteMaker

Ένα μπλοκ phpBB SiteMaker είναι απλά μια κλάση που επεκτείνει το blitze\sitemaker\services\blocks\driver\block class και επιστρέφει έναν πίνακα από τη μέθοδο "εμφάνιση" με έναν 'τίτλο' και 'περιεχόμενο'. Όλα τα υπόλοιπα είναι στο χέρι σας. Για να γίνει το block σας αναγνωρίσιμο από το phpBB SiteMaker, θα πρέπει να του δώσετε την ετικέτα "sitemaker.block".

Πείτε ότι έχουμε μια επέκταση με προμηθευτή/επέκταση ως μου / παράδειγμα. Για να δημιουργήσετε ένα μπλοκ που ονομάζεται "my_block" για το phpBB SiteMaker:

- Δημιουργία φακέλου "blocks"
- Δημιουργήστε το αρχείο my_block.php στο φάκελο μπλοκ με το ακόλουθο περιεχόμενο

```php
namespace my\example\blocks;

χρήση blitze\sitemaker\services\blocks\driver\block;

class my_block extends block
mptom
    /**
     * {@inheritdoc}
     */
    public function display(array $settings, $edit_mode = false)
    mptom
        return array(
            'title' => 'my block title',
            'περιεχόμενο' => 'το περιεχόμενό μου',
        );
    }
}
```

Στη συνέχεια, στο αρχείο config.yml σας, προσθέστε τα εξής:

```yml
υπηρεσίες:

...

    my.example.block.my_block:
        class: my\example\blocks\my_block
        κλήσεις:
            - [set_name, [my.example.block.my_block]]
        ετικέτες:
            - { name: sitemaker.block }

....

```

Σε ένα ελάχιστο ελάχιστο, αυτό είναι το μόνο που χρειάζεστε. Αν μεταβείτε σε λειτουργία επεξεργασίας, θα πρέπει να δείτε το μπλοκ που εμφανίζεται ως 'MY_EXAMPLE_BLOCK_MY_BLOCK' που μπορεί να συρθεί και να πέσει σε οποιαδήποτε θέση του μπλοκ. Αλλά αυτό το μπλοκ δεν κάνει τίποτα συναρπαστικό. Δεν έχει ρυθμίσεις και δεν μεταφράζει το όνομα του ταμπλό. Ας το κάνουμε πιο ενδιαφέρον.

### Ρυθμίσεις Μπλοκ

Ας τροποποιήσουμε τα blocks/my_block. hp αρχείο και να προσθέσετε μια μέθοδο "get_config" th στο επιστρέφει έναν πίνακα με τα πλήκτρα να είναι οι ρυθμίσεις μπλοκ και οι τιμές να είναι ένας πίνακας που περιγράφει τις ρυθμίσεις όπως έτσι:

```php
    /**
     * @inheritdoc
     */
    δημόσια συνάρτηση get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        πίνακας επιστροφής (
            'legend1' => 'TAB1',
            'checkbox' => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'default' => array(), 'explain' => false),
            'yes_no' => array('lang' => 'SOME_LANG_VAR_2', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => false),
            'radio' => array('lang' => 'SOME_LANG_VAR_3', 'validate' => 'bool', 'type' => 'radio', 'options' => $options, 'explain' => false, 'default' => 'topic'),
            'select' => array('lang' => 'SOME_LANG_VAR_4', 'validate' => 'string', 'type' => 'select', 'options' => $options, 'default' => '', 'explain' => false),
            'multi' => πίνακας ('lang' => 'SOME_LANG_VAR_5', 'validate' => 'string', 'type' => 'multi_select', 'options' => $options, 'default' => array(), 'explain' => false),
            'legend2' => 'TAB2',
            'αριθμός' => πίνακας ('lang' => 'SOME_LANG_VAR_6', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false, 'προεπιλογή' => 5),
            'textarea' => array('lang' => 'SOME_LANG_VAR_7', 'validate' => 'string', 'type' => 'textarea:3:40', 'maxlength' => 2, 'explain' => true, 'default' => ''),
            'togglable' => array('lang' => 'SOME_TOGLABLE_VAR', 'validate' => 'string', 'type' => 'select:1:0:toggle_key', 'options' => $options'προεπιλογή' => '', 'append' => '<div id="toggle_key-1">Εμφανίζονται μόνο όταν η επιλογή 1 είναι ενεργοποιημένη</div>'),
        );
}
```

Αυτό είναι κατασκευασμένο με τον ίδιο τρόπο που το phpBB χτίζει τη διαμόρφωση για τις ρυθμίσεις του πίνακα στα ACP. Μπορείτε να δείτε περισσότερα παραδείγματα [εδώ](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Αν θέλετε έναν προσαρμοσμένο τύπο πεδίου, μπορείτε να δείτε ένα παράδειγμα [εδώ](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) (ρύθμιση 'content_type').

Παρατηρήστε το 'legend1' και το 'legend2': Χρησιμοποιούνται για να διαχωρίσουν τις ρυθμίσεις σε καρτέλες.

### Μπλοκ Ονόματος

Η σύμβαση για τα ονόματα μπλοκ είναι ότι το όνομα της υπηρεσίας (π.χ. my.example.block. y*μπλοκ παραπάνω) θα χρησιμοποιηθεί ως κλειδί γλώσσας αντικαθιστώντας τις τελείες (.) με κάτω παύλα (*) (π.χ MY_EXAMPLE_BLOCK_MY_BLOCK).

### Μετάφραση

Επίσης παρατηρήσετε ότι έχουμε πολλά κλειδιά γλώσσας που πρέπει να μεταφραστούν. Για να το κάνετε αυτό, δημιουργήστε ένα αρχείο με όνομα "blocks_admin.php" στο φάκελο γλώσσας σας. Αυτό το αρχείο θα φορτωθεί αυτόματα κατά την επεξεργασία μπλοκ και θα πρέπει να έχει μεταφράσεις για τις ρυθμίσεις μπλοκ και τα ονόματα μπλοκ.

    $lang = array_merge($lang, array(
        'SOME_LANG_VAR' => 'Επιλογή 1',
        'OTHER_LANG_VAR' => 'Επιλογή 2',
        'SOME_LANG_VAR_1' => 'Ρύθμιση 1',
    ....
        'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'Ο Κύβος μου',
    , );
    

Επειδή το 'blocks_admin.php' φορτώνεται μόνο όταν επεξεργάζεστε μπλοκ, θα πρέπει να προσθέσετε άλλες μεταφράσεις (π.χ. αποκλείστε τον τίτλο) φορτώνοντας ένα αρχείο γλώσσας με τη μέθοδο εμφάνισης όπως αυτή `$language->add_lang('my_lang_file', 'my/example');`

### Αποδίδοντας το μπλοκ

Το νέο μπλοκ θα εμφανιστεί μόνο αν αποδίδει κάτι. Το μπλοκ σας μπορεί να επιστρέψει οποιαδήποτε συμβολοσειρά ως περιεχόμενο, αλλά στις περισσότερες περιπτώσεις, χρειάζεστε ένα πρότυπο για να αποδώσετε το περιεχόμενό σας. Για να εμφανίσετε το block σας χρησιμοποιώντας πρότυπα, το μπλοκ πρέπει να επιστρέψει έναν πίνακα που κρατά τα δεδομένα που θέλετε να περάσετε στο πρότυπο και πρέπει επίσης να εφαρμόσει τη μέθοδο `get_template` , όπως φαίνεται παρακάτω:

```php
    /**
     * @inheritdoc
     */
    δημόσια συνάρτηση get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        πίνακας επιστροφής (
            'legend1' => 'TAB1',
            'some_setting' => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'default' => array(), 'explain' => false),
        );
    }

    /**
     * {@inheritdoc}
     */
    δημόσια συνάρτηση get_ template()
    {
        επιστρέφει '@my_example/my_block. tml';
    }

    /**
     * {@inheritdoc}
     */
    εμφάνιση δημόσιας λειτουργίας (πίνακας $data, $edit_mode = false)
    {
        if ($edit_mode)
        {
            // do something only in edit mode
        }

        return array(
            'title' => 'MY_BLOCK_TITLE',
            'δεδομένα' => πίνακας (
                'some_var' => $data['settings']['some_setting'],
            ),
        );
}
```

Στη συνέχεια, το αρχείο styles/all/my_block.html ή στυλ/prosilver/my_block.html μπορεί να μοιάζει κάπως έτσι:

    <p>Επιλέξατε: {{ some_var }}</p>
    

Συνοπτικά, το ταμπλό σας πρέπει να επιστρέψει έναν πίνακα με ένα `κλειδί τίτλου` (για τον τίτλο του μπλοκ) και ένα κλειδί `περιεχομένου` (αν το μπλοκ εμφανίζει απλά μια συμβολοσειρά και δεν χρησιμοποιεί ένα πρότυπο) ή ένα κλειδί `δεδομένων` (αν το μπλοκ χρησιμοποιεί ένα πρότυπο, σε ποια περίπτωση, θα χρειαστεί επίσης να εφαρμόσετε τη μέθοδο `get_template`).

### Αποκλεισμός Περιουσιακών Στοιχείων

Αν το μπλοκ σας χρειάζεται να προσθέσει περιουσιακά στοιχεία (css/js) στη σελίδα, συνιστώ τη χρήση της κλάσης [util](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php) του sitemaker για αυτό. Δεδομένου ότι μπορεί να υπάρχουν περισσότερες από μία περιπτώσεις του ίδιου μπλοκ στη σελίδα, ή άλλα μπλοκ μπορεί να προσθέτουν το ίδιο περιουσιακό στοιχείο, η κλάση util εξασφαλίζει ότι το περιουσιακό στοιχείο προστίθεται μόνο αυτά.

```php
        $this->util->add_assets(array(
            'js' => array(
                '@my_example/assets/some. s',
                100 => '@my_example/assets/other. s', // ορισμός προτεραιότητας
            ),
            'css' => array(
                '@my_example/assets/some. ss',
            )
));
```

Η κλάση util θα πρέπει, φυσικά, να προστεθεί στους ορισμούς των υπηρεσιών σας στο config.yml όπως τόσο: `- '@blitze.sitemaker. til'` και ορίστηκε στον κατασκευαστή του block's `\blitze\sitemaker\services\util $util`.

Και αυτό είναι όλο. Είμαστε έτοιμοι!