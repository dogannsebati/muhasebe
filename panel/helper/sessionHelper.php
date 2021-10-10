<?php
class sessionHelper {
    private $sessionVar         = 'hzm_sess';
    private $sessionVarAdmin    = 'hzm_sess_admin';
    private static $_instance   = null;
    
    public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new sessionHelper();
        }
        return self::$_instance;
    }
	
    public function start() {
        $secure         = true; // if you only want to receive the cookie over HTTPS
        $httponly       = true; // prevent JavaScript access to session cookie
        $samesite       = 'None';
        $maxlifetime    = 60*60*24*2; // 2 days;
        $host           = $_SERVER['HTTP_HOST'];
        if(PHP_VERSION_ID < 70300) {
            session_set_cookie_params($maxlifetime, '/; samesite='.$samesite, $host, $secure, $httponly);
        } else {
            session_set_cookie_params([
                'lifetime' => $maxlifetime,
                'path' => '/',
                'domain' => $host,
                'secure' => $secure,
                'httponly' => $httponly,
                'samesite' => $samesite
            ]);
        }
        session_start();
	}
	
	public function end() {
	    session_write_close();
	}
	
	public function setVar($var, $value) {
	    $_SESSION[$var] = $value;
	}
	
	public function getVar($var, $defValue=false) {
	    if(isset($_SESSION[$var])){
	        return $_SESSION[$var];
	    }
	    
	    return $defValue;
	}
	
	
	public function setUserSession($account) {
	    $_SESSION[$this->sessionVar] = $account;
	}
	
	public function getUserSession() {
	    if(isset($_SESSION[$this->sessionVar])){
	        return $_SESSION[$this->sessionVar];
	    }
	    
	    return false;
	}
	
	public function removeUserSession() {
	    if(isset($_SESSION[$this->sessionVar])){
	       unset($_SESSION[$this->sessionVar]);
	    }
	    return false;
	}
	
	
	public function setAdminSession($account) {
	    $_SESSION[$this->sessionVarAdmin] = $account;
	}
	
	public function getAdminSession() {
	    if(isset($_SESSION[$this->sessionVarAdmin])){
	        return $_SESSION[$this->sessionVarAdmin];
	    }
		return false;
	}
	
	public function removeAdminSession() {
	    unset($_SESSION[$this->sessionVarAdmin]);
	}
	
	public function gotoAdminLogin() {
	    $gotoUrl = '../';
	    if (! headers_sent ()) {header ( 'Location: '.$gotoUrl );} else{echo '<script language="javascript">location.href="'.$gotoUrl.'";</script>';}
	    die();
	}
}
?>