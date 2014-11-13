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

jimport('joomla.application.component.modelitem');
jimport('joomla.event.dispatcher');

/**
 * Pedigree model.
 */
class PedigreeModelPedigree extends JModelItem {

	protected $_occurrences;

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since	1.6
     */
    protected function populateState() {
        $app = JFactory::getApplication('com_pedigree');
		
        // Load state from the request userState on edit or from the passed variable on default
	    $id = $app->input->get('id');
        if (isset($id) && $id!=0) {
			$this->setState('pedigree.id', $id);
		}
	    $limit = $app->input->get('limit');
        if (isset($limit) && $limit!=0) {
			$this->setState('pedigree.limit', $limit);
		}

        // Load the parameters.
        $params = $app->getParams();
        $params_array = $params->toArray();
        if (isset($params_array['item_id'])) {
            $this->setState('pedigree.id', $params_array['item_id']);
        }
        $this->setState('params', $params);
    }
	
	 /**
     * Method to get an ojbect.
     *
     * @param	integer	The id of the object to get.
     *
     * @return	mixed	Object on success, false on failure.
     */
    public function &getData($id = null) {
        if ($this->_item === null) {
            $this->_item = new stdClass();

            if (empty($id)) {
                $id = $this->getState('pedigree.id', 0);
			}

 			$limit = $this->getState('pedigree.limit', $this->state->params->get('gen-default',4));
			
        }
		
		$this->_occurrences = array();
		
		$this->_item = $this->PedigreePopulateNode($this->_item, $id, 0, $limit+1);
		$this->_item->occurrences = $this->_occurrences;

        return $this->_item;
    }
	
	protected function CalculateCOI($limit) {
			
	}
	
	protected function PedigreePopulateNode($curNode, $id_dog, $i, $limit=4) {
		++$i;
		
		if (isset($curNode->id) && $curNode->id == $id_dog && $curNode->id > 0) {
			// If we're traversing an already build pedigree node, no need to redo the query on it.
			$dog = $curNode;
		} elseif (isset($curNode->id) && $curNode->id < 0) {
			// Last generation was unknown.  This one will be too.
			$dog = $this->unknownDog($i);
			// Grab sex from the last argument
			$dog->sex = $curNode->sex;
		} else {
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$this->_item->registrations = array();
			$query
					->select('a.`id`, a.`name`, a.`id_sire`, a.`id_dam`, a.`sex`, a.`birth_date`, a.`id_gallery_image`, a.`titles_prefix`, a.`titles_suffix`, b.`registration_number`')
					->from('#__pedigree_dogs a')
					->leftJoin('#__pedigree_registrations b ON (b.id_dog = a.id AND b.is_primary = 1)')
					->where('a.`id` = ' . $db->quote($db->escape($id_dog)));
					//->order('a.`is_primary` DESC');
			$db->setQuery($query);
			$result = $db->loadObject();
			if ($result) {		
				$dog = $result;
				if ($dog->id_sire == 0) {
					 $dog->id_sire = -($i+1);
					 $dog->sire = $this->unknownDog($i+1);
					 $dog->sire->sex = 1 ;
				} else {
					$dog->sire = new stdClass();
					$dog->sire->sex = 1;
				}
					
				if ($dog->id_dam == 0) {
					 $dog->id_dam = -($i+1);
					 $dog->dam = $this->unknownDog($i+1);
					 $dog->dam->sex = 2;
				} else {
					$dog->dam = new stdClass();
					$dog->dam->sex = 2;
				}
				
				// increment _occurrences
				$this->_occurrences[(string) $dog->id]= ((array_key_exists((string) $dog->id, $this->_occurrences))?++$this->_occurrences[(string) $dog->id]:1);

			} else {
				// Dog Unknown.  Spoof it.
				$dog = $this->unknownDog($i);
				// Grab sex from the last argument
				$dog->sex = $curNode->sex;
			}
		}
		
		if (isset($dog->id) && $i < $limit) {
			$dog->sire = $this->PedigreePopulateNode($dog->sire, $dog->id_sire, $i, $limit);
			$dog->dam = $this->PedigreePopulateNode($dog->dam, $dog->id_dam, $i, $limit);	
		}
		
		return $dog;	
	}
	
	protected function unknownDog($i) {
		$dog = new stdClass();
		$dog->id = -$i;
		$dog->id_sire = -$i-1;
		$dog->id_dam = -$i-1;
		$dog->name = JText::_('COM_PEDIGREE_DOG_UNKNOWN');
		$dog->sex = 1;
		$dog->birth_date = '';
		$dog->id_gallery_image = '';
		$dog->titles_prefix = '';
		$dog->titles_suffix = '';
		$dog->registration_number = '';
		$dog->sire = new stdClass();
		$dog->sire->sex = 1;
		$dog->dam = new stdClass();
		$dog->dam->sex = 2;
		
		return $dog;
	}

 }
