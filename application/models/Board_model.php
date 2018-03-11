<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Board_model extends CI_Model{
  function __construct(){
    parent::__construct();
  }
  public function read($id)
  {
    //return $this->db->get_where('topic',array('id'=>$id))->row();
    $this->db->select('topic.id as t_id,notice,topic.title,topic.description,topic.created as t_created,topic.hit,user.id as u_id,user.email,user.created as u_created,user.name');
    $this->db->from('topic');
    $this->db->join('user','topic.user_id=user.id','left');
    $this->db->where(array('topic.id'=>$id));
    return $this->db->get()->row();
  }
  public function get($page,$list)//현재 page와 page에 표현될 list의 개수, ci 페이지네이션
  {
    $this->db->select('topic.id as t_id,notice,topic.title,topic.description,topic.created as t_created,topic.hit,user.id as u_id,user.email,user.created as u_created,user.name');
    $this->db->from('topic');
    $this->db->join('user','topic.user_id=user.id','left');
    // $this->db->limit($list,$page);
    $this->db->limit($list,($page-1)*$list);
    $this->db->order_by('topic.created','DESC');
    return $this->db->get()->result();
  }
  public function get_php($page,$list)//현재 page와 page에 표현될 list의 개수, 순수 php 페이지네이션
  {
    $this->db->select('topic.id as t_id,notice,topic.title,topic.description,topic.created as t_created,topic.hit,user.id as u_id,user.email,user.created as u_created,user.name');
    $this->db->from('topic');
    $this->db->join('user','topic.user_id=user.id','left');
    $this->db->limit($list,($page-1)*$list); //순수 php
    $this->db->order_by('topic.created','DESC');
    return $this->db->get()->result();
  }
  public function write($topic)
  {
    $this->db->set('created','now()',false);
    $this->db->insert('topic',array('title'=>$topic['title'],'description'=>$topic['desc'],'user_id'=>$topic['user_id']));
    return $this->db->insert_id();
  }
  public function hits($id)//조회수 증가
  {
    $this->db->select('hit');
    $topic=$this->db->get_where('topic',array('id'=>$id))->row();
    $this->db->set('hit',$topic->hit+1);
    $this->db->where(array('id'=>$id));
    $this->db->update('topic');
  }
  public function read_reply($id)
  {
    $this->db->select('reply.id as r_id, reply.description, reply.created as r_created, reply.topic_id, user.id as u_id, user.name, user.created as u_created');
    $this->db->from('reply');
    $this->db->join('user','reply.user_id=user.id','left');
    $this->db->where('reply.topic_id',$id);
    return $this->db->get()->result();
  }
  public function write_reply($reply)
  {
    $this->db->set('created','now()',false);
    $this->db->insert('reply',array('user_id'=>$reply->user_id,'topic_id'=>$reply->topic_id,'description'=>$reply->desc));
  }
  public function get_count()
  {
    return $this->db->count_all('topic');
  }
  public function get_notice($page,$list)
  {
    $this->db->select('topic.id as t_id,notice,topic.title,topic.description,topic.created as t_created,topic.hit,user.id as u_id,user.email,user.created as u_created,user.name');
    $this->db->from('topic');
    $this->db->join('user','topic.user_id=user.id','left');
    $this->db->where('topic.notice',true);
    // $this->db->limit($list,$page);
    $this->db->limit($list,($page-1)*$list);
    $this->db->order_by('topic.created','DESC');
    return $this->db->get()->result();
  }
  public function get_notice_count()
  {
    $this->db->where('notice',true);
    return $this->db->get('topic')->num_rows();
    //return $this->db->count_all('topic');
  }
}
?>
