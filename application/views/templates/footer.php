<footer class="page-footer elegant-color">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">
                    <?= $this->lang->line('footer_about_title'); ?>
                </h5>
                <p class="grey-text text-lighten-4">
                    <?= $this->lang->line('footer_about_text'); ?>
                </p>
            </div>
            <div class="col l3 s12">
                <h5 class="white-text">
                    <?= $this->lang->line('footer_contact_title'); ?>
                </h5>
                <ul id="dev_links">
                    <li><i class="material-icons tiny">location_on</i>
                        <?= $this->lang->line('footer_about_text_location'); ?>
                    </li>
                    <li><i class="material-icons tiny">alternate_email</i>
                        <?= $this->lang->line('footer_about_text_email'); ?>
                    </li>
                </ul>
            </div>
            <div class="col l3 s12">
                <h5 class="white-text">
                    <?= $this->lang->line('footer_social_title'); ?>
                </h5>
                <ul>
                    <li>
                        <a class="white-text" href="https://www.facebook.com/belgiancarclub/" rel="noopener" target="_blank"><img src="<?= base_url('assets/images/Social/facebook.png'); ?>" alt="facebook logo" width="50"></a>
                        <a class="white-text" href="https://www.instagram.com/belgiancarclub/" rel="noopener" target="_blank"><img src="<?= base_url('assets/images/Social/instagram.png'); ?>" alt="instagram logo" width="50"></a>
                        <a class="white-text" href="https://twitter.com/belgiancarclub/" rel="noopener" target="_blank"><img src="<?= base_url('assets/images/Social/twitter.png'); ?>" alt="twitter logo" width="50"></a>
                        <a class="white-text" href="mailto:belgiancarclub@gmail.com"><img src="<?= base_url('assets/images/Social/mail.png'); ?>" alt="email logo" width="50"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright elegant-color-footer">
        <div class="container">© 2019 Belgian Car Club</div>
    </div>
</footer>
<script src="<?= base_url('assets/js/materialize.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/init.js'); ?>"></script>
<script src="<?= base_url('assets/js/animations.js'); ?>"></script>
</body>
</html>
