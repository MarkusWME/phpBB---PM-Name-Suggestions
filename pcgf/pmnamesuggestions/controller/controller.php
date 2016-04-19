<?php

/**
 * @author MarkusWME <markuswme@pcgamingfreaks.at>
 * @copyright 2016 MarkusWME
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

namespace pcgf\pmnamesuggestions\controller;

use Symfony\Component\HttpFoundation\Response;

/** @version 1.0.0 */
class controller
{
	/** @const Max user count */
	const MAX_USER_COUNT = 5;
	
	/** @var \phpbb\request\request $request Request object */
	protected $request;
	
	/** @var \phpbb\db\driver\factory $db Database object */
	protected $db;
	
	/** @var \phpbb\auth\auth $auth Authenticator object */
	protected $auth;
	
	/** @var \phpbb\user $user User object */
	protected $user;
	
	/**
	 * Constructor
	 *
	 * @access public
	 * @since 1.0.0
	 * @param \phpbb\request\request\		$request	Request object
	 * @param \phpbb\db\driver\factory		$db			Database object
	 * @param \phpbb\auth\auth				$auth		Authenticator object
	 * @param \phpbb\user					$user		User object
	 * @return \pcgf\pmnamesuggestions\controller\controller The controller object of the extension
	 */
	public function __construct(\phpbb\request\request $request, \phpbb\db\driver\factory $db, \phpbb\auth\auth $auth, \phpbb\user $user)
	{
		$this->request = $request;
		$this->db = $db;
		$this->auth = $auth;
		$this->user = $user;
	}
	
	/**
	 * Function to get names matching a given username
	 *
	 * @access public
	 * @since 1.0.0
	 * @return null
	 */
	public function getNameSuggestions()
	{
		$response = new Response();
		$response->headers->set('Content-Type', 'text/html');
		$response->setContent('');
		// Only allow JSON requests
		if ($this->request->is_ajax())
		{
			// Search if a name is given
			$search = utf8_strtolower($this->request->variable('search', ''));
			if (strlen($search) > 0)
			{
				$users = '';
				$user_count = 0;
				$search = $this->db->sql_escape($search);
				$query = 'SELECT *
					FROM ' . USERS_TABLE . '
					WHERE ' . $this->db->sql_in_set('user_type', array(USER_NORMAL, USER_FOUNDER)) . '
						AND LOWER(username) LIKE "%' . $search . '%"
					ORDER BY CASE WHEN LOWER(username) LIKE "' . $search . '%" THEN 0 ELSE 1 END, username';
				$result = $this->db->sql_query($query);
				$phpbb_root_path = defined('PHPBB_ROOT_PATH') ? PHPBB_ROOT_PATH : './';
				$default_avatar_url = $phpbb_root_path . '/styles/' . $this->user->style['style_path'] . '/theme/images/no_avatar.gif';
				if (!file_exists($default_avatar_url))
				{
					$default_avatar_url = $phpbb_root_path . '/ext/pcgf/pmnamesuggestions/styles/all/theme/images/no_avatar.gif';
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
						$users .= '<li' . ($user['user_colour'] == '' ? '' : ' style="color: #' . $user['user_colour'] . ';"') . '>' . $avatar_image . $user['username'] . '</li>';
						$user_count++;
						if ($user_count == self::MAX_USER_COUNT)
						{
							break;
						}
					}
				}
				$this->db->sql_freeresult($result);
				$response->setStatusCode(200);
				$response->setContent('<ul>' . $users . '</ul>');
			}
		}
		else
		{
			$response->setStatusCode(400);
		}
		return $response;
	}
}