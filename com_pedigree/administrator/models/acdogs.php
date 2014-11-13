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
class PedigreeModelAcdogs extends JModelList {


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
				'q', 
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
			$ordering = 'a.name';
		}

        // List state information.
        parent::populateState($ordering, $direction);
		
        // List state information
        $limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
        $this->setState('list.limit', $limit);

        //$limitstart = $app->input->getInt('start', 0);
		//$limitstart = $app->getUserStateFromRequest($this->context . '.limitstart', 'start', 0);
		//$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
        $this->setState('list.start', 0);
		
		// Filters
		foreach ($this->filter_fields as $filterName) {
			$tempState = $app->getUserStateFromRequest($this->context.'.filter.'.$filterName, $filterName);
			$this->setState('filter.'.$filterName, preg_replace('/\s+/',' ', $tempState));
		}
		/*$tempState = $app->getUserStateFromRequest($this->context.'.filter.name', 'term', '');
		$this->setState('filter.name', preg_replace('/\s+/',' ', $tempState));*/
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
					case 'q' :
					case 'name' :
						$query->where('( a.name LIKE '.$db->Quote('%' . $db->escape($value, true) . '%').' )');
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

    /*public function getItems() {		
        $items = parent::getItems();

        return $items;
    }*/
	
	/**
	 * Method to get the starting number of items for the data set.
	 *
	 * @return  integer  The starting number of items available in the data set.
	 *
	 * @since   12.2
	 */
	/*public function getStart()
	{
		return $this->getState('list.start');
	}*/
}
