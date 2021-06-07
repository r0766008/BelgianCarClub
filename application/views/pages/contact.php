<div class="container">
    <div style="margin: 100px 0;">
        <div class="row">
            <div class="col s12 l10 offset-l1 z-depth-5">
                <div><h4 class="col s12 center">Contact</h4></div>
                <?php if($this->session->flashdata('message')) echo '<div class="col s12 card-panel '.$this->session->flashdata("alert").'">'.$this->session->flashdata("message").'</div>'; ?>
                <div class="row">
                  <form method="post" action="<?= site_url('contact_validation'); ?>">
                        <div class="input-field col s12">
                            <select name="category">
                                <option value="" disabled selected><?= $this->lang->line('contact_choose_option') ?></option>
                                <option value="Spotlighted Event" <?= (set_value('category')=='Spotlighted Event')?"selected='selected'":""?>><?= $this->lang->line('contact_spotlighted_event') ?></option>
                                <option value="Normal Event" <?= (set_value('category')=='Normal Event')?"selected='selected'":""?>><?= $this->lang->line('contact_normal_event') ?></option>
                                <option value="Partner Deal" <?= (set_value('category')=='Partner Deal')?"selected='selected'":""?>><?= $this->lang->line('contact_partner_deal') ?></option>
                                <option value="Request" <?= (set_value('category')=='Request')?"selected='selected'":""?>><?= $this->lang->line('contact_request') ?></option>
                                <option value="Question" <?= (set_value('category')=='Question')?"selected='selected'":""?>><?= $this->lang->line('contact_question') ?></option>
                            </select>
                            <label><?= $this->lang->line('contact_category') ?></label>
                            <div style="margin-top: -20px;">
                                <span class="red-text text-lighten-1"><?= form_error('category'); ?></span>
                            </div>
                        </div>
                        <div class="input-field col s12">
                            <input id="name" type="text" name="name" value="<?= set_value('name'); ?>">
                            <label for="name"><?= $this->lang->line('contact_name') ?></label>
                            <div style="margin-top: -20px;">
                                <span class="red-text text-lighten-1"><?= form_error('name'); ?></span>
                            </div>
                        </div>
                        <div class="input-field col s12">
                            <input id="email" type="email" name="email" class="validate" value="<?= set_value('email'); ?>">
                            <label for="email"><?= $this->lang->line('contact_email') ?></label>
                            <div style="margin-top: -20px;">
                                <span class="red-text text-lighten-1"><?= form_error('email'); ?></span>
                            </div>
                        </div>
                        <div class="input-field col s12">
                            <textarea id="message" class="materialize-textarea" name="message" rows="9" style="height: 150px;"><?= set_value('message'); ?></textarea>
                            <label for="message"><?= $this->lang->line('contact_message') ?></label>
                            <div style="margin-top: -20px;">
                                <span class="red-text text-lighten-1"><?= form_error('message'); ?></span>
                            </div>
                        </div>
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light" type="submit" name="action"><?= $this->lang->line('contact_submit') ?>
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('select').formSelect();
    });
</script>
