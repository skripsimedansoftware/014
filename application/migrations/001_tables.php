<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Tables extends CI_Migration
{
	public function __construct()
	{
		$this->load->dbforge();
		$this->load->database();
	}

	/**
	 * Up
	 */
	public function up()
	{
		$this->user();
		$this->verification_code();
		$this->data_training();
		$this->product();
		$this->comment();
		$this->seeder();
	}

	/**
	 * Down
	 */
	public function down()
	{
		$this->dbforge->drop_table('user');
	}

	/**
	 * User table
	 */
	private function user()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'BIGINT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'email' => array(
				'type' => 'VARCHAR',
				'null' => TRUE,
				'unique' => TRUE,
				'constraint' => 40
			),
			'username' => array(
				'type' => 'VARCHAR',
				'null' => TRUE,
				'unique' => TRUE,
				'constraint' => 24
			),
			'password' => array(
				'type' => 'VARCHAR',
				'null' => TRUE,
				'constraint' => 255
			),
			'gender' => array(
				'type' => 'ENUM',
				'null' => TRUE,
				'constraint' => array('male', 'female')
			),
			'full-name' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'photo' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'created_at' => array(
				'type' => 'DATETIME'
			),
			'updated_at' => array(
				'type' => 'DATETIME'
			),
			'deleted_at' => array(
				'type' => 'DATETIME',
				'null' => TRUE
			)
		));

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('user');
	}

	/**
	 * Product
	 */
	private function product()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'BIGINT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'shop_id' => array(
				'type' => 'BIGINT',
				'unsigned' => TRUE
			),
			'item_id' => array(
				'type' => 'BIGINT',
				'unsigned' => TRUE
			),
			'data' => array(
				'type' => 'TEXT'
			),
			'created_at' => array(
				'type' => 'DATETIME'
			)
		));

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('product');
	}

	/**
	 * Comment
	 */
	private function comment()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'BIGINT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'order_id' => array(
				'type' => 'BIGINT',
				'unsigned' => TRUE
			),
			'shop_id' => array(
				'type' => 'BIGINT',
				'unsigned' => TRUE
			),
			'item_id' => array(
				'type' => 'BIGINT',
				'unsigned' => TRUE
			),
			'classification' => array(
				'type' => 'VARCHAR',
				'null' => TRUE,
				'constraint' => 255
			),
			'comment' => array(
				'type' => 'TEXT'
			)
		));

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('comment');
	}

	/**
	 * Data training
	 */
	private function data_training()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'BIGINT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'classification' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'text' => array(
				'type' => 'TEXT'
			),
			'created_at' => array(
				'type' => 'DATETIME'
			)
		));

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('data-training');
	}

	/**
	 * Verification code
	 */
	private function verification_code()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'BIGINT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'type' => array(
				'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 40
			),
			'code' => array(
				'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 40
			),
			'user-id' => array(
				'type' => 'BIGINT',
				'unsigned' => TRUE
			),
			'expired' => array(
				'type' => 'DATETIME'
			),
			'status' => array(
				'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 20
			),
			'created_at' => array(
				'type' => 'DATETIME'
			),
			'updated_at' => array(
				'type' => 'DATETIME'
			)
		));

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('verification-code');
	}

	/**
	 * Seeder
	 */
	private function seeder()
	{
		$this->db->insert('user', array(
			'email' => 'admin@angeli.id',
			'username' => 'admin',
			'password' =>  $this->security->user_password('admin'),
			'full-name' => 'Administrator',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));
	}
}

/* End of file 001_tables.php */
/* Location: ./application/migrations/001_tables.php */
