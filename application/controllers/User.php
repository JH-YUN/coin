<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{
    public function mypage()
    {
        if (!$this->session->userdata('is_login')) {
            $this->session->set_flashdata('msg', '로그인이 필요한 서비스입니다.');
            redirect('/auth/login');
        }
        $this->load->helper('time_cut');
        $this->load->model('user_model');
        $user=$this->user_model->mypage();
        $myreply=$this->user_model->myreply_count();
        $mytopic=$this->user_model->mytopic_count();
        $this->_head();
        $this->load->view('mypage', array('user'=>$user,'mytopic'=>$mytopic,'myreply'=>$myreply));
        $this->_footer();
    }
    public function mytopic($page)
    {
        if (!$this->session->userdata('is_login')) {
            $this->session->set_flashdata('msg', '로그인이 필요한 서비스입니다.');
            redirect('/auth/login');
        }
        $this->load->model('User_model');
        $this->load->library('pagination');
        $list=20;
        $mytopic=$this->User_model->mytopic($page, $list);
        $total_topic=$this->User_model->mytopic_count();//모든 게시물의 개수
        $config['total_rows']=$total_topic;
        $config['per_page']=$list;
        $config['last_url']=site_url("user/mytopic/$total_topic");
        $config['base_url']=site_url("user/mytopic");
        $config['first_url']=site_url("user/mytopic/1");
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $pagination=$this->pagination->create_links();

        $this->_head();
        $this->load->view('mytopic', array('topic'=>$mytopic,'pagination'=>$pagination));
        $this->_footer();
    }
    public function update_profile()
    {
        $this->load->model('user_model');
        $info=htmlspecialchars($this->input->post('user_info'), ENT_NOQUOTES);

        $config['upload_path']=FCPATH."/static/user_img/";
        $config['allowed_types']='gif|jpg|png';
        $config['file_name']="{$this->session->userdata('id')}.jpg";
        $config['max_size']=2048;
        $config['overwrite']=true;
        $this->load->library('upload', $config);
        print_r($this->input->post('user_img'));
        print_r($_FILES);
        if (empty($_FILES['user_img']['type'])) {
            $this->user_model->update_profile($info);
        //redirect('user/mypage');
        } else {
            if (!$this->upload->do_upload('user_img')) {
                $this->session->set_flashdata('err_msg', $this->upload->display_errors('', ''));
                redirect('user/mypage');
            } else {
                $img_name=$this->upload->data('file_name');
                $config['image_library'] = 'gd2';
                $config['source_image'] = FCPATH."/static/user_img/$img_name";
                $config['width']=100;
                $config['height']=100;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $this->user_model->update_profile($info);
                redirect('user/mypage');
            }
        }
    }
    public function userprofile()
    {
      $this->load->model('user_model');
      $this->load->helper('time_cut');
      $user=$this->user_model->get_userprofile($this->input->get('user'));
      $topic=$this->user_model->topic_count($this->input->get('user'));
      $reply=$this->user_model->reply_count($this->input->get('user'));
      $this->_head();
      $this->load->view('userprofile',array('user'=>$user,'topic'=>$topic,'reply'=>$reply));
      $this->_footer();

    }
}
// }
