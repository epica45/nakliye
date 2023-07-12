<?php 

defined('BASEPATH') OR exit('No direct script access allowed');



class Nakliye_Model extends CI_model {

	public function get_izmir_aciklama() {

		return $query = $this->db->select('*')->from("izmir_aciklama")->get()->row();

	}

	public function update_izmir_aciklama($val)

	{

		$this->db->update('izmir_aciklama',$val);

	}

	public function get_port_dues() {

		return $query = $this->db->select('*')->from("dues_series")->get()->row();

	}

	public function update_port_dues($val)

	{

		$this->db->where('id','1')->update('dues_series',$val);

	}

	public function get_garbage()

	{

		return $query = $this->db->select('*')->from("garbage")->get()->row();

	}

	public function update_garbage($val)

	{

		$this->db->where('id','1')->update('garbage',$val);

	}

	public function get_warfage()

	{

		return $query = $this->db->select('*')->from("warfage")->get()->row();

	}

	public function update_warfage($val)

	{

		$this->db->update('warfage',$val);

	}

	public function get_notariel()

	{

		return $query = $this->db->select('*')->from("notariel")->get()->row();

	}

	public function update_notariel($val)

	{

		$this->db->update('notariel',$val);

	}

	public function get_tr_chamber()

	{

		return $query = $this->db->select('*')->from("tr_freight_chamber")->get()->row();

	}

	public function update_trchamber($val)

	{

		$this->db->update('tr_freight_chamber',$val);

	}

	public function get_foreign_chamber()

	{	

		return $query = $this->db->select('*')->from("foreign_chamber")->get()->row();

	}

	public function update_foreign_chamber($val)

	{

		$this->db->update('foreign_chamber',$val);

	}

	public function get_foreignpass()

	{

		return $query = $this->db->select('*')->from('foreign_passenger')->get()->row();

	}

	public function update_foreignpass($val)

	{

		$this->db->update('foreign_passenger',$val);

	}

	public function get_covertime($durum)

	{

		return $query = $this->db->select('*')->from('custom_overtime')->where('durum',$durum)->get()->row();

	}

	public function get_assosiation()

	{

		return $query = $this->db->select('*')->from('assosiation')->get()->row();

	}

	public function update_assosiation($val)

	{

		$this->db->update('assosiation',$val);

	}

	public function update_impcovertime($val)

	{

		$this->db->where('durum','imp')->update('custom_overtime',$val);

	}

	public function update_expcovertime($val)

	{

		$this->db->where('durum','exp')->update('custom_overtime',$val);

	}

	public function get_agency()

	{

		return $query = $this->db->select('*')->from('agency_services')->get()->row();

	}

	public function update_agency($val)

	{

		$this->db->update('agency_services',$val);

	}

	public function save_data($val)

	{

		$this->db->insert('data', $val);

		return $result = $this->db->insert_id(); 

	}

	public function update_data($val)

	{

		$sonuc = $this->db->where('id',$val["id"])->update('data',$val);

	}

	public function get_faturalist()

	{

		return $query = $this->db->select('*')->from('data')->order_by('id','DESC')->get()->result();


	}


	public function get_faturalist2()

	{

		return $query = $this->db->select('id,tarih,vesselname,duration,flagname,nrt,grt,cargo,ekleyen,guncelleyen')->from('data')->get()->result();

	}

	public function get_single_fatura($val)

	{

		return $query = $this->db->select('*')->from('data')->where('id',$val)->get()->result();

	}

	public function get_headandfooinfo()

	{

		return $query = $this->db->select('*')->from('headandfooinfo')->where('id',1)->get()->row();

	}

	public function update_headinfo($val)

	{

		$sonuc = $this->db->where('id',1)->update('headandfooinfo',$val);

	}

	public function update_fooinfo($val)

	{

		$sonuc = $this->db->where('id',1)->update('headandfooinfo',$val);

	}

	public function update_bulk_cargo_type($val)

	{

		$sonuc = $this->db->where('id',1)->update('bulk_cargo_type',$val);

	}

	public function get_bulk_cargo_type()

	{

		return $query = $this->db->select('*')->from('bulk_cargo_type')->where('id',1)->get()->row();

	}

	public function create_users($val)

	{

		$this->db->insert('users', $val);

		return $result = $this->db->insert_id(); 

	}

	public function get_users()

	{

		return $query = $this->db->select('*')->from('users')->get()->result();					

	}

	public function delete_users($id)

	{

		$result = $this->db->where('id',$id)->delete('users');

		return $result; 

	}

	public function mail_kontrol($mail)

	{

		return $query = $this->db->select('COUNT(*) as count')->from('users')->where('email',$mail)->get()->row();					

	}

	public function get_single_user($id)

	{

		return $query = $this->db->select('*')->from('users')->where('id',$id)->get()->row();	

	}

	public function update_users($val)

	{

		$this->db->where('id',$val["id"])->update('users',$val);

	}

	public function login_kontrol($val)

	{

		//$query_count = $this->db->select('COUNT(*) as count')->from('users')->where('email',$val["email"])->where('password',$val["password"])->get()->row();

		return $query_user = $this->db->select('*')->from('users')->where('email',$val["email"])->where('password',$val["password"])->get()->row();

	}

	public function get_aliagatarife()

	{

		return $query = $this->db->select('*')->from('aliaga_tarifesi')->get()->row();

	}

	public function update_aliagatarife($val)

	{

		$this->db->update('aliaga_tarifesi',$val);

	}

	public function get_izmirtarife()

	{

		return $query = $this->db->select('*')->from('izmir_tarifesi')->get()->row();

	}

	public function update_izmirtarife($val)

	{

		$this->db->update('izmir_tarifesi',$val);

	}

	public function delete_fatura($id)

	{

		$result = $this->db->where('id',$id)->delete('data');

		return $result; 

	}

	public function get_dovizler()

	{

		return $query = $this->db->select('*')->from("dovizler")->get()->row();

	}

	public function update_dovizler($val)

	{

		$this->db->where('id','1')->update('dovizler',$val);

	}
	public function get_gtf_series()

	{

		return $query = $this->db->select('*')->from("gtf_series")->get()->row();

	}

	public function update_gtf_series($val)

	{
		return $query = $this->db->update('gtf_series',$val);

	}

}

?>