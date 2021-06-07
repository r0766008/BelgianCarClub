<div class="container">
    <div style="margin: 100px 0;">
        <div class="row">
            <div class="col s12 l10 offset-l1 z-depth-5">
                <h5 class="col s12"><?= $this->lang->line('create_user_heading'); ?>
                </h5>
                <?php if($this->session->flashdata('message')) echo '<div class="col s12 card-panel '.$this->session->flashdata("alert").'">'.$this->session->flashdata("message").'</div>'; ?>
                <form method="post" action="<?= site_url('register_validation'); ?>">
                    <div class="input-field col s6">
                        <input id="user_first_name" type="text" name="user_first_name" value="<?= set_value('user_first_name'); ?>">
                        <label for="user_first_name"><?= $this->lang->line('create_user_fname_label'); ?></label>
                        <div style="margin-top: -20px;">
                            <span class="red-text text-lighten-1"><?= form_error('user_first_name'); ?></span>
                        </div>
                    </div>
                    <div class="input-field col s6">
                        <input id="user_last_name" type="text" name="user_last_name" value="<?= set_value('user_last_name'); ?>">
                        <label for="user_last_name"><?= $this->lang->line('create_user_lname_label'); ?></label>
                        <div style="margin-top: -20px;">
                            <span class="red-text text-lighten-1"><?= form_error('user_last_name'); ?></span>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <input id="user_email" type="text" name="user_email" value="<?= set_value('user_email'); ?>">
                        <label for="user_email"><?= $this->lang->line('create_user_email_label'); ?></label>
                        <div style="margin-top: -20px;">
                            <span class="red-text text-lighten-1"><?= form_error('user_email'); ?></span>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <input id="user_password" type="password" name="user_password" value="<?= set_value('user_password'); ?>">
                        <label for="user_password"><?= $this->lang->line('create_user_password_label'); ?></label>
                        <div style="margin-top: -20px;">
                            <span class="red-text text-lighten-1"><?= form_error('user_password'); ?></span>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <input id="user_confirm_password" type="password" name="user_confirm_password" value="<?= set_value('user_confirm_password'); ?>">
                        <label for="user_confirm_password"><?= $this->lang->line('create_user_password_confirm_label'); ?></label>
                        <div style="margin-top: -20px;">
                            <span class="red-text text-lighten-1"><?= form_error('user_confirm_password'); ?></span>
                        </div>
                    </div>
                    <div class="g-recaptcha col s12" data-sitekey="6LckDJUUAAAAALudo_Hfb30CdBtg3v3Ki01Ou83s" style="margin: 22px 0;"></div>
                    <div class="col s12" style="margin-top: -20px;">
                        <span class="red-text text-lighten-1"><?= form_error('g-recaptcha-response'); ?></span>
                    </div>
                    <div class="col right">
                        <a href="<?= site_url('login'); ?>"><?= $this->lang->line('login_submit_btn'); ?></a>
                    </div>
                    <div class="col" style="margin-bottom: 22px;">
                        <input type="submit" value="<?= $this->lang->line('create_user_submit_btn'); ?>" class="btn" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
