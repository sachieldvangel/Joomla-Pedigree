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
class PedigreeModelDog extends JModelItem {

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
        if ($app->input->get('layout') == 'edit') {
            $id = $app->getUserState('com_pedigree.edit.dog.id');
        } else {
            $id = $app->input->get('id');
            $app->setUserState('com_pedigree.edit.dog.id', $id);
        }
        $this->setState('dog.id', $id);

        // Load the parameters.
        $params = $app->getParams();
        $params_array = $params->toArray();
        if (isset($params_array['item_id'])) {
            $this->setState('dog.id', $params_array['item_id']);
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
            $this->_item = false;

            if (empty($id)) {
                $id = $this->getState('dog.id');
            }

            // Get a level row instance.
            $table = $this->getTable();

            // Attempt to load the row.
            if ($table->load($id)) {
                // Check published state.
                if ($published = $this->getState('filter.published')) {
                    if ($table->state != $published) {
                        return $this->_item;
                    }
                }

                // Convert the JTable to a clean JObject.
                $properties = $table->getProperties(1);
                $this->_item = JArrayHelper::toObject($properties, 'JObject');
            } elseif ($error = $table->getError()) {
                $this->setError($error);
            }
        }
		
		// Sex
		
		$this->_item->sex_name = JText::_('COM_PEDIGREE_DOGS_SEX_OPTION_' . $this->_item->sex);
		
		/**
			Sire
		**/
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$this->_item->registrations = array();
		$query
				->select('a.`name`')
				->from('#__pedigree_dogs a')
				->where('a.`id` = ' . $db->quote($db->escape($this->_item->id_sire)));
		$db->setQuery($query);
		$result = $db->loadObject();
		if ($result) {				
			$this->_item->sire_name = (string) $result->name;
		}
		
		/**
			Dam
		**/
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$this->_item->registrations = array();
		$query
				->select('a.`name`')
				->from('#__pedigree_dogs a')
				->where('a.`id` = ' . $db->quote($db->escape($this->_item->id_dam)));
		$db->setQuery($query);
		$result = $db->loadObject();
		if ($result) {				
			$this->_item->dam_name = (string) $result->name;
		}
		
		/**
			Registrations
		**/
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$this->_item->registrations = array();
		$query
				->select('a.`registration_number`, a.`id_country`, b.`iso3`')
				->from('#__pedigree_registrations a')
				->innerJoin('#__pedigree_countries b ON a.`id_country` = b.`id`')
				->where('a.`id_dog` = ' . $db->quote($db->escape($this->_item->id)))
				->order('a.`is_primary` DESC');
		$db->setQuery($query);
		$results = $db->loadObjectList();
		if ($results) {				
			foreach ($results as $row){
				$this->_item->registrations[] = $row;
			}				
		}
		
		/**
			Breeders
		**/
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$this->_item->breeders = array();
		$query
				->select('a.`id`, a.`is_primary`, b.`first_name`, b.`last_name`, b.`kennel_name`, b.`id_country`, c.`iso3`')
				->from('#__pedigree_breeders a')
				->leftJoin('#__pedigree_people b ON a.`id_person` = b.`id`')
				->leftJoin('#__pedigree_countries c ON b.`id_country` = c.`id`')
				->where('a.`id_dog`= '.$this->_item->id)
				->order('a.`is_primary` DESC, b.`last_name`, b.`first_name`');
		$db->setQuery($query);
		$results = $db->loadObjectList();
		if ($results) {				
			foreach ($results as $row){
				$this->_item->breeders[] = $row;
			}				
		}
		
		/**
			Owners
		**/
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$this->_item->owners = array();
		$query
				->select('a.`id`, a.`is_primary`, b.`first_name`, b.`last_name`, b.`kennel_name`, b.`id_country`, c.`iso3`')
				->from('#__pedigree_owners a')
				->leftJoin('#__pedigree_people b ON a.`id_person` = b.`id`')
				->leftJoin('#__pedigree_countries c ON b.`id_country` = c.`id`')
				->where('a.`id_dog`= '.$this->_item->id)
				->order('a.`is_primary` DESC, b.`last_name`, b.`first_name`');
		$db->setQuery($query);
		$results = $db->loadObjectList();
		if ($results) {				
			foreach ($results as $row){
				$this->_item->owners[] = $row;
			}				
		}

		$this->_item->siblings = new stdClass();

