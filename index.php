<?php
require_once 'src/db/AbstractRepository.php';
require_once 'src/db/ArticleRepository.php';
require_once 'src/db/AuthorRepository.php';
require_once 'src/model/Article.php';
require_once 'src/model/Author.php';

require_once 'libs/vendor/autoload.php';

$templateBasePath = '../source/templates/';

$selectedTheme = 'bootstrap';

$directoriesToLoad = array(
	'layouts/',
	'pages/',
	'partials/',
	'',
);

$themePath = $templateBasePath . $selectedTheme . '/';

foreach ($directoriesToLoad as $key => $value) {
	if (!is_dir($themePath . $value)) {
		unset($directoriesToLoad[$key]);
	} else {
		$directoriesToLoad[$key] = $themePath . $value;
	}
}

$loader = new Twig_Loader_Filesystem($directoriesToLoad);
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('home.twig');

$alerts = array(
	1 => array(
		'priority' => 'success',
		'title' => 'Success!',
		'message' => 'Well Done!'
	),
	2 => array(
		'priority' => 'danger',
		'title' => 'Error!',
		'message' => 'What have you done?!?'
	),
);

/*
$jumbo = array(
	'title' => 'This is my jumbo',
	'lead' => 'What a shite.'
);
*/
$host = 'localhost';
$user = 'blog';
$password = 'golb';
$databaseName = 'blog';

$mysqlConnection = new mysqli($host, $user, $password, $databaseName);

if ($mysqlConnection->connect_errno) {
	printf("Connect failed: %s\n", $mysqlConnection->connect_error);
	exit();
}


$articleRepo = new \mpetermann\blog\db\ArticleRepository($mysqlConnection);

/** @var \mpetermann\blog\model\Article[] $articles */
$articles = $articleRepo->findAll();
//var_dump($articles);
$jumbo = $articles[0];

echo $template->render(
	array(
		'blogTitle' => 'My stupid blog',
		'alerts' => $alerts,
		'jumbo' => $jumbo,
		'loggedIn' => FALSE,
	)
);

/*

$authorRepo = new \mpetermann\blog\db\AuthorRepository($mysqlConnection);

/** @var \mpetermann\blog\model\Author[]  $authors *
$authors = $authorRepo->findAllAuthors();

var_dump($authors);
*/
?>
