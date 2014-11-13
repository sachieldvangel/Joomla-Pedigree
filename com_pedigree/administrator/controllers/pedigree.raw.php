<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_banners
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Tracks list controller class.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_banners
 * @since       1.6
 */
class PedigreeControllerPedigree extends JController {
	/**
	 * @var    string  The context for persistent state.
	 *
	 * @since  1.6
	 */
	//protected $context = 'com_pedigree.pedigree';

	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The name of the model.
	 * @param   string  $prefix  The prefix for the model class name.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JModel
	 *
	 * @since   1.6
	 */
	/*public function getModel($name = 'Pedigree', $prefix = 'PedigreeModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}*/

	/**
	 * Display method for the raw track data.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached
	 * @param   array    $urlparams  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JController  This object to support chaining.
	 *
	 * @since   1.5
	 * @todo    This should be done as a view, not here!
	 */
	public function display($cachable = false, $urlparams = false)
	{
		/*// Get the document object.
		$document	= JFactory::getDocument();
		$vName		= 'pedigree';
		$vFormat	= 'raw';

		//Get and render the view.
		if ($view = $this->getView($vName, $vFormat))
		{
			// Get the model for the view.
			$model = $this->getModel($vName);

			// Load the filter state.
			$app = JFactory::getApplication();
			
			$dogId = $app->input->getInt('id', null, 'array');
			$model->setState('pedigree.id', $dogId);
			
			$limit = $app->input->getInt('limit', null, 'array');
			$model->setState('pedigree.limit', $limit);

			// Push the model into the view (as default).
			$view->setModel($model, true);

			// Push document object into the view.
			$view->document = $document;

			$view->display();
		}*/
		echo 'in display';
	}
}
