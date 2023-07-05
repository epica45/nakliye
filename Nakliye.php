<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Nakliye extends CI_Controller {

	public function __construct() 

	{

		parent::__construct();

        $this->load->model('Nakliye_model','nakliye_model');

        $this->load->library('session');

        $this->load->helper('url');

        $this->load->helper('form');

        $this->load->helper('file');

    }

	public function index()

	{

		if (empty($this->session->login))

			redirect('/Nakliye/giris', 'refresh');

		if (date('H:i') >= '15:30') {

    		$connect_web = simplexml_load_file('https://www.tcmb.gov.tr/kurlar/today.xml');

    		//print_r($connect_web);

    		$dolar = $connect_web->Currency[0]->ForexBuying;

    		$euro = $connect_web->Currency[3]->CrossRateOther;

		    $savedata = array('dolar' => $dolar,'euro' => $euro);

		    $result = $this->nakliye_model->update_dovizler($savedata);

		} else {

		    $dovizler = $this->nakliye_model->get_dovizler();

		    $dolar = $dovizler->dolar;

    		$euro = $dovizler->euro;

		}

		$deyta = array('dolar' => $dolar, 'euro' => $euro);

		$this->load->helper('form');

		$this->load->helper('url');

		$this->load->view('header',$deyta);

		$this->load->view('left_sidebar');

		$this->load->view('proforma_sorgulama');

		$this->load->view('footer');

	}

	public function hesapla()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();



		$dues_series = $this->nakliye_model->get_port_dues();

		$notariel = $this->nakliye_model->get_notariel();

		$impCovertime = $this->nakliye_model->get_covertime("imp");

		$expCovertime = $this->nakliye_model->get_covertime("exp");

		$view_assosiation = $this->nakliye_model->get_assosiation();

		$trchamber = $this->nakliye_model->get_tr_chamber();

		$view_foreignchamber = $this->nakliye_model->get_foreign_chamber();

		$view_foreignpass = $this->nakliye_model->get_foreignpass();

		$garbage = $this->nakliye_model->get_garbage();

		$warfage_degerleri = $this->nakliye_model->get_warfage();

		$agency_services = $this->nakliye_model->get_agency();

		$get_bulk_cargo_type = $this->nakliye_model->get_bulk_cargo_type();

		$get_aliagatarife = $this->nakliye_model->get_aliagatarife();

		$get_izmirtarife = $this->nakliye_model->get_izmirtarife();

		$gtf_series = $this->nakliye_model->get_gtf_series();

		$dolar = $data["tlDolar"];

		$eurodolar = $data["euroDolar"];		

		$dolar = (float)$dolar;

		$eurodolar = (float)$eurodolar;



		if (151 <= $data["nrt"] && $data["nrt"] <= 500) {

			$portDues = $dues_series->portdues1 / $dolar;		

		} else if(501 <= $data["nrt"] && $data["nrt"] <= 3000){

			$portDues = $dues_series->portdues2 / $dolar;

		} elseif (3001 <= $data["nrt"]) {

			$portDues = $dues_series->portdues3 / $dolar;

		}

		$portDues = round($portDues);

		//print_r($data);
		if ($data["flagtype"] == "Turkish") {
				if (300 <= $data["nrt"] && $data["nrt"] <= 2000) {
					$gtf_fee = $gtf_series->gtf_fee1;
				} else if(2001 <= $data["nrt"] && $data["nrt"] <= 5000){
					$gtf_fee = $gtf_series->gtf_fee2;
				} else if(5001 <= $data["nrt"] && $data["nrt"] <= 10000){
					$gtf_fee = $gtf_series->gtf_fee3;
				} else if(10001 <= $data["nrt"] && $data["nrt"] <= 20000){
					$gtf_fee = $gtf_series->gtf_fee4;
				} else if(20001 <= $data["nrt"] && $data["nrt"] <= 50000){
					$gtf_fee = $gtf_series->gtf_fee5;
				} elseif (50001 <= $data["nrt"]) {
					$gtf_fee = $gtf_series->gtf_fee6;
				}
		} else {
			if ($data["passFre"] == "Passenger") {
				if (300 <= $data["nrt"] && $data["nrt"] <= 2000) {
					$gtf_fee = $gtf_series->gtf_fee7;
				} else if(2001 <= $data["nrt"] && $data["nrt"] <= 5000){
					$gtf_fee = $gtf_series->gtf_fee8;
				} else if(5001 <= $data["nrt"] && $data["nrt"] <= 10000){
					$gtf_fee = $gtf_series->gtf_fee9;
				} else if(10001 <= $data["nrt"] && $data["nrt"] <= 20000){
					$gtf_fee = $gtf_series->gtf_fee10;
				} else if(20001 <= $data["nrt"] && $data["nrt"] <= 50000){
					$gtf_fee = $gtf_series->gtf_fee11;
				} elseif (50001 <= $data["nrt"]) {
					$gtf_fee = $gtf_series->gtf_fee12;
				}
			} else if ($data["passFre"] == "Freight") {
				if (300 <= $data["nrt"] && $data["nrt"] <= 2000) {
					$gtf_fee = $gtf_series->gtf_fee13;
				} else if(2001 <= $data["nrt"] && $data["nrt"] <= 5000){
					$gtf_fee = $gtf_series->gtf_fee14;
				} else if(5001 <= $data["nrt"] && $data["nrt"] <= 10000){
					$gtf_fee = $gtf_series->gtf_fee15;
				} else if(10001 <= $data["nrt"] && $data["nrt"] <= 20000){
					$gtf_fee = $gtf_series->gtf_fee16;
				} else if(20001 <= $data["nrt"] && $data["nrt"] <= 50000){
					$gtf_fee = $gtf_series->gtf_fee17;
				} elseif (50001 <= $data["nrt"]) {
					$gtf_fee = $gtf_series->gtf_fee18;
				}
			}
		
		}
		
		$gtf_fee = $gtf_fee * 2;


		$sanitaryDues = ( $dues_series->sanitarydues1 * $data["nrt"] ) / $dolar;

		$sanitaryDues = round($sanitaryDues);

		if ($data["nrt"] <= 800) {

			$lightDues = $data["nrt"] *  $dues_series->lightdues1;

		} else {

			$lightDues = ( $data["nrt"] + 800 ) *  $dues_series->lightdues2;

		}

		$lightDues = round($lightDues);

		if ($data["port"] == "ALIAGA" && $data["grt"] >= 500) {
			for ($i=1001; $i < 100000000; $i+=1000) {
				if ($i <= $data["grt"] && $data["grt"] <= $i+999) {
					$warfage = ceil($data["grt"] / 1000);
					$trornotr = ($data["flagtype"] == "Turkish") ? $warfage_degerleri->warfage_tr : $warfage_degerleri->warfage_notr;
					$warfage = $warfage * $trornotr * $data["duration"];
					$warfage = round($warfage);
					break;
				}
			}
		} else {
			$warfage = ceil($data["grt"] / 1000);
			$warfage = $warfage * 10 * $data["duration"];
			$warfage = round($warfage);
		}

		$mooring = ceil($data["grt"] / 1000);

		$mooring = ($mooring * $get_izmirtarife->mooring_kat) + $get_izmirtarife->mooring;

		$mooring = round($mooring);



		$notarialFees = $notariel->notariel;

		if (0 < $data["grt"] && $data["grt"] <= 2000) {

			$tugboatCount = 0;

		} else if (2001 <= $data["grt"] && $data["grt"] <= 5000) {

			$tugboatCount = 2;

		} else if (5001 <= $data["grt"]) {

			$tugboatCount = 4;

		}



		if ($data["port"] == "ALIAGA") {

			$count = 0;

			for ($i=1001; $i < 100000000; $i+=1000) {

				if ($i <= $data["grt"] && $data["grt"] <= $i+999) {

					$son = $i+999;

					$para = ($get_aliagatarife->pilotaj + ( $count * $get_aliagatarife->pilotaj_kat ) ) * 2;

					$tugboat = ($get_aliagatarife->tugboat + ( $count * $get_aliagatarife->tugboat_kat ) ) * $tugboatCount;

					$mooring = ($get_aliagatarife->mooring + ( $count * $get_aliagatarife->mooring_kat ) );

					//echo $data["grt"]." değeri ".$i." ile ".$son." arasındadır. Ve döngü sayısı: ".$count;

					break;

				}

				$count++;			

			}

		} else {

			$count = 0;

			for ($i=1; $i < 100000000; $i+=1000) { 

				if ($i <= $data["grt"] && $data["grt"] <= $i+999) {

					$son = $i+999;

					$para = ($get_izmirtarife->pilotaj + ( $count * $get_izmirtarife->pilotaj_kat ) ) * 2;

					//echo "Count ".$count;

					$tugboat = ($get_izmirtarife->tugboat + ( $count * $get_izmirtarife->tugboat_kat ) ) * $tugboatCount;

					//echo $pilotage = $data["grt"]." değeri ".$i." ile ".$son." arasındadır.";

					break;

				}

				$count++;

			}

		}



		$para = round($para);

		$tugboat = round($tugboat);

		$tugovertime = ($para + $tugboat) / 4;

		$tugovertime = round($tugovertime);

		

		if (0 <= $data["grt"] && $data["grt"] <= 1000) {

			$garbageVal = $garbage->garbage1 * $eurodolar;

		} else if(1001 <= $data["grt"] && $data["grt"] <= 5000){

			$garbageVal = $garbage->garbage2 * $eurodolar;

		} else if(5001 <= $data["grt"] && $data["grt"] <= 10000){

			$garbageVal = $garbage->garbage3 * $eurodolar;

		} else if(10001 <= $data["grt"] && $data["grt"] <= 15000){

			$garbageVal = $garbage->garbage4 * $eurodolar;

		} else if(15001 <= $data["grt"] && $data["grt"] <= 20000){

			$garbageVal = $garbage->garbage5 * $eurodolar;

		} else if(20001 <= $data["grt"] && $data["grt"] <= 25000){

			$garbageVal = $garbage->garbage6 * $eurodolar;

		} else if(25001 <= $data["grt"] && $data["grt"] <= 35000){

			$garbageVal = $garbage->garbage7 * $eurodolar;

		} else if(35001 <= $data["grt"] && $data["grt"] <= 60000){

			$garbageVal = $garbage->garbage8 * $eurodolar;

		} else if(60000 <= $data["grt"]){

			$garbageVal = $garbage->garbage9 * $eurodolar; 

		}

		$garbageVal = round($garbageVal);



		if ($data["port"] == "ALIAGA") {

			$aliagaCover = $get_aliagatarife->aliaga_covertime;

			$aliagaCover = (int)$aliagaCover;

			$custom_overtime = $aliagaCover / $dolar;

			$immigration = $get_aliagatarife->aliaga_immigration;

			$immigration = (int)$immigration;

			$immigration = $immigration / $dolar;

			$immigration = round($immigration);

			if ($data["expImp"] == "Export") {

				$cargoText = "LOADING";

			} else if ($data["expImp"] == "Import") {

				$cargoText = "DISCHARGING";

			}

		}else{

			$immigration = 0;

			if ($data["expImp"] == "Export") {

				$cargoText = "LOADING";

				if (0 <= $data["cargo"] && $data["cargo"] <= 3000) {

					$custom_overtime = $expCovertime->covertime1 / $dolar;

				} else if (3001 <= $data["cargo"] && $data["cargo"] <= 6000) {

					$custom_overtime = $expCovertime->covertime2 / $dolar;

				} else if (6001 <= $data["cargo"] && $data["cargo"] <= 9000) {

					$custom_overtime = $expCovertime->covertime3 / $dolar;

				} else if (9001 <= $data["cargo"] && $data["cargo"] <= 12000) {

					$custom_overtime = $expCovertime->covertime4 / $dolar;

				} else if (12001 <= $data["cargo"] && $data["cargo"] <= 15000) {

					$custom_overtime = $expCovertime->covertime5 / $dolar;

				} else if (15001 <= $data["cargo"] && $data["cargo"] <= 18000) {

					$custom_overtime = $expCovertime->covertime6 / $dolar;

				} else if (18001 <= $data["cargo"] && $data["cargo"] <= 21000) {

					$custom_overtime = $expCovertime->covertime7 / $dolar;

				} else if (21001 <= $data["cargo"] && $data["cargo"] <= 25000) {

					$custom_overtime = $expCovertime->covertime8 / $dolar;

				} else if (25001 <= $data["cargo"] && $data["cargo"] <= 30000) {

					$custom_overtime = $expCovertime->covertime9 / $dolar;

				} else if (30001 <= $data["cargo"] && $data["cargo"] <= 35000) {

					$custom_overtime = $expCovertime->covertime10 / $dolar;	

				} else if (35001 <= $data["cargo"]) {

					$custom_overtime = $expCovertime->covertime11 / $dolar;

				}

			} else if ($data["expImp"] == "Import") {

				$cargoText = "DISCHARGING";

				if (0 <= $data["cargo"] && $data["cargo"] <= 3000) {

					$custom_overtime = $impCovertime->covertime1 / $dolar;

				} else if (3001 <= $data["cargo"] && $data["cargo"] <= 6000) {

					$custom_overtime = $impCovertime->covertime2 / $dolar;

				} else if (6001 <= $data["cargo"] && $data["cargo"] <= 9000) {

					$custom_overtime = $impCovertime->covertime3 / $dolar;

				} else if (9001 <= $data["cargo"] && $data["cargo"] <= 12000) {

					$custom_overtime = $impCovertime->covertime4 / $dolar;

				} else if (12001 <= $data["cargo"] && $data["cargo"] <= 15000) {

					$custom_overtime = $impCovertime->covertime5 / $dolar;

				} else if (15001 <= $data["cargo"] && $data["cargo"] <= 18000) {

					$custom_overtime = $impCovertime->covertime6 / $dolar;

				} else if (18001 <= $data["cargo"] && $data["cargo"] <= 21000) {

					$custom_overtime = $impCovertime->covertime7 / $dolar;

				} else if (21001 <= $data["cargo"] && $data["cargo"] <= 25000) {

					$custom_overtime = $impCovertime->covertime8 / $dolar;

				} else if (25001 <= $data["cargo"] && $data["cargo"] <= 30000) {

					$custom_overtime = $impCovertime->covertime9 / $dolar;

				} else if (30001 <= $data["cargo"] && $data["cargo"] <= 35000) {

					$custom_overtime = $impCovertime->covertime10 / $dolar;	

				} else if (35001 <= $data["cargo"]) {

					$custom_overtime = $impCovertime->covertime11 / $dolar;

				}	

			}

		}

		$custom_overtime = round($custom_overtime);



		if ($data["flagtype"] == "Turkish") {

			if (0 <= $data["grt"] && $data["grt"] <= 500) {

				$chamber = $trchamber->chamber1;

			} else if (501 <= $data["grt"] && $data["grt"] <= 1500) {

				$chamber = $trchamber->chamber2;

			} else if (1501 <= $data["grt"] && $data["grt"] <= 2500) {

				$chamber = $trchamber->chamber3;

			} else if (2501 <= $data["grt"] && $data["grt"] <= 5000) {

				$chamber = $trchamber->chamber4;

			}  else if (5001 <= $data["grt"] && $data["grt"] <= 10000) {

				$chamber = $trchamber->chamber5;

			}  else if (10001 <= $data["grt"] && $data["grt"] <= 25000) {

				$chamber = $trchamber->chamber6;

			}  else if (25001 <= $data["grt"] && $data["grt"] <= 35000) {

				$chamber = $trchamber->chamber7;

			}  else if (35001 <= $data["grt"] && $data["grt"] <= 50000) {

				$chamber = $trchamber->chamber8;

			}  else if (50001 <= $data["grt"]) {

				$chamber = $trchamber->chamber9;

			}

		} else if ($data["flagtype"] == "Not Turkish") {

			if (0 <= $data["grt"] && $data["grt"] <= 500) {

				$chamber = $view_foreignchamber->chamber1;

			} else if (501 <= $data["grt"] && $data["grt"] <= 1000) {

				$chamber = $view_foreignchamber->chamber2;

			} else if (1001 <= $data["grt"] && $data["grt"] <= 1500) {

				$chamber = $view_foreignchamber->chamber3;

			} else if (1501 <= $data["grt"] && $data["grt"] <= 2000) {

				$chamber = $view_foreignchamber->chamber4;

			}  else if (2001 <= $data["grt"] && $data["grt"] <= 2500) {

				$chamber = $view_foreignchamber->chamber5;

			}  else if (2501 <= $data["grt"] && $data["grt"] <= 5000) {

				$chamber = $view_foreignchamber->chamber6;

			}  else if (5001 <= $data["grt"] && $data["grt"] <= 10000) {

				$chamber = $view_foreignchamber->chamber7;

			}  else if (10001 <= $data["grt"] && $data["grt"] <= 25000) {

				$chamber = $view_foreignchamber->chamber8;

			}  else if (25001 <= $data["grt"]) {

				$chamber = $view_foreignchamber->chamber9;

			}

		}

		$chamber = (int)($chamber);

		$chamber = round($chamber / $dolar);



		if (0 <= $data["cargo"] && $data["cargo"] <= 20000) {

			$assosiation = $view_assosiation->assosiation1;

		} else if (20001 <= $data["cargo"] && $data["cargo"] <= 40000) {

			$assosiation = $view_assosiation->assosiation2;

		} else if (40001 <= $data["cargo"] && $data["cargo"] <= 60000) {

			$assosiation = $view_assosiation->assosiation3;

		} else if (60001 <= $data["cargo"] && $data["cargo"] <= 100000) {

			$assosiation = $view_assosiation->assosiation4;

		} else if (100001 <= $data["cargo"]) {

			$assosiation = $view_assosiation->assosiation5;

		}



		if (0 <= $data["nrt"] && $data["nrt"] <= 10000) {

			if (0 <= $data["nrt"] && $data["nrt"] <= 500) {

				$agency = $agency_services->agency1;

				$agencytodolar = $agency * $eurodolar;

			} else if(501 <= $data["nrt"] && $data["nrt"] <= 1000) {

				$agency = $agency_services->agency2;

				$agencytodolar = $agency * $eurodolar;

			} else if(1001 <= $data["nrt"] && $data["nrt"] <= 2000) {

				$agency = $agency_services->agency3;

				$agencytodolar = $agency * $eurodolar;

			} else if(2001 <= $data["nrt"] && $data["nrt"] <= 3000) {

				$agency = $agency_services->agency4;

				$agencytodolar = $agency * $eurodolar;

			} else if(3001 <= $data["nrt"] && $data["nrt"] <= 4000) {

				$agency = $agency_services->agency5;

				$agencytodolar = $agency * $eurodolar;

			} else if(4001 <= $data["nrt"] && $data["nrt"] <= 5000) {

				$agency = $agency_services->agency6;

				$agencytodolar = $agency * $eurodolar;

			} else if(5001 <= $data["nrt"] && $data["nrt"] <= 7500) {

				$agency = $agency_services->agency7;

				$agencytodolar = $agency * $eurodolar;

			} else if(7501 <= $data["nrt"] && $data["nrt"] <= 10000) {

				$agency = $agency_services->agency8;

				$agencytodolar = $agency * $eurodolar;

			}

			

		} else if (10001 <= $data["nrt"] && $data["nrt"] <= 20000) {

			$sabit1 = $agency_services->sabit1;

			$islem1 = $data["nrt"]%10000;

			$islem2 = (int)($islem1 / 1000);

			$islem2_2 = $islem1%1000;

			$islem3 = $islem2*$agency_services->islem1;

			if($islem2_2 > 0){$islem3 = $islem3 + $agency_services->islem1;}

			$agency = $sabit1 + $islem3;

			$agencytodolar = $agency * $eurodolar;

		} else if (20001 <= $data["nrt"] && $data["nrt"] <= 30000) {

			$sabit1 = $agency_services->sabit1;

			$sabit2 = $agency_services->sabit2;

			$islem1 = $data["nrt"]%10000;

			$islem2 = (int)($islem1 / 1000);

			$islem2_2 = $islem1%1000;

			$islem3 = $islem2*$agency_services->islem2;

			if($islem2_2 > 0){$islem3 = $islem3 + $agency_services->islem2;}

			$agency = $sabit1 + $sabit2 + $islem3;

			$agencytodolar = $agency * $eurodolar;

		} else if (30001 <= $data["nrt"] && $data["nrt"] <= 40000) {

			$sabit1 = $agency_services->sabit1;

			$sabit2 = $agency_services->sabit2;

			$sabit3 = $agency_services->sabit3;

			$islem1 = $data["nrt"]%10000;

			$islem2 = (int)($islem1 / 1000);

			$islem2_2 = $islem1%1000;

			$islem3 = $islem2*$agency_services->islem3;

			if($islem2_2 > 0){$islem3 = $islem3 + $agency_services->islem3;}

			$agency = $sabit1 + $sabit2 + $sabit3 + $islem3;

			$agencytodolar = $agency * $eurodolar; 

		} else if (40001 <= $data["nrt"] && $data["nrt"] <= 50000) {

			$sabit1 = $agency_services->sabit1;

			$sabit2 = $agency_services->sabit2;

			$sabit3 = $agency_services->sabit3;

			$sabit4 = $agency_services->sabit4;

			$islem1 = $data["nrt"]%10000;

			$islem2 = (int)($islem1 / 1000);

			$islem2_2 = $islem1%1000;

			$islem3 = $islem2*$agency_services->islem4;

			if($islem2_2 > 0){$islem3 = $islem3 + $agency_services->islem4;}

			$agency = $sabit1 + $sabit2 + $sabit3 + $sabit4 + $islem3;

			$agencytodolar = $agency * $eurodolar; 

		} else if (50001 <= $data["nrt"]) {

			$sabit1 = $agency_services->sabit1;

			$sabit2 = $agency_services->sabit2;

			$sabit3 = $agency_services->sabit3;

			$sabit4 = $agency_services->sabit4;

			$sabit5 = $agency_services->sabit5;

			$islem1 = $data["nrt"]%10000;

			$islem2 = (int)($islem1 / 1000);

			$islem2_2 = $islem1%1000;

			$islem3 = $islem2*$agency_services->islem5;

			if($islem2_2 > 0){$islem3 = $islem3 + $agency_services->islem5;}

			$agency = $sabit1 + $sabit2 + $sabit3 + $sabit4 + $sabit5 + $islem3;

			$agencytodolar = $agency * $eurodolar;

		}

		$agencytodolar = round($agencytodolar);



		if ($data['bulk'] == 'a' && $data['cargotypecode'] == 'a') {

			if (0 <= $data["cargo"] && $data["cargo"] <= 10000) {

				$islem1 = $data["cargo"];

				//$islem2 = (int)($islem1 / 1000);

				//$islem2_2 = $islem1%1000;

				//if($islem2_2 > 0){$islem2 = $islem2 + 1;}

				$islem1 = (int)$islem1;

				$supervision = $islem1 * $get_bulk_cargo_type->aa_0_10000;

				$supervisiontodolar = $supervision * $eurodolar;

			} else if(10001 <= $data["cargo"] && $data["cargo"] <= 20000) {

				$sabit1 = 10000*$get_bulk_cargo_type->aa_0_10000;

				$islem1 = $data["cargo"]-10000;

				$islem1 = (int)$islem1;

				//$islem2 = (int)($islem1 / 1000);

				//$islem2_2 = $islem1%1000;

				//if($islem2_2 > 0){$islem2 = $islem2 + 1;}

				$supervision = $sabit1 + ($islem1 * $get_bulk_cargo_type->aa_10001_20000);

				$supervisiontodolar = $supervision * $eurodolar;

			} else if(20001 <= $data["cargo"]) {

				$sabit1 = 10000*$get_bulk_cargo_type->aa_0_10000;

				$sabit2 = 10000*$get_bulk_cargo_type->aa_10001_20000;

				$islem1 = $data["cargo"] - 20000;

				$islem1 = (int)$islem1;

				//$islem2 = (int)($islem1 / 1000);

				//$islem2_2 = $islem1%1000;

				//if($islem2_2 > 0){$islem2 = $islem2 + 1;}

				$supervision =  $sabit1 + $sabit2 + ($islem1 * $get_bulk_cargo_type->aa_20001);

				$supervisiontodolar = $supervision * $eurodolar;

			}

		} else if ($data['bulk'] == 'a' && $data['cargotypecode'] == 'b') {

			if (0 <= $data["cargo"] && $data["cargo"] <= 10000) {

				$islem1 = $data["cargo"];

				$islem1 = (int)$islem1;

				$supervision = $islem1 * $get_bulk_cargo_type->ab_0_10000;

				$supervisiontodolar = $supervision * $eurodolar;

			} else if(10001 <= $data["cargo"] && $data["cargo"] <= 25000) {

				$sabit1 = 10000*$get_bulk_cargo_type->ab_0_10000;

				$islem1 = $data["cargo"]-10000;

				$islem1 = (int)$islem1;

				$supervision = $sabit1 + ($islem1 * $get_bulk_cargo_type->ab_10001_25000);

				$supervisiontodolar = $supervision * $eurodolar;

			} else if(25001 <= $data["cargo"]) {

				$sabit1 = 10000*$get_bulk_cargo_type->ab_0_10000;

				$sabit2 = 15000*$get_bulk_cargo_type->ab_10001_25000;

				$islem1 = $data["cargo"] - 25000;

				$islem1 = (int)$islem1;

				$supervision =  $sabit1 + $sabit2 + ($islem1 * $get_bulk_cargo_type->ab_25001);

				$supervisiontodolar = $supervision * $eurodolar;

			}

		} else if ($data['bulk'] == 'a' && $data['cargotypecode'] == 'c') {

			if (0 <= $data["cargo"] && $data["cargo"] <= 5000) {

				$islem1 = $data["cargo"];

				$islem1 = (int)$islem1;

				$supervision = $islem1 * $get_bulk_cargo_type->ac_0_5000;

				$supervisiontodolar = $supervision * $eurodolar;

			} else if(5001 <= $data["cargo"]) {

				$sabit1 = 5000*$get_bulk_cargo_type->ac_0_5000;

				$islem1 = $data["cargo"]-5000;

				$islem1 = (int)$islem1;

				$supervision = $sabit1 + ($islem1 * $get_bulk_cargo_type->ac_5001);

				$supervisiontodolar = $supervision * $eurodolar;

			}

		} else if ($data['bulk'] == 'a' && $data['cargotypecode'] == 'd') {

			if (0 <= $data["cargo"] && $data["cargo"] <= 15000) {

				$islem1 = $data["cargo"];

				$islem1 = (int)$islem1;

				$supervision = $islem1 * $get_bulk_cargo_type->ad_0_15000;

				$supervisiontodolar = $supervision * $eurodolar;

			} else if(15001 <= $data["cargo"] && $data["cargo"] <= 35000) {

				$sabit1 = 15000*$get_bulk_cargo_type->ad_0_15000;

				$islem1 = $data["cargo"]-15000;

				$islem1 = (int)$islem1;

				$supervision = $sabit1 + ($islem1 * $get_bulk_cargo_type->ad_15001_35000);

				$supervisiontodolar = $supervision * $eurodolar;

			} else if(35001 <= $data["cargo"]) {

				$sabit1 = 15000*$get_bulk_cargo_type->ad_0_15000;

				$sabit2 = 20000*$get_bulk_cargo_type->ad_15001_35000;

				$islem1 = $data["cargo"] - 35000;

				$islem1 = (int)$islem1;

				$supervision =  $sabit1 + $sabit2 + ($islem1 * $get_bulk_cargo_type->ad_35001);

				$supervisiontodolar = $supervision * $eurodolar;

			}

		} else if ($data['bulk'] == 'a' && $data['cargotypecode'] == 'e') {

			if (0 <= $data["cargo"] && $data["cargo"] <= 15000) {

				$islem1 = $data["cargo"];

				$islem1 = (int)$islem1;

				$supervision = $islem1 * $get_bulk_cargo_type->ae_0_15000;

				$supervisiontodolar = $supervision * $eurodolar;

			} else if(15001 <= $data["cargo"]) {

				$sabit1 = 15000*$get_bulk_cargo_type->ae_0_15000;

				$islem1 = $data["cargo"]-15000;

				$islem1 = (int)$islem1;

				$supervision = $sabit1 + ($islem1 * $get_bulk_cargo_type->ae_15001);

				$supervisiontodolar = $supervision * $eurodolar;

			}

		} else if ($data['bulk'] == 'a' && $data['cargotypecode'] == 'f') {

			$islem1 = $data["cargo"];

			$islem1 = (int)$islem1;

			$supervision = $islem1 * $get_bulk_cargo_type->af_tek_deger;

			$supervisiontodolar = $supervision * $eurodolar;

		}

		if ($data['bulk'] == 'b' && $data['cargotypecode'] == 'a') {

			if (0 <= $data["cargo"] && $data["cargo"] <= 20000) {

				$islem1 = $data["cargo"];

				$islem1 = (int)$islem1;

				$supervision = $islem1 * $get_bulk_cargo_type->ba_0_20000;

				$supervisiontodolar = $supervision * $eurodolar;

			} else if(20001 <= $data["cargo"]) {

			    $islem1 = $data["cargo"];

				$sabit1 = 20000 * $get_bulk_cargo_type->ba_0_20000;

				$islem2 = $data["cargo"]-20000;

				$supervision = $sabit1 + ($islem2 * $get_bulk_cargo_type->ba_20001);

				$supervisiontodolar = $supervision * $eurodolar;

			}

		} else if ($data['bulk'] == 'b' && $data['cargotypecode'] == 'b') {

			$islem1 = $data["cargo"];

			$islem1 = (int)$islem1;

			$supervision = $islem1 * $get_bulk_cargo_type->bb_tek_deger;

			$supervisiontodolar = $supervision * $eurodolar;

		} else if ($data['bulk'] == 'b' && $data['cargotypecode'] == 'c') {

			$islem1 = $data["cargo"];

			$islem1 = (int)$islem1;

			$supervision = $islem1 * $get_bulk_cargo_type->bc_tek_deger;

			$supervisiontodolar = $supervision * $eurodolar;

		} else if ($data['bulk'] == 'b' && $data['cargotypecode'] == 'd') {

			if (0 <= $data["cargo"] && $data["cargo"] <= 5000) {

				$islem1 = $data["cargo"];

				$islem1 = (int)$islem1;

				$supervision = $islem1 * $get_bulk_cargo_type->bd_0_5000;

				$supervisiontodolar = $supervision * $eurodolar;

			} else if(5001 <= $data["cargo"] && $data["cargo"] <= 10000) {

				$sabit1 = 5000 * $get_bulk_cargo_type->bd_0_5000;

				$islem1 = $data["cargo"]-5000;

				$islem1 = (int)$islem1;

				$supervision = $sabit1 + ($islem1 * $get_bulk_cargo_type->bd_5001_10000);

				$supervisiontodolar = $supervision * $eurodolar;

			} else if(10001 <= $data["cargo"]) {

				$sabit1 = 5000 * $get_bulk_cargo_type->bd_0_5000;

				$sabit2 = 5000 * $get_bulk_cargo_type->bd_5001_10000;

				$islem1 = $data["cargo"] - 10000;

				$islem1 = (int)$islem1;

				$supervision =  $sabit1 + $sabit2 + ($islem1 * $get_bulk_cargo_type->bd_10001);

				$supervisiontodolar = $supervision * $eurodolar;

			}

		} else if ($data['bulk'] == 'b' && $data['cargotypecode'] == 'e') {

			if (0 <= $data["cargo"] && $data["cargo"] <= 3000) {

				$islem1 = $data["cargo"];

				$islem1 = (int)$islem1;

				$supervision = $islem1 * $get_bulk_cargo_type->be_0_3000;

				$supervisiontodolar = $supervision * $eurodolar;

			} else if(3001 <= $data["cargo"] && $data["cargo"] <= 5000) {

				$sabit1 = 3000 * $get_bulk_cargo_type->be_0_3000;

				$islem1 = $data["cargo"]-3000;

				$islem1 = (int)$islem1;

				$supervision = $sabit1 + ($islem1 * $get_bulk_cargo_type->be_3001_5000);

				$supervisiontodolar = $supervision * $eurodolar;

			} else if(5001 <= $data["cargo"]) {

				$sabit1 = 3000 * $get_bulk_cargo_type->be_0_3000;

				$sabit2 = 2000 * $get_bulk_cargo_type->be_3001_5000;

				$islem1 = $data["cargo"] - 5000;

				$islem1 = (int)$islem1;

				$supervision =  $sabit1 + $sabit2 + ($islem1 * $get_bulk_cargo_type->be_5001);

				$supervisiontodolar = $supervision * $eurodolar;

			}

		}

		if ($data['bulk'] == 'c' && $data['cargotypecode'] == 'a') {			

			$islem1 = $data["cargo"];

			$islem1 = (int)$islem1;

			$supervision = $islem1 * $get_bulk_cargo_type->ca_tek_deger;

			$supervisiontodolar = $supervision * $eurodolar;

		}

		if ($data['bulk'] == 'd' && $data['cargotypecode'] == 'a') {

			$islem1 = $data["cargo"];

			$islem1 = (int)$islem1;

			$supervision = $islem1 * $get_bulk_cargo_type->da_tek_deger;

			$supervisiontodolar = $supervision * $eurodolar;

		} else if ($data['bulk'] == 'd' && $data['cargotypecode'] == 'b') {

			$islem1 = $data["cargo"];

			$islem1 = (int)$islem1;

			$supervision = $islem1 * $get_bulk_cargo_type->db_tek_deger;

			$supervisiontodolar = $supervision * $eurodolar;

		}

		if ($data['bulk'] == 'e' && $data['cargotypecode'] == 'a') {

			$islem1 = $data["cargo"];

			$islem1 = (int)$islem1;

			$supervision = $islem1 * $get_bulk_cargo_type->ea_tek_deger;

			$supervisiontodolar = $supervision * $eurodolar;

		} else if ($data['bulk'] == 'e' && $data['cargotypecode'] == 'b') {

			$islem1 = $data["cargo"];

			$islem1 = (int)$islem1;

			$supervision = $islem1 * $get_bulk_cargo_type->eb_tek_deger;

			$supervisiontodolar = $supervision * $eurodolar;

		}

		if ($data['bulk'] == 'f' && $data['cargotypecode'] == 'a') {

			$islem1 = $data["cargo"];

			$islem1 = (int)$islem1;

			$supervision = $islem1 * $get_bulk_cargo_type->fa_tek_deger;

			$supervisiontodolar = $supervision * $eurodolar;

		} else if ($data['bulk'] == 'f' && $data['cargotypecode'] == 'b') {

			$islem1 = $data["cargo"];

			$islem1 = (int)$islem1;

			$supervision = $islem1 * $get_bulk_cargo_type->fb_tek_deger;

			$supervisiontodolar = $supervision * $eurodolar;

		}

		if ($data['bulk'] == 'g' && $data['cargotypecode'] == 'a') {

			if (0 <= $data["cargo"] && $data["cargo"] <= 50) {

				$islem1 = $data["cargo"];

				$islem1 = (int)$islem1;

				$supervision = $islem1 * $get_bulk_cargo_type->ga_0_50;

				$supervisiontodolar = $supervision * $eurodolar;

			} else if(51 <= $data["cargo"] && $data["cargo"] <= 300) {

				$sabit1 = 50*$get_bulk_cargo_type->ga_0_50;

				$islem1 = $data["cargo"]-50;

				$islem1 = (int)$islem1;

				$supervision = $sabit1 + ($islem1 * $get_bulk_cargo_type->ga_51_300);

				$supervisiontodolar = $supervision * $eurodolar;

			} else if(301 <= $data["cargo"]) {

				$sabit1 = 50*$get_bulk_cargo_type->ga_0_50;

				$sabit2 = 250*$get_bulk_cargo_type->ga_51_300;

				$islem1 = $data["cargo"] - 300;

				$islem1 = (int)$islem1;

				$supervision =  $sabit1 + $sabit2 + ($islem1 * $get_bulk_cargo_type->ga_301);

				$supervisiontodolar = $supervision * $eurodolar;

			}

		}

		if ($data['bulk'] == 'h' && $data['cargotypecode'] == 'a') {

			$islem1 = $data["cargo"];

			$islem1 = (int)$islem1;

			$supervision = $islem1 * $get_bulk_cargo_type->ha_tek_deger;

			$supervisiontodolar = $supervision * $eurodolar;

		}



		$supervisiontodolar = round($supervisiontodolar);

		$supervision = round($supervision);

		

		$anchorage = ceil($data["grt"] * $notariel->anchorage);



		if ($data["duration"] > 5) {

			if (6 <= $data["duration"] && $data["duration"] <= 8) {

				$agencyovertime = $agency * 25 / 100;

				$agencyovertimeText = "6 TO 8 DAYS";

			} else if(9 <= $data["duration"] && $data["duration"] <= 11) {

				$agencyovertime = $agency * 50 / 100;

				$agencyovertimeText = "9 TO 11 DAYS";

			} else if(12 <= $data["duration"] && $data["duration"] <= 14) {

				$agencyovertime = $agency * 75 / 100;

				$agencyovertimeText = "12 TO 14 DAYS";

			} else if(15 <= $data["duration"]) {

				$agencyovertime = $agency;

				$agencyovertimeText = "15 DAYS";

			}

			$agencyovertime = round($agencyovertime);

			$agencyovertimedolar = $agencyovertime * $eurodolar;

			$agencyovertimedolar = round($agencyovertimedolar);

			$total = $portDues + $sanitaryDues + $lightDues + $gtf_fee + $mooring + $notarialFees + $tugboat + $para + $garbageVal + $custom_overtime + $assosiation + $chamber + $tugovertime + $agencytodolar + $supervisiontodolar + $warfage + $notariel->petties + $notariel->taxihire + $notariel->phone_calls + $notariel->fotocopies + $agencyovertimedolar;

		} else {

			$agencyovertimedolar = 0;

			$agencyovertime = 0;

			$agencyovertimeText = "";

			$total = $portDues + $sanitaryDues + $lightDues + $gtf_fee + $mooring + $notarialFees + $tugboat + $para + $garbageVal + $custom_overtime + $assosiation + $chamber + $tugovertime + $agencytodolar + $supervisiontodolar + $warfage + $notariel->petties + $notariel->taxihire + $notariel->phone_calls + $notariel->fotocopies;

		}

		if ($data["port"] == "ALIAGA") {

			$total = $total + $immigration + $notariel->motorlunch + $anchorage - $tugovertime;

		}



		$view = array('gtf_fee' => $gtf_fee, 'portdues' => $portDues, 'sanitarydues' => $sanitaryDues, 'lightdues' => $lightDues, 'warfage' => $warfage, 'mooring' => $mooring, 'notarialFees' => $notarialFees, 'tugboat' => $tugboat, 'pilotaj' => $para, 'garbage' => $garbageVal, 'vesselname' => $data["vesselname"], 'flagtype' => $data["flagtype"], 'flagname' => $data["flagname"], 'nrt' => $data["nrt"], 'grt' => $data["grt"], 'cargo' => $data["cargo"], 'port' => $data["port"], 'custom_overtime' => $custom_overtime, 'assosiation' => $assosiation, 'chamber' => $chamber, 'total' => $total, 'tugovertime' => $tugovertime, 'agency' => $agencytodolar, 'agencyeuro' => $agency, 'cargotype' => $data["cargotype"], 'duration' => $data["duration"], 'supervision' => $supervisiontodolar, 'supervisioneuro' => $supervision, 'anchorage' => $anchorage, 'motorlunch' => $notariel->motorlunch, 'agencyovertime' => $agencyovertime, 'agencyovertimedolar' => $agencyovertimedolar, 'agencyovertimeText' => $agencyovertimeText, 'cargoText' => $cargoText, 'expImp' => $data['expImp'], 'immigration' => $immigration, 'petties' => $notariel->petties, 'taxihire' => $notariel->taxihire, 'phone_calls' => $notariel->phone_calls, 'fotocopies' => $notariel->fotocopies, 'user_name' => $this->session->userdata('user_name'));

		$headandfooinfo = $this->nakliye_model->get_headandfooinfo();

		$headandfooinfo->fooinfo = str_replace("@user_name@",$this->session->userdata('user_name'),$headandfooinfo->fooinfo);

		$view_info = array('headinfo' => $headandfooinfo->headinfo,'fooinfo' => $headandfooinfo->fooinfo);

		$this->load->view('header',$view);

		$this->load->view('left_sidebar');

		$this->load->view('proforma_sonuc',$view_info);

		$this->load->view('footer');	

	}

	public function izmirAciklama(){

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$this->load->helper('form');

		$this->load->helper('url');

		$izmir_aciklama = $this->nakliye_model->get_izmir_aciklama();

		$view_izmir_aciklama = array('aciklama1' => $izmir_aciklama->aciklama1, 'aciklama2' => $izmir_aciklama->aciklama2);

		$this->load->view('header',$view_izmir_aciklama);

		$this->load->view('left_sidebar');

		$this->load->view('edit_izmir_aciklama');

		$this->load->view('footer');

	}

	public function izmir_aciklama_update()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();

		$savedata = array('aciklama1' => $data["aciklama1"], 'aciklama2' => $data["aciklama2"]);

		$result = $this->nakliye_model->update_izmir_aciklama($savedata);

		echo json_encode($result);

	}

	public function PortDues(){

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$this->load->helper('form');

		$this->load->helper('url');

		$dues_series = $this->nakliye_model->get_port_dues();

		$view_dues = array('portdues1' => $dues_series->portdues1, 'portdues2' => $dues_series->portdues2, 'portdues3' => $dues_series->portdues3, 'sanitarydues1' => $dues_series->sanitarydues1, 'lightdues1' => $dues_series->lightdues1, 'lightdues2' => $dues_series->lightdues2);

		$this->load->view('header',$dues_series);

		$this->load->view('left_sidebar');

		$this->load->view('edit_dues_series');

		$this->load->view('footer');

	}

	public function dues_series_update()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();

		$savedata = array('portdues1' => $data["portdues1"], 'portdues2' => $data["portdues2"], 'portdues3' => $data["portdues3"], 'sanitarydues1' => $data["sanitarydues"], 'lightdues1' => $data["lightdues1"], 'lightdues2' => $data["lightdues2"]);

		$result = $this->nakliye_model->update_port_dues($savedata);

		echo json_encode($result);

	}

	public function editgarbage()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$this->load->helper('form');

		$this->load->helper('url');

		$garbage = $this->nakliye_model->get_garbage();

		$warfage = $this->nakliye_model->get_warfage();

		$view_dues = array('garbage1' => $garbage->garbage1, 'garbage2' => $garbage->garbage2, 'garbage3' => $garbage->garbage3, 'garbage4' => $garbage->garbage4, 'garbage5' => $garbage->garbage5, 'garbage6' => $garbage->garbage6, 'garbage7' => $garbage->garbage7, 'garbage8' => $garbage->garbage8, 'garbage9' => $garbage->garbage9, 'warfage500notr' => $warfage->warfage500notr, 'warfage500tr' => $warfage->warfage500tr, 'warfage_notr' => $warfage->warfage_notr, 'warfage_tr' => $warfage->warfage_tr);

		$this->load->view('header',$view_dues);

		$this->load->view('left_sidebar');

		$this->load->view('edit_garbage');

		$this->load->view('footer');

	}

	public function garbage_update()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();

		$savedata = array('garbage1' => $data["garbage1"], 'garbage2' => $data["garbage2"], 'garbage3' => $data["garbage3"], 'garbage4' => $data["garbage4"], 'garbage5' => $data["garbage5"], 'garbage6' => $data["garbage6"], 'garbage7' => $data["garbage7"], 'garbage8' => $data["garbage8"], 'garbage9' => $data["garbage9"]);

		$result = $this->nakliye_model->update_garbage($savedata);

		echo json_encode($result);

	}

	public function warfage_update()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		echo $data = $this->input->post();

		$savedata = array('warfage500notr' => $data["warfage500notr"], 'warfage500tr' => $data["warfage500tr"], 'warfage_notr' => $data["warfage_notr"], 'warfage_tr' => $data["warfage_tr"]);

		$result = $this->nakliye_model->update_warfage($savedata);

		echo json_encode($result);

	}

	public function notariel()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$notariel = $this->nakliye_model->get_notariel();

		$view = array('notariel' => $notariel);

		$this->load->helper('form');

		$this->load->helper('url');

		$this->load->view('header',$view);

		$this->load->view('left_sidebar');

		$this->load->view('notariel');

		$this->load->view('footer');

	}

	public function update_notariel()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();

		$savedata = array('notariel' => $data["notariel"],'anchorage' => $data["anchorage"],'petties' => $data["petties"],'taxihire' => $data["taxihire"],'phone_calls' => $data["phone_calls"],'fotocopies' => $data["fotocopies"],'motorlunch' => $data["motorlunch"],'defaultusefulinfo' => $data["defaultusefulinfo"]);

		$result = $this->nakliye_model->update_notariel($savedata);

		echo json_encode($result);

	}

	public function editChamber()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$this->load->helper('form');

		$this->load->helper('url');

		$trchamber = $this->nakliye_model->get_tr_chamber();

		$view_foreignchamber = $this->nakliye_model->get_foreign_chamber();

		$view_foreignpass = $this->nakliye_model->get_foreignpass();

		$view = array('trchamber' => $trchamber, 'view_foreignchamber' => $view_foreignchamber, 'view_foreignpass' => $view_foreignpass);

		$this->load->view('header',$view);

		$this->load->view('left_sidebar');

		$this->load->view('edit_chamber.php');

		$this->load->view('footer');

	}

	public function tr_freight_chamber_update()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();

		$savedata = array('chamber1' => $data["trchamber1"], 'chamber2' => $data["trchamber2"], 'chamber3' => $data["trchamber3"], 'chamber4' => $data["trchamber4"], 'chamber5' => $data["trchamber5"], 'chamber6' => $data["trchamber6"], 'chamber7' => $data["trchamber7"], 'chamber8' => $data["trchamber8"], 'chamber9' => $data["trchamber9"]);

		$result = $this->nakliye_model->update_trchamber($savedata);

		echo json_encode($result);

	}

	public function foreign_freight_chamber_update()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();

		$savedata = array('chamber1' => $data["foreignchamber1"], 'chamber2' => $data["foreignchamber2"], 'chamber3' => $data["foreignchamber3"], 'chamber4' => $data["foreignchamber4"], 'chamber5' => $data["foreignchamber5"], 'chamber6' => $data["foreignchamber6"], 'chamber7' => $data["foreignchamber7"], 'chamber8' => $data["foreignchamber8"], 'chamber9' => $data["foreignchamber9"]);

		$result = $this->nakliye_model->update_foreign_chamber($savedata);

		echo json_encode($result);

	}

	public function foreign_pass_update()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();

		$savedata = array('chamber1' => $data["foreignpass1"], 'chamber2' => $data["foreignpass2"], 'chamber3' => $data["foreignpass3"]);

		$result = $this->nakliye_model->update_foreignpass($savedata);

		echo json_encode($result);

	}

	public function editAssosiation()

	{

		$this->load->helper('url');

		$this->load->helper('form');

		$assosiation = $this->nakliye_model->get_assosiation();

		$this->load->view('header',$assosiation);

		$this->load->view('left_sidebar');

		$this->load->view('edit_assosiation');

		$this->load->view('footer');

	}

	public function assosiation_update()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();

		$result = $this->nakliye_model->update_assosiation($data);

		echo json_encode($result);

	}

	public function editcovertime()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$this->load->helper('url');

		$this->load->helper('form');

		$impcovertime = $this->nakliye_model->get_covertime("imp");

		$expcovertime = $this->nakliye_model->get_covertime('exp');

		$view = array('impcovertime' => $impcovertime, 'expcovertime' => $expcovertime);

 		$this->load->view('header',$view);

		$this->load->view('left_sidebar');

		$this->load->view('edit_covertime');

		$this->load->view('footer');

	}

	public function impcovertime_update()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();

		$result = $this->nakliye_model->update_impcovertime($data);

		echo json_encode($result);

	}

	public function expcovertime_update()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();

		$result = $this->nakliye_model->update_expcovertime($data);

		echo json_encode($result);

	}

	public function sonucKaydet()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

    	$sil = array('id','duration','cargoton','cargotype','supervisioneuro','agencyeuro','agencyovertimeeuro','port','expImp','tarih','vesselname','flagname','nrt','grt','cargo','aciklama1','aciklama2','total','totalPlus','ekleyen');

    	$sil2 = array('portdues_2','sanitarydues_2','lightdues_2','gtf_fee_2','pilotaj_2','tugboat_2','tugovertime_2','mooring_2','warfage_2','garbage_2','notarial_2','custom_overtime_2','immigration_2','motorlunch_2','anchorage_2','agencyovertime_2','chamber_2','assosiation_2','petties_2','taxihire_2','phonecalls_2','fotocopies_2','supervision_2','agency_2','customFiyat118','customFiyat119','customFiyat120','customFiyat121','customFiyat122','customFiyat123','customFiyat124','customFiyat125','customFiyat126','customFiyat127','customAciklama118','customAciklama119','customAciklama120','customAciklama121','customAciklama122','customAciklama123','customAciklama124','customAciklama125','customAciklama126','customAciklama127');

		$data = $this->input->post();

		$adimlar = $data;		

		

		for ($i=0; $i < 20; $i++) { 

			unset($adimlar[$sil[$i]]);

		}

		for ($j=0; $j < 42; $j++) { 

			unset($data[$sil2[$j]]);

		}

		$data["jsondata"] = json_encode($adimlar);

		$result = $this->nakliye_model->save_data($data);

		echo $result;

	}

	public function sonucGuncelle()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();		

		$sil = array('id','duration','cargoton','cargotype','supervisioneuro','agencyeuro','agencyovertimeeuro','port','expImp','tarih','vesselname','flagname','nrt','grt','cargo','aciklama1','aciklama2','total','totalPlus','useful_info','guncelleyen');

		$sil2 = array('portdues_2','sanitarydues_2','lightdues_2','gtf_fee_2','pilotaj_2','tugboat_2','tugovertime_2','mooring_2','warfage_2','garbage_2','notarial_2','custom_overtime_2','immigration_2','motorlunch_2','anchorage_2','agencyovertime_2','chamber_2','assosiation_2','petties_2','taxihire_2','phonecalls_2','fotocopies_2','supervision_2','agency_2','customFiyat114','customFiyat115','customFiyat116','customFiyat117','customFiyat118','customFiyat119','customFiyat120','customFiyat121','customFiyat122','customFiyat123','customFiyat124','customFiyat125','customFiyat126','customFiyat127','customAciklama114','customAciklama115','customAciklama116','customAciklama117','customAciklama118','customAciklama119','customAciklama120','customAciklama121','customAciklama122','customAciklama123','customAciklama124','customAciklama125','customAciklama126','customAciklama127');
		
		$adimlar = $data;		

		for ($i=0; $i < count($sil); $i++) { 

			unset($adimlar[$sil[$i]]);

		}

		for ($j=0; $j < count($sil2); $j++) { 

			unset($data[$sil2[$j]]);

		}

		$data["jsondata"] = json_encode($adimlar);

		$result = $this->nakliye_model->update_data($data);

		echo $result;

	}

	public function editAgency()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$this->load->helper('url');

		$this->load->helper('form');

		$agency = $this->nakliye_model->get_agency();

		$this->load->view('header',$agency);

 		$this->load->view('header');

		$this->load->view('left_sidebar');

		$this->load->view('edit_agency');

		$this->load->view('footer');

	}

	public function agency_update()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();

		$result = $this->nakliye_model->update_agency($data);

		echo json_encode($result);

	}

	public function headinfo_update()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();

		//echo json_encode($data);

		$result = $this->nakliye_model->update_headinfo($data);

		echo json_encode($result);

	}

	public function fooinfo_update()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();

		//echo json_encode($data);

		$result = $this->nakliye_model->update_fooinfo($data);

		echo json_encode($result);

	}

	public function bulk_cargo_type_update()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();

		$result = $this->nakliye_model->update_bulk_cargo_type($data);

		echo json_encode($result);

	}

	public function view_proforma()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$get = $this->input->get();

		$single = $this->nakliye_model->get_single_proforma($get["id"]);

		$defaultusefulinfo = $this->nakliye_model->get_notariel();

		$headandfooinfo = $this->nakliye_model->get_headandfooinfo();

		$headandfooinfo->fooinfo = str_replace("@user_name@",$this->session->userdata('user_name'),$headandfooinfo->fooinfo);

		$view_info = array('headinfo' => $headandfooinfo->headinfo,'fooinfo' => $headandfooinfo->fooinfo,'defaultusefulinfo' => $defaultusefulinfo->defaultusefulinfo);

		$single["user_name"] = $this->session->userdata('user_name');

		$data = array('data' => $single);

		$this->load->helper('form');

		$this->load->helper('url');

		$this->load->view('header',$data);

		$this->load->view('left_sidebar');

		$this->load->view('view_proforma',$view_info);

		$this->load->view('footer');

	}

	public function oncekiSorgular()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$gemiadilist = array();

		$tarihlist = array();

		$list = $this->nakliye_model->get_proformalist();

		$data = array('data' => $list);

		$this->load->helper('form');

		$this->load->helper('url');

		$this->load->view('header',$data);

		$this->load->view('left_sidebar');

		$this->load->view('proforma_list');

		$this->load->view('footer');

	}
	public function oncekiSorgular2_get()

	{
		$data = $this->nakliye_model->get_proformalist2();
        echo json_encode($data);
	}
	public function oncekiSorgular2()

	{
		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$this->load->helper('form');

		$this->load->helper('url');

		$this->load->view('header');

		$this->load->view('left_sidebar');

		$this->load->view('proforma_list_dt');
	}	

	public function giris()

	{

		$this->load->view('header');

		$this->load->view('left_sidebar');

		$this->load->view('giris');

		$this->load->view('footer');

	}

	public function cikis()

	{

		$this->session->sess_destroy();

		redirect('Nakliye/giris', 'refresh');

	}

	public function giris_yap()

	{

		$data = $this->input->post();

		$data["password"] = md5($data["password"]);

		$result = $this->nakliye_model->login_kontrol($data);

		$total = count((array)$result);

		if($total != 0) {

			$this->session->login = 1;

			$this->session->set_userdata(array(

				'user_role' => $result->role,

			    'user_name' => $result->name,

			));

			echo "true";

		} else {

			$this->session->login = 0;

			echo "false";

		}

	}

	public function headandfooinfo()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$this->load->helper('url');

		$this->load->helper('form');

		$headandfooinfo = $this->nakliye_model->get_headandfooinfo();

		$view_info = array('headinfo' => $headandfooinfo->headinfo,'fooinfo' => $headandfooinfo->fooinfo);

		$this->load->view('header');

		//$this->load->view('header');

		$this->load->view('left_sidebar');

		$this->load->view('edit_headandfooinfo',$view_info);

		$this->load->view('footer');

	}

	public function editBulk_cargo_type()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$this->load->helper('form');

		$this->load->helper('url');

		$get_result_bulk_cargo_type = $this->nakliye_model->get_bulk_cargo_type();

		$bulk_cargo_type["bulk_cargo_type"] = $get_result_bulk_cargo_type;

		$this->load->view('header');

		$this->load->view('left_sidebar');

		$this->load->view('edit_bulk_cargo_type',$bulk_cargo_type);

		$this->load->view('footer');

	}

	public function kullanicilar(){

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

    	if ($this->session->userdata('user_role') != '1')

    		redirect('Nakliye/', 'refresh');

		$get_users = $this->nakliye_model->get_users();

		$get_users_db["get_users"] = $get_users;

		$this->load->helper('form');

		$this->load->helper('url');

		$this->load->view('header');

		$this->load->view('left_sidebar');

		$this->load->view('kullanicilar',$get_users_db);

		$this->load->view('footer');

	}

	public function create_users()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();

		$data["password"] = md5($data["password"]);

		$result = $this->nakliye_model->create_users($data);

		echo json_encode($result);

	}

	public function delete_users()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();

		$result = $this->nakliye_model->delete_users($data["id"]);

		echo json_encode($data);

	}

	public function mail_kontrol(){

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

    	$data = $this->input->post();

		$result = $this->nakliye_model->mail_kontrol($data["email"]);

		echo $result->count;

	}

	public function get_single_user(){

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

    	$data = $this->input->post();

		$result = $this->nakliye_model->get_single_user($data["id"]);

		echo json_encode($result);

	}

	public function update_users()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();

		if(!empty($data["password"])){

			$data["password"] = md5($data["password"]);

		} else {

			unset($data["password"]);

		}		

		$result = $this->nakliye_model->update_users($data);

		echo json_encode($result);

	}

	public function editAliaga(){

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

    	$result = $this->nakliye_model->get_aliagatarife();

		$this->load->helper('form');

		$this->load->helper('url');

		$this->load->view('header');

		$this->load->view('left_sidebar');

		$this->load->view('edit_aliaga',$result);

		$this->load->view('footer');

	}

	public function update_aliagatarife()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();	

		$result = $this->nakliye_model->update_aliagatarife($data);

		echo json_encode($result);

	}

	public function editIzmir(){

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

    	$result = $this->nakliye_model->get_izmirtarife();

		$this->load->helper('form');

		$this->load->helper('url');

		$this->load->view('header');

		$this->load->view('left_sidebar');

		$this->load->view('edit_izmir',$result);

		$this->load->view('footer');

	}

	public function update_izmirtarife()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();	

		$result = $this->nakliye_model->update_izmirtarife($data);

		echo json_encode($result);

	}

	public function delete_proforma()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();

		$result = $this->nakliye_model->delete_proforma($data["id"]);
			
		echo json_encode($result);

	}
	public function editGtf_Series()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$this->load->helper('form');

		$this->load->helper('url');

		$view_gtf_series = $this->nakliye_model->get_gtf_series();

		$view = array('gtf_series' => $view_gtf_series);

		$this->load->view('header',$view);

		$this->load->view('left_sidebar');

		$this->load->view('edit_gtf_series.php');

		$this->load->view('footer');

	}

	public function gtf_series_update()

	{

		if (empty($this->session->login))

    		redirect('Nakliye/giris', 'refresh');

		$data = $this->input->post();

		$savedata = array('gtf_fee1' => $data["gtf_fee1"], 'gtf_fee2' => $data["gtf_fee2"], 'gtf_fee3' => $data["gtf_fee3"], 'gtf_fee4' => $data["gtf_fee4"], 'gtf_fee5' => $data["gtf_fee5"], 'gtf_fee6' => $data["gtf_fee6"], 'gtf_fee7' => $data["gtf_fee7"], 'gtf_fee8' => $data["gtf_fee8"], 'gtf_fee9' => $data["gtf_fee9"], 'gtf_fee10' => $data["gtf_fee10"], 'gtf_fee11' => $data["gtf_fee11"], 'gtf_fee12' => $data["gtf_fee12"], 'gtf_fee13' => $data["gtf_fee13"], 'gtf_fee14' => $data["gtf_fee14"], 'gtf_fee15' => $data["gtf_fee15"], 'gtf_fee16' => $data["gtf_fee16"], 'gtf_fee17' => $data["gtf_fee17"], 'gtf_fee18' => $data["gtf_fee18"]);

		$result = $this->nakliye_model->update_gtf_series($savedata);

		echo json_encode($result);

	}

}