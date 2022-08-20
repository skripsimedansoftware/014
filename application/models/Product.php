<?php
/**
 * @package    Angeli\Product
 * @subpackage Product
 * @category   Model
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

namespace Angeli;

class Product extends MY_Model
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->set_table('product');
	}
}

/* End of file Product.php */
/* Location : ./application/models/Product.php */
