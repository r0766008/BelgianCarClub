<div class="slider fullscreen">
  <ul class="slides">
    <li class="active" style="opacity: 1;">
      <img src="data:image/gif;base64,R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="background-image: url(<?= base_url('assets/images/Home/1-min.jpg'); ?>);">
      <div class="caption center-align" style="opacity: 1; transform: translateX(0px) translateY(0px);">
          <h3>Belgian Car Club</h3>
          <h5 class="grey-text text-lighten-3"><?= $this->lang->line('slogan_1'); ?></h5>
      </div>
    </li>
    <li style="opacity: 0; transform: translateX(0px) translateY(0px);">
      <img src="data:image/gif;base64,R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="background-image: url(<?= base_url('assets/images/Home/3-min.jpg'); ?>">
      <div class="caption center-align" style="opacity: 1; transform: translateX(0px) translateY(0px);">
          <h3>Belgian Car Club</h3>
          <h5 class="grey-text text-lighten-3"><?= $this->lang->line('slogan_1'); ?></h5>
      </div>
    </li>
    <li style="opacity: 0; transform: translateX(0px) translateY(0px);">
      <img src="data:image/gif;base64,R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="background-image: url(<?= base_url('assets/images/Home/2-min.jpg'); ?>);">
      <div class="caption center-align" style="opacity: 1; transform: translateX(0px) translateY(0px);">
          <h3>Belgian Car Club</h3>
          <h5 class="grey-text text-lighten-3"><?= $this->lang->line('slogan_1'); ?></h5>
      </div>
    </li>
    <li style="opacity: 0; transform: translateX(0px) translateY(0px);">
      <img src="data:image/gif;base64,R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="background-image: url(<?= base_url('assets/images/Home/4-min.jpg'); ?>);">
      <div class="caption center-align" style="opacity: 1; transform: translateX(0px) translateY(0px);">
          <h3>Belgian Car Club</h3>
          <h5 class="grey-text text-lighten-3"><?= $this->lang->line('slogan_1'); ?></h5>
      </div>
    </li>
  </ul>
<ul class="indicators"><li class="indicator-item"></li><li class="indicator-item"></li><li class="indicator-item"></li><li class="indicator-item"></li></ul></div>
<div class="parallax-container"></div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col s12 m4 animatable bounceInLeft">
                <div class="icon-block">
                    <h2 class="center blue-grey-text text-darken-3"><i class="material-icons medium">people</i></h2>
                    <h5 class="center"><?= $this->lang->line('community_title'); ?></h5>
                    <p class="light center"><?= $this->lang->line('community_text'); ?></p>
                </div>
            </div>

            <div class="col s12 m4 animatable bounceIn">
                <div class="icon-block">
                    <h2 class="center blue-grey-text text-darken-3"><i class="material-icons medium">photo_camera</i></h2>
                    <h5 class="center"><?= $this->lang->line('photography_title'); ?></h5>
                    <p class="light center"><?= $this->lang->line('photography_text'); ?></p>
                </div>
            </div>

            <div class="col s12 m4 animatable bounceInRight">
                <div class="icon-block">
                    <h2 class="center blue-grey-text text-darken-3"><i class="material-icons medium">calendar_today</i></h2>
                    <h5 class="center"><?= $this->lang->line('events_title', TRUE); ?></h5>
                    <p class="light center"><?= $this->lang->line('events_text'); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="carousel carousel-slider z-depth-5">
    <?php foreach($instagram_feed as $post): ?>
    <div class="carousel-item white">
        <div class="row">
            <div class="col s12 m6 offset-l2 l6">
                <h2 style="text-transform: uppercase;"><?= explode('#', $post->caption->text)[1].' '.explode('#', $post->caption->text)[2];?></h2>
                <p><?= preg_replace("~\#(\w+)~i", '', $post->caption->text); ?></p>
                <a class="btn waves-effect white black-text" href="<?= $post->link; ?>" target="_blank"  rel="noopener">See post</a>
            </div>
            <div class="col s12 m6 l4 hide-on-small-only valign-wrapper" style="height: 400px;">
                <img alt="Instagram post" class="z-depth-3" style="width: 100%;" src="<?= $post->images->standard_resolution->url; ?>"/>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<div class="section">
    <div class="container">
        <h3 class="center">FAQ</h3>
        <ul class="collapsible popout">
        <?php
            $questions = $this->lang->line('faq_questions');
            $answers = $this->lang->line('faq_answers');
            $count = 0;
            foreach ($questions as $value) {
                $count += 1;
                echo '<li><div class="collapsible-header black-text" tabindex="0"><i class="material-icons">expand_more</i>'.$questions['faq_q'.$count].'</div><div class="collapsible-body black-text"><span>'.$answers['faq_a'.$count].'</span></div></li>';
            }
        ?>
        </ul>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.slider').slider({
            interval: 10000
        });
        $(".indicators li:nth-child(1)").addClass("active");
    });
</script>
