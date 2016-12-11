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
    'ACP_PCGF_PMNAMESUGGESTIONS'                           => 'PM Name Suggestions',
    'ACP_PCGF_PMNAMESUGGESTIONS_AVATAR_IMAGE_SIZE'         => 'Avatar image size',
    'ACP_PCGF_PMNAMESUGGESTIONS_AVATAR_IMAGE_SIZE_EXPLAIN' => 'Sets width and height of the avatar image to the given value. To hide the avatar image you can set the value to 0.',
    'ACP_PCGF_PMNAMESUGGESTIONS_SETTINGS'                  => 'Settings',
    'ACP_PCGF_PMNAMESUGGESTIONS_SETTINGS_EXPLAIN'          => 'Here you can adjust the settings for PM Name Suggestions.',
    'ACP_PCGF_PMNAMESUGGESTIONS_SETTINGS_SAVED'            => 'The settings have been saved successfully!',
    'ACP_PCGF_PMNAMESUGGESTIONS_USER_COUNT'                => 'Suggestion count',
    'ACP_PCGF_PMNAMESUGGESTIONS_USER_COUNT_EXPLAIN'        => 'The maximum count of suggested users (values between 0 and 100 are allowed).',
));
