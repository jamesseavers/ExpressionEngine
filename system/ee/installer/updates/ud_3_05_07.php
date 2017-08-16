<?php
/**
 * ExpressionEngine (https://expressionengine.com)
 *
 * @link      https://expressionengine.com/
 * @copyright Copyright (c) 2003-2017, EllisLab, Inc. (https://ellislab.com)
 * @license   https://expressionengine.com/license
 */

/**
 * Update
 */
class Updater {

	var $version_suffix = '';

	/**
	 * Do Update
	 *
	 * @return TRUE
	 */
	public function do_update()
	{
		$steps = new \ProgressIterator(
			array(
				'modifyChannelDataRelationshipFields',
			)
		);

		foreach ($steps as $k => $v)
		{
			$this->$v();
		}

		return TRUE;
	}

	/**
	 * Make sure all relationship fields are of type VARCHAR, older fields may
	 * be of type INT and may complain when entries are added with no value
	 * specified
	 */
	protected function modifyChannelDataRelationshipFields()
	{
		// Get all relationship fields
		$channel_fields = ee()->db->where('field_type', 'relationship')
			->get('channel_fields');

		foreach ($channel_fields->result_array() as $field)
		{
			$field_name = 'field_id_'.$field['field_id'];

			ee()->smartforge->modify_column(
				'channel_data',
				array(
					$field_name => array(
						'name'       => $field_name,
						'type'       => 'VARCHAR',
						'constraint' => 8,
						'null'       => TRUE
					)
				)
			);
		}
	}
}

// EOF
