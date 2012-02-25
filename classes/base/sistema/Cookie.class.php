<?php
class PHP_COOKIE
{
  var $_name  = "";
  var $_val   = array();
  var $_expires;
  var $_dir   = '/';    // all dirs
  var $_site  = '';

  function PHP_COOKIE($cname, $cexpires="", $cdir="/", $csite="")
  {
    $this->_name=$cname;

    if($cexpires){
      $this->_expires=$cexpires;
    }
    else{
      $this->_expires=time() + 60*60*24*30*12; // ~12 months
    }

    $this->_dir=$cdir;
    $this->_site=$csite;
    $this->_val=array();
    $this->extract();
  }

  function extract($cname="")
  {
    if(!isset($_COOKIE)){
      global $_COOKIE;
      $_COOKIE=$GLOBALS["HTTP_COOKIE_VARS"];
    }

    if(empty($cname) && isset($this)){
      $cname=$this->_name;
    }
    
    if(!empty($_COOKIE[$cname])){

      if(get_magic_quotes_gpc()){
        $_COOKIE[$cname]=stripslashes($_COOKIE[$cname]);
      }
      $arr=unserialize($_COOKIE[$cname]);

      if($arr!==false && is_array($arr)){

        foreach($arr as $var => $val){

          $_COOKIE[$var]=$val;

          if(isset($GLOBALS["PHP_SELF"])){
              $GLOBALS[$var]=$val;
          }
        }
      }

      if(isset($this)) $this->_val=$arr;

    }
    // remove the site cookie from the global scope.
    unset($_COOKIE[$cname]);
    unset($GLOBALS[$cname]);
  }

  function put($var, $value)
  {
    $_COOKIE[$var]=$value;
    $this->_val["$var"]=$value;

    if(isset($GLOBALS["PHP_SELF"])){
      $GLOBALS[$var]=$value;
    }

    if(empty($value)){
      unset($this->_val[$var]);
    }

  }

  function clear()
  {
    $this->_val=array();
  }

  function set()
  {
    if(empty($this->_val)){
      $cookie_val="";
    } 
    else {
      $cookie_val=serialize($this->_val);
    }
    
    if(strlen($cookie_val)>4*1024){
      trigger_error("The cookie $this->_name exceeds the specification for the maximum cookie size.  Some data may be lost", E_USER_WARNING);
    }
    setcookie("$this->_name", $cookie_val, $this->_expires, $this->_dir, $this->_site);
  }
}
?>