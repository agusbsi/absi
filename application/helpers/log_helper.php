<?php
function set_online($id){
	date_default_timezone_set("Asia/Jakarta");
    $CI =& get_instance();
    $date = date("Y-m-d H:i:s");
    $CI->db->query("UPDATE tb_user set last_online = '$date' where id = $id");

}
function set_offline($id){
    $CI =& get_instance();
    $CI->db->query("UPDATE tb_user set last_online = NULL where id = $id");

}
?>