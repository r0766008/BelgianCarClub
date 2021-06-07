<?php
class LanguageLoader {

   function initialize() {
       $languages = array('header', 'footer', 'auth_lang', 'account_errors', 'home', 'spotlights', 'contact');
       $ci =& get_instance();
       $ci->load->helper('language');
       $siteLang = $ci->session->userdata('site_lang');
       if ($siteLang) $ci->lang->load($languages, $ci->session->userdata('site_lang'));
       else $ci->lang->load($languages, 'english');
   }
}
