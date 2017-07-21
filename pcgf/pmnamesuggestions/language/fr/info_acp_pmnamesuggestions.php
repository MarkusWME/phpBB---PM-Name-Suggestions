<?php
/**
 *
 * PM Name Suggestions. An extension for the phpBB Forum Software package.
 * French translation by Kenjiraw (https://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=1688226) & Galixte (http://www.galixte.com)
 *
 * @copyright (c) 2016, 2017 MarkusWME <markuswme@pcgamingfreaks.at>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

/**
 * DO NOT CHANGE
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

$lang = array_merge($lang, array(
    'ACP_PCGF_PMNAMESUGGESTIONS'                           => 'Noms suggérés dans les MP',
    'ACP_PCGF_PMNAMESUGGESTIONS_AVATAR_IMAGE_SIZE'         => 'Dimensions des avatars',
    'ACP_PCGF_PMNAMESUGGESTIONS_AVATAR_IMAGE_SIZE_EXPLAIN' => 'Permet de définir la largeur et la hauteur des avatars affichés dans la liste des suggestions.<br/>Définir sur 0 pour masquer l’affichage des avatars.',
    'ACP_PCGF_PMNAMESUGGESTIONS_SETTINGS'                  => 'Paramètres',
    'ACP_PCGF_PMNAMESUGGESTIONS_SETTINGS_EXPLAIN'          => 'Sur cette page il est possible de configurer les paramètres de l’extension « PM Name Suggestions ».',
    'ACP_PCGF_PMNAMESUGGESTIONS_SETTINGS_SAVED'            => 'Les paramètres ont été sauvegardés avec succès !',
    'ACP_PCGF_PMNAMESUGGESTIONS_USER_COUNT'                => 'Nombre de suggestions',
    'ACP_PCGF_PMNAMESUGGESTIONS_USER_COUNT_EXPLAIN'        => 'Permet de définir le nombre maximum de noms d’utilisateurs suggérés (valeurs acceptées : entre 0 et 100).',
));
