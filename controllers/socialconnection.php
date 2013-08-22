<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Connection Controller
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

class Hello_Controller extends Controller
{
    public function _say_hello()
    {
        $view = View::factory('socialconnection/connection_form');
        $view->render(TRUE);
    }
}
