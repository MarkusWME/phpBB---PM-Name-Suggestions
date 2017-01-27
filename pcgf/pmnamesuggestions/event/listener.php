<?php

/**
 * @author    MarkusWME <markuswme@pcgamingfreaks.at>
 * @copyright 2016 MarkusWME
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

namespace pcgf\pmnamesuggestions\event;

use phpbb\config\config;
use phpbb\controller\helper;
use phpbb\template\template;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/** @version 1.1.1 */
class listener implements EventSubscriberInterface
{
    /** @var template $template Template object */
    protected $template;

    /** @var helper $helper Helper object */
    protected $helper;

    /** @var config $config Configuration object */
    protected $config;

    /**
     * Constructor
     *
     * @access public
     * @since  1.0.0
     *
     * @param template $template Template object
     * @param helper   $helper   Helper object
     * @param config   $config   Configuration object
     */
    public function __construct(template $template, helper $helper, config $config)
    {
        $this->template = $template;
        $this->helper = $helper;
        $this->config = $config;
    }

    /**
     * Function that returns the subscribed events
     *
     * @access public
     * @since  1.0.0
     * @return mixed[] The subscribed event list
     */
    static public function getSubscribedEvents()
    {
        return array(
            'core.ucp_pm_compose_modify_data' => 'add_pmnamesuggestion_css',
        );
    }

    /**
     * Function that set's the template variable to load the css file when writing a pm
     *
     * @access public
     * @since  1.0.0
     */
    public function add_pmnamesuggestion_css()
    {
        $this->template->assign_vars(array(
            'PM_NAME_SUGGESTIONS'                => true,
            'PCGF_PM_NAME_SUGGESTION_URL'        => $this->helper->route('pcgf_pmnamesuggestions_controller'),
            'PCGF_PM_NAME_SUGGESTION_IMAGE_SIZE' => $this->config['pcgf_pmnamesuggestions_avatar_image_size'],
        ));
    }
}
