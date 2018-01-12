var kolor = 0;

function zapiszOdwiedziny(){
	if (typeof(Storage) !== 'undefined') {
		var data = new Date();
		
	   localStorage.ostatnieOdwiedziny = data.toLocaleTimeString();
   	} 
	else {
		alert('Brak wsparcia dla Web Storage');
	}
}

function czasNaStronie(){
	if (typeof(Storage) !== 'undefined') {
		if(sessionStorage.czasSpedzony){
			sessionStorage.czasSpedzony = Number(sessionStorage.czasSpedzony) + 1;
		}
		else{
			sessionStorage.czasSpedzony = 1;
		}
	}
	else {
		alert('Brak wsparcia dla Web Storage');
	}
}

function zmianaKoloru(){
	if(kolor == 0){
		document.getElementById('tabela').style.backgroundColor = '#e8e5de';
		kolor = 1;
	}
	else{
		document.getElementById('tabela').style.backgroundColor = 'inherit';
		kolor = 0;
	}
}

function dodajLicencje(){
	
	var licencja = document.createElement('div');
	licencja.className = 'title';
	var tekstLicencji = document.createTextNode('Pusta licencja');
	licencja.appendChild(tekstLicencji);
	document.getElementsByClassName('desc')[0].appendChild(licencja);
	
}
