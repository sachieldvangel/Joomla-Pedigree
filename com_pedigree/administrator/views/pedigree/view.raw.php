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
class PedigreeViewPedigree extends JViewLegacy
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
		$this->PedHelper = new PedigreeFrontendHelper();
				
		$this->state = $this->get('State');
		$this->item = $this->get('Data');
        $this->params = $app->getParams('com_pedigree');
		$limit = $this->state->get('pedigree.limit');

        if (!empty($this->item)) {
			$this->form		= $this->get('Form');
        }

		echo $this->getPedigreeNodeHtml($this->item, 0, $limit);		
	}
	
	public function getPedigreeNodeHtml($dog, $i, $limit) {
		$retval='';
		
		if(isset($dog) && isset($dog->id) && $dog->id !=0) {
			$sex_name = (($dog->sex == 1) ? 'sire' : 'dam');
		
			if ($i==0) {
				$retval .= '<div class="ped-pedigree gen-'.$limit.'">';
				// skip info pane
			} elseif ($dog->id < 0 ) {
				// Unknown Dog
				$retval .= '<div class="ped-pedigree-'.$sex_name.'-'.$i.'">';
				$retval .= 	 '<div class="ped-pedigree-info-'.$i.'">';
				$retval .= 	 '<div class="ped-pedigree-name">';
				$retval .= 	 '<div class="ped-pedigree-regname">'.$dog->name.'</div>';
				$retval .= 	 '</div>';
				$retval .= 	 '</div>';
			} else {
				$retval .= '<div class="ped-pedigree-'.$sex_name.'-'.$i.'">';
				$retval .= 	 '<div class="ped-pedigree-info-'.$i;
				if (isset($this->item->occurrences[$dog->id]) && $this->item->occurrences[$dog->id] > 1) {
					$retval .= ' ped-pedigree-occur-'.$this->item->occurrences[$dog->id].'" ';
					$retval .= 'title="'.$dog->name.'&#013;'.JText::sprintf('COM_PEDIGREE_FORM_LBL_DOG_OCCURRENCES_IN', $this->item->occurrences[$dog->id], $limit).'">';
				} else {
					$retval .= '" title="'.$dog->name.'">';
				}
			
				$retval .= 	 '<div class="ped-pedigree-name">';
				// Include Prefix title?
				$retval .= 	 ($dog->titles_prefix=='')?'':'<div class="ped-pedigree-title">'.$dog->titles_prefix.'</div>';
				$retval .= 	 '<div class="ped-pedigree-regname">';
				$retval .= 	 '<a href="'.JRoute::_('index.php?option=com_pedigree&view=dog&id='.(int) $dog->id).'">'.$dog->name.'</a>';
				$retval .= 	 '</div>';
				// Include Suffix title?
				$retval .= 	 ($dog->titles_suffix=='')?'':'<div class="ped-pedigree-title">'.$dog->titles_suffix.'</div>';
				$retval .=   ($dog->registration_number=='')?'':'<div class="ped-pedigree-regnumber">'.$dog->registration_number.'</div>';
				$retval .= 	 '</div>';

				// Include Thumbnail?
				$retval .= 	 (($this->state->params->get('gen-imagethumbsenabled',1)==1) ? $this->PedHelper->iGallery->displayThumb($this->PedHelper->iGallery->getPicture($dog->id_gallery_image),true,null,'ped-pedigree-thumbnail') : '');

				$retval .= 	 '</div>';
				//'.(($dog->titles_suffix=='')?'':'<br />').'<span class="ped-pedigree-regnumber">'.$dog->registration_number.'</span>
			}
			
			++$i;
		
			if ($i <= $limit) {
				$retval .=		 '<div class="ped-pedigree-mating-'.$i.'">';
				$retval .= $this->getPedigreeNodeHtml($dog->sire, $i, $limit);
				$retval .= $this->getPedigreeNodeHtml($dog->dam, $i, $limit);
				$retval .= 		 '</div>';
			}
			$retval .=     '</div>';
        }
        
        return $retval;
    }
    
}
