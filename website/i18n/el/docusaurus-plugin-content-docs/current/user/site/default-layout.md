---
title: Ορισμός μιας προκαθορισμένης διάταξης
sidebar_position: 4
---

Όταν προσθέτετε ένα μπλοκ, προστίθεται σε αυτή τη συγκεκριμένη σελίδα. Ως εκ τούτου, θα ήταν ένα κουραστικό καθήκον να θέσει μπλοκ για όλες τις σελίδες στην ιστοσελίδα σας. Μπορείτε να ορίσετε όλα τα επιθυμητά μπλοκ για μια συγκεκριμένη σελίδα, και στη συνέχεια να ορίσετε αυτή τη σελίδα ως την προεπιλεγμένη διάταξη. Με άλλα λόγια, οποιαδήποτε σελίδα δεν έχει δικά της μπλοκ, θα κληρονομήσει μπλοκ από αυτή τη σελίδα.

Για να ορίσετε μια προεπιλεγμένη διάταξη
* Πηγαίνετε στη σελίδα που θα θέλατε να ορίσετε ως προεπιλεγμένη διάταξη
* Κάντε κλικ στο `Ρυθμίσεις` στη γραμμή διαχείρισης
* Κάντε κλικ στο κουμπί `Ορισμός ως προεπιλεγμένη διάταξη`

Πείτε ότι προσθέτουμε μπλοκ σε μια σελίδα (phpBB/index.php) με μπλοκ στην πλαϊνή μπάρα και στις κορυφαίες θέσεις, για παράδειγμα, και ορίστε την ως προεπιλεγμένη διάταξη μας. Αυτό έχει τα ακόλουθα αποτελέσματα για άλλες σελίδες:
* Οποιαδήποτε σελίδα δεν έχει δικά της μπλοκ, θα κληρονομήσει τα μπλοκ από την προεπιλεγμένη διάταξη. Βλ. [Κατανόηση της Κληρονομιάς](/docs/user/site/block-inheritance) για εξαιρέσεις.
* Μπορείτε ακόμα να κληρονομήσετε μπλοκ από μια προεπιλεγμένη διάταξη (δείκτη. hp) αλλά επιλέξτε να μην εμφανίζονται μπλοκ σε κάποιες θέσεις μπλοκ ή να μην εμφανίζονται καθόλου μπλοκ. Για να το κάνετε αυτό,
    * Πηγαίνετε στη σελίδα που δεν θέλετε να εμφανίζονται όλα / μερικά μπλοκ
    * Κάντε κλικ στο `Ρυθμίσεις` στη γραμμή διαχείρισης
    * Επιλέξτε `Μην εμφανίζετε μπλοκ σε αυτή τη σελίδα` αν δεν θέλετε να κληρονομείτε/εμφανίσετε τυχόν μπλοκ σε αυτή τη σελίδα Ή
    * Χρησιμοποιήστε CTRL + κλικ για να επιλέξετε τις θέσεις μπλοκ (στα δεξιά) που δεν θέλετε να εμφανίσετε μπλοκ
* Σε `λειτουργία επεξεργασίας`, μια σελίδα που κληρονομεί μπλοκ από την προεπιλεγμένη διάταξη, δεν θα εμφανίσει κανένα μπλοκ, δίνοντάς σας την ευκαιρία να προσθέσετε μπλοκ στη σελίδα αν θέλετε να
* Οποιαδήποτε σελίδα έχει δικά της μπλοκ δεν θα κληρονομήσει από την προεπιλεγμένη διάταξη