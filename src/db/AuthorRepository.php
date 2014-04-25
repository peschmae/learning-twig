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
class AuthorRepository extends AbstractRepository {

	/**
	 * Basic implementation of "SELECT * FROM `users`"
	 * @return \mpetermann\blog\model\Author[]|boolean
	 */
	public function findAllAuthors() {
		/** @var \mysqli_result $queryResult */
		$queryResult = $this->sqlConnection->query(
			'SELECT id,username,password,email,author,admin FROM user WHERE author = 1'
		);

		if ($queryResult !== FALSE ) {
			$authors = array();

			while ($row = $queryResult->fetch_assoc()) {

				$authors[] = $this->mapToAuthor(
					$row['id'],
					$row['username'],
					$row['password'],
					$row['email'],
					$row['author'],
					$row['admin']
				);
			}

		} else {
			$authors = FALSE;
		}

		return $authors;

	}

	/**
	 * @param \mpetermann\blog\model\Author $author
	 *
	 * @return \mpetermann\blog\model\Author
	 * @throws \Exception
	 */
	public function add($author) {

		/** @var \mysqli_stmt $preparedStatement */
		$preparedStatement = $this->sqlConnection->prepare(
			'INSERT INTO user(username, email, password, author, admin) VALUES (?, ?, ?, ?, ?)'
		);

		$preparedStatement->bind_param(
			'sssii',
			$author->username,
			$author->email,
			$author->getPassword(),
			intval($author->author),
			intval($author->admin)
		);

		$result = $preparedStatement->execute();

		$preparedStatement->close();

		return $result;
	}

	/**
	 * @param \mpetermann\blog\model\Author $author
	 *
	 * @return boolean
	 */
	public function update($author) {
		return FALSE;
	}

	/**
	 * @param \mpetermann\blog\model\Author $author
	 *
	 * @return bool
	 */
	public function remove($author) {
		/** @var \mysqli_stmt $preparedStatement */
		$preparedStatement = $this->sqlConnection->prepare(
			'DELETE FROM user WHERE id = ?'
		);

		$preparedStatement->bind_param(
			'i',
			$author->id
		);

		$result = $preparedStatement->execute();

		$preparedStatement->close();

		return $result;

	}


	/**
	 * @param int $id
	 * @param string $username
	 * @param string $password
	 * @param string $email
	 * @param string $author
	 * @param string $admin
	 *
	 * @return \mpetermann\blog\model\Author
	 */
	protected function mapToAuthor($id, $username, $password, $email, $author, $admin) {
		$authorObject = new \mpetermann\blog\model\Author();

		if (isset($id)) {
			$authorObject->id = $id;
		}

		$authorObject->username = $username;
		$authorObject->email = $email;
		$authorObject->setPassword($password);
		$authorObject->author = (bool) intval($author);
		$authorObject->admin = (bool) intval($admin);

		return $authorObject;
	}
}