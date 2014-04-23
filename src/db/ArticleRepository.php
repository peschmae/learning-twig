<?php
/**
 * Created by PhpStorm.
 * User: peschmae
 * Date: 4/9/14
 * Time: 11:48 PM
 */

namespace mpetermann\blog\db;

use \mpetermann\blog\model\Article;

/**
 * Class ArticleRepository
 * @package mpetermann\blog\db
 */
class ArticleRepository extends AbstractRepository {

	/**
	 * Basic implementation of "SELECT * FROM `articles`"
	 * @return \mpetermann\blog\model\Article[]|boolean
	 */
	public function findAll() {
		/** @var \mysqli_result $queryResult */
		$queryResult = $this->sqlConnection->query('SELECT * FROM article');

		if ($queryResult !== FALSE ) {
			$articles = array();

			while ($row = $queryResult->fetch_assoc()) {

				$articles[] = $this->mapToArticle(
					$row['id'],
					$row['title'],
					$row['lead'],
					$row['body'],
					$row['author'],
					$row['timestamp'],
					$row['modifiedTimestamp']
				);
			}

		} else {
			$articles = FALSE;
		}

		return $articles;

	}

	/**
	 * @param \mpetermann\blog\model\Article $article
	 *
	 * @return \mpetermann\blog\model\Article
	 * @throws \Exception
	 */
	public function add($article) {

		/** @var \mysqli_stmt $preparedStatement */
		$preparedStatement = $this->sqlConnection->prepare('INSERT INTO article(title,lead,body,author,timestamp,modifiedTimestamp) VALUES (?, ?, ?, ?, ?, ?)');

		$now = (int) date('U');

		$preparedStatement->bind_param(
			'sssiii',
			$article->title,
			$article->lead,
			$article->body,
			$article->getAuthorId(),
			$article->getCreatedTimestamp(),
			$now
		);

		return $preparedStatement->execute();
	}

	/**
	 * @param \mpetermann\blog\model\Article $article
	 *
	 * @return boolean
	 */
	public function update($article) {
		return FALSE;
	}

	/**
	 * @param $object
	 *
	 * @return bool|mixed
	 */
	public function remove($object) {
		return FALSE;
	}

	/**
	 * @param string $id
	 * @param string $title
	 * @param string $lead
	 * @param string $body
	 * @param int $authorId
	 * @param int $timestamp
	 * @param int $modifiedTimestamp
	 *
	 * @return \mpetermann\blog\model\Article
	 */
	protected function mapToArticle($id, $title, $lead, $body, $authorId, $timestamp, $modifiedTimestamp) {
		$article = new Article();

		if (isset($id)) {
			$article->id = $id;
		}
		$article->title = $title;
		$article->lead = $lead;
		$article->body = $body;

		if (isset($authorId)) {
			$article->setAuthorById($authorId);
		}

		// either I'm too stoned, or php is just fucked up again...
		$article->createdDateTime = new \DateTime('@' . $timestamp);
		$article->createdDateTime->setTimezone(new \DateTimeZone(date_default_timezone_get()));

		$article->modifiedDateTime = new \DateTime('@' . $modifiedTimestamp);
		$article->modifiedDateTime->setTimezone(new \DateTimeZone(date_default_timezone_get()));

		return $article;
	}
}