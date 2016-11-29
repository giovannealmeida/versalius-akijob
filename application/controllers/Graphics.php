<?php

class Graphics extends CI_Controller {

    private $user_info;

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else {
            $this->load->model("Recommendation_model", 'recommendation');
            $this->load->model("Users_model", "users");
            $this->load->model("Subscription_model", "subs");
            $this->load->model("City_model", "city");
            $this->load->model("State_model", "state");

            $this->user_info["user_profile"] = $this->session->userdata('logged_in');
            $this->user_info['recommendations_positive'] = $this->recommendation->getRecommendationPositiveByUser($this->user_info["user_profile"]->id);
            $this->user_info['recommendations_negative'] = $this->recommendation->getRecommendationNegativeByUser($this->user_info["user_profile"]->id);
            $tier_balance = $this->user_info['recommendations_positive'] - $this->user_info['recommendations_negative'];
            $this->user_info["tier_img"] = $this->users->getTierImage($this->user_info["user_profile"]->id, $tier_balance);
            $this->user_info["premium_data"]["isPremium"] = $this->subs->isSubscribed($this->user_info["user_profile"]->id);
            $this->user_info["scripts"] = array(base_url("assets/js/page-highlight.js"));
        }
    }

    public function visitsGraphics($monthChosen, $yearChosen){
    		
    	$data = $this->user_info;
    	$data['typeGraphic'] = array(
	    	'Visitas'=>'Visitas',
	    	'Visitantes'=>'Visitantes'
		);	
    	$data['months'] = array(
    		'0'=>'',
    		'1' => "Janeiro",
			'2' => 'Fevereiro',
			'3' => 'Março',
			'4' => 'Abril',
			'5' => 'Maio',
			'6' => 'Junho',
			'7' => 'Julho',
			'8' => 'Agosto',
			'9' => 'Setembro',
			'10' => 'Outubro',
			'11' => 'Novembro',
			'12' => 'Dezembro',
		);
		$data['years'] = array(
			'0'=>'',
			'2016'=>"2016"
		);
		
		if($this->input->post() == NULL){
				$monthYear = array();
			$monthYear[0] = $monthChosen;
			$monthYear[1] = $yearChosen;
			if(($monthYear[0] <= 0) or ($monthYear[0] > date('t'))){
					
					$data['invalide_date'] = "Data inválida. Escolha uma data.";	
            		$this->load->view("_inc/header", $data);
            		$this->load->view("profile/menu");
            		$this->load->view("profile/graphics/visits_graphic");
            		$this->load->view("_inc/footer");
					return;
			}
				
		}
		else{
			echo "2";
			$monthYear = array();
			$monthYear[0] = $monthChosen;
			$monthYear[1] = $yearChosen;
		}
		
        if ($data['premium_data']['isPremium'] == NULL) {
            redirect('subscribe');
        } else {

            $this->load->model("Services_model", "services");
            $this->load->model("Visits_model", "visits");
            $data['services'] = $this->services->getServicesById($this->session->userdata('logged_in')->id);
            $data['all_services'] = $this->services->getServicesByUser($this->session->userdata('logged_in')->id);

            $total_visits = 0;
            $add_column_chart = 'data.addColumn("number", "Dia");';
            for ($i = 0; $i < count($data['all_services']); $i++) {
                $visits_service = $this->visits->getVisitsByService($data['all_services'][$i]->id);
                $data['all_services'][$i]->service_visits = $visits_service[0]->visit_service;
                $data['all_services'][$i]->visit_dates = $this->visits->getVisitDateByService($data['all_services'][$i]->id);
                $total_visits += $data['all_services'][$i]->service_visits;
                $add_column_chart = $add_column_chart . 'data.addColumn("number", "' . $data['all_services'][$i]->job . '");';
            }
            if(($data['all_services']) == NULL){
            	$data['no_service'] = "Não há estatísticas disponíveis, pois não há serviços cadastrados";	
            	$this->load->view("_inc/header", $data);
            	$this->load->view("profile/menu");
            	$this->load->view("profile/graphics/visits_graphic");
            	$this->load->view("_inc/footer");
            }
            else{
            	$data['all_services'][0]->total_visits = $total_visits;
            	$number_column_charts = substr_count($add_column_chart, ';', 0);
	            $row_charts = array();
	            for ($i = 0; $i < $number_column_charts; $i++) {
	                ${"column_charts$i"} = 0; //variavéis dinâmicas 
	            }
	            $data['scripts'] = array('https://www.gstatic.com/charts/loader.js',
	                'http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js'
	            );
	
	            $dayVisit = '';
	            $day = 1;
	            $day_current = NULL;
	
	            for ($iService = 0; $iService < count($data['all_services']); $iService++) {
	                $idService = $data['all_services'][$iService]->id;
	
	                for ($jDay = 1; $jDay <= date("t"); $jDay++) {
	                    $auxDayVisit = $this->visits->getCountVisitDayByService($idService, date('Y-m-d', mktime(0, 0, 0, $monthYear[0], $jDay, $monthYear[1])));
	                    if ($auxDayVisit[0]->count_visit_date != 0) {
	
	                        ${"column_charts$iService"} = $auxDayVisit[0]->count_visit_date;
	
	                        if (isset($row_charts[$jDay]) == false) {
	                            $row_charts[$jDay] = "[$jDay ";
	                            for ($col = 0; $col < $number_column_charts - 1; $col++) {
	
	                                if ($col == $iService) {
	                                    $row_charts[$jDay] = $row_charts[$jDay] . "," . ${"column_charts$col"};
	                                } else {
	                                    $row_charts[$jDay] = $row_charts[$jDay] . ",0";
	                                }
	                            }
	                            $row_charts[$jDay] = $row_charts[$jDay] . "],";
	                        } else {
	                            $count_comma = 0;
	                            for ($pos = 1; $pos < strlen($row_charts[$jDay]); $pos++) {
	                                if (strcmp($row_charts[$jDay][$pos], ",") == 0) {
	                                    $count_comma++;
	                                    if (strcmp($row_charts[$jDay][$pos + 1], "0") == 0) {
	                                        if ($count_comma == $iService + 1) {
	                                            $row_charts[$jDay][$pos + 1] = ${"column_charts$iService"};
	                                            break;
	                                        }
	                                    }
	                                }
	                            }
	                        }
	                    } else {
	                        if (isset($row_charts[$jDay]) == false) {
	                            $row_charts[$jDay] = "[$jDay";
	                            for ($col = 0; $col < $number_column_charts - 1; $col++) {
	                                $row_charts[$jDay] = $row_charts[$jDay] . ",0";
	                            }
	                            $row_charts[$jDay] = $row_charts[$jDay] . "],";
	                        }
	                    }
	                }
	            }
	
	            $add_row_charts = '';
	            for ($i = 1; $i < date("t"); $i++) {
	                $add_row_charts = $add_row_charts . $row_charts[$i];
	            }
				
				switch($monthYear[0]){
				case "1": $monthYear[0] = "Janeiro"; break;
				case "2": $monthYear[0] = "Fevereiro"; break;
				case "3": $monthYear[0] = "Março"; break;
				case "4": $monthYear[0] = "Abril"; break;
				case "5": $monthYear[0] = "Maio"; break;
				case "6": $monthYear[0] = "Junho"; break;
				case "7": $monthYear[0] = "Julho"; break;
				case "8": $monthYear[0] = "Agosto"; break;
				case "9": $monthYear[0] = "Setembro"; break;
				case "10": $monthYear[0] = "Outubro"; break;
				case "11": $monthYear[0] = "Novembro"; break;
				case "12": $monthYear[0] = "Dezembro"; break;
				default: $monthYear[0] = "Unknown"; break;
				}
				
	            $data['functions_scripts'] = array('  google.charts.load("current", {"packages":["line"]});
	      google.charts.setOnLoadCallback(drawChart);
	
	    function drawChart() {var data = new google.visualization.DataTable();
	      ' . $add_column_chart . '
	      data.addRows(
	        [' . $add_row_charts . ']
	      );
	
	      var options = {
	        chart: {
	          title: "Gráfico de Visitas diárias do mês de '.$monthYear[0].'",
	          subtitle: ""
	        },
	        width: 450,
	        height: 350,
	        vAxis:{
	        	title: "Visitas"
	        },
			legend: { position: "botton" }
	      };
		  options.legend = "bottom";
	
	      var chart = new google.charts.Line(document.getElementById("linechart_material"));
	
	      chart.draw(data,  google.charts.Line.convertOptions(options));
	      }');
	
	            $this->load->view("_inc/header", $data);
	            $this->load->view("profile/menu");
	            $this->load->view("profile/graphics/visits_graphic");
	            $this->load->view("_inc/footer");
	        }	
	    }
    }
	
	public function visitorsGraphics($monthChosen, $yearChosen){
		$data = $this->user_info;
    	$data['typeGraphic'] = array(
	    	'Visitas'=>'Visitas',
	    	'Visitantes'=>'Visitantes'
		);	
    	$data['months'] = array(
    		'0'=>'',
    		'1' => "Janeiro",
			'2' => 'Fevereiro',
			'3' => 'Março',
			'4' => 'Abril',
			'5' => 'Maio',
			'6' => 'Junho',
			'7' => 'Julho',
			'8' => 'Agosto',
			'9' => 'Setembro',
			'10' => 'Outubro',
			'11' => 'Novembro',
			'12' => 'Dezembro',
		);
		$data['years'] = array(
			'0'=>'',
			'2016'=>"2016"
		);
		
		$this->load->model("Services_model", "services");
		$this->load->model("Visits_model", "visits");
		$this->load->model("Users_model", "users");
		
		$data['all_services'] = $this->services->getServicesByUser($this->session->userdata('logged_in')->id);
		$total_services = count($data['all_services']); 
		for($iService=0; $iService<$total_services; $iService++){
			$data['visitors'] = $this->visits->getVisitorsByService($data['all_services'][$iService]->id);
		}
		
		 
		$this->load->view("_inc/header", $data);
	    $this->load->view("profile/menu");
	    $this->load->view("profile/graphics/visitors_graphic");
	    $this->load->view("_inc/footer");
	}
	
}