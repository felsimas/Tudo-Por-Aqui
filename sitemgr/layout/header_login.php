<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/layout/header.php
	# ----------------------------------------------------------------------------------------------------

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<link rel="shortcut icon" href="<?=DEFAULT_URL?>/images/favicon.ico">

		<title>Tudo Por Aqui - Login</title>

		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>">

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

		<meta name="ROBOTS" content="index, follow" />

		<?=system_getNoImageStyle($cssfile = true);?>

		<link href="<?=DEFAULT_URL?>/layout/login.css" rel="stylesheet" type="text/css">
		<link href="<?=DEFAULT_URL?>/layout/admin/style.css" rel="stylesheet" media="all" />
		<script src="<?=DEFAULT_URL?>/scripts/jquery.js" language="javascript" type="text/javascript"></script>


	</head>

	<body>


