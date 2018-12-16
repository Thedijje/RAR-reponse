<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Response extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct() {
        parent::__construct();    
        // dd("hi") ;   
	}
	public function index()
	{
        //get incident id from database

        //get values of  from database

		$this->load->view('header');
		$this->load->view('index');
		$this->load->view('footer');
    }

    public function respond($incident_id){
        
        $input = $this->input->post();
        //get location values from the database
        $data['x_coord'] = '28.610981';
        $data['y_coord'] = '77.227434';

        $data['lat_to_go'] = '28.832648';
        $data['lon_to_go'] = '77.243499';
        // hit api
        // http://apis.mapmyindia.com/advancedmaps/v1/<licence_key>/route?start=28.111,77.111&destination=28.22,77.22&alternatives=true&with_advices=1

        $response = $input['response'];
        // exit($response);
        if($response == -2){
            //this emergency service is not responding, call another service
            $view = $this->load->view('no_response',$data,TRUE);
        }if($response == -1){
            //call another emergency vehicle, this one is not coming
            // echo "here";
            $view = $this->load->view('response_not_coming',$data,TRUE);
        }
        else if($response == 0){
            //leave now, call map api and send location to the front
            $view = $this->load->view('map_ui',$data,TRUE);
            // exit();
        }else if($response == 10){
            //store in db
            //call another response
            //wait for their response, if the responding time is less store in db and cancel the previous response team
        }else if($response == 30){
            //call another emergency team, wait for their response if the response team is 
        }
        echo json_encode(array('success'=>'true','view'=>$view));
        exit();
    }
    public function get_route(){

        $input = $this->input->post();
        // var_dump($input);
        //get location values from the database
        $my_lat = $input['my_lat'];
        $my_lon = $input['my_lon'];

        $dest_lat = $input['dest_lat'];
        $dest_lon = $input['dest_lon'];
        $curl = curl_init();

       

        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://apis.mapmyindia.com/advancedmaps/v1/j2xrsx5hpruvfbn9nrzj1jnx6i39ykhi/route?start=28.489631799999998,77.0916732&destination=28.832648,77.243499&alternatives=true&with_advices=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
        ),
        CURLOPT_POSTREDIR   => 3,
        CURLOPT_FOLLOWLOCATION=> TRUE,
        ));
        // curl_setopt($curl, CURLOPT_POSTREDIR, 3);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        echo $response;
        }
        exit();
    }
}
