<?php
/**
 * @package    Angeli\Data_Training
 * @subpackage Data_Training
 * @category   Model
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

namespace Angeli;

class Data_Training extends MY_Model
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->set_table('data-training');
	}
}

/* End of file Data_Training.php */
/* Location : ./application/models/Data_Training.php */
