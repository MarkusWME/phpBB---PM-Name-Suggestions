<?php

/**
 * @author    MarkusWME <markuswme@pcgamingfreaks.at>
 * @copyright 2016 MarkusWME
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

namespace pcgf\pmnamesuggestions\controller;

use phpbb\auth\auth;
use phpbb\config\config;
use phpbb\db\driver\factory;
use phpbb\json_response;
use phpbb\request\request;
use phpbb\user;

/** @version 1.1.1 */
class controller
{
    /** @var request $request Request object */
    protected $request;

    /** @var factory $db Database object */
    protected $db;

    /** @var auth $auth Authenticator object */
    protected $auth;

    /** @var user $user User object */
    protected $user;

    /** @var  config $config Configuration object */
    protected $config;

    /** @var  string $phpbb_root_path The forum root path */
    protected $phpbb_root_path;

    /**
     * Constructor
     *
     * @access public
     * @since  1.0.0
     *
     * @param request $request         Request object
     * @param factory $db              Database object
     * @param auth    $auth            Authenticator object
     * @param user    $user            User object
     * @param config  $config          Configuration object
     * @param string  $phpbb_root_path The forum root path
     */
    public function __construct(request $request, factory $db, auth $auth, user $user, config $config, $phpbb_root_path)
    {
        $this->request = $request;
        $this->db = $db;
        $this->auth = $auth;
        $this->user = $user;
        $this->config = $config;
        $this->phpbb_root_path = $phpbb_root_path;
    }

    /**
     * Function to get names matching a given username
     *
     * @access public
     * @since  1.0.0
     */
    public function getNameSuggestions()
    {
        $response = new json_response();
        $users = array();
        // Only allow JSON requests
        if ($this->request->is_ajax())
        {
            // Search if a name is given
            $search = utf8_normalize_nfc(strtolower($this->request->variable('search', '', true)));
            if (strlen($search) > 0)
            {
                $user_count = 0;
                $search = $this->db->sql_escape($search);
                $query = 'SELECT *
					FROM ' . USERS_TABLE . '
					WHERE ' . $this->db->sql_in_set('user_type', array(USER_NORMAL, USER_FOUNDER)) . '
						AND username_clean ' . $this->db->sql_like_expression($this->db->get_any_char() . $search . $this->db->get_any_char()) . '
					ORDER BY username_clean ' . $this->db->sql_like_expression($search . $this->db->get_any_char()) . ' DESC, username DESC';
                $result = $this->db->sql_query($query);
                $default_avatar_url = $this->phpbb_root_path . 'styles/' . $this->user->style['style_path'] . '/theme/images/no_avatar.gif';
                if (!file_exists($default_avatar_url))
                {
                    $default_avatar_url = $this->phpbb_root_path . 'ext/pcgf/pmnamesuggestions/styles/all/theme/images/no-avatar.gif';
                }
                if (!defined('PHPBB_USE_BOARD_URL_PATH'))
                {
                    define('PHPBB_USE_BOARD_URL_PATH', true);
                }
                // Get all users with pm read permission
                while ($user = $this->db->sql_fetchrow($result))
                {
                    $this->auth->acl($user);
                    if ($this->auth->acl_get('u_readpm') > 0)
                    {
                        // Add the user to the user list
                        $avatar_image = phpbb_get_user_avatar($user);
                        if ($avatar_image == '')
                        {
                            $avatar_image = '<img src="' . $default_avatar_url . '"/>';
                        }
                        array_push($users, array('username' => $user['username'], 'user' => get_username_string('no_profile', $user['user_id'], $user['username'], $user['user_colour']), 'avatar' => $avatar_image));
                        $user_count++;
                        if ($user_count == $this->config['pcgf_pmnamesuggestions_user_count'])
                        {
                            break;
                        }
                    }
                }
            }
        }
        $response->send($users);
    }
}
