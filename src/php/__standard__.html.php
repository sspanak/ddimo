<!DOCTYPE html>
<html lang="<?=$lang?>">

	<head>
		<meta charset="utf-8">
		<title><?=$title?> | Dimo Karaivanov's website</title>

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- <link rel="shortcut icon" href="img/favicon.ico"> -->

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;700&family=Orbitron:wght@700&display=swap">

		<link rel="stylesheet" href="//<?=$base_url?>/v2/dd.css">

		<?php foreach ($include_files as $filepath): ?>
			<?=$filepath;?>
		<?php endforeach; ?>
	</head>
	<body>
		
		<header>
			<nav>
				<?php foreach ($breadcrumbs as $page => $url): ?>
					<?php if ($page !== array_key_last($breadcrumbs)): ?>
						<?=$page !== array_key_first($breadcrumbs) ? '/' : ''?>
						<a class="nav-element" href="//<?=$url?>"> <?=$page?> </a>
					<?php else: ?>
						/ <span class="nav-element"> <?=$page?> </span>
					<?php endif; ?>
				<?php endforeach; ?>
			</nav>
		</header>

		<hr>

		<div class="content-wrapper"><?=$content?></div>
	</body>
</html>
