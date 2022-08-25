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
	}

	public function product($shop_id, $item_id)
	{
		$data['title'] = 'Product Sentiment';
		$data['product'] = $this->product->get_where(array('shop_id' => $shop_id, 'item_id' => $item_id));
		$data['comment'] = $this->comment->get_where(array('shop_id' => $shop_id, 'item_id' => $item_id));
		$this->template->load('sentiment/product', $data);
	}

	private function pre_process($str){
		$stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
		$stemmer = $stemmerFactory->createStemmer();

		$stopWordRemoverFactory = new \Sastrawi\StopWordRemover\StopWordRemoverFactory();
		$stopword = $stopWordRemoverFactory->createStopWordRemover();

		$str = strtolower($str);
		$str = $stemmer->stem($str);
		$str = $stopword->remove($str);

		return $str;
	}

	public function analysis($shop_id = NULL, $item_id = NULL)
	{
		$data_training = $this->data_training->get('data-training');
		$data_training = $data_training->result_array();

		$class_count = array('NETRAL' => 0);
		$naive_bayes = naive_bayes();

		$data_training_count = array();

		foreach ($data_training as $train)
		{
			$class_count[strtoupper($train['classification'])] = 0;

			if (!array_key_exists(strtoupper($train['classification']), $data_training_count))
			{
				$data_training_count[strtoupper($train['classification'])] = 0;
			}

			$data_training_count[strtoupper($train['classification'])] = ($data_training_count[strtoupper($train['classification'])]+1);
			$naive_bayes->train($train['classification'], array_unique(tokenize($train['text'])));
		}

		$product_comments = $this->comment->get_where(array('shop_id' => $shop_id, 'item_id' => $item_id));

		$sentiments = array();

		foreach ($product_comments->result_array() as $key => $product_comment)
		{
			$pre_processing = $this->pre_process($product_comment['comment']);
			$sentiment = $naive_bayes->predict(array_unique(tokenize($pre_processing)));
			$sentiments[$key] = array(
				'comment' => array(
					'real' => $product_comment['comment'],
					'prep' => $pre_processing
				),
				'sentiment' => $sentiment
			);

			if (count(array_unique($sentiment)) == 1)
			{
				$class_count['NETRAL'] = ($class_count['NETRAL']+1);
				$this->comment->update(array('classification' => strtoupper('netral')), array('id' => $product_comment['id']));
			}
			else
			{
				$class = strtoupper(array_search(max($sentiment), $sentiment));
				$class_count[$class] = ($class_count[$class]+1);
				$this->comment->update(array('classification' => $class), array('id' => $product_comment['id']));
			}

			$this->comment->reset_query();
		}

		$data['title'] = 'Sentiment Analysis';
		$data['sentiments'] = $sentiments;
		$data['class_count'] = $class_count;
		$data['data_training_count'] = $data_training_count;
		$data['product'] = $this->product->get_where(array('shop_id' => $shop_id, 'item_id' => $item_id));
		$this->template->load('sentiment/analysis', $data);
	}
}

/* End of file Sentiment.php */
/* Location : ./site/controllers/Sentiment.php */
