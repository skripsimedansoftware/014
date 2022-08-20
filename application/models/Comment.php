<?php
/**
 * @package    Angeli\Comment
 * @subpackage Comment
 * @category   Model
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

namespace Angeli;

class Comment extends MY_Model
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->set_table('comment');
	}
}

/* End of file Comment.php */
/* Location : ./application/models/Comment.php */
