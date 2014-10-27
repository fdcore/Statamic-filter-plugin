<?php
/*
   Filter plugin for Statamic

   @author Dmitriy Nyashkin
   @site http://nyashk.in
*/
   
class Plugin_filter extends Plugin
{

   private $_cond = array();
   private $_get = array();

   public function index()
   {
        $global_config = Helper::pick($this->getConfig(), array());
        
        $conditions = '';

   	  if(count($global_config) > 0){
   	  	  $conditions = $this->generate_conditions($global_config);
   	  }

      return $conditions;
   }

   private function generate_conditions($params_list){
      
      foreach ($params_list as $key => $values) {
         
         // skip settings
         if($key[0] == '_') continue;

         // check filter param, if exits
         if(isset($values['filter'])) {

            if(strstr($values['filter'], ',')) 
               $rules = explode(',', $values['filter']); else $rules = array($values['filter']);
         
         } else $rules = array('any');
         
         // remove spaces
         array_walk($rules, function(&$value, $index){
             $value = trim($value);
         });


         $key_name = $key;
         
         // check secure orig name
         if(isset($values['name']) && $values['name'] != '') 
               $cond_key = $values['name']; else $cond_key = $key;

         // check GET var & secure array check
         if(isset($_GET[$key_name]) && !is_array($_GET[$key_name])){

            $_var = trim($_GET[$key_name]);

            // Go Filters! 
            if(in_array('int', $rules)) $_var = intval($_var);
            if(in_array('abs', $rules)) $_var = abs($_var);

            if(in_array('no_zero', $rules) && $_var == 0) continue;

            if(!is_numeric($_var)) $_var = strip_tags($_var);

            if(isset($params_list['_max_length']) && strlen($_var) > $params_list['_max_length']) continue;

            $this->_c($cond_key, $_var);
            $this->_g($key_name, $_var);

         } else {
            // add default value
            if(isset($values['default'])) 
                  $this->_c($cond_key, $values['default']);
         }

      }// end each


      return implode(',', $this->_cond);

   }

   // add condition
   private function _c($name, $param){
      $this->_cond[]=$name.":".$param;
   }

   // add get param in link
   private function _g($name, $param){

      $this->_get[$name]=$param;

   }

   /* Return link params

      Example:

         <li {{ if get:year == '2014' }}class="uk-active"{{ /if }}><a href="{{ filter:params_link year="2014" }}">2014</a>
   */
   public function params_link(){
      $global_config = Helper::pick($this->getConfig(), array());

      if(count($global_config) > 0) $this->generate_conditions($global_config);
       
      $link = '?';
      $get_vars = array_merge($this->_get, $this->attributes);

      foreach ($get_vars as $key => $value) $link.="$key=$value&";

      return substr($link, 0, -1);
   }
}