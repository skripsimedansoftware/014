<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package    Codeigniter
 * @subpackage Shopee
 * @category   HMVC Controller
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

class Shopee extends HMVC_Controller
{
	private $url;

	private $curl;

	private $user_image_url;

	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->url = 'https://shopee.co.id';
		$this->curl = new Curl\Curl;
		$this->user_image_url = 'https://cf.shopee.co.id';
	}

	public function search_hint($search_type = 0, $version = 1)
	{
		$request = $this->curl->get($this->url.'/api/v4/search/search_hint', array(
			'keyword' => $this->input->get('keyword'),
			'search_type' => $search_type,
			'version' => $version
		));

		$this->output->set_content_type('application/json')->set_output($request->response);
	}

	public function search_user($limit = 6, $offset = 0, $page = 'search_user', $with_search_cover = TRUE)
	{
		$request = $this->curl->get($this->url.'/api/v4/search/search_user', array(
			'keyword' => $this->input->get('keyword'),
			'page' => $page,
			'limit' => $limit,
			'offset' => $offset,
			'with_search_cover' => filter_var($with_search_cover, FILTER_VALIDATE_BOOLEAN)
		));

		$this->output->set_content_type('application/json')->set_output($request->response);
	}

	public function get_shop_detail($username = NULL, $sort_sold_out = 0)
	{
		$request = $this->curl->get($this->url.'/api/v4/shop/get_shop_detail', array(
			'username' => $username,
			'sort_sold_out' => $sort_sold_out
		));

		$this->output->set_content_type('application/json')->set_output($request->response);
	}

	public function get_shop_categories($shopid = NULL, $limit = 20, $offset = 0)
	{
		$request = $this->curl->get($this->url.'/api/v4/shop/get_categories', array(
			'shopid' => $shopid,
			'limit' => $limit,
			'offset' => $offset
		));

		$this->output->set_content_type('application/json')->set_output($request->response);
	}

	public function user_image($uid)
	{
		$request = $this->curl->get($this->user_image_url.'/file/'.$uid.'_tn');
		$this->output->set_content_type($request->response_headers[2])->set_output($request->response);
	}

	public function get_item($item_id = NULL, $shopid = NULL)
	{
		$request = $this->curl->get($this->url.'/api/v4/item/get', array(
			'shopid' => $shopid,
			'item_id' => $item_id
		));

		$this->output->set_content_type('application/json')->set_output($request->response);
	}

	public function get_item_ratings($shopid = NULL, $item_id = 20, $type = 0, $filter = 0, $flag = 1, $limit = 10, $offset = 0)
	{
		$request = $this->curl->get($this->url.'/api/v2/item/get_ratings', array(
			'shopid' => $shopid,
			'item_id' => $item_id,
			'type' => $type,
			'filter' => $filter,
			'flag' => $flag,
			'limit' => $limit,
			'offset' => $offset
		));

		$this->output->set_content_type('application/json')->set_output($request->response);
	}
}

/* End of file Shopee.php */
/* Location : ./api/controllers/Shopee.php */
