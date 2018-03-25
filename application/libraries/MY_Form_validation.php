<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Form_validation extends CI_Form_validation
{
  /*
    해당 테이블의 필드에 동일 값이 존재하면 true
    is_unique()의 반대
  */
    public function in_DB($str, $field)
    {
      sscanf($field, '%[^.].%[^.]', $table, $field);
      return isset($this->CI->db)
        ? ($this->CI->db->limit(1)->get_where($table, array($field => $str))->num_rows() === 1)
        : FALSE;
    }
}
?>
