<?php defined('SYSPATH') or die('No direct script access.');
/**
 * socialconnection Hook
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com> 
 * @package	   Ushahidi - http://source.ushahididev.com
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license	   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */

class socialconnection {
	
	/**
	 * Registers the main event add method
	 */
	public function __construct()
	{	
		// Hook into routing
		Event::add('system.pre_controller', array($this, 'add'));
	}
	
	/**
	 * Adds all the events to the main Ushahidi application
	 */
	public function add()
    {
   // Hook into the main_sidebar event and call the Hello controller
	// and the method _say_hello within the Hello controller
	Event::add('ushahidi_action.login_user_form', array($this, 'connection'));
    }
	
	public function connection()
    {
        // Print the words 'Hello World' in the front page side bar
        $sharing_bar = View::factory('socialconnection/connection_form');
		$sharing_bar->render(TRUE);
    }
}

new socialconnection;
