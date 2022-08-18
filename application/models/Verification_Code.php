<?php
/**
 * @package    Angeli\Verification_Code
 * @subpackage Verification_Code
 * @category   Model
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

namespace Angeli;

class Verification_Code extends MY_Model
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

/* End of file Verification_Code.php */
/* Location : ./application/models/Verification_Code.php */
