const previewContainerSelector = '.picture-preview-container';
const previewImgSelector = `${previewContainerSelector} img`;

window.previewImage = ($img) => {
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
	$previewContainer.className = $previewContainer.className.replace('hidden', '');
};


window.closeImagePreview = () => {
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
	$previewContainer.className = `${$previewContainer.className} hidden`;
};
