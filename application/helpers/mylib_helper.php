<?php

function cmb_dinamis($name, $table,$field, $pk, $selected = null, $extra = null)
	{
		$ci =& get_instance();
		$cmb = "<select name='$name' class='form-control' $extra>";
		$data = $ci->db->get($table)->result();
		foreach ($data as $row) {
			$cmb .="<option value='".$row->$pk."'";
			$cmb .= $selected==$row->$pk?'selected':'';
			$cmb .=">".$row->$field."</option>";
		}
		$cmb .= "</select>";
		return $cmb;
	}

function terbilang($x)
	{
	  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	  if ($x < 12)
	    return " " . $abil[$x];
	  elseif ($x < 20)
	    return Terbilang($x - 10) . "belas";
	  elseif ($x < 100)
	    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
	  elseif ($x < 200)
	    return " seratus" . Terbilang($x - 100);
	  elseif ($x < 1000)
	    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
	  elseif ($x < 2000)
	    return " seribu" . Terbilang($x - 1000);
	  elseif ($x < 1000000)
	    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
	  elseif ($x < 1000000000)
	    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
	}

function TanggalIndo($date){
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
 
	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl   = substr($date, 8, 2);
 
	$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
	return($result);
}

function chekAksesModule2(){
	$ci =& get_instance();

	$controller = $ci->uri->segment(1);
	$method		= $ci->uri->segment(2);
	$method2	= $ci->uri->segment(3);
	$method3	= $ci->uri->segment(4);

	if(empty($method2)){

		if(empty($method)){
			$url = $controller;
		}else{
			$url = $controller.'/'.$method;
		}

		$menu = $ci->db->get_where('abe_menu',array('link'=>$url))->row_array();
		$level_user = $ci->session->userdata('level');
		if(!empty($level_user)){
			$chek = $ci->db->get_where('abe_user_rule',array('id_level_user'=>$level_user,'id_menu'=>$menu['id']));
			if($chek->num_rows() == 0){
				//echo "tidak boleh diakses";
				redirect('auth/akses');
			}
		}else{
			redirect('auth');
		}
	}

	}

function chekAksesModule(){
	$ci =& get_instance();

	$controller = $ci->uri->segment(1);
	$method		= $ci->uri->segment(2);
	$method2	= $ci->uri->segment(3);
	$method3	= $ci->uri->segment(4);
	$level_user = $ci->session->userdata('id_karyawan');

	if(!empty($level_user)){
		if(empty($method2)){
			if(empty($method)){
				$url = $controller;
			}else{
				$url = $controller.'/'.$method;
			}
			$menu = $ci->db->get_where('abe_menu',array('link'=>$url))->row_array();
			$chek = $ci->db->get_where('abe_user_rule',array('id_level_user'=>$level_user,'id_menu'=>$menu['id_menu']));
			if($chek->num_rows() == 0){
				//echo "tidak boleh diakses";
				redirect('auth/akses');
			}
		}
	}else{
		redirect('auth');
	}

	}
