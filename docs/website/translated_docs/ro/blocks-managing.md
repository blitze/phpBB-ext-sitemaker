---
id: blocks-management
title: Mananaging Blocks
---

Pentru a gestiona blocurile în phpBB SiteMaker, trebuie să fiți în [Editare Mod](./blocks-overview#edit-mode).

> Cand un bloc nu afiseaza nici un continut, nu va fi afisat, cu exceptia modului de editare. În acest fel, fie îi poți da conținut (în cazul blocului personalizat) fie îi poți schimba setările.
> 
> În modul de editare blocurile oarecum transparente sunt blocuri care altfel nu vor fi afișate, dar sunt afișate doar pentru că suntem în modul de editare

## Adăugarea de blocuri

Puteți adăuga blocuri la orice pagină frontală, cu excepția paginilor Panoului de Control al Utilizatorilor și Panoului de Control Moderator. Pentru a adăuga un bloc, va trebui să: * apasă pe **Blocurile** din bara de administrare. Acest lucru va afișa o listă de blocuri disponibile * Trage și plasează blocul dorit în orice poziție de bloc

## Editare blocuri

### Adăugare pictogramă bloc

În stânga titlului blocului (prosilver), există o casetă pentru iconița blocului. Faceţi clic pe această casetă pentru a obţine selectorul de icoane. Poți selecta dimensiunea pictogramelor, culoarea, pluta, rotația, etc.

### Editează titlul blocului

blocurile SiteMaker phpBB vor avea un titlu implicit tradus, dar dacă titlul nu satisface nevoile tale, îl poți modifica. Pentru a edita titlul blocului, * Faceți clic pe titlul blocului pentru a obține un formular de editare în linie * Schimbați titlul la orice doriți * Eliminați focalizarea din câmp sau apăsați enter pentru a trimite modificări

> Titlul blocului modificat nu este tradus
> 
> Pentru a reveni la titlul implicit, simpla ștergere a titlului și apăsați enter

### Editare setări bloc

Când plutești peste un bloc, o pictogramă de ceață va apărea în dreapta blocului care poate fi folosit pentru a edita blocul. În caseta de dialog a blocului de editare, puteți: - Activați/dezactivați un bloc [Status] - Alegeți când blocul ar trebui/nu ar trebui afișat [Display]. Acest lucru se aplică numai în cazurile în care ai pagini imbricate (vezi [Înțelegerea moștenirii blocului](./blocks-inheritance.md)): - **Întotdeauna**: Afișează blocul - **Ascunde pe rutele pentru copii**: Arată doar acest bloc pe ruta părinte - **Arată doar pe rutele pentru copii**: Arată acest bloc pe o rută de copii - Alege ce grupuri de utilizatori pot vizualiza blocul [Vizualizabil]. Utilizați CTRL + faceți clic pentru a selecta mai multe grupuri. - Setați clase personalizate pentru a modifica aspectul blocului sau al articolelor (liste, imagini, fundal, etc) în interiorul blocului [Clasa CSS] - Arată/ascunde titlul blocului [Ascunde titlul blocului? - Selectați vizualizarea blocului [Vizualizare bloc]. Puteți selecta o vizualizare implicită a blocului atunci când sunt adăugate blocuri noi în ACP. - **Implicit / Simplu**: folosește clasa panourilor de prosilver pentru a înfășura blocul într-un container padded - **Basic**: blocul nu are nici un container împachetat - **Cuprins**: folosește clasa cu forabg prosilver pentru a înfășura blocul într-o căsuță - Setează / Actualizează setările specifice blocului - Dacă ai același bloc cu aceleași setări pe mai multe pagini, le puteți actualiza imediat verificând blocurile **Actualizare cu setări similare**

## Ştergere blocuri

- Treci peste blocul pe care dorești să îl ștergi
- Faceți clic pe pictograma **x** și confirmați că doriți să ștergeți blocul
- Mergeți în sus la bara de administrare și faceți clic pe `Salvează Modificările`