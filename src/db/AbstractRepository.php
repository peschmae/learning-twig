<?php
/**
 * Created by PhpStorm.
 * User: peschmae
 * Date: 4/10/14
 * Time: 12:10 AM
 */

namespace mpetermann\blog\db;

/**
 * Class AbstractRepository
 * @package mpetermann\blog\db
 */
abstract class AbstractRepository {

	/**
	 * @var Object $sqlConnection
	 */
	protected $sqlConnection;

	/**
	 * @param Object $sqlConnection
	 * @throws \Exception
	 */
	public function __construct($sqlConnection) {
		if (!is_object($sqlConnection)) {
			throw new \Exception('Constructor called without a valid sql connection');
		}

		$this->sqlConnection = $sqlConnection;
	}

	/**
	 * @param $object
	 *
	 * @return mixed
	 */
	public abstract function add($object);

	/**
	 * @param $object
	 *
	 * @return mixed
	 */
	public abstract function update($object);

	/**
	 * @param $object
	 *
	 * @return mixed
	 */
	public abstract function remove($object);

}