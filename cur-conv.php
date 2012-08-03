<?PHP
	
	/**
	*	getCurrency
	*	$amount - the amount (number)
	*	$from 	- country code (GBP = Great Britian Pound, ZAR = South African Rand)
	*	$to 	- same as above, currency converted to this currency
	*/

	function getCurrency($amount, $from, $to) {
		 
		//	Query google, save response
		$url = "http://www.google.com/ig/calculator?hl=en&q=$amount$from=?$to";
		$data = file_get_contents($url);
		
		//	Convert result into json format
		$data = preg_replace('/(\w+):/', '"\\1":', $data);

		//	Deal with the json code
		$curr = json_decode($data);

		//	Get only the number and return it (formatted)
		$rhs = explode(' ', $curr->rhs);
		return number_format($rhs[0], 2, '.', ' ');
	}

	echo '$1 = R' . getCurrency(1, 'USD', 'ZAR');