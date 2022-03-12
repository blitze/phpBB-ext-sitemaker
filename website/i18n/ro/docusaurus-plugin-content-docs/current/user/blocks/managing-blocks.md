---
title: Mananaging Blocks
sidebar_position: 3
---

Pentru a gestiona blocurile în phpBB SiteMaker, trebuie să fiți în [Editare Mod](./overview#edit-mode).

> Cand un bloc nu afiseaza nici un continut, nu va fi afisat, cu exceptia modului de editare. În acest fel, fie îi poți da conținut (în cazul blocului personalizat) fie îi poți schimba setările.

> În modul de editare blocurile oarecum transparente sunt blocuri care altfel nu vor fi afișate, dar sunt afișate doar pentru că suntem în modul de editare

## Adăugarea de blocuri
Puteți adăuga blocuri la orice pagină frontală, cu excepția paginilor Panoului de Control al Utilizatorilor și Panoului de Control Moderator. Pentru a adăuga un bloc, va trebui să:
* click pe **Blocurile** din bara de administrare. Acest lucru va afișa o listă de blocuri disponibile
* Trageți și plasați blocul dorit în orice poziție de bloc

## Editare blocuri
### Adăugare pictogramă bloc
În stânga titlului blocului (prosilver), există o casetă pentru iconița blocului. Faceţi clic pe această casetă pentru a obţine selectorul de icoane. Poți selecta dimensiunea pictogramelor, culoarea, pluta, rotația, etc.

### Editează titlul blocului
blocurile SiteMaker phpBB vor avea un titlu implicit tradus, dar dacă titlul nu satisface nevoile tale, îl poți modifica. Pentru a edita titlul blocului,
* Faceți clic pe titlul blocului pentru a obține un formular de editare în linie
* Schimbă titlul la orice vrei
* Elimină focalizarea din câmp sau lovește enter pentru a trimite modificări

> Titlul blocului modificat nu este tradus

> Pentru a reveni la titlul implicit, simpla ștergere a titlului și apăsați enter

### Editare setări bloc
Când plutești peste un bloc, o pictogramă de ceață va apărea în dreapta blocului care poate fi folosit pentru a edita blocul. În dialogul blocului de editare, puteți:
- Activează/dezactivează un bloc [Status]
- Alegeți când ar trebui/nu ar trebui afișat blocul [Display]. Acest lucru se aplică numai în cazurile în care ai pagini imbricate (vezi [Înțelegerea Legăturii Blocului](/docs/user/site/block-inheritance)):
    - **Întotdeauna**: Afișează mereu blocul
    - **Ascundere pe rutele copii**: Arată doar acest bloc pe ruta părinte
    - **Arată doar pe rutele copiilor**: Arată doar acest bloc pe o rută de copil
- Alegeți grupurile de utilizatori care pot vizualiza blocul [Vizualizabil]. Utilizați CTRL + faceți clic pentru a selecta mai multe grupuri.
- Setați clasele personalizate pentru a modifica aspectul blocului sau al elementelor (liste, imagini, fundal, etc) în interiorul blocului [clasa CSS]
- Arată/ascunde titlul blocului [Ascunde titlul blocului?]
- Selectaţi vizualizarea blocului [Vizualizare bloc]. Puteți selecta o vizualizare implicită a blocului atunci când sunt adăugate blocuri noi în ACP.
    - **Implicit / Simplu**: folosește clasa panourilor de prosilver pentru a înfășura blocul într-un container căptușit
    - **Basic**: block-ul nu are nici un container de ambalare
    - **Cuprins**: folosește clasa forabg prosilver pentru a înfășura blocul într-o casetă
- Setare / Actualizare setări specifice blocului
- Dacă aveţi acelaşi bloc cu aceleaşi setări pe mai multe pagini, le puteți actualiza imediat verificând **Actualizați blocurile cu setări similare**

## Ştergere blocuri
- Treci peste blocul pe care dorești să îl ștergi
- Faceți clic pe pictograma **x** și confirmați că doriți să ștergeți blocul
- Mergeți în sus la bara de administrare și faceți clic pe `Salvează Modificările`
