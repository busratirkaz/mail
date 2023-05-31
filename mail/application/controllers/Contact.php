<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
{
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('name', 'Ad', 'required');
    $this->form_validation->set_rules('email', 'E-posta', 'required|valid_email');
    $this->form_validation->set_rules('subject', 'Konu', 'required');
    $this->form_validation->set_rules('message', 'Açıklama', 'required');

    if ($this->form_validation->run() == FALSE) {
        // Hata durumunda
        $response['status'] = 'error';
        $response['message'] = validation_errors();
    } else {
        // Form doğru ise
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');

        // E-posta gönderme işlemi
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.office365.com', // SMTP sunucu adresi
            'smtp_port' => 587, // SMTP sunucu portu
            'smtp_user' => 'busra_ea_fb@hotmail.com', // E-posta hesabı
            'smtp_pass' => '19071997Bt.', // E-posta hesabı şifresi
            'mailtype' => 'html',
            'charset' => 'utf-8'
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($email, $name);
        $this->email->to('busra_ea_fb@hotmail.com'); // E-postanın gönderileceği adres
        $this->email->subject($subject);
        $this->email->message($message);
        
        if ($this->email->send()) {
            $response['status'] = 'success';
            $response['message'] = 'E-posta gönderildi!';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'E-posta gönderimi sırasında bir hata oluştu. Hata ayrıntıları: ' . $this->email->print_debugger();
        }
        
    }

    echo json_encode($response);
}

}
