<?php

/**
 * @author    MarkusWME <markuswme@pcgamingfreaks.at>
 * @copyright 2016 MarkusWME
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

namespace pcgf\pmnamesuggestions\acp;

/** @version 1.1.1 */
class pmnamesuggestions_info
{
    /**
     * Function that returns module information data
     *
     * @access public
     * @since  1.1.0
     * @return array The module information array
     */
    public function module()
    {
        return array(
            'filename' => '\pcgf\pmnamesuggestions\acp\pmnamesuggestions_module',
            'title'    => 'ACP_PCGF_PMNAMESUGGESTIONS',
            'modes'    => array(
                'settings' => array(
                    'title' => 'ACP_PCGF_PMNAMESUGGESTIONS',
                    'auth'  => 'ext_pcgf/pmnamesuggestions',
                    'cat'   => array('ACP_MESSAGES'),
                ),
            ),
        );
    }
}
