<!DOCTYPE html>
<html lang="<?=$lang?>">

	<head>
		<meta charset="utf-8">
		<title><?=$title?> | Dimo Karaivanov's website</title>

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="shortcut icon" href="<?=$base_url?>/favicon.ico">

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;700&family=Orbitron:wght@700&family=Play:wght@400;700&display=swap">

		<link rel="stylesheet" href="<?=$base_url?>/ddimo.css?v=007">

		<script>
			function yesScript() {
				var $noscipt = document.querySelector('.no-script');
				$noscipt.className = $noscipt.className.replace('no-script', '');
			}
		</script>

		<?php foreach ($scripts_remote as $script): ?>
			<script
				src="<?=$script->url?>?v=007"
				<?=$script->async ? 'async' : ''?>
				<?=$script->defer ? 'defer' : ''?>
				<?=$script->module === true ? 'type="module"' : ''?>
				<?=$script->module === false ? 'nomodule' : ''?>
			></script>
		<?php endforeach;?>

		<?php foreach ($scripts_inline as $script): ?>
			<script <?=$script->module === true ? 'type="module"' : ''?> <?=$script->module === false ? 'nomodule' : ''?>><?=$script->script?></script>
		<?php endforeach;?>
	</head>
	<body class="no-script" onload="yesScript();">
		
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

		<div class="content-wrapper <?=$content_classes?>">
			<?=$content?>
		</div>
	</body>
</html>
