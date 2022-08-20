<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package    Codeigniter
 * @subpackage Sentiment
 * @category   HMVC Controller
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

class Sentiment extends HMVC_Controller
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->authenticated_module(NULL, function() {
			redirect(module_link('sign-in'), 'refresh');
		});
	}

	public function index()
	{
		$data['title'] = 'Sentiment';
		$this->template->load('sentiment/index', $data);
	}

	public function product($shop_id, $item_id)
	{
		$data['title'] = 'Product Sentiment';
		$data['product'] = $this->product->get_where(array('shop_id' => $shop_id, 'item_id' => $item_id));
		$data['comment'] = $this->comment->get_where(array('shop_id' => $shop_id, 'item_id' => $item_id));
		$this->template->load('sentiment/product', $data);
	}

	public function analysis($shop_id = NULL, $item_id = NULL)
	{
		$data_training = $this->data_training->get('data-training');
		$data_training = $data_training->result_array();

		$naive_bayes = naive_bayes();

		foreach ($data_training as $train)
		{
			$naive_bayes->train($train['classification'], tokenize($train['text']));
		}

		$product_comments = $this->comment->get_where(array('shop_id' => $shop_id, 'item_id' => $item_id));

		$sentiment = array();

		foreach ($product_comments->result_array() as $key => $product_comment)
		{
			$sentiment[$key] = array(
				'comment' => $product_comment['comment'],
				'sentiment' => $naive_bayes->predict(tokenize($product_comment['comment']))
			);
		}

		$data['title'] = 'Sentiment Analysis';
		$data['sentiment'] = $sentiment;
		$this->template->load('sentiment/analysis', $data);
	}
}

/* End of file Sentiment.php */
/* Location : ./user/controllers/Sentiment.php */
