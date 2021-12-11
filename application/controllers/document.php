<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {

    function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in')){
            $this->load->model('document_model');
        }
    }
    
    function index($document_link){
        $this->download_file('assets/patient_documents/'.$document_link, $document_link);                    
        if($this->session->userdata('logged_in')){
            $this->download_file('assets/equipment_documents/'.$document_link, $document_link);                    
        } else {
            show_404();
        }
    }
    
    function download_file($path, $name){
        if(is_file($path)){
            $this->load->helper('file');
    
            header('Content-Type: '.get_mime_by_extension($path));  
            header('Content-Disposition: inline; filename="'.basename($name).'"');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: '.filesize($path));
        
            header('Connection: close');
            readfile($path); 
            die();
        }
    }
}