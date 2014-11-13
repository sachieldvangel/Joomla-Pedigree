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
 * View class for a list of tracks.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_banners
 * @since       1.6
 */
class PedigreeViewAcdogs extends JViewLegacy
{
	/**
	 * Display the view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	 
    protected $state;
    protected $item;
    protected $form;
    protected $params;
	
	protected $PedHelper;
	
	public function display($tpl = null)
	{
		/*$basename		= $this->get('BaseName');
		$filetype		= $this->get('FileType');
		$mimetype		= $this->get('MimeType');
		$content		= $this->get('Content');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));

			return false;
		}

		$document = JFactory::getDocument();
		$document->setMimeEncoding($mimetype);
		JFactory::getApplication()->setHeader('Content-disposition', 'attachment; filename="' . $basename . '.' . $filetype . '"; creation-date="' . JFactory::getDate()->toRFC822() . '"', true);
		echo $content;*/
	
        $app = JFactory::getApplication();
        $user = JFactory::getUser();
		//$this->PedHelper = new PedigreeFrontendHelper();
				
		$this->state = $this->get('State');
		$this->items = $this->get('Items');
        $this->params = $app->getParams('com_pedigree');
		//$limit = $this->state->get('pedigree.limit');

		// Get the document object.
		$document = JFactory::getDocument();
		 
		// Set the MIME type for JSON output.
		$document->setMimeEncoding('application/json');
		 
		// Change the suggested filename.
		JResponse::setHeader('Content-Disposition','attachment;filename="'.$this->getName().'.json"');
		
		echo json_encode($this->items);		
	}
	    
}
