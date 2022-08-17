<?php
/**
 * @package    Codeigniter
 * @subpackage MY_Model
 * @category   Libraries
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

namespace Angeli;

class MY_Model extends \CI_Model
{
	private $table;

	/**
	 * Set table name
	 *
	 * @param      string  $table  Table name
	 *
	 * @return     self
	 */
	public function set_table($table)
	{
		$this->table = $table;
		return $this;
	}

	/**
	 * Get table name
	 *
	 * @return     string  Table name
	 */
	public function get_table()
	{
		return $this->table;
	}

	/**
	 * Set model database connection
	 *
	 * @param      string  $connection  Database group name
	 *
	 * @return     self
	 */
	public function set_connection($connection)
	{
		$this->db = $this->load->database($connection, TRUE);
		return $this;
	}

	/**
	 * Get model database connection
	 *
	 * @return     object  DB Driver class
	 */
	public function get_connection()
	{
		return $this->db;
	}

	/**
	 * Call method
	 *
	 * @link       https://www.codeigniter.com/userguide3/database/query_builder.html Query builder guide
	 *
	 * @param      string  $method     Method name
	 * @param      array   $arguments  Method arguments
	 *
	 * @return     mixed
	 */
	public function __call($method, $arguments = array())
	{
		if (method_exists($this->db, $method))
		{
			$has_response = array('set_dbprefix', 'dbprefix', 'count_all_results', 'get', 'get_where', 'insert', 'insert_batch', 'update', 'update_batch', 'replace', 'delete', 'truncate', 'empty_table', 'get_compiled_select', 'get_compiled_insert', 'get_compiled_update', 'get_compiled_delete');

			if (in_array($method, $has_response))
			{
				// Blacklist method not required table name in first argument
				if (!in_array($method, ['set_dbprefix']))
				{
					$args = array_values($arguments);

					// First argument is table name & check table exists or set table name if table doesn't exists
					if (!$this->db->table_exists(array_shift($args)))
					{
						$arguments = array_merge(array($this->get_table()), $arguments);
					}
				}

				return call_user_func_array(array($this->db, $method), $arguments);
			}
			else
			{
				call_user_func_array(array($this->db, $method), $arguments);
			}
		}

		return $this;
	}
}

/* End of file MY_Model.php */
/* Location : ./application/core/MY_Model.php */
