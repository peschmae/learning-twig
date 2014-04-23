<?php
/**
 * Created by PhpStorm.
 * User: peschmae
 * Date: 4/11/14
 * Time: 2:33 AM
 */

namespace mpetermann\blog\model;

/**
 * Class Author
 * @package mpetermann\blog\model
 */
class Author {
	/**
	 * @var string $id
	 */
	public $id;

	/**
	 * @var string $username
	 */
	public $username;

	/**
	 * @var string $email
	 */
	public $email;

	/**
	 * @var bool $author
	 */
	public $author;

	/**
	 * @var bool $admin
	 */
	public $admin;

	public function isAuthor() {
		return $this->author;
	}

	/**
	 * @return bool
	 */
	public function isAdmin() {
		return $this->admin;
	}
}