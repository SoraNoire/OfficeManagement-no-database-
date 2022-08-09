<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        chekAksesModule();
        $this->load->model('M_menu');
    }

    function data(){
        $table      = 'abe_menu';
        $primaryKey = 'id_menu';
        $columns    = array(
            array('db' => 'id_menu', 'dt' => 'id_menu'),
            array('db' => 'menu', 'dt' => 'nama'),
            array(
                'db' => 'sub_menu',
                'dt' => 'jenis',
                'formatter' => function($parent){
                if ($parent == 0){
                        return 'Menu Utama';
                    }else{
                        $parent2 = $this->db->get_where("abe_menu",array("id_menu"=>$parent))->row_array();
                        return $parent2["menu"];
                    } 
                }),
            array(
                'db' => 'id_menu',
                'dt' => 'aksi',
                'formatter' => function($d){
                    return "<button title=\"edit menu\" class=\"btn btn-xs btn-warning\" onclick=\"edit_menu('$d')\"><i class=\"glyphicon glyphicon-pencil\"></i></button> <button title=\"delete menu\" class=\"btn btn-xs btn-danger\" onclick=\"delete_menu('$d')\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
                })
            );
        $sql_details = array(
            'user'  => $this->db->username,
            'pass'  => $this->db->password,
            'db'    => $this->db->database,
            'host'  => $this->db->hostname
            );

        echo json_encode(
            SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
            );
    }

    public function index()
    {
        $this->template->load('template','admin/menu');
    }

    public function ajax_add()
    {
        $data = array(
                'menu'      => $this->input->post('judul_menu'),
                'link'      => $this->input->post('link'),
                'sub_menu'  => $this->input->post('parent'),
                'icon'      => $this->input->post('icon'),
            );
        $insert = $this->M_menu->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_edit($id)
    {
        $data = $this->M_menu->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {
        $data = array(
                'menu'      => $this->input->post('judul_menu'),
                'link'      => $this->input->post('link'),
                'sub_menu'  => $this->input->post('parent'),
                'icon'      => $this->input->post('icon'),
            );
        $update = $this->M_menu->update(array('id_menu' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id)
    {
        $this->M_menu->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function add_rule()
    {
        $this->template->load('template','admin/pengguna_rule');
    }

    public  function modul()
    {
        $user      = $_GET['user'];
        echo "<table class='table table-bordered table-striped'>
              <thead>
                <tr>
                  <th width='10'>No</th>
                  <th>Nama Modul</th>
                  <th>Link</th>
                  <th width='100'>Hak Akses</th>
                </tr>";
        $menu = $this->db->get('abe_menu');
        $no = 1;
        foreach ($menu->result() as $row) {
            echo"<tr>
                <td>$no</td>
                <td>". strtoupper($row->menu) ."</td>
                <td>$row->link</td>
                <td align='center'><input type='checkbox'";
            $this->chek_akses($user, $row->id_menu);
            echo " onclick='addRule($row->id_menu)'></td>
                </tr>";
            $no++;
        }

        echo "</thead>
            </table>";
    }

    public function chek_akses($user, $id_menu)
    {
        $data       = array('id_level_user'=>$user,'id_menu'=>$id_menu);
        $chek       = $this->db->get_where('abe_user_rule',$data);
        if($chek->num_rows() > 0){
            echo " checked";
        }
    }

    public function addrule()
    {
        $user       = $_GET['user'];
        $id_modul   = $_GET['id_modul'];
        $data       = array('id_level_user'=>$user,'id_menu'=>$id_modul);
        $chek       = $this->db->get_where('abe_user_rule',$data);
        if($chek->num_rows() < 1){
            $this->db->insert('abe_user_rule',$data);
        }else{
            $this->db->where('id_menu',$id_modul);
            $this->db->where('id_level_user',$user);
            $this->db->delete('abe_user_rule');
        }
    }
}
