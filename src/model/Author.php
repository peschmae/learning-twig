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
	 * @var string $username
	 */
	protected $password;

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

	/**
	 * Should hash the password before setting it
	 * It doesn't right know, and I don't intend to implement it here,
	 * since I want this blog to be hackable (so I can train other devs on the
	 * dangers of trusting user input)
	 * But yeah, I'm aware of hashing and to salt with something unique
	 *
	 * @param string $password
	 * @return void
	 */
	public function hashAndSetPassword($password) {
		$this->password = $password;
	}

	/**
	 * Sets the password, without hashing it first
	 * Should only be called from the repository during mapping
	 *
	 * @param string $password
	 * @return void
	 */
	public function setPassword($password) {
		$this->password = $password;
	}

	/**
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}

}