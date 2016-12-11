<?php

/**
 * @author    MarkusWME <markuswme@pcgamingfreaks.at>
 * @copyright 2016 MarkusWME
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

namespace pcgf\pmnamesuggestions\migrations;

use phpbb\db\migration\migration;

/** @version 1.1.0 */
class release_1_1_0 extends migration
{
    /**
     * Function that checks if the extension has been effectively installed
     *
     * @access public
     * @since  1.1.0
     * @return bool If the extension has been installed effectively
     */
    public function effectively_installed()
    {
        return isset($this->config['pcgf_pmnamesuggestions_user_count'], $this->config['pcgf_pmnamesuggestions_user_count']);
    }

    /**
     * Function for building the dependency tree
     *
     * @access public
     * @since  1.1.0
     * @return array Dependency data
     */
    static public function depends_on()
    {
        return array('\phpbb\db\migration\data\v31x\v311');
    }

    /**
     * Function that updates module data and configuration values
     *
     * @access public
     * @since  1.1.0
     * @return array Update information array
     */
    public function update_data()
    {
        return array(
            array('config.add', array('pcgf_pmnamesuggestions_user_count', 5)),
            array('config.add', array('pcgf_pmnamesuggestions_avatar_image_size', 20)),
            array('module.add', array(
                'acp',
                'ACP_MESSAGES',
                array(
                    'module_basename' => '\pcgf\pmnamesuggestions\acp\pmnamesuggestions_module',
                    'modes'           => array('settings'),
                ),
            )),
        );
    }
}
