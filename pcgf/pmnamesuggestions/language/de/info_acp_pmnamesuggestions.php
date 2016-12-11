<?php

/**
 * @author    MarkusWME <markuswme@pcgamingfreaks.at>
 * @copyright 2016 MarkusWME
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @version   1.1.0
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
    'ACP_PCGF_PMNAMESUGGESTIONS'                           => 'PN Namensvorschläge',
    'ACP_PCGF_PMNAMESUGGESTIONS_AVATAR_IMAGE_SIZE'         => 'Größe der Avatar-Bilder',
    'ACP_PCGF_PMNAMESUGGESTIONS_AVATAR_IMAGE_SIZE_EXPLAIN' => 'Legt die Breite und die Höhe des Avatar-Bildes auf den angegebenen Wert fest. Um kein Avatar-Bild anzeigen zu lassen kann der Wert auf 0 gesetzt werden.',
    'ACP_PCGF_PMNAMESUGGESTIONS_SETTINGS'                  => 'Einstellungen',
    'ACP_PCGF_PMNAMESUGGESTIONS_SETTINGS_EXPLAIN'          => 'Hier kannst du einige Einstellungen für die PN Namensvorschläge anpassen.',
    'ACP_PCGF_PMNAMESUGGESTIONS_SETTINGS_SAVED'            => 'Die Einstellungen wurden erfolgreich gespeichert!',
    'ACP_PCGF_PMNAMESUGGESTIONS_USER_COUNT'                => 'Anzahl der Vorschläge',
    'ACP_PCGF_PMNAMESUGGESTIONS_USER_COUNT_EXPLAIN'        => 'Die maximale Anzahl der vorzuschlagenden Benutzer (Werte zwischen 0 und 100 sind erlaubt).',
));