		/**
			Full Siblings
		**/
		if ($this->_item->id_sire > 0 && $this->_item->id_dam > 0) {	
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$this->_item->siblings->full = array();
			$query
					->select('a.`id`, a.`name`, a.`sex`, b.`registration_number`, a.`birth_date`, a.`id_color`, a.`id_pattern`, a.`brs_number`, a.`stud_number`')
					->from('#__pedigree_dogs a')
					->leftJoin('#__pedigree_registrations b ON (a.`id` = b.`id_dog` AND b.`is_primary`=1)')
					->where('a.`id` != '.$db->quote($db->escape($this->_item->id)).' AND (a.`id_sire`= '.$db->quote($db->escape($this->_item->id_sire)).' AND a.`id_dam`= '.$db->quote($db->escape($this->_item->id_dam)).')')
					->order('a.`name`');
			$db->setQuery($query);
			$results = $db->loadObjectList();
			if ($results) {				
				foreach ($results as $row){
					$this->_item->siblings->full[] = $row;
				}				
			}
		}
		
		/**
			Half Siblings
		**/
		if ($this->_item->id_sire > 0 || $this->_item->id_dam > 0) {
			$whereClause = '';
			if ($this->_item->id_sire > 0 && $this->_item->id_dam > 0) {
				$whereClause = '(a.`id_sire`= '.$db->quote($db->escape($this->_item->id_sire)).' XOR a.`id_dam`= '.$db->quote($db->escape($this->_item->id_dam)).')';
			} else {
				$whereClause = '(a.`id_sire`= '.$db->quote($db->escape($this->_item->id_sire)).' AND a.`id_dam`= '.$db->quote($db->escape($this->_item->id_dam)).')';
			}
			
			if ($whereClause != '') {
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$this->_item->siblings->half = array();
				$query
						->select('a.`id`, a.`name`, a.`sex`, b.`registration_number`, a.`birth_date`, a.`id_color`, a.`id_pattern`, a.`brs_number`, a.`stud_number`')
						->from('#__pedigree_dogs a')
						->leftJoin('#__pedigree_registrations b ON (a.`id` = b.`id_dog` AND b.`is_primary`=1)')
						->where('a.`id` != '.$db->quote($db->escape($this->_item->id)).' AND '.$whereClause)
						->order('a.`birth_date`, a.`name`');
				$db->setQuery($query);
				$results = $db->loadObjectList();
				if ($results) {				
					foreach ($results as $row){
						$this->_item->siblings->half[] = $row;
					}				
				}
			}
		}
        
		/**
			Offspring
		**/
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$this->_item->offspring = array();
		$query
				->select('a.`id`, a.`name`, a.`sex`, b.`registration_number`, a.`birth_date`, a.`id_color`, a.`id_pattern`, a.`brs_number`, a.`stud_number`')
				->from('#__pedigree_dogs a')
				->leftJoin('#__pedigree_registrations b ON (a.`id` = b.`id_dog` AND b.`is_primary`=1)')
				->where('a.`id_'.(($this->_item->sex==1) ? 'sire' : 'dam').'`= '.$db->quote($db->escape($this->_item->id)))
				->order('a.`birth_date`, a.`name`');
		$db->setQuery($query);
		$results = $db->loadObjectList();
		if ($results) {				
			foreach ($results as $row){
				$this->_item->offspring[] = $row;
			}				
		}	
			
		if ( isset($this->_item->created_by) ) {
			$this->_item->created_by_name = JFactory::getUser($this->_item->created_by)->name;
		}

        return $this->_item;
    }


    public function getTable($type = 'Dog', $prefix = 'PedigreeTable', $config = array()) {
        $this->addTablePath(JPATH_COMPONENT_ADMINISTRATOR . '/tables');
        return JTable::getInstance($type, $prefix, $config);
    }

    /**
     * Method to check in an item.
     *
     * @param	integer		The id of the row to check out.
     * @return	boolean		True on success, false on failure.
     * @since	1.6
     */
    public function checkin($id = null) {
        // Get the id.
        $id = (!empty($id)) ? $id : (int) $this->getState('dog.id');

        if ($id) {

            // Initialise the table
            $table = $this->getTable();

            // Attempt to check the row in.
            if (method_exists($table, 'checkin')) {
                if (!$table->checkin($id)) {
                    $this->setError($table->getError());
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Method to check out an item for editing.
     *
     * @param	integer		The id of the row to check out.
     * @return	boolean		True on success, false on failure.
     * @since	1.6
     */
    public function checkout($id = null) {
        // Get the user id.
        $id = (!empty($id)) ? $id : (int) $this->getState('dog.id');

        if ($id) {

            // Initialise the table
            $table = $this->getTable();

            // Get the current user object.
            $user = JFactory::getUser();

            // Attempt to check the row out.
            if (method_exists($table, 'checkout')) {
                if (!$table->checkout($user->get('id'), $id)) {
                    $this->setError($table->getError());
                    return false;
                }
            }
        }

        return true;
    }


    public function publish($id, $state) {
        $table = $this->getTable();
        $table->load($id);
        $table->state = $state;
        return $table->store();
    }

    public function delete($id) {
        $table = $this->getTable();
        return $table->delete($id);
    }

}
