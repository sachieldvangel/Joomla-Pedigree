<?php
/**
 * @version     1.0.2
 * @package     com_pedigree
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Eddie Kominek <eddie@kominekafghans.com> - http://www.kominekafghans.com/
 */

// No direct access.
defined('_JEXEC') or die;

require_once JPATH_COMPONENT.'/controller.php';

/**
 * Pedigrees list controller class.
 */
class PedigreeControllerPedigrees extends PedigreeController
{
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function &getModel($name = 'Pedigrees', $prefix = 'PedigreeModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}