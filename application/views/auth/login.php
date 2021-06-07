<div class="container">
    <div style="margin: 100px 0;">
        <div class="row">
            <div class="col s12 l10 offset-l1 z-depth-5">     
            <h5 class="col s12"><?= $this->lang->line('login_heading'); ?></h5>
                <?php if($this->session->flashdata('message')) echo '<div class="col s12 card-panel '.$this->session->flashdata("alert").'">'.$this->session->flashdata("message").'</div>'; ?>
                <form method="post" action="<?= site_url('login_validation'); ?>">
                    <div class="input-field col s12">
                        <input id="user_email" type="text" name="user_email" value="<?= set_value('user_email'); ?>">
                        <label for="user_email"><?= $this->lang->line('login_identity_label'); ?></label>
                        <div style="margin-top: -20px;">
                            <span class="red-text text-lighten-1"><?= form_error('user_email'); ?></span>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <input id="user_password" type="password" name="user_password" value="<?= set_value('user_password'); ?>">
                        <label for="user_password"><?= $this->lang->line('login_password_label'); ?></label>
                        <div style="margin-top: -20px;">
                            <span class="red-text text-lighten-1"><?= form_error('user_password'); ?></span>
                        </div>
                    </div>  
                    <div class="col s12">		
                        <p>
                            <label>
                                <input type="checkbox" class="filled-in" name="user_remember"/>
                                <span><?= $this->lang->line('login_remember_label'); ?></span>
                            </label>
                        </p>
                    </div>
                    <div class="col right">
                        <a href="<?= site_url('register'); ?>"><?= $this->lang->line('create_user_submit_btn'); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="<?= site_url('forgot_password'); ?>"><?= $this->lang->line('forgot_password_submit_btn'); ?></a>
                    </div>
                    <div class="col" style="margin-bottom: 22px;">
                        <input type="submit" value="<?= $this->lang->line('login_submit_btn'); ?>" class="btn" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>