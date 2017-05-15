<?php

/**
 * @author    MarkusWME <markuswme@pcgamingfreaks.at>
 * @copyright 2016, 2017 MarkusWME
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @version   1.1.0
 *
 * French translation by Kenjiraw (https://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=1688226)
 */

if (!defined('IN_PHPBB'))
{
    exit;
}

if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

// Merging language data for the ACP with the other language data
$lang = array_merge($lang, array(
    'ACP_PCGF_PMNAMESUGGESTIONS'                           => 'MP Suggestions de Noms',
    'ACP_PCGF_PMNAMESUGGESTIONS_AVATAR_IMAGE_SIZE'         => 'Taille de l\'Avatar',
    'ACP_PCGF_PMNAMESUGGESTIONS_AVATAR_IMAGE_SIZE_EXPLAIN' => 'Définis la largeur et la hauteur de l\'avatar à la valeur donnée.<br/>Pour cacher l\'avatar vous pouvez définir cette valeur à 0.',
    'ACP_PCGF_PMNAMESUGGESTIONS_SETTINGS'                  => 'Paramètres',
    'ACP_PCGF_PMNAMESUGGESTIONS_SETTINGS_EXPLAIN'          => 'Ici vous pouvez ajuster les paramètres pour MP Suggestions de Noms.',
    'ACP_PCGF_PMNAMESUGGESTIONS_SETTINGS_SAVED'            => 'Les paramètres ont été sauvegardés avec succès !',
    'ACP_PCGF_PMNAMESUGGESTIONS_USER_COUNT'                => 'Nombre de suggestions',
    'ACP_PCGF_PMNAMESUGGESTIONS_USER_COUNT_EXPLAIN'        => 'Le nombre maximum d\'utilisateurs proposés (valeurs comprises entre 0 et 100).',
));
