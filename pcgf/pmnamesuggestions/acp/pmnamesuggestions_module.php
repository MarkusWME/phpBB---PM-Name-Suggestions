<?php

/**
 * @author    MarkusWME <markuswme@pcgamingfreaks.at>
 * @copyright 2016 MarkusWME
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

namespace pcgf\pmnamesuggestions\acp;

/** @version 1.1.0 */
class pmnamesuggestions_module
{
    /** @var string $page_title The title of the page */
    public $page_title;

    /** @var string $tpl_name The name of the template file */
    public $tpl_name;

    /** @var object $u_action The user action */
    public $u_action;

    /**
     * Main function of the module
     *
     * @access public
     * @since  1.1.0
     *
     * @param int    $id   The module id
     * @param string $mode The mode the module is being called with
     */
    public function main($id, $mode)
    {
        global $user, $request, $template, $config;
        $this->page_title = $user->lang('ACP_PCGF_PMNAMESUGGESTIONS');
        $this->tpl_name = 'acp_pmnamesuggestions_body';
        add_form_key('pcgf/pmnamesuggestions');
        if ($request->is_set_post('submit'))
        {
            if (!check_form_key('pcgf/pmnamesuggestions'))
            {
                trigger_error('FORM_INVALID', E_USER_WARNING);
            }
            $config->set('pcgf_pmnamesuggestions_user_count', $request->variable('pmnamesuggestions_user_count', 5));
            $config->set('pcgf_pmnamesuggestions_avatar_image_size', $request->variable('pmnamesuggestions_avatar_image_size', 20));
            trigger_error($user->lang('ACP_PCGF_PMNAMESUGGESTIONS_SETTINGS_SAVED') . adm_back_link($this->u_action));
        }
        $template->assign_vars(array(
            'PCGF_PMNAMESUGGESTIONS_USER_COUNT'        => $config['pcgf_pmnamesuggestions_user_count'],
            'PCGF_PMNAMESUGGESTIONS_AVATAR_IMAGE_SIZE' => $config['pcgf_pmnamesuggestions_avatar_image_size'],
            'U_ACTION'                                 => $this->u_action,
        ));
    }
}
