---
title: Υποβολή αιτήματος έλξης
sidebar_label: Αιτήσεις Λήψης
---

`Τραβήξτε αιτήσεις μας επιτρέπουν να πούμε σε άλλους για τις αλλαγές που έχουμε ωθήσει σε έναν κλάδο σε ένα αποθετήριο στο GitHub. Μόλις ανοίξει ένα αίτημα έλξης, μπορούμε να συζητήσουμε και να εξετάσουμε τις πιθανές αλλαγές με τους συνεργάτες μας και να προσθέσουμε υποβολές πριν οι αλλαγές μας συγχωνευθούν στον βασικό κλάδο.` [Διαβάστε περισσότερα](https://help.github.com/articles/about-pull-requests/)

## Περονοφόρο/κλωνοποίηση

* Δημιουργήστε ένα λογαριασμό github αν δεν έχετε ήδη έναν
* Πηγαίνετε στο https://github.com/blitze/phpBB-ext-sitemaker.git και κάντε κλικ στο "Fork"

Κλωνοποιήστε το πιρούνι σας του αποθετηρίου:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

Από τη γραμμή εντολών πηγαίνετε στον κατάλογο sitemaker:

    cd phpBB/ext/blitze/sitemaker

**Ρύθμιση git:**

Προσθέστε το όνομα χρήστη στο Git στο σύστημά σας:

    git config --global user.name "Your Name Here"

Προσθέστε τη διεύθυνση ηλεκτρονικού ταχυδρομείου σας στο Git στο σύστημά σας:

    git config --add user.email username@phpbb.com

Προσθέστε το τηλεχειριστήριο ανάντη (μπορείτε να αλλάξετε το 'upstream' σε ό,τι θέλετε):

    git remote add upstream git://github.com/blitze/phpBB-ext-sitemaker.git

**Εγκατάσταση προμηθευτών**

    εγκατάσταση συνθέτη

**Εγκατάσταση πακέτων NPM**

    npm install

Εναλλακτικά μπορείτε να χρησιμοποιήσετε [νήματα](https://yarnpkg.com):

    εγκατάσταση νήματος

## Αιτήσεις Λήψης

    # Δημιουργήστε έναν νέο κλάδο για τη δυνατότητα μας & αλλάξτε σε αυτόν
    git checkout -b feature/my-fancy-new-feature
    
    # δημιουργήστε έναν νέο κλάδο για το ζήτημα που εργαζόμαστε στο * μεταβείτε σε αυτόν (ticket # is from github tracker)
    git checkout -b ticket/1234

Κάντε τις αλλαγές σας

    # Στάδιο τα αρχεία
    git add <files> 
    
    # Commit staged files - παρακαλώ χρησιμοποιήστε ένα σωστό μήνυμα υποβολής
    git commit -m "το μήνυμα υποβολής μου"

Πιέστε τον κλάδο πίσω στο GitHub git push origin feature/my-fancy-new-feature

Υποβάλετε [αίτηση έλξης](https://github.com/blitze/phpBB-ext-sitemaker/pulls)
