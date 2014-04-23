<?php
/**
 * Created by PhpStorm.
 * User: peschmae
 * Date: 4/10/14
 * Time: 12:16 AM
 */

namespace mpetermann\blog\model;

/**
 * Class Article
 * @package mpetermann\blog\model
 */
class Article {

	/**
	 * @var string $id
	 */
	public $id;

	/**
	 * @var string $title
	 */
	public $title;

	/**
	 * @var string $lead
	 */
	public $lead;

	/**
	 * @var string $body
	 */
	public $body;

	/**
	 * @var \mpetermann\blog\model\Author
	 */
	public $author;

	/**
	 * @var \DateTime $createdDateTime
	 */
	public $createdDateTime;

	/**
	 * @var \DateTime $modifiedDateTime
	 */
	public $modifiedDateTime;

	/**
	 * @param $authorId
	 *
	 * @return boolean
	 */
	public function setAuthorById($authorId) {
		$this->author = $authorId;
		// find author using AuthorRepository
		return FALSE;
	}

	/**
	 * @return Author
	 */
	public function getAuthorId() {
		return $this->author;
	}

	/**
	 * @return string
	 */
	public function getCreatedTimestamp() {
		return $this->createdDateTime->format('U');
	}

	/**
	 * @return string
	 */
	public function getModifiedTimestamp() {
		return $this->modifiedDateTime->format('U');
	}
}