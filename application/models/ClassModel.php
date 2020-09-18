<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClassModel extends CI_Model {

	public function findBySchool($idSchool, $schoolYear) {

		$this->db->select("
			ANO_LETIVO.DS_ANO_LETIVO, 
			TURMA.ID_TURMA,
			TURMA.DS_TURMA,
			TURNOS.DS_TURNO,
			TURMA.ID_UNIDADE,
			STATUS_TURMA.DS_STATUS,
			ETAPAS_ENSINO.DS_ETAPA,
			SUB_PERIODO.DS_SUB_PERIODO,
			UNIDADE_ENSINO_00.NOME_ESCOLA
		");
		$this->db->from("TURMA");
		$this->db->join("ANO_LETIVO", "ANO_LETIVO.ID_ANO_LETIVO = TURMA.ID_ANO_LETIVO");
    $this->db->join("TURNOS", "TURNOS.ID_TURNO = TURMA.ID_TURNO");
    $this->db->join("STATUS_TURMA", "STATUS_TURMA.ID_STATUS = TURMA.STATUS");
    $this->db->join("SUB_PERIODO", "SUB_PERIODO.ID_SUB_PERIODO = TURMA.ID_SUB_PERIODO");
    $this->db->join("ETAPAS_ENSINO", "ETAPAS_ENSINO.ID_ETAPA = TURMA.ETAPA_ENSINO");
    $this->db->join("UNIDADE_ENSINO_00", "UNIDADE_ENSINO_00.ID_ESCOLA = TURMA.ID_UNIDADE");
    $this->db->where("ANO_LETIVO.ID_ANO_LETIVO", $schoolYear);
		$this->db->where("TURMA.ID_UNIDADE", $idSchool);
		
		$classes = $this->db->get()->result();

		return $classes;

	}

}

?>
