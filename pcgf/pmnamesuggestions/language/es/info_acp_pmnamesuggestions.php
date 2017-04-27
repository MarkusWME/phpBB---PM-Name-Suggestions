<?php

/**
 * @author    MarkusWME <markuswme@pcgamingfreaks.at>
 * @copyright 2017 MarkusWME
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @version   1.1.0
 *
 * Spanish translation by Raul [ThE KuKa] (https://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=94590)
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
    'ACP_PCGF_PMNAMESUGGESTIONS'                           => 'PM Name Suggestions',
    'ACP_PCGF_PMNAMESUGGESTIONS_AVATAR_IMAGE_SIZE'         => 'Tamaño de la imagen de avatar',
    'ACP_PCGF_PMNAMESUGGESTIONS_AVATAR_IMAGE_SIZE_EXPLAIN' => 'Establece la anchura y la altura de la imagen del avatar en el valor dado. Para ocultar la imagen del avatar, puede establecer el valor en 0.',
    'ACP_PCGF_PMNAMESUGGESTIONS_SETTINGS'                  => 'Ajustes',
    'ACP_PCGF_PMNAMESUGGESTIONS_SETTINGS_EXPLAIN'          => 'Aquí puede establecer los ajustes de PM Name Suggestions.',
    'ACP_PCGF_PMNAMESUGGESTIONS_SETTINGS_SAVED'            => '¡Los ajustes han sido guardados correctamente!',
    'ACP_PCGF_PMNAMESUGGESTIONS_USER_COUNT'                => 'Cantidad de sugerencias',
    'ACP_PCGF_PMNAMESUGGESTIONS_USER_COUNT_EXPLAIN'        => 'La cantidad máxima de usuarios sugeridos (valores entre 0 y 100 son permitidos).',
));
