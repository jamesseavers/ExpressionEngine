<?php
/**
 * ExpressionEngine (https://expressionengine.com)
 *
 * @link      https://expressionengine.com/
 * @copyright Copyright (c) 2003-2018, EllisLab, Inc. (https://ellislab.com)
 * @license   https://expressionengine.com/license
 */

namespace EllisLab\ExpressionEngine\Model\Message;

use EllisLab\ExpressionEngine\Service\Model\Model;

/**
 * Listed member
 *
 * Represents a member's place on another member's list, be it a buddy list or
 * block list
 */
class ListedMember extends Model {

	protected static $_primary_key = 'listed_id';
	protected static $_table_name = 'message_listed';

	protected static $_relationships = [
		'ListedByMember' => [
			'type' => 'belongsTo',
			'model' => 'Member'
		],
		'Member' => [
			'type' => 'belongsTo',
			'from_key' => 'listed_member'
		]
	];

	protected $listed_id;
	protected $member_id;
	protected $listed_member;
	protected $listed_description;
	protected $listed_type;
}
// END CLASS

// EOF
