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
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                                'id', 'a.id',
                'name', 'a.name',
                'id_sire', 'a.id_sire',
                'id_dam', 'a.id_dam',
                'sex', 'a.sex',
                'birth_date', 'a.birth_date',
                'call_name', 'a.call_name',
                'id_gallery_image', 'a.id_gallery_image',
                'id_gallery_category', 'a.id_gallery_category',
                'coi', 'a.coi',
                'stud_number', 'a.stud_number',
                'brs_number', 'a.brs_number',
                'atc_number', 'a.atc_number',
                'id_color', 'a.id_color',
                'color_variations', 'a.color_variations',
                'id_pattern', 'a.id_pattern',
                'is_scented', 'a.is_scented',
                'is_smooth', 'a.is_smooth',
                'is_bearded', 'a.is_bearded',
                'titles_prefix', 'a.titles_prefix',
                'titles_suffix', 'a.titles_suffix',
                'awards', 'a.awards',
                'microchip', 'a.microchip',
                'dna_profile', 'a.dna_profile',
                'chic_number', 'a.chic_number',
                'health_test_thyroid', 'a.health_test_thyroid',
                'health_test_elbow', 'a.health_test_elbow',
                'health_test_hips', 'a.health_test_hips',
                'health_test_eyes', 'a.health_test_eyes',
                'health_test_heart', 'a.health_test_heart',
                'health_notes', 'a.health_notes',
                'death_date', 'a.death_date',
                'death_cause', 'a.death_cause',
                'is_stud', 'a.is_stud',
                'stud_details', 'a.stud_details',
                'is_semen', 'a.is_semen',
                'videos', 'a.videos',
                'articles', 'a.articles',
                'notes', 'a.notes',
                'source', 'a.source',
                'ordering', 'a.ordering',
                'state', 'a.state',
                'created_by', 'a.created_by',

            );
        }

        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     */
    protected function populateState($ordering = null, $direction = null) {
        // Initialise variables.
        $app = JFactory::getApplication('administrator');

        // Load the filter state.
        $search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        $published = $app->getUserStateFromRequest($this->context . '.filter.state', 'filter_published', '', 'string');
        $this->setState('filter.state', $published);

        
		//Filtering sex
		$this->setState('filter.sex', $app->getUserStateFromRequest($this->context.'.filter.sex', 'filter_sex', '', 'string'));

		//Filtering id_color
		$this->setState('filter.id_color', $app->getUserStateFromRequest($this->context.'.filter.id_color', 'filter_id_color', '', 'string'));

		//Filtering id_pattern
		$this->setState('filter.id_pattern', $app->getUserStateFromRequest($this->context.'.filter.id_pattern', 'filter_id_pattern', '', 'string'));


        // Load the parameters.
        $params = JComponentHelper::getParams('com_pedigree');
        $this->setState('params', $params);

        // List state information.
        parent::populateState('a.name', 'asc');
    }

    /**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param	string		$id	A prefix for the store id.
     * @return	string		A store id.
     * @since	1.6
     */
    protected function getStoreId($id = '') {
        // Compile the store id.
        $id.= ':' . $this->getState('filter.search');
        $id.= ':' . $this->getState('filter.state');

        return parent::getStoreId($id);
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
		// Join over the user field 'created_by'
		$query->select('created_by.name AS created_by');
		$query->join('LEFT', '#__users AS created_by ON created_by.id = a.created_by');

        
    // Filter by published state
    $published = $this->getState('filter.state');
    if (is_numeric($published)) {
        $query->where('a.state = '.(int) $published);
    } else if ($published === '') {
        $query->where('(a.state IN (0, 1))');
    }
    

        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int) substr($search, 3));
            } else {
                $search = $db->Quote('%' . $db->escape($search, true) . '%');
                $query->where('( a.name LIKE '.$search.'  OR  a.id_sire LIKE '.$search.'  OR  a.id_dam LIKE '.$search.'  OR  a.birth_date LIKE '.$search.'  OR  a.titles_prefix LIKE '.$search.'  OR  a.titles_suffix LIKE '.$search.' )');
            }
        }

        

		//Filtering sex
		$filter_sex = $this->state->get("filter.sex");
		if ($filter_sex) {
			$query->where("a.sex = '".$db->escape($filter_sex)."'");
		}

		//Filtering id_color
		$filter_id_color = $this->state->get("filter.id_color");
		if ($filter_id_color) {
			$query->where("a.id_color = '".$db->escape($filter_id_color)."'");
		}

		//Filtering id_pattern
		$filter_id_pattern = $this->state->get("filter.id_pattern");
		if ($filter_id_pattern) {
			$query->where("a.id_pattern = '".$db->escape($filter_id_pattern)."'");
		}


        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        if ($orderCol && $orderDirn) {
            $query->order($db->escape($orderCol . ' ' . $orderDirn));
        }

        return $query;
    }

    public function getItems() {
        $items = parent::getItems();
        
		foreach ($items as $oneItem) {

			if (isset($oneItem->id_sire)) {
				$values = explode(',', $oneItem->id_sire);

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

			$oneItem->id_sire = !empty($textValue) ? implode(', ', $textValue) : $oneItem->id_sire;

			}

			if (isset($oneItem->id_dam)) {
				$values = explode(',', $oneItem->id_dam);

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

			$oneItem->id_dam = !empty($textValue) ? implode(', ', $textValue) : $oneItem->id_dam;

			}

			if (isset($oneItem->id_color)) {
				$values = explode(',', $oneItem->id_color);

				$textValue = array();
				foreach ($values as $value){
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
							->select('color')
							->from('`#__pedigree_colors`')
							->where('id = ' . $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->color;
					}
				}

			$oneItem->id_color = !empty($textValue) ? implode(', ', $textValue) : $oneItem->id_color;

			}

			if (isset($oneItem->id_pattern)) {
				$values = explode(',', $oneItem->id_pattern);

				$textValue = array();
				foreach ($values as $value){
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
							->select('pattern')
							->from('`#__pedigree_patterns`')
							->where('id = ' . $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->pattern;
					}
				}

			$oneItem->id_pattern = !empty($textValue) ? implode(', ', $textValue) : $oneItem->id_pattern;

			}
		}
        return $items;
    }

}
