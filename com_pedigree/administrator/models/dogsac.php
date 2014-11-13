<?php

/**
 * @version     1.0.3
 * @package     com_pedigree
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Eddie Kominek <eddie@kominekafghans.com> - http://www.kominekafghans.com/
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Pedigree records.
 */
class PedigreeModelDogsAC extends JModelList {


    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id', 
				'name', 
				'id_sire', 
				'id_dam', 
                'sex'
            );
        }
        parent::__construct($config);
    }
	
	//protected function getFilterForm($data

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since	1.6
     */
    protected function populateState($ordering = null, $direction = null) {

        // Initialise variables.
        $app = JFactory::getApplication();
		
		if(empty($ordering)) {
			$ordering = 'a.ordering';
		}

        // List state information.
        parent::populateState($ordering, $direction);
		
        // List state information
        $limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
        $this->setState('list.limit', $limit);

        //$limitstart = $app->input->getInt('start', 0);
		$limitstart = $app->getUserStateFromRequest($this->context . '.limitstart', 'start', 0);
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
        $this->setState('list.start', $limitstart);
		
		// Filters
		foreach ($this->filter_fields as $filterName) {
			$tempState = $app->getUserStateFromRequest($this->context.'.filter.'.$filterName, $filterName);
			$this->setState('filter.'.$filterName, preg_replace('/\s+/',' ', $tempState));
		}
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    protected function getListQuery() {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        //$query->select($this->getState('list.select', 'DISTINCT a.*'));
		$query->select('DISTINCT a.name as label, a.id as value');
        $query->from('`#__pedigree_dogs` AS a');
		
		$orderCol = $this->state->get('list.ordering');
		$orderDirn = $this->state->get('list.direction');
		
		$activeFilters = $this->getActiveFilters();
        
		// Join over the users for the checked out user.

        
        // Filters
		foreach ($activeFilters as $name => $value) {
			if (!empty($value)) {
				switch ($name) {
					case 'id' : 
						$query->where("a.id != ".$db->Quote($db->escape($value, true)));
						break;
					case 'name' :
						if (stripos($activeFilters['name'], 'id:') === 0) {
							$query->where('a.id = ' . (int) substr($value, 3));
						} else {
							$query->where('( a.name LIKE '.$db->Quote('%' . $db->escape($value, true) . '%').' )');
						}
						break;
					case 'sire' :
					case 'dam' :
						$query->join("LEFT", "#__pedigree_dogs AS #__pedigree_dogs_".$name." ON #__pedigree_dogs_".$name.".id = a.id_".$name);
						$query->where("( #__pedigree_dogs_".$name.".name LIKE ".$db->Quote("%" . $db->escape($value, true) . "%")." )");
						break;
					// Typical =
					case 'sex' :
						$query->where($name." = ".$db->Quote($db->escape($value, true)));
						break;
					default :
						break;				
				}
			}
		}
		
        // Add the list ordering clause.
		if ($activeFilters) {
			if ($orderCol && $orderDirn) {
				$query->order($db->escape($orderCol . ' ' . $orderDirn));
			}
		}

        return $query;
    }

    public function getItems() {		
        $items = parent::getItems();
		
        /*foreach($items as $item){
			if (isset($item->id_sire) && $item->id_sire != 0) {
				if(is_object($item->id_sire)){
					$item->id_sire = JArrayHelper::fromObject($item->id_sire);
				}
				$values = (is_array($item->id_sire)) ? $item->id_sire : explode(',',$item->id_sire);

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

				$item->sire_name = !empty($textValue) ? implode(', ', $textValue) : ''; //$item->id_sire;
			} else {
				$item->sire_name = JText::_('COM_PEDIGREE_DOG_UNKNOWN');
			}

			if (isset($item->id_dam) && $item->id_dam != 0) {
				if(is_object($item->id_dam)){
					$item->id_dam = JArrayHelper::fromObject($item->id_dam);
				}
				$values = (is_array($item->id_dam)) ? $item->id_dam : explode(',',$item->id_dam);

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

				$item->dam_name = !empty($textValue) ? implode(', ', $textValue) : ''; //$item->id_dam;
			} else {
				$item->dam_name = JText::_('COM_PEDIGREE_DOG_UNKNOWN');
			}
			
			$item->sex_name = JText::_('COM_PEDIGREE_DOGS_SEX_OPTION_' . strtoupper($item->sex));
			
			
			/**
				Registrations
			**/
			/*$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query
					->select('a.`registration_number`, b.`iso3`')
					->from('#__pedigree_registrations a')
					->innerJoin('#__pedigree_countries b ON a.`id_country` = b.`id`')
					->where('a.`id_dog` = ' . $db->quote($db->escape($item->id)))
					->order('a.`is_primary` DESC');
			$db->setQuery($query);
			$results = $db->loadObjectList();
			if ($results) {				
				foreach ($results as $row){
					$item->registrations[] = $row;
				}				
			}
		}*/
        return $items;
    }
	
	/**
	 * Method to get the starting number of items for the data set.
	 *
	 * @return  integer  The starting number of items available in the data set.
	 *
	 * @since   12.2
	 */
	public function getStart()
	{
		return $this->getState('list.start');
	}
}
