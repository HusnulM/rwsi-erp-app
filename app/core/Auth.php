<?php

/**
* 
*/
class Auth
{
	
	public static function setLoginSession($user,$token,$role,$userlevel,$name,$jabatan,$dept,$jbtn,$custid)
    {
        $_SESSION['usr_erp'] = [
            'user'      => $user,
            'token'     => $token,
            'role'      => $role,
            'userlevel' => $userlevel,
            'name'      => $name,
            'jabatan'   => $jabatan,
            'department'=> $dept,
            'jbtn'      => $jbtn,
            'customer'  => $custid
        ];   
    }
}