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

		// $class_count = array('UNKNOWN' => 0);
		$class_count = array();
		$naive_bayes = naive_bayes();

		$data_training_count = array();
		$confussion_matrix = array();
		$confussion_matrix_class = array();

		foreach ($data_training as $key => $train)
		{
			$class_count[strtoupper($train['classification'])] = 0;

			if (!array_key_exists(strtoupper($train['classification']), $data_training_count))
			{
				$data_training_count[strtoupper($train['classification'])] = 0;
			}

			$data_training_count[strtoupper($train['classification'])] = ($data_training_count[strtoupper($train['classification'])]+1);
			$naive_bayes->train($train['classification'], array_unique(tokenize($train['text'])));
		}

		$product_comments = $this->comment->limit(200)->get_where(array('shop_id' => $shop_id, 'item_id' => $item_id));
		$sentiments = array();

		foreach ($product_comments->result_array() as $key => $product_comment)
		{
			$find = array_search($product_comment['id'], array_column($data_training, 'comment_id'));
			$confussion_matrix[$key] = array();

			if ($find !== FALSE)
			{
				$confussion_matrix[$key] = array('actual' => strtoupper($data_training[$find]['classification']));
			}

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
				// $class_count['UNKNOWN'] = ($class_count['UNKNOWN']+1);
				// $this->comment->update(array('classification' => strtoupper('UNKNOWN')), array('id' => $product_comment['id']));
				$class = strtoupper(array_keys(array_unique($sentiment))[0]);
				$class_count[$class] = ($class_count[$class]+1);
				$this->comment->update(array('classification' => strtoupper($class)), array('id' => $product_comment['id']));
				$confussion_matrix[$key] = array_merge($confussion_matrix[$key], array('predict' => $class));
			}
			else
			{
				$class = strtoupper(array_search(max($sentiment), $sentiment));
				$class_count[$class] = ($class_count[$class]+1);
				$confussion_matrix[$key] = array_merge($confussion_matrix[$key], array('predict' => $class));
				$this->comment->update(array('classification' => $class), array('id' => $product_comment['id']));
			}

			$this->comment->reset_query();
		}

		$confussion_matrix_actual = array_map(function($data){
			return $data['actual'];
		}, $confussion_matrix);

		$confussion_matrix_predict = array_map(function($data){
			return $data['predict'];
		}, $confussion_matrix);

		$confussion_matrix_count = array_map(function($class) use ($confussion_matrix_actual, $confussion_matrix_predict) {
			return array(
				'class' => $class,
				'actual' => array_sum(array_map(function($item) use ($class) {
					return $item === $class;
				}, $confussion_matrix_actual)),
				'predict' => array_sum(array_map(function($item) use ($class) {
					return $item === $class;
				}, $confussion_matrix_predict))
			);
		}, array_keys($class_count));

		$actual = array_sum(array_column($confussion_matrix_count, 'actual'));
		$predict = array_sum(array_column($confussion_matrix_count, 'predict'));

		$data['title'] = 'Sentiment Analysis';
		$data['sentiments'] = $sentiments;
		$data['class_count'] = $class_count;
		$data['data_training_count'] = $data_training_count;
		$data['confussion_matrix'] = ($actual/($predict+$actual)*100);
		$data['product'] = $this->product->get_where(array('shop_id' => $shop_id, 'item_id' => $item_id));
		$this->template->load('sentiment/analysis', $data);
	}
}

/* End of file Sentiment.php */
/* Location : ./user/controllers/Sentiment.php */
