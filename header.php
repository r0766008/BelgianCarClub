<!DOCTYPE html>
<html lang="<?= $this->lang->line('language_abbrevation'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="This is a page for the BelgianCarClub community">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="white">
    <link rel="shortcut icon" href="<?= base_url('assets/images/logo.png'); ?>"/>
    <link href="<?= base_url('assets/css/materialize.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/main.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/animations.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" />
	<link href='https://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
    <script src="<?= base_url('assets/js/jquery-3.3.1.js'); ?>"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="<?= base_url('assets/css/timeline.css'); ?>" rel="stylesheet" type="text/css" />
    <title><?= $title; ?> | BelgianCarClub</title>
</head>
<body>
    <div class="navbar-fixed">
        <nav class="white">
            <div class="nav-wrapper container">
                <a id="logo-container" href="<?= base_url('home'); ?>" class="brand-logo center"><img src="<?= base_url('assets/images/logo.png'); ?>" alt="Logo van BelgianCarClub" style="height: 75px;"></a>
                <ul class="hide-on-med-and-down left">
                    <li><?= anchor(base_url('home'), $this->lang->line('header_home', TRUE)); ?></li>
                    <li><?= anchor(base_url('events'), $this->lang->line('header_events', TRUE)); ?></li>
                    <li><?= anchor(base_url('contact'), $this->lang->line('header_contact', TRUE)); ?></li>
                </ul>
                <ul class="hide-on-med-and-down right">
                    <li>
                        <a class="dropdown-trigger" data-target="dropdown-language"><?= $this->lang->line('language_abbrevation'); ?></a>
                        <ul id="dropdown-language" class="dropdown-content">
                            <?php if($this->lang->line('language_abbrevation') != 'EN'): ?><li><?= anchor(base_url('switchlang/english'), 'EN'); ?></li><?php endif; ?>
                            <?php if($this->lang->line('language_abbrevation') != 'NL'): ?><li><?= anchor(base_url('switchlang/dutch'), 'NL'); ?></li><?php endif; ?>
                            <?php if($this->lang->line('language_abbrevation') != 'FR'): ?><li><?= anchor(base_url('switchlang/french'), 'FR'); ?></li><?php endif; ?>
                        </ul>
                    </li>
                    <li><?= anchor(base_url($this->ion_auth->logged_in() ? 'logout' : 'login'), $this->ion_auth->logged_in() ? $this->lang->line('header_logout') : $this->lang->line('header_login_register')); ?></li>
                </ul>
                <ul id="nav-mobile" class="sidenav">
                    <li><?= anchor(base_url('home'), $this->lang->line('header_home', TRUE)); ?></li>
                    <li><?= anchor(base_url('events'), $this->lang->line('header_events', TRUE)); ?></li>
                    <li><?= anchor(base_url('contact'), $this->lang->line('header_contact', TRUE)); ?></li>
                    <li><?= anchor(base_url($this->ion_auth->logged_in() ? 'logout' : 'login'), $this->ion_auth->logged_in() ? $this->lang->line('header_logout') : $this->lang->line('header_login_register')); ?></li>
                    <li><?php if($this->lang->line('language_abbrevation') != 'EN'): ?><li><?= anchor(base_url('switchlang/english'), 'English'); ?></li><?php endif; ?>
                    <li><?php if($this->lang->line('language_abbrevation') != 'NL'): ?><li><?= anchor(base_url('switchlang/dutch'), 'Dutch'); ?></li><?php endif; ?>
                    <li><?php if($this->lang->line('language_abbrevation') != 'FR'): ?><li><?= anchor(base_url('switchlang/french'), 'French'); ?></li><?php endif; ?>
                </ul>
                <a href="#!" data-target="nav-mobile" id="open-sidenav" class="sidenav-trigger primary-color right"><i class="material-icons">menu</i></a>
            </div>
        </nav>
    </div>
