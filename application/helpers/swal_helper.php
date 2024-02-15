<?php

function tampil_alert($type,$title,$text){
  $CI =& get_instance();
  $data = array(
    'type'  => $type,
    'title' => $title,
    'text'  => $text
  );

  $CI->session->set_flashdata($data);

}



?>