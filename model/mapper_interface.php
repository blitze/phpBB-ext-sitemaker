<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model;

interface mapper_interface
{
	/**
	 * Load a single item
	 *
	 * @param array $condition		e.g array('field', '>', 'value') 0R
	 *                                  array(
	 * 										array('field1', '=', 'value1'),
	 * 										array('field2', '<>', 'value2'),
	 * 									)
	 * @return \blitze\sitemaker\model\entity_interface
	 */
	public function load(array $condition = array());

	/**
	 * Find all items
	 *
	 * @param array $condition		e.g array('field', '>', 'value') 0R
	 *                                  array(
	 * 										array('field1', '=', 'value1'),
	 * 										array('field2', '<>', 'value2'),
	 * 									)
	 * @return \blitze\sitemaker\model\base_collection
	 */
	public function find(array $condition = array());

	/**
	 * Save entity
	 *
	 * @param \blitze\sitemaker\model\entity_interface $entity
	 * @return \blitze\sitemaker\model\entity_interface
	 */
	public function save(\blitze\sitemaker\model\entity_interface $entity);

	/**
	 * Delete by condition
	 *
	 * @param array|\blitze\sitemaker\model\entity_interface $condition  entity object or array
	 * 								e.g array('field', '>', 'value') 0R
	 *                                  array(
	 * 										array('field1', '=', 'value1'),
	 * 										array('field2', '<>', 'value2'),
	 * 									)
	 *                                  OR an entity of type \blitze\sitemaker\model\entity_interface
	 * @return void
	 * @throws \blitze\sitemaker\exception\invalid_argument
	 */
	public function delete($condition);

	/**
	 * Create the entity
	 * @param array $row
	 * @return \blitze\sitemaker\model\entity_interface
	 */
	public function create_entity(array $row);
}
