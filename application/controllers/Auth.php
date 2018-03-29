<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{
    public function login()
    {
        $returnURL=empty($this->input->get('returnURL'))? site_url('main') : $this->input->get('returnURL');//return URL의 유무 확인
        $this->_head();
        $this->load->view("login", array('returnURL'=>$returnURL));
        $this->_footer();
    }
    public function register()
    {
        $this->load->library("form_validation");
        // $this->form_validation->set_rules('register_email','이메일','required|is_unique[user.email]');
        // $this->form_validation->set_rules('register_password','비밀번호','required');
        // $this->form_validation->set_rules('register_password_verify','비밀번호 확인','required|matches[register_password]');
        // $this->form_validation->set_rules('register_name','닉네임','required|is_unique[user.name]|max_length[30]');
        $rules=array(
      array(
        'field'=>'email',
        'label'=>'이메일',
        'rules'=>'required|is_unique[user.email]',
        'errors'=>array(
                    'required'=>'이메일을 입력해주세요.',
                    'is_unique'=>'이미 있는 이메일입니다. 다른 이메일을 입력해주세요.'
                  )
                ),
      array(
        'field'=>'password',
        'label'=>'비밀번호',
        'rules'=>'required',
        'errors'=>array(
                    'required'=>'비밀번호를 입력해주세요.'
                  )
                ),
      array(
        'field'=>'password_verify',
        'label'=>'비밀번호 확인',
        'rules'=>'required|matches[password_verify]',
        'errors'=>array(
                    'required'=>'비밀번호 확인을 해주세요.',
                    'matches'=>'비밀번호와 비밀번호 확인의 값이 다릅니다.'
                  )
                ),
      array(
        'field'=>'name',
        'label'=>'닉네임',
        'rules'=>'required|is_unique[user.name]|max_length[30]',
        'errors'=>array(
                    'required'=>'별명을 입력해주세요.',
                    'is_unique'=>'이미 존재하는 닉네임입니다.',
                    'max_length'=>'너무 긴 닉네임입니다.'
                  )
                )
    );
        $this->form_validation->set_rules($rules);
        $this->_head();
        if ($this->form_validation->run()==false) {
            $this->load->view("register");
        } else {
            //디비에 회원 추가
            $pwd=password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            $user=array('email'=>$this->input->post('email'),
                'password'=>$pwd,
                'name'=>$this->input->post('name'));
            $this->load->model('user_model');
            $this->load->model('message_model');
            $welcome_id=$this->user_model->register($user);
            $this->message_model->welcome_message($welcome_id);
            $this->session->set_flashdata('msg', '가입을 축하합니다. 로그인 해주세요.');
            redirect('/auth/login');
        }
        $this->_footer();
    }
    public function confirm()  //로그인시 유저 검증
    {
        $this->load->model('user_model');
        $user=$this->user_model->confirm($this->input->post('email'))->row();
        if ($user->email==$this->input->post('email')&&
            password_verify($this->input->post('password'), $user->password)) {
            $this->session->set_userdata('is_login', true);
            $this->session->set_userdata('name', $user->name);
            $this->session->set_userdata('id', $user->id);
            redirect($this->input->get('returnURL'));
        } else {
            $this->session->set_flashdata('msg', '이메일과 비밀번호를 확인해주세요.');
            redirect('/auth/login');
        }
    }
    public function logout()
    {   $returnURL=empty($this->input->get('returnURL'))? site_url('main') : $this->input->get('returnURL');//return URL의 유무 확인
        $this->session->sess_destroy();
        redirect("$returnURL");
    }
}
