const previewContainerSelector = '.crossfire-volunteer-screenshot-preview';
const previewImgSelector = `${previewContainerSelector} img`;

function previewCrossfireScreenshot($img) {
	if (!($img instanceof HTMLElement)) {
		console.error('Не може да се покаже голяма снимка. Невалиден входен <img> елемент.');
		return;
	}

	const $previewContainer = document.querySelector(previewContainerSelector);
	if (!$previewContainer) {
		console.error('Не може да се покаже голяма снимка. Няма контейнер за показване.');
		return;
	}

	const $previewImg = document.querySelector(previewImgSelector);
	if (!$previewImg) {
		console.error('Не може да се покаже голяма снимка. Невалиден целеви <img> елемент.');
		return;
	}

	$previewImg.src = $img.src;
	$previewContainer.className = previewContainerSelector.replace('.', '');
}


function closeCrossfireScreenshot() {
	const $previewContainer = document.querySelector(previewContainerSelector);
	if (!$previewContainer) {
		console.error('Не може да се покаже голяма снимка. Няма контейнер за показване.');
		return;
	}

	const $previewImg = document.querySelector(previewImgSelector);
	if (!$previewImg) {
		console.error('Не може да се покаже голяма снимка. Невалиден целеви <img> елемент.');
		return;
	}

	$previewImg.src = '';
	$previewContainer.className = `${previewContainerSelector.replace('.', '')} hidden`;
}
