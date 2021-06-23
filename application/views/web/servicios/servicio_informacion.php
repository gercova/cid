<?php



?>
<style>
	.section_title h1::before {
		display: none;
	}
</style>

<div class="home">
  <div class="home_background_container prlx_parent">
	  <div class="home_background prlx" style="background-image:url(<?= $fondo ?>)"></div>
  </div>
  <div class="home_content">
	  <h1> <?= $home_content ?></h1>
  </div>
</div>

<!-- Services -->
<div class="services page_section">
	<div class="container">
		<?php foreach ($content as $key => $v) { ?>
			<div class="row">
				<div class="col">
					<div class="section_title">
						<h1><?= $v['section_title'] ?></h1>
					</div>
					<p class="section_text">
						<?= $v['section_text'] ?>
					</p>

					<ul style="list-style: disc;font-size: 16px;color: #636363;padding-left: 1.5rem">
						<?php foreach ($v['section_text_li'] as $skey => $svalue) { ?>
							<li><?= $svalue ?></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
