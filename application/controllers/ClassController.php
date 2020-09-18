<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'libraries/fpdf182/fpdf.php');

class ClassController extends CI_Controller {

	private $pdf;

	public function __construct() {
		parent::__construct();

		$this->pdf = new FPDF("P","pt","A4");

		$this->load->model("ClassModel", "class");
		$this->load->model("CompanyModel", "company");
	}


	public function index($schoolId, $schoolYear) {

		
		$classes = $this->class->findBySchool($schoolId, $schoolYear);
		
		if (!$classes) { 

			echo json_encode(["error"=> "Classes not found"]);

			return;

		}
		
		$companyInformations = $this->company->findOne();
		

		$data['pdf'] = $this->pdf;
    $data['classes'] = $classes;
    $data['company'] = $companyInformations;
		$data['school'] = $classes[0]->NOME_ESCOLA;
		
		$this->load->view("ClassView", $data);

		$this->pdf->Output("Turmas.pdf", "I");

		return;
		
	}

}


?>
