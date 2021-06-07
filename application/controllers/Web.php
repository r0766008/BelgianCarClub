<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Web extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->lang->load('header', $this->session->userdata('site_lang'));
        $this->data['title'] = ucfirst(strlen(uri_string()) > 0 ? explode("_",uri_string())[0] : 'home');
        $this->load->view('templates/header', $this->data);
        $this->load->model('web_model');
    }

    public function index() {
        $this->load->helper('file');
        $this->data['instagram_feed'] = $this->web_model->instagram_posts();
        $this->load->view('pages/home', $this->data);
        $this->load->view('templates/footer', $this->data);
    }

    public function spotlights($spotlight_id = '') {
        $this->data['spotlights'] = $this->web_model->get_spotlights();
        if($spotlight_id && !$this->ion_auth->logged_in()) redirect('login');
        if($spotlight_id && file_exists(APPPATH.'views/pages/spotlights/'.$spotlight_id.'.php')) $this->load->view('pages/spotlights/'.$spotlight_id, $this->data);
        else $this->load->view('pages/spotlights', $this->data);
        $this->load->view('templates/footer', $this->data);
    }

    public function calendar() {
        $this->load->view('pages/calendar');
        $this->load->view('templates/footer');
    }

    public function shop() {
        $this->load->view('pages/shop');
        $this->load->view('templates/footer');
    }

    public function contact() {
        $this->load->view('pages/contact');
        $this->load->view('templates/footer');
    }

    function switchLang($language = "") {
        switch($language) {
             default:
                  $this->session->set_userdata('site_lang', 'english');
             break;

             case "dutch":
                  $this->session->set_userdata('site_lang', 'dutch');
             break;
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function instagram_update() {
        $this->load->helper('file');
        $url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token=7387140897.1677ed0.dc7b60ff409d441a91f2b103755dd359&count=4';
        $output = file_get_contents($url);
        write_file('./application/cache/belgiancarclub.json', $output);
        $this->index();
    }

    public function register() {
        if($this->ion_auth->logged_in()) $this->index();
        else {
            $this->load->view('auth/register');
            $this->load->view('templates/footer');
        }
    }

    public function register_validation() {
        $this->form_validation->set_rules('user_first_name', 'First Name', 'required|trim',
            array(
                'required'      => $this->lang->line('register_error_first_name_required')
            )
        );
        $this->form_validation->set_rules('user_last_name', 'Last Name', 'required|trim',
            array(
                'required'      => $this->lang->line('register_error_last_name_required')
            )
        );
        $this->form_validation->set_rules('user_email', 'Email Address', 'required|trim|valid_email|is_unique[users.email]',
            array(
                'required'      => $this->lang->line('register_error_email_required'),
                'is_unique'     => $this->lang->line('register_error_email_isunique'),
                'valid_email'   => $this->lang->line('register_error_email_isvalid')
            )
        );
        $this->form_validation->set_rules('user_password', 'Password', 'required|min_length[6]|matches[user_confirm_password]',
            array(
                'required'      => $this->lang->line('register_error_password_required'),
                'min_length'    => $this->lang->line('register_error_password_min_length'),
                'matches'       => $this->lang->line('register_error_password_matches')
            )
        );
        $this->form_validation->set_rules('user_confirm_password', 'Confirmed Password', 'trim|required|min_length[6]',
            array(
                'required'      => $this->lang->line('register_error_password_confirm_required')
            )
        );
        $this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|callback_validate_captcha',
            array(
                'callback_validate_captcha' => $this->lang->line('register_error_captcha'),
                'required'                  => $this->lang->line('register_error_captcha')
            )
        );
        if($this->form_validation->run()) {
            $additional_data = array(
                'first_name' => $this->input->post('user_first_name'),
                'last_name' => $this->input->post('user_last_name')
            );
            $this->ion_auth->register(NULL, $this->input->post('user_password'), $this->input->post('user_email'), $additional_data);
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            $this->session->set_flashdata('alert', "green lighten-4 green-text text-darken-4");
            $this->load->view('auth/login');
            $this->load->view('templates/footer');
            $this->session->set_flashdata('message', '');
            $this->session->set_flashdata('alert', "");
        } else $this->register();
    }

    public function login() {
        if($this->ion_auth->logged_in()) $this->index();
        else {
            $this->load->view('auth/login');
            $this->load->view('templates/footer');
        }
    }

    public function login_validation() {
        $this->form_validation->set_rules('user_email', 'Email Address', 'required|trim|valid_email',
            array(
                'required'      => $this->lang->line('login_error_email_required'),
                'valid_email'   => $this->lang->line('login_error_email_isvalid')
            )
        );
        $this->form_validation->set_rules('user_password', 'Password', 'required',
            array(
                'required'      => $this->lang->line('login_error_password_required')
            )
        );
        if($this->form_validation->run()) {
            $identity = $this->input->post('user_email');
            $password = $this->input->post('user_password');
            $remember = $this->input->post('user_remember');
            if ($this->ion_auth->login($identity, $password, $remember)) {
                redirect('home');
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                $this->session->set_flashdata('alert', "red lighten-4 red-text text-darken-4");
                $this->load->view('auth/login');
                $this->load->view('templates/footer');
                $this->session->set_flashdata('message', '');
                $this->session->set_flashdata('alert', '');
            }
        } else $this->login();
    }

    public function verjaardag() {
      $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]--><meta http-equiv="Content-type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> <meta http-equiv="X-UA-Compatible" content="IE=edge" /><meta name="format-detection" content="date=no" /><meta name="format-detection" content="address=no" /><meta name="format-detection" content="telephone=no" /><title>Email Template</title><style type="text/css" media="screen">/* Linked Styles */body { padding:0 !important; margin:0 !important; display:block !important; background:#1e1e1e; -webkit-text-size-adjust:none }a { color:#a88123; text-decoration:none }p { padding:0 !important; margin:0 !important }/* Mobile styles */</style><style media="only screen and (max-device-width: 480px), only screen and (max-width: 480px)" type="text/css">@media only screen and (max-device-width: 480px), only screen and (max-width: 480px) {div[class=\'mobile-br-5\'] { height: 5px !important; }div[class=\'mobile-br-10\'] { height: 10px !important; }div[class=\'mobile-br-15\'] { height: 15px !important; }div[class=\'mobile-br-20\'] { height: 20px !important; }div[class=\'mobile-br-25\'] { height: 25px !important; }div[class=\'mobile-br-30\'] { height: 30px !important; }th[class=\'m-td\'],td[class=\'m-td\'],div[class=\'hide-for-mobile\'],span[class=\'hide-for-mobile\'] { display: none !important; width: 0 !important; height: 0 !important; font-size: 0 !important; line-height: 0 !important; min-height: 0 !important; }span[class=\'mobile-block\'] { display: block !important; }div[class=\'wgmail\'] img { min-width: 320px !important; width: 320px !important; }div[class=\'img-m-center\'] { text-align: center !important; }div[class=\'fluid-img\'] img,td[class=\'fluid-img\'] img { width: 100% !important; max-width: 100% !important; height: auto !important; }table[class=\'mobile-shell\'] { width: 100% !important; min-width: 100% !important; }td[class=\'td\'] { width: 100% !important; min-width: 100% !important; }table[class=\'center\'] { margin: 0 auto; }td[class=\'column-top\'],th[class=\'column-top\'],td[class=\'column\'],th[class=\'column\'] { float: left !important; width: 100% !important; display: block !important; }td[class=\'content-spacing\'] { width: 15px !important; }div[class=\'h2\'] { font-size: 44px !important; line-height: 48px !important; }}</style></head><body class="body" style="padding:0 !important; margin:0 !important; display:block !important; background:#1e1e1e; -webkit-text-size-adjust:none"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#1e1e1e"><tr><td align="center" valign="top"><table width="600" border="0" cellspacing="0" cellpadding="0" class="mobile-shell"><tr><td class="td" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; width:600px; min-width:600px; Margin:0" width="600"><!-- Main --><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><!-- Head --><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#d2973b"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="img" style="font-size:0pt; line-height:0pt; text-align:left" width="27"><img src="https://d1pgqke3goo8l6.cloudfront.net/JJxrFRyVRr20CJD3pOx9_top_left.jpg" border="0" width="27" height="27" alt="" /></td><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="img" style="font-size:0pt; line-height:0pt; text-align:left" height="3" bgcolor="#e6ae57">&nbsp;</td></tr></table><table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%"><tr><td height="24" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">&nbsp;</td></tr></table></td><td class="img" style="font-size:0pt; line-height:0pt; text-align:left" width="27"><img src="https://d1pgqke3goo8l6.cloudfront.net/SNcoUN5kSfCDagqSBEZ4_top_right.jpg" border="0" width="27" height="27" alt="" /></td></tr></table><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="img" style="font-size:0pt; line-height:0pt; text-align:left" width="3" bgcolor="#e6ae57"></td><td class="img" style="font-size:0pt; line-height:0pt; text-align:left" width="10"></td><td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%"><tr><td height="20" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">&nbsp;</td></tr></table><div class="h3-2-center" style="color:#1e1e1e; font-family:Arial, sans-serif; min-width:auto !important; font-size:20px; line-height:26px; text-align:center; letter-spacing:5px">IT‘S CARINE\'S</div><table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%"><tr><td height="5" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">&nbsp;</td></tr></table><div class="h2" style="color:#ffffff; font-family:Georgia, serif; min-width:auto !important; font-size:60px; line-height:64px; text-align:center"><em>Birthday!</em></div><table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%"><tr><td height="30" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">&nbsp;</td></tr></table></td><td class="img" style="font-size:0pt; line-height:0pt; text-align:left" width="10"></td><td class="img" style="font-size:0pt; line-height:0pt; text-align:left" width="3" bgcolor="#e6ae57"></td></tr></table></td></tr></table><!-- END Head --><!-- Body --><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="padding-bottom: 25px;"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="content-spacing" style="font-size:0pt; line-height:0pt; text-align:left" width="20"></td><td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%"><tr><td height="35" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">&nbsp;</td></tr></table><div class="h3-1-center" style="color:#1e1e1e; font-family:Georgia, serif; min-width:auto !important; font-size:20px; line-height:26px; text-align:center">Dit is een uitnodiging</div><table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%"><tr><td height="15" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">&nbsp;</td></tr></table><div class="h4-center" style="color:#1e1e1e; font-family:Arial, sans-serif; min-width:auto !important; font-size:18px; line-height:24px; text-align:center"><strong>CARINE <span style="color: #a88123;">WORDT</span> 60!</strong></div><table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%"><tr><td height="25" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">&nbsp;</td></tr></table><table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%"><tr><td height="35" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">&nbsp;</td></tr></table></td><td class="content-spacing" style="font-size:0pt; line-height:0pt; text-align:left" width="20"></td></tr></table><div class="fluid-img" style="font-size:0pt; line-height:0pt; text-align:left"><a href="#" target="_blank"><!--El presente código está protegido por las leyes de propiedad intelectual y por las leyes y tratados internacionales de Copyright. Cualquier impresión o uso the este material está prohibido. Ninguna parte puede ser reproducida o transmitida en ningún formato, esto incluye tanto medios electrónicos o mecánicos, incluyendo fotocopias, grabaciones o por cualquier medio de almacenamiento sin la autorización expresa de VIWOM--><!-- 14.0 --><!--ALL RIGHTS RESERVED. This code contains material protected under International Copyright Laws and Treaties. Any unauthorized reprint or use of this material is prohibited. No part of this code may be reproduced or transmitted in any form or by any means, electronic or mechanical, including photocopying, recording, or by any information storage and retrieval system without express written permission from VIWOM.--> <style type="text/css">@media {} @media (min-device-width: 1024px) and (device-aspect-ratio: 4/3),(min-device-width: 1280px) {.viwomailvideo {width: 300px!important;height: 530px!important;max-height: 530px!important;}.viwomailimg {width: 0!important;height: 0!important;padding: 0!important;overflow: hidden;}}@media only screen and (max-device-width: 1023px) {.viwomailcontainer {width: 300px !important;height: 530px !important;}.viwomailvideo {display: none!important;overflow: hidden!important;visibility: hidden!important;}img.viwomailvideo {visibility: hidden!important;display: none!important;}video.viwomailvideo {display: none!important;}.viwomailimg {width: 300px !important;height: 530px!important;}.viwomailimg img {height: 530px!important;max-width: 300px!important;width: 300px !important;}@supports (-webkit-overflow-scrolling:touch) and (color:#ffffffff) {.viwomailvideo {width: 300px!important;height: 530px!important;max-height: 530px!important;display: block!important;overflow: visible!important;visibility: visible!important;position: relative;padding-bottom: 0;padding-top: 0px;height: 0;overflow: hidden;margin: 0 auto;}.viwomailvideo video {position: absolute;top: 0;left: 0;width: 300px;height: 530px;}.viwomailimg {min-width: 0!important;height: 0!important;padding: 0!important;overflow: hidden;}}#MessageViewBody .viwomailvideo {width: 300px !important;max-width: 300px !important;max-height: 530px !important;height: 530px !important;display: block!important;overflow: visible!important;visibility: visible!important;}#MessageViewBody .viwomailvideo video {width: 300px!important;max-width: 300px !important;height: 530px!important;display: block!important;}#MessageViewBody .viwomailimg {min-width: 0!important;height: 0!important;padding: 0!important;overflow: hidden!important;}#MessageViewBody .viwomailfallback {display: block!important;}}.viwomailfallback {height: 530px!important;max-height: 530px!important;width: 300px!important;overflow: visible!important;text-align: center!important;} </style> <table align="center" border="0" cellpadding="0" cellspacing="0" width="300" style="width:300px;border:none;max-width:300px;" class="viwomailcontainer"><tr align="center"><td> <div class="viwomailimg" style="text-align:center;mso-hide:all;"><a href="http://track.viwomail.com/videoemail/LP/09688580015626900425d24c1faec93d/birthday.html" style="border:none;"> <img alt="VIDEO" border="0" src="http://track.viwomail.com/videoemail/C/09688580015626900425d24c1faec93d/alt/envio" style="display:block;border:none; min-width:300px; max-width:300px; min-height:530px; max-height:530px; height:530px; font-size: 0px;" /> </a></div> <div class="viwomailvideo" style="width:0px;max-height:0px;height:0px;overflow:hidden;text-align:center;"><video width="300" height="530" controls="controls" poster="http://track.viwomail.com/videoemail/C/09688580015626900425d24c1faec93d/poster/envio" src="http://track.viwomail.com/videoemail/C/09688580015626900425d24c1faec93d/trackem/envio" autoplay="autoplay" loop="" style="display:block;"><a href="http://track.viwomail.com/videoemail/LP/09688580015626900425d24c1faec93d/birthday.html" style="border:none;"><!--[if !mso]><!-- --><img alt="VIDEO" border="0" class="viwomailfallback" src="http://track.viwomail.com/videoemail/C/09688580015626900425d24c1faec93d/alt/envio" style="border:none;width:0px;max-height:0px;height:0px;overflow:hidden;text-align:center;" /><!--<![endif]--><img alt="VIDEO" border="0" class="viwomailfallbackmso" src="http://track.viwomail.com/videoemail/C/09688580015626900425d24c1faec93d/postermso/envio" style="border:none;width:0px;max-height:0px;height:0px;overflow:hidden;text-align:center;" width="300" height="530" /> </a></video> </div> </td></tr> </table></a></div></td></tr></table><!-- END Body --><!-- Foot --><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#d2973b"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="img" style="font-size:0pt; line-height:0pt; text-align:left" width="3" bgcolor="#e6ae57"></td><td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%"><tr><td height="30" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">&nbsp;</td></tr></table><table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%"><tr><td height="15" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">&nbsp;</td></tr></table><table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%"><tr><td height="15" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">&nbsp;</td></tr></table></td><td class="img" style="font-size:0pt; line-height:0pt; text-align:left" width="3" bgcolor="#e6ae57"></td></tr></table><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="img" style="font-size:0pt; line-height:0pt; text-align:left" width="27"><img src="https://d1pgqke3goo8l6.cloudfront.net/nK8bYazcQWGAQt8sAH2g_bot_left.jpg" border="0" width="27" height="27" alt="" /></td><td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%"><tr><td height="24" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">&nbsp;</td></tr></table><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="img" style="font-size:0pt; line-height:0pt; text-align:left" height="3" bgcolor="#e6ae57">&nbsp;</td></tr></table></td><td class="img" style="font-size:0pt; line-height:0pt; text-align:left" width="27"><img src="https://d1pgqke3goo8l6.cloudfront.net/v9RanaDRM2FzjQNT9PwV_bot_right.jpg" border="0" width="27" height="27" alt="" /></td></tr></table></td></tr></table><!-- END Foot --></td></tr></table><!-- END Main --></td></tr></table><div class="wgmail" style="font-size:0pt; line-height:0pt; text-align:center"><img src="https://d1pgqke3goo8l6.cloudfront.net/oD2XPM6QQiajFKLdePkw_gmail_fix.gif" width="600" height="1" style="min-width:600px" alt="" border="0" /></div></td></tr></table></body></html>';
      $config = array(
          'protocol'      => 'smtp',
          'smtp_host'     => 'ssl://send.one.com',
          'smtp_port'     => '465',
          'smtp_timeout'  => '7',
          'smtp_user'     => 'belgiancarclub@procode.be',
          'smtp_pass'     => 'belgiancar',
          'mailtype'      => 'html',
          'crlf'          => "\r\n",
          'newline'       => "\r\n",
          'charset'       => 'utf-8',
      );
      $this->load->library('email', $config);
      $this->email->from('belgiancarclub@procode.be', 'Mila Lipa');
      $this->email->to('cody.volz@hotmail.com');
      $this->email->subject('Verjaardag');
      $this->email->message($message);
      $this->email->send();
    }

    public function contact_validation() {
        $this->form_validation->set_rules('category', 'Category', 'required',
            array(
                'required'      => $this->lang->line('login_error_password_required')
            )
        );
        $this->form_validation->set_rules('name', 'Name', 'required',
            array(
                'required'      => $this->lang->line('login_error_password_required')
            )
        );
        $this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email',
            array(
                'required'      => $this->lang->line('login_error_email_required'),
                'valid_email'   => $this->lang->line('login_error_email_isvalid')
            )
        );
        $this->form_validation->set_rules('message', 'Message', 'required',
            array(
                'required'      => $this->lang->line('login_error_password_required')
            )
        );
        if($this->form_validation->run()) {
            $message = '<html><body>';
            $message .= '<h3>'.$this->input->post('category').'</h3>';
            $message .= '<table style="border-collapse: collapse;"><tr><th style="border: 1px solid black">Email</th><th style="border: 1px solid black">Name</th></tr><tr><td style="border: 1px solid black">'.$this->input->post('email').'</td><td style="border: 1px solid black">'.$this->input->post('name').'</td></tr></table>';
            $message .= '<p>'.$this->input->post('message').'</p>';
            $message .= "</body></html>";
            $config = array(
                'protocol'      => 'smtp',
                'smtp_host'     => 'ssl://send.one.com',
                'smtp_port'     => '465',
                'smtp_timeout'  => '7',
                'smtp_user'     => 'belgiancarclub@procode.be',
                'smtp_pass'     => 'belgiancar',
                'mailtype'      => 'html',
                'crlf'          => "\r\n",
                'newline'       => "\r\n",
                'charset'       => 'utf-8',
            );
            $this->load->library('email', $config);
            $this->email->from('belgiancarclub@procode.be', $this->input->post('name'));
            $this->email->to('belgiancarclub@procode.be');
            $this->email->subject($this->input->post('category'));
            $this->email->message($message);
            if ($this->email->send()) {
              $this->session->set_flashdata('message', '<p>Email was successfull send</p>');
              $this->session->set_flashdata('alert', "green lighten-4 green-text text-darken-4");
              redirect('contact');
              $this->session->set_flashdata('message', '');
              $this->session->set_flashdata('alert', '');
            } else {
              $this->session->set_flashdata('message', '<p>Email could\'nt be send due to an error, please try again later.');
              $this->session->set_flashdata('alert', "red lighten-4 red-text text-darken-4");
              $this->load->view('pages/contact');
              $this->load->view('templates/footer');
              $this->session->set_flashdata('message', '');
              $this->session->set_flashdata('alert', '');
            }
        } else $this->contact();
    }

    public function forgot_password() {
        if($this->ion_auth->logged_in()) $this->index();
        else {
            $this->load->view('auth/forgot_password');
            $this->load->view('templates/footer');
        }
    }

    public function forgot_password_validation() {
        $this->form_validation->set_rules('user_email', 'Email Address', 'trim|required|valid_email',
            array(
                'required'        => $this->lang->line('forgot_error_email_required'),
                'valid_email'     => $this->lang->line('forgot_error_email_isvalid')
            )
        );
        if ($this->form_validation->run() == false) {
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->load->view('auth/forgot_password', $this->data);
            $this->load->view('templates/footer');
        } else {
            $forgotten = $this->ion_auth->forgotten_password($this->input->post('user_email'));
            if ($forgotten) {
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                $this->session->set_flashdata('alert', "green lighten-4 green-text text-darken-4");
                $this->login();
                $this->session->set_flashdata('message', '');
                $this->session->set_flashdata('alert', '');
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                $this->session->set_flashdata('alert', "red lighten-4 red-text text-darken-4");
                $this->forgot_password();
                $this->session->set_flashdata('message', '');
                $this->session->set_flashdata('alert', '');
            }
        }
    }

    public function event_validation($page = '') {
        $validate_form = FALSE;
        if ($this->input->post('role') == 1) {
            $this->form_validation->set_rules('brand_car', 'Brand of your car', 'required|trim');
            $this->form_validation->set_rules('model_car', 'Model of your car', 'required|trim');
            if (!$this->form_validation->run()) $validate_form = TRUE;
        }
        if ($this->input->post('role') == NULL || $validate_form || $this->input->post('receive_email') == NULL) {
            $this->session->set_flashdata('message', $this->lang->line('spotlight_error_flash'));
            $this->session->set_flashdata('alert', "red lighten-4 red-text text-darken-4");
            $this->load->view('pages/spotlights/'.$page, $this->data);
            $this->load->view('templates/footer');
            $this->session->set_flashdata('message', '');
            $this->session->set_flashdata('alert', '');
        } else if ($this->ion_auth->logged_in()){
            $user = $this->ion_auth->user()->row();
            $query = $this->db->where('page', $page)->from('spotlights')->get()->result_array();
            foreach ($query as $row) {
                $spotlight_id = $row['id'];
                $spotlight_title = $row['title'];
            }
            $query = $this->db->where('userID', $user->id)->from('attending')->get()->result_array();
            $notExists = True;
            foreach ($query as $row) if ($row['spotlightID'] == $spotlight_id) $notExists = False;
            if ($notExists) {
                $additional_data = array(
                    'userID'                => $user->id,
                    'spotlightID'           => $spotlight_id,
                    'first_name'            => $user->first_name,
                    'last_name'             => $user->last_name,
                    'email'                 => $user->email,
                    'role'                  => $this->input->post('role'),
                    'receive_email'         => $this->input->post('receive_email'),
                    'instagram_name'        => $this->input->post('instagram'),
                    'facebook_name'         => $this->input->post('facebook'),
                    'brand_car'             => $this->input->post('brand_car'),
                    'model_car'             => $this->input->post('model_car'),
                    'club'                  => $this->input->post('club'),
                );
                $this->web_model->create_entry($additional_data);
                $subject = "Je bent ingeschreven";
                $message = '<html><body><h3>'.$this->lang->line('spotlight_error_title').$spotlight_title.'</h3><br/><table rules="all" style="border-color: #666;" cellpadding="10"><tr style="background: #eee;"><td><strong>'.$this->lang->line('spotlight_email_name').'</strong></td><td>'.$user->first_name.' '.$user->last_name.'</td></tr><tr><td><strong>'.$this->lang->line('spotlight_email_email').'</strong></td><td>'.$user->email.'</td></tr>';
                if ($this->input->post('role') == 1) $message .= '<tr><td><strong>'.$this->lang->line('spotlight_email_car_brand').'</strong></td><td>'.$this->input->post('brand_car').'</td></tr><tr><td><strong>'.$this->lang->line('spotlight_email_car_model').'</strong></td><td>'.$this->input->post('model_car').'</td></tr><tr><td><strong>'.$this->lang->line('spotlight_email_club').'</strong></td><td>'.$this->input->post('club').'</td></tr>';
                else if ($this->input->post('role') == 2) $message .= '<tr><td><strong>'.$this->lang->line('spotlight_email_photographer_instagram').'</strong></td><td>'.$this->input->post('instagram').'</td></tr><tr><td><strong>'.$this->lang->line('spotlight_email_photographer_facebook').'</strong></td><td>'.$this->input->post('facebook').'</td></tr>';
                $message .= "</table>";
                $message .= "</body></html>";
                $config = array(
                    'protocol'      => 'smtp',
                    'smtp_host'     => 'ssl://send.one.com',
                    'smtp_port'     => '465',
                    'smtp_timeout'  => '7',
                    'smtp_user'     => 'belgiancarclub@procode.be',
                    'smtp_pass'     => 'belgiancar',
                    'mailtype'      => 'html',
                    'crlf'          => "\r\n",
                    'newline'       => "\r\n",
                    'charset'       => 'utf-8',
                );
                $this->load->library('email', $config);
                $this->email->from('belgiancarclub@procode.be', 'Mila Lipa');
                $this->email->to($user->email);
                $this->email->subject($subject);
                $this->email->message($message);
                $this->email->send();
            }
            redirect('spotlights');
        } else $this->index();
    }

    public function logout() {
        $language = $this->lang->line('language');
		    $this->ion_auth->logout();
        $this->session->set_userdata('site_lang', $language);
        redirect('home');
    }

    function validate_captcha() {
        $captcha = $this->input->post('g-recaptcha-response');
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LckDJUUAAAAAAUM64wacx9SCWCa6hw6dvNigLbB&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if ($response.'success' == false) return FALSE;
        else return TRUE;
    }
}
