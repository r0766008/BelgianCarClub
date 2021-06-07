<div class="container">
    <div style="margin: 100px 0;">
        <div class="row">
            <div class="col s12 l10 offset-l1 z-depth-5">     
            <h5 class="col s12"><?= $this->lang->line('forgot_password_heading'); ?></h5>
                <?php if($this->session->flashdata('message')) echo '<div class="col s12 card-panel '.$this->session->flashdata("alert").'">'.$this->session->flashdata("message").'</div>'; ?>
                <form method="post" action="<?= site_url('forgot_password_validation'); ?>">
                    <div class="input-field col s12">
                        <input id="user_email" type="text" name="user_email" value="<?= set_value('user_email'); ?>">
                        <label for="user_email"><?= $this->lang->line('forgot_password_validation_email_label'); ?></label>
                        <div style="margin-top: -20px;">
                            <span class="red-text text-lighten-1"><?= form_error('user_email'); ?></span>
                        </div>
                    </div>
                    <div class="col right" style="margin: 22px 0;">
                        <a href="<?= site_url('login'); ?>"><?= $this->lang->line('login_submit_btn'); ?></a>
                    </div>
                    <div class="col" style="margin: 22px 0;">
                        <input type="submit" value="<?= $this->lang->line('forgot_password_submit_btn'); ?>" class="btn" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>