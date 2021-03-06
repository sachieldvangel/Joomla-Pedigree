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

jimport('joomla.application.component.modelform');
jimport('joomla.event.dispatcher');

/**
 * Pedigree model.
 */
class PedigreeModelDogForm extends JModelForm
{
    
    var $_item = null;
    
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	protected function populateState()
	{
		$app = JFactory::getApplication('com_pedigree');

		// Load state from the request userState on edit or from the passed variable on default
        if (JFactory::getApplication()->input->get('layout') == 'edit') {
            $id = JFactory::getApplication()->getUserState('com_pedigree.edit.dog.id');
        } else {
            $id = JFactory::getApplication()->input->get('id');
            JFactory::getApplication()->setUserState('com_pedigree.edit.dog.id', $id);
        }
		$this->setState('dog.id', $id);

		// Load the parameters.
        $params = $app->getParams();
        $params_array = $params->toArray();
        if(isset($params_array['item_id'])){
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
	public function &getData($id = null)
	{
		if ($this->_item === null)
		{
			$this->_item = false;

			if (empty($id)) {
				$id = $this->getState('dog.id');
			}

			// Get a level row instance.
			$table = $this->getTable();

			// Attempt to load the row.
			if ($table->load($id))
			{
                
                $user = JFactory::getUser();
                $id = $table->id;
                if($id){
					$canEdit = $user->authorise('core.edit', 'com_pedigree.dog.'.$id) || $user->authorise('core.create', 'com_pedigree.dog.'.$id);
				}
				else{
					$canEdit = $user->authorise('core.edit', 'com_pedigree') || $user->authorise('core.create', 'com_pedigree');
				}
				
                if (!$canEdit && $user->authorise('core.edit.own', 'com_pedigree.dog.'.$id)) {
                    $canEdit = $user->id == $table->created_by;
                }

                if (!$canEdit) {
                    JError::raiseError('500', JText::_('JERROR_ALERTNOAUTHOR'));
                }
                
				// Check published state.
				if ($published = $this->getState('filter.published'))
				{
					if ($table->state != $published) {
						return $this->_item;
					}
				}

				// Convert the JTable to a clean JObject.
				$properties = $table->getProperties(1);
				$this->_item = JArrayHelper::toObject($properties, 'JObject');
				
				// Sire Name
				if (isset($this->_item->id_sire) && $this->_item->id_sire != 0) {
					if(is_object($this->_item->id_sire)){
						$this->_item->id_sire = JArrayHelper::fromObject($this->_item->id_sire);
					}
					$values = (is_array($this->_item->id_sire)) ? $this->_item->id_sire : explode(',',$this->_item->id_sire);
	
					$textValue = array();
					foreach ($values as $value){
						$db = JFactory::getDbo();
						$query = $db->getQuery(true);
						$query
								->select('name')
								->from('`#__pedigree_dogs`')
								->where('id = ' . $db->quote($db->escape($value)));
						$db->setQuery($query);
						$results = $db->loadObject();
						if ($results) {
							$textValue[] = $results->name;
						}
					}
	
					$this->_item->id_sire_label = !empty($textValue) ? implode(', ', $textValue) : '';
				} else {
					$this->_item->id_sire_label = "";
				}
	
				// Dam Name
				if (isset($this->_item->id_dam) && $this->_item->id_dam != 0) {
					if(is_object($this->_item->id_dam)){
						$this->_item->id_dam = JArrayHelper::fromObject($this->_item->id_dam);
					}
					$values = (is_array($this->_item->id_dam)) ? $this->_item->id_dam : explode(',',$this->_item->id_dam);
	
					$textValue = array();
					foreach ($values as $value){
						$db = JFactory::getDbo();
						$query = $db->getQuery(true);
						$query
								->select('name')
								->from('`#__pedigree_dogs`')
								->where('id = ' . $db->quote($db->escape($value)));
						$db->setQuery($query);
						$results = $db->loadObject();
						if ($results) {
							$textValue[] = $results->name;
						}
					}
	
					$this->_item->id_dam_label = !empty($textValue) ? implode(', ', $textValue) : ''; //$item->id_dam;
				} else {
					$this->_item->id_dam_label = "";
				}
				
				/**
					Registrations
				**/
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$query
						->select('a.`id`, a.`id_dog`, a.`id_country`, a.`is_primary`, a.`registration_number`, a.`registration_name`, a.`verified`, a.`notes`, a.`ordering`, a.`state`, a.`checked_out`, a.`checked_out_time`, a.`created_by`')
						->from('#__pedigree_registrations a')
						//->innerJoin('#__pedigree_countries b ON a.`id_country` = b.`id`')
						->where('a.`id_dog` = ' . $db->quote($db->escape($this->_item->id)))
						->order('a.`is_primary` DESC');
				$db->setQuery($query);
				$results = $db->loadObjectList();
				if ($results) {				
					foreach ($results as $row){
						$item->registrations[] = $row;
					}				
				}

			} elseif ($error = $table->getError()) {
				$this->setError($error);
			}
		}

		return $this->_item;
	}
    
	public function getTable($type = 'Dog', $prefix = 'PedigreeTable', $config = array())
	{   
        $this->addTablePath(JPATH_COMPONENT_ADMINISTRATOR.'/tables');
        return JTable::getInstance($type, $prefix, $config);
	}  

    
	/**
	 * Method to check in an item.
	 *
	 * @param	integer		The id of the row to check out.
	 * @return	boolean		True on success, false on failure.
	 * @since	1.6
	 */
	public function checkin($id = null)
	{
		// Get the id.
		$id = (!empty($id)) ? $id : (int)$this->getState('dog.id');

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
	public function checkout($id = null)
	{
		// Get the user id.
		$id = (!empty($id)) ? $id : (int)$this->getState('dog.id');

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
    
	/**
	 * Method to get the profile form.
	 *
	 * The base form is loaded from XML 
     * 
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_pedigree.dog', 'dogform', array('control' => 'jform', 'load_data' => $loadData));
//		$form = $this->loadForm('com_pedigree.dog', 'dogform', array('load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_pedigree.edit.dog.data', array());
        if (empty($data)) {
            $data = $this->getData();
        }
        
        return $data;
	}

	/**
	 * Method to save the form data.
	 *
	 * @param	array		The form data.
	 * @return	mixed		The user id on success, false on failure.
	 * @since	1.6
	 */
	public function save($data)
	{
		$id = (!empty($data['id'])) ? $data['id'] : (int)$this->getState('dog.id');
        $state = (!empty($data['state'])) ? 1 : 0;
        $user = JFactory::getUser();

        if($id) {
            //Check the user can edit this item
            $authorised = $user->authorise('core.edit', 'com_pedigree.dog.'.$id) || $authorised = $user->authorise('core.edit.own', 'com_pedigree.dog.'.$id);
            if($user->authorise('core.edit.state', 'com_pedigree.dog.'.$id) !== true && $state == 1){ //The user cannot edit the state of the item.
                $data['state'] = 0;
            }
        } else {
            //Check the user can create new items in this section
            $authorised = $user->authorise('core.create', 'com_pedigree');
            if($user->authorise('core.edit.state', 'com_pedigree.dog.'.$id) !== true && $state == 1){ //The user cannot edit the state of the item.
                $data['state'] = 0;
            }
        }

        if ($authorised !== true) {
            JError::raiseError(403, JText::_('JERROR_ALERTNOAUTHOR'));
            return false;
        }
        
        $table = $this->getTable();
        if ($table->save($data) === true) {
            return $id;
        } else {
            return false;
        }
        
	}
    
     function delete($data)
    {
        $id = (!empty($data['id'])) ? $data['id'] : (int)$this->getState('dog.id');
        if(JFactory::getUser()->authorise('core.delete', 'com_pedigree.dog.'.$id) !== true){
            JError::raiseError(403, JText::_('JERROR_ALERTNOAUTHOR'));
            return false;
        }
        $table = $this->getTable();
        if ($table->delete($data['id']) === true) {
            return $id;
        } else {
            return false;
        }
        
        return true;
    }
    
}