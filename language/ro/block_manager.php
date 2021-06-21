<?php

/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2012 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ADD_BLOCK_EXPLAIN'							=> '*Blocuri Drag and Drop',
	'AJAX_ERROR'								=> 'Ups! A apărut o eroare la procesarea cererii dvs. Încercați din nou.',
	'AJAX_LOADING'								=> 'Încărcare...',
	'AJAX_PROCESSING'							=> 'Procesare...',

	'BACKGROUND'								=> 'Context',
	'BLOCKS'									=> 'Blocuri',
	'BLOCKS_COPY_FROM'							=> 'Copiază Blocurile',
	'BLOCK_ACTIVE'								=> 'Activ',
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'Arată doar pe rutele copiilor',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'Ascunde pe rutele copil',
	'BLOCK_CLASS'								=> 'Clasă CSS',
	'BLOCK_CLASS_EXPLAIN'						=> 'Modifică aspectul blocului cu clasele CSS',
	'BLOCK_DESIGN'								=> 'Aspectul',
	'BLOCK_DISPLAY_TYPE'						=> 'Afişare',
	'BLOCK_HIDE_TITLE'							=> 'Ascunde titlul blocului?',
	'BLOCK_INACTIVE'							=> 'Inactiv',
	'BLOCK_MISSING_TEMPLATE'					=> 'Lipsește șablonul pentru bloc. Vă rugăm să contactați dezvoltatorul',
	'BLOCK_NOT_FOUND'							=> 'Ups! Serviciul de blocare solicitat nu a fost găsit',
	'BLOCK_NO_DATA'								=> 'Nu există date de afișat',
	'BLOCK_NO_ID'								=> 'Hopa! Lipsește id bloc',
	'BLOCK_PERMISSION'							=> 'Permisiune',
	'BLOCK_PERMISSION_ALLOW'					=> 'Arată pentru',
	'BLOCK_PERMISSION_DENY'						=> 'Ascunde din',
	'BLOCK_PERMISSION_EXPLAIN'					=> 'Folosește CTRL + click pentru a comuta selecția',
	'BLOCK_SHOW_ALWAYS'							=> 'Întotdeauna',
	'BLOCK_STATUS'								=> 'Status',
	'BLOCK_UPDATED'								=> 'Setările blocului au fost actualizate',

	'CANCEL'									=> 'Anulează',
	'CHILD_ROUTE'								=> 'Copil',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articles/my-article',
	'CLEAR'										=> 'Curăță',
	'COPY'										=> 'Copiază',
	'COPY_BLOCKS'								=> 'Copiază blocurile?',
	'COPY_BLOCKS_CONFIRM'						=> 'Ești sigur că vrei să copiezi blocuri de pe altă pagină?<br /><br />Aceasta va șterge toate blocurile existente și setările lor pentru această pagină și le va înlocui cu blocurile din pagina selectată.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'Dacă este setat, toate paginile site-ului pentru care nu aţi specificat blocuri vor moşteni blocurile din layout-ul implicit. Cu toate acestea, puteți suprascrie aspectul implicit pentru anumite pagini folosind opțiunile de la dreapta.',
	'DELETE'									=> 'Ștergere',
	'DELETE_ALL_BLOCKS'							=> 'Șterge toate blocurile',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'Ești sigur că vrei să ștergi toate blocurile pentru această pagină?',
	'DELETE_BLOCK'								=> 'Șterge bloc',
	'DELETE_BLOCK_CONFIRM'						=> 'Sunteţi sigur că doriţi să ştergeţi acest bloc?<br /><br /><br /><strong>Notă:</strong> Va trebui să salvați modificările de aspect pentru a face acest lucru permanent.',

	'EDIT'										=> 'Editare',
	'EDIT_BLOCK'								=> 'Modifică bloc',
	'EXIT_EDIT_MODE'							=> 'Ieșire din modul de editare',

	'FEED_PROBLEMS'								=> 'A apărut o problemă la procesarea feed-ului rss/atom furnizat',
	'FEED_URL_MISSING'							=> 'Vă rugăm să furnizați cel puțin un rss/atom pentru a începe',
	'FIELD_INVALID'								=> 'Valoarea furnizată pentru câmpul „%s” are un format nevalid',
	'FIELD_REQUIRED'							=> '“%s” este un câmp obligatoriu',
	'FIELD_TOO_LONG'							=> 'Valoarea furnizată pentru câmpul „%1$s” este prea lungă. Valoarea maximă acceptabilă este %2$d.',
	'FIELD_TOO_SHORT'							=> 'Valoarea furnizată pentru câmpul „%1$s” este prea scurtă. Valoarea minimă acceptabilă este %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'Nu arăta blocuri pe această pagină',
	'HIDE_BLOCK_POSITIONS'						=> 'Nu afișa blocuri pentru următoarele poziții ale blocului:',

	'IMAGES'									=> 'Imagini',

	'LAYOUT'									=> 'Aspect',
	'LAYOUT_SAVED'								=> 'Aspect salvat cu succes!',
	'LAYOUT_SETTINGS'							=> 'Setări aspect',
	'LEAVE_CONFIRM'								=> 'Aveți câteva modificări nesalvate la această pagină. Vă rugăm să salvați munca înainte de a trece la',
	'LISTS'										=> 'Liste',

	'MAKE_DEFAULT_LAYOUT'						=> 'Setează ca Layout implicit',

	'OR'										=> '<strong>SAU</strong>',

	'PARENT_ROUTE'								=> 'Părinte',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/articles',
	'PREDEFINED_CLASSES'						=> 'Clase predefinite',

	'REDO'										=> 'Reface',
	'REMOVE_DEFAULT_LAYOUT'						=> 'Elimină ca aspect implicit',
	'REMOVE_STARTPAGE'							=> 'Elimină pagina de start',
	'ROUTE_HIDDEN_BLOCKS'						=> 'Blocurile sunt ascunse pentru această pagină',
	'ROUTE_HIDDEN_POSITIONS'					=> 'Blocurile sunt ascunse pentru următoarele poziții',
	'ROUTE_UPDATED'								=> 'Setările paginii au fost actualizate',

	'SAVE_CHANGES'								=> 'Salvează modificările',
	'SAVE_SETTINGS'								=> 'Salvează setările',
	'SELECT_ICON'								=> 'Selectaţi o pictogramă',
	'SETTINGS'									=> 'Setări',
	'SETTING_TOO_BIG'							=> 'Valoarea furnizată pentru setarea "%1$s" este prea mare. Valoarea maximă acceptabilă este %2$d.',
	'SETTING_TOO_LONG'							=> 'Valoarea furnizată pentru setarea „%1$s” este prea lungă. Lungimea maximă acceptabilă este %2$d.',
	'SETTING_TOO_LOW'							=> 'Valoarea furnizată pentru setarea „%1$s” este prea mică. Valoarea minimă acceptabilă este %2$d.',
	'SETTING_TOO_SHORT'							=> 'Valoarea furnizată pentru setarea „%1$s” este prea scurtă. Lungimea minimă acceptabilă este %2$d.',
	'SET_STARTPAGE'								=> 'Setează ca pagină de start',

	'TITLES'									=> 'Titluri',

	'UPDATE_SIMILAR'							=> 'Actualizați blocurile cu setări similare',
	'UNDO'										=> 'Anulează',

	'VIEW_DEFAULT_LAYOUT'						=> 'Vizualizare/Editare Layout implicit',
	'VISIT_PAGE'								=> 'Vizitează pagina',
));
