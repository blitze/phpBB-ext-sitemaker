---
id: bloc-particularizat
title: Bloc personalizat
---

Dacă blocurile disponibile nu vă oferă libertatea de care aveţi nevoie, există `blocul personalizat` care vă permite libertatea de a afişa propriul conţinut folosind BBcode sau HTML. Blocul vine cu un editor WYSIWYG (TinyMCE) și un manager de script-uri:

## Editorul

- Poți folosi editorul pentru a crea conținut HTML
- Poți edita codul sursă dacă ai nevoie de acel nivel de control făcând clic pe pictograma `codul sursă` (`<>`) din editor
- Editorul vă permite să încărcaţi şi să modificaţi imaginile 
    - Creează un dosar nou în phpBB/images/sitemaker_uploads/ pentru fiecare utilizator care are acces la el
    - Puteți vizualiza/gestiona toate dosarele utilizatorilor
- Editorul filtrează orice script-uri potențial periculoase cum ar fi javascript, etc. Dacă aveţi nevoie să adăugaţi conţinut ca Google Ads, javascript va fi filtrat, dar puteţi trece peste asta făcând următoarele: 
    - Adaugă blocul personalizat la locația dorită
    - Editați blocul personalizat, faceți clic pe tab-ul `HTML` și lipiți Javascript

## Managerul de scripturi

Blocul personalizat vă permite, de asemenea, să adăugați fișiere CSS și Javascript la pagina dvs. Pentru a face acest lucru:

- Adaugă un `bloc personalizat` în orice poziție de bloc. Poziția nu contează decât dacă afișezi și conținut cu blocul
- Editează blocul, click pe tab-ul `Scripturi` și adaugă fișierele CSS sau Javascript > Word de precauție încă: Adăugarea la mai multe scripturi de pe pagina ta poate afecta timpii de încărcare