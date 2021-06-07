<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<section class="jumbotron">
  <h1><?= $this->lang->line('spotlights_title')?></h1>
  <p><?= $this->lang->line('spotlights_subtitle')?></p>
  <a href="<?= base_url('contact') ?>" class="button">Contact</a>
</section>
<section id="cd-timeline" class="cd-container">
  <?php foreach($spotlights as $spotlight): ?>
		<div class="cd-timeline-block">
			<div class="cd-timeline-img">
			</div>

			<div class="cd-timeline-content z-depth-5">
				<h2><?= $spotlight->title; ?></h2>
        <div class="timeline-content-info">
          <span class="timeline-content-info-date">
            <i class="fa fa-calendar-plus" aria-hidden="true"></i>
            <?= date("d-m-Y", strtotime($spotlight->date)) ?>
          </span>
          <br>
          <span class="timeline-content-info-location">
            <i class="fa fa-location-arrow" aria-hidden="true"></i>
            <?= $spotlight->location; ?>
          </span>
        </div>
				<p><?= $spotlight->description; ?></p>
        <ul class="content-organisators">
          <?php $organisators = explode(";", $spotlight->organisators) ?>
          <?php foreach ($organisators as $organisator): ?>
            <li><a href="<?= explode('~', $organisator)[0] ?>" target="_blank"><?= explode('~', $organisator)[1] ?></a></li>
          <?php endforeach; ?>
        </ul>
			</div>
		</div>
    <?php endforeach; ?>
	</section>
