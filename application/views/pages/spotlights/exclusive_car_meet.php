<div class="container">
    <div style="margin: 100px 0;">
        <div class="row">
            <div class="col s12 l10 offset-l1 z-depth-5">
                <div><h4 class="col s12 center">Exclusive Car Meet By BelgianCarClub</h4></div>
                <?= $this->lang->line('event_sub_title_pricing'); ?>
                <?php if($this->session->flashdata('message')) echo '<div class="col s12 card-panel '.$this->session->flashdata("alert").'">'.$this->session->flashdata("message").'</div>'; ?>
                <form id="event" method="post" action="<?= site_url('event_validation/exclusive_car_meet'); ?>">
                    <div>
                        <div class="col s12">
                            <h5><?= $this->lang->line('event_role'); ?></h5>
                            <p>
                                <label>
                                    <input id="car" class="with-gap" name="role" type="radio" value="1" <?php if ($this->input->post('role') == 1) echo 'checked'; ?>/>
                                    <span><?= $this->lang->line('event_role_car'); ?></span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input id="photographer" class="with-gap" name="role" type="radio" value="2" <?php if ($this->input->post('role') == 2) echo 'checked'; ?>/>
                                    <span><?= $this->lang->line('event_role_photographer'); ?></span>
                                </label>
                            </p>
                        </div>
                        <div id="car_section" style="display: none;">
                            <div class="col s12">
                                <h5><?= $this->lang->line('event_car_info'); ?></h5>
                                <?= $this->lang->line('event_car_sub_title_requirements'); ?>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input id="brand_car" type="text" name="brand_car" value="<?= set_value('brand_car'); ?>">
                                        <label for="brand_car"><?= $this->lang->line('event_car_info_brand'); ?><span style="color:red;">*</span></label>
                                        <div style="margin-top: -20px;">
                                            <span class="red-text text-lighten-1"><?= form_error('brand_car'); ?></span>
                                        </div>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="model_car" type="text" name="model_car" value="<?= set_value('model_car'); ?>">
                                        <label for="model_car"><?= $this->lang->line('event_car_info_model'); ?><span style="color:red;">*</span></label>
                                        <div style="margin-top: -20px;">
                                            <span class="red-text text-lighten-1"><?= form_error('model_car'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="club" type="text" name="club" value="<?= set_value('club'); ?>">
                                        <label for="club"><?= $this->lang->line('event_car_info_club'); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="photographer_section" style="display: none;">
                            <div class="col s12">
                                <h5><?= $this->lang->line('event_photgrapher_info'); ?></h5>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input id="instagram" type="text" name="instagram" value="<?= set_value('instagram'); ?>">
                                        <label for="instagram"><?= $this->lang->line('event_photgrapher_info_instagram'); ?></label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="facebook" type="text" name="facebook" value="<?= set_value('facebook'); ?>">
                                        <label for="facebook"><?= $this->lang->line('event_photgrapher_info_facebook'); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="col s12">
                                <h5><?= $this->lang->line('event_email'); ?></h5>
                                <p>
                                    <label>
                                        <input class="with-gap" name="receive_email" type="radio" value="2" <?php if ($this->input->post('receive_email') == 2) echo 'checked'; ?>/>
                                        <span><?= $this->lang->line('event_email_yes'); ?></span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input class="with-gap" name="receive_email" type="radio" value="1" <?php if ($this->input->post('receive_email') == 1) echo 'checked'; ?>/>
                                        <span><?= $this->lang->line('event_email_no'); ?>No</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col" style="margin-bottom: 22px;">
                        <input type="submit" value="<?= $this->lang->line('event_submit'); ?>" class="btn" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?= site_url('../assets/js/form_changer.js'); ?>"></script>