<?


$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$shift = $request->what;


if($shift == 'f'){
	
	$ar = array(
		
		"davanti" => 18,
		"numerino" => '017',
		);	
		
		$json = json_encode($ar);
		echo $json;
	
	
	
	}else if($shift =='s'){
		
		$ar = array(
		
		"davanti" => 8,
		"numerino" => '009',
		);	
		
		$json = json_encode($ar);
			echo $json;
		
		
		
		} else{
			
		$ar = array(
		
		"davanti" => 10,
		"numerino" => '011',
		);	
		
		$json = json_encode($ar);
			echo $json;
			
			
			/*echo '{"error":0,"message":"OK","services":[{"id":230688,"descr":"BOLLETTINI / F24","descr2":"RITIRO ACQUISTI ONLINE RICARICHE TELEFONICHE","serviceLetter":"B"},{"id":230692,"descr":"SERVIZI AL CITTADINO","descr2":"PERMESSI DI SOGGIORNO","serviceLetter":"T"},{"id":288119,"descr":"POSTEIMPRESA","descr2":"SERVIZI PER PROFESSIONISTI E IMPRESA","serviceLetter":"I"},{"id":421776,"descr":"PAGAMENTI E PRELIEVI","descr2":"BOLLETTINI LIBRETTI E BUONI POSTALI F23/F24 POSTEPAY INVIO/RISCOSSIONE DENARO PENSIONE E BONIFICI DOMICILIATI ACQUISTO SIM SPID","serviceLetter":"F"},{"id":421784,"descr":"POSTALE","descr2":"SPEDIZIONE/RITIRO CORRISPONDENZA E PACCHI FRANCOBOLLI TELEGRAMMI","serviceLetter":"P"},{"id":421799,"descr":"POSTALE E SERVIZI AL CITTADINO","descr2":"SPEDIZIONE/RITIRO CORRISPONDENZA E PACCHI PERMESSI DI SOGGIORNO FRANCOBOLLI TELEGRAMMI","serviceLetter":"P"},{"id":230693,"descr":"TITOLARI CONTO BANCOPOSTA","descr2":"SERVIZI PER TITOLARI CONTO BANCOPOSTA","serviceLetter":"E"},{"id":2,"descr":"Non Regressione ","descr2":"Non Regressione ","serviceLetter":":H"}]}';*/
			
			
			
			}