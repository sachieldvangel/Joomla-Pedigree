<?php

/**
 * @version     1.0.2
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
class PedigreeModelDogs extends JModelList {

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array()) {
        parent::__construct($config);
    }

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

        // List state information
        $limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
        $this->setState('list.limit', $limit);

        $limitstart = JFactory::getApplication()->input->getInt('limitstart', 0);
        $this->setState('list.start', $limitstart);

        
		if(empty($ordering)) {
			$ordering = 'a.ordering';
		}

        // List state information.
        parent::populateState($ordering, $direction);
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
        $query->select(
                $this->getState(
                        'list.select', 'a.*'
                )
        );

        $query->from('`#__pedigree_dogs` AS a');

        
    // Join over the users for the checked out user.
    $query->select('uc.name AS editor');
    $query->join('LEFT', '#__users AS uc ON uc.id=a.checked_out');
    
		// Join over the foreign key 'id_sire'
		$query->select('#__pedigree_dogs_1067710.name AS dogs_name_1067710');
		$query->join('LEFT', '#__pedigree_dogs AS #__pedigree_dogs_1067710 ON #__pedigree_dogs_1067710.id = a.id_sire');
		// Join over the foreign key 'id_dam'
		$query->select('#__pedigree_dogs_1067711.name AS dogs_name_1067711');
		$query->join('LEFT', '#__pedigree_dogs AS #__pedigree_dogs_1067711 ON #__pedigree_dogs_1067711.id = a.id_dam');
		// Join over the foreign key 'id_color'
		$query->select('#__pedigree_colors_1067722.color AS colors_color_1067722');
		$query->join('LEFT', '#__pedigree_colors AS #__pedigree_colors_1067722 ON #__pedigree_colors_1067722.id = a.id_color');
		// Join over the foreign key 'id_pattern'
		$query->select('#__pedigree_patterns_1067724.pattern AS patterns_pattern_1067724');
		$query->join('LEFT', '#__pedigree_patterns AS #__pedigree_patterns_1067724 ON #__pedigree_patterns_1067724.id = a.id_pattern');
		// Join over the created by field 'created_by'
		$query->select('created_by.name AS created_by');
		$query->join('LEFT', '#__users AS created_by ON created_by.id = a.created_by');
        

        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int) substr($search, 3));
            } else {
                $search = $db->Quote('%' . $db->escape($search, true) . '%');
                $query->where('( a.name LIKE '.$search.'  OR  a.birth_date LIKE '.$search.'  OR  a.titles_prefix LIKE '.$search.'  OR  a.titles_suffix LIKE '.$search.' )');
            }
        }

        

		//Filtering sex
		$filter_sex = $this->state->get("filter.sex");
		if ($filter_sex) {
			$query->where("a.sex = '".$filter_sex."'");
		}

		//Filtering id_color
		$filter_id_color = $this->state->get("filter.id_color");
		if ($filter_id_color) {
			$query->where("a.id_color = '".$filter_id_color."'");
		}

		//Filtering id_pattern
		$filter_id_pattern = $this->state->get("filter.id_pattern");
		if ($filter_id_pattern) {
			$query->where("a.id_pattern = '".$filter_id_pattern."'");
		}

        return $query;
    }

    public function getItems() {
        return parent::getItems();
    }

}
