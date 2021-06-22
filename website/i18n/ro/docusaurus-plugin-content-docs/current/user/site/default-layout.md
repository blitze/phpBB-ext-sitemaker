---
title: Setarea unui Layout implicit
sidebar_position: 4
---

Atunci când adăugați un bloc, acesta este adăugat la acea pagină specifică. Prin urmare, ar fi o sarcină obositoare să setezi blocuri pentru toate paginile de pe site-ul tău. Puteți seta toate blocurile dorite pentru o anumită pagină, apoi setați acea pagină ca aspect implicit. În alte cuvinte, orice pagină care nu are propriile blocuri, va moșteni blocuri de pe această pagină.

Pentru a seta un aspect implicit
* Mergeți la pagina pe care doriți să o setați ca aspect implicit
* Faceți clic pe `Setări` din bara de administrare
* Faceți clic pe butonul `Setare ca layout implicit`

Spune că am adăugat blocuri unei pagini (phpBB/index.php) cu blocuri în bara laterală și pozițiile de sus, de exemplu, și am setat-o ca aspect implicit. Acesta are următoarele efecte pentru alte pagini:
* Orice pagină care nu are propriile blocuri, va moșteni blocurile din layout-ul implicit. Vezi [Înțelegerea moștenirii blocului](/docs/user/site/block-inheritance) pentru excepții.
* Încă poți moșteni blocuri de la un aspect implicit (index). hp) dar alege să nu afișeze blocuri pe unele poziții din bloc sau să nu afișeze niciun bloc. În acest scop,
    * Mergeți la pagina pe care nu doriți să o afișați toate/câteva blocuri
    * Faceți clic pe `Setări` din bara de administrare
    * Selectaţi `Nu arăta blocuri pe această pagină` dacă nu doriţi să moşteniţi/afişaţi nici un bloc pe această pagină SAU
    * Utilizați CTRL + faceți clic pentru a selecta pozițiile blocului (în dreapta) pe care nu doriți să afișați blocurile
* În modul `de editare`, o pagină care moștenește blocuri din aspectul implicit, nu va afișa nici un bloc, oferindu-vă oportunitatea de a adăuga blocuri la pagină dacă doriți
* Orice pagină care are propriile blocuri nu va moșteni de la aspectul implicit
