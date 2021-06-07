<div class="container">
    <div style="margin: 100px 0;">
        <div class="row">
            <div class="col s12 l10 offset-l1 z-depth-5">     
            <h5 class="col s12"><?= $this->lang->line('reset_password_heading'); ?></h5>
                <?php if($this->session->flashdata('message')) echo '<div class="col s12 card-panel '.$this->session->flashdata("alert").'">'.$this->session->flashdata("message").'</div>'; ?>
                <form method="post" action="<?= site_url('auth/reset_password/'.$code); ?>">
                    <div class="input-field col s12">
                        <input id="new" type="password" name="new" value="<?= set_value('new'); ?>">
                        <label for="new"><?= $this->lang->line('reset_password_new_password_label'); ?></label>
                        <div style="margin-top: -20px;">
                            <span class="red-text text-lighten-1"><?= form_error('new'); ?></span>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <input id="new_confirm" type="password" name="new_confirm" value="<?= set_value('new_confirm'); ?>">
                        <label for="new_confirm"><?= $this->lang->line('reset_password_new_password_confirm_label'); ?></label>
                        <div style="margin-top: -20px;">
                            <span class="red-text text-lighten-1"><?= form_error('new_confirm'); ?></span>
                        </div>
                    </div>
                    <?php echo form_input($user_id);?>
                    <?php echo form_hidden($csrf); ?>
                    <div class="col" style="margin: 22px 0;">
                        <input type="submit" value="<?= $this->lang->line('reset_password_submit_btn'); ?>" class="btn" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>