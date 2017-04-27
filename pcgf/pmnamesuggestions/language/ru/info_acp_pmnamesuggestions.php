<?php

/**
 * @author    MarkusWME <markuswme@pcgamingfreaks.at>
 * @copyright 2017 MarkusWME
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @version   1.1.0
 *
 * Russian translation by HD321kbps (https://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=1351231)
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
    'ACP_PCGF_PMNAMESUGGESTIONS_AVATAR_IMAGE_SIZE'         => 'Размер аватар',
    'ACP_PCGF_PMNAMESUGGESTIONS_AVATAR_IMAGE_SIZE_EXPLAIN' => 'Установите значение ширины и высоты аватара. Чтобы скрыть аватар, вы можете установить значение 0.',
    'ACP_PCGF_PMNAMESUGGESTIONS_SETTINGS'                  => 'Настройки',
    'ACP_PCGF_PMNAMESUGGESTIONS_SETTINGS_EXPLAIN'          => 'Здесь вы можете настроить PM Name Suggestions.',
    'ACP_PCGF_PMNAMESUGGESTIONS_SETTINGS_SAVED'            => 'Настройки были успешно сохранены!',
    'ACP_PCGF_PMNAMESUGGESTIONS_USER_COUNT'                => 'Количество выводимых пользователей',
    'ACP_PCGF_PMNAMESUGGESTIONS_USER_COUNT_EXPLAIN'        => 'Максимальное количество выводимых пользователей (допустимы значения от 0 до 100).',
));
