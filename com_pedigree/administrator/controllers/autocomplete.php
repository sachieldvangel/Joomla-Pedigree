<?php
/**
 * @version     1.0.3
 * @package     com_pedigree
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Eddie Kominek <eddie@kominekafghans.com> - http://www.kominekafghans.com/
 */

// No direct access.
defined('_JEXEC') or die;

//jimport('joomla.application.controller');
require_once JPATH_COMPONENT . '/controller.php';

/**
 * Dog controller class.
 */
class PedigreeControllerAutocomplete extends PedigreeController {

//class PedigreeControllerAutocomplete extends JControllerLegacy {

	

	public function dogs()
	{
		try
		{
		  //$anyParam = JFactory::getApplication()->input->get('anyparam');
	 
		  //$count = $this->getModel('example')->countSomething($anyParam);
	 	  $count=5;
		  echo new JResponseJson($count);
		}
		catch(Exception $e)
		{
		  echo new JResponseJson($e);
		}
	}
}