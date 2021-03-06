<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Asetmasuk extends CI_Controller
{

    

    public function __construct()
    {
        parent::__construct();
        //$this->permission->is_logged_in();
        //load model
        $this->load->helper('url');
        $this->load->helper('form');
        
        $this->load->model('Aset_model', 'asetm');
        $this->load->library('form_validation');
        //$this->load->model('leave_model');
    }



    public function index ()
    {   
        $data['title'] = 'Daftar Aset Masuk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
        $this->load->library('session');
         $data['asetmasuk'] = $this->asetm->getAsetMasuk();
         
        
       
        $this->load->view('user/asetmasuk', $data);
     

    }


    
   


    public function delete()
    {   $this->load->model('Aset_model');
        $id = $this->uri->segment(3);
        
        if (empty($id))
        {
            $this->session->set_flashdata('message',  '<div class="alert alert-danger" role="alert">Gagal hapus data aset masuk</div>');
        redirect( base_url() . 'asetmasuk'); 
        }
                
        $a = $this->asetm->get_astmsk_by_id($id);
        
        $this->asetm->delete_astmsk($id);   
             $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert">Berhasil hapus data aset masuk</div>');
        redirect( base_url() . 'asetmasuk');        
    }


  


    

}