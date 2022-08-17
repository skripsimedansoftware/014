<?php
/**
 * @package    Angeli\Verification_code
 * @subpackage Verification_code
 * @category   Model
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

namespace Angeli;

class Verification_code extends MY_Model
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->set_table('verification-code');
	}
}

/* End of file Verification_code.php */
/* Location : ./application/models/Verification_code.php */
