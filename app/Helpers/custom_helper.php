<?php 
function userLogin(){
    // $this->$db = \Config\Database::connect();   //karena di function, jadinya gk pake $this lagi [20[4:35]]
    $db = \Config\Database::connect();
    return $db->table('users')->where('id_user', session('id_user'))->get()->getRow();
}

function countData($table){
    $db = \Config\Database::connect();
    return $db->table($table)->countAllResults();
}
?>