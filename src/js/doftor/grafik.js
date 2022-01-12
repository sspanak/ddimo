const Grafik = new class {
	constructor() {
		this.dnes = new Date();
		window.addEventListener('load', () => this._init());
	}


	_init() {
		this.$element = {
			$dnes: document.querySelector('#dnes'),
			$input: document.querySelector('#data_za_grafik'),
			$izbranaData: document.querySelector('#izbranaData'),
			$smyana1: document.querySelector('#smyana1'),
			$smyana2: document.querySelector('#smyana2'),
			$smyana3: document.querySelector('#smyana3')
		};

		this.izberiDnes().poplni();
	}


	_koyaData() {
		return new Date(this.$element.$input.value);
	}


	_poplniInput(data) {
		if (typeof data !== 'object' && !(data instanceof Date)) {
			console.error(`Датата трябва да бъде от тип Date, а използваме: ${data}`);
			return this;
		}

		this.$element.$input.value = data.toISOString().replace(/T.+/, '');

		return this;
	}


	poplni() {
		const dnes = new Date();
		dnes.setUTCHours(0,0,0,0);

		const izbranaData = new Date(this.$element.$input.value);

		this.$element.$dnes.style.display = dnes.getTime() === izbranaData.getTime() ? 'inline' : 'none';

		let data = '';
		let den = '';
		if (isNaN(izbranaData.getTime())) {
			data = '...';
			den = 'избери дата';
		}  else if (Object.prototype.toString.call(window.operamini) === '[object OperaMini]') {
			// засичане на Opera Mini по пример от https://dev.opera.com/articles/opera-mini-and-javascript/
			data = izbranaData.toISOString().replace(/T.+$/, '');
			den = izbranaData.toGMTString().replace(/(\w+),.+$/, '$1');
		} else {
			data = izbranaData.toLocaleDateString('bg');
			den = izbranaData.toLocaleDateString('bg', { weekday: 'long' });
		}

		this.$element.$izbranaData.innerHTML = `${data} (${den})`;


		const smeni = DoftorskaSmyana.koy(izbranaData);
		for (let smyana in smeni) {
			const $element = this.$element[`$smyana${smyana}`];

			if (!$element) {
				console.warn(`"${smyana}" не е валидна смяна`);
			} else {
				$element.innerHTML = smeni[smyana];
			}
		}
	}


	izberiVczera() {
		try {
			const data = this._koyaData();
			data.setDate(data.getDate() - 1);
			this._poplniInput(data);
		} catch (e) {
			this.izberiDnes();
		}

		return this;
	}


	izberiDnes() {
		return this._poplniInput(new Date());
	}


	izberiUtre() {
		try {
			const data = this._koyaData();
			data.setDate(data.getDate() + 1);
			this._poplniInput(data);
		} catch (e) {
			this.izberiDnes();
		}

		return this;
	}
};
