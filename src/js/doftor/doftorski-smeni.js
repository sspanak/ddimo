const DoftorskaSmyana = new class {
	_ambareva(den, czetna) {
		if (den === 1 || den === 3 || (den === 5 && !czetna)) {
			return 1;
		}
		if (den === 2 || den === 4) {
			return 3;
		}
		return undefined;
	}


	_mileva(den, czetna) {
		if (den === 2 || den === 4 || (den === 5 && czetna)) {
			return 1;
		}
		if (den === 1 || den === 3) {
			return 3;
		}

		return undefined;
	}


	_todorova(den) {
		return (den === 2 || den === 3 || den === 4) ? 2 : undefined;
	}


	koy(data) {
		if (typeof data !== 'object' || !(data instanceof Date)) {
			return 'Грешка';
		}

		const den = data.getDay();
		const czetna = !(data.getDate() % 2);

		const smeni = {
			1: 'Никой',
			2: 'Никой',
			3: 'Никой'
		};

		if (this._ambareva(den, czetna)) {
			smeni[this._ambareva(den, czetna)] = 'Амбарева';
		}
		if (this._mileva(den, czetna)) {
			smeni[this._mileva(den, czetna)] = 'Милева';
		}
		if (this._todorova(den, czetna)) {
			smeni[this._todorova(den, czetna)] = 'Тодорова';
		}

		return smeni;
	}
};
