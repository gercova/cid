<!-- Home -->

<div class="home">
	<div class="home_background_container prlx_parent">
		<div class="home_background prlx" style="background-image:url(<?= $fondo ?>)"></div>
	</div>
	<div class="home_content">
		<h1>Buscar en CTI - UNSM</h1>
	</div>
</div>

<!-- News -->

<div class="news">
	<div class="container">
		<div class="row">
			<div class="col-md-8 text-center">
				<div class="mx-auto">
					<form action="post">
						<div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-center">
							<input id="Busquedad" class="newsletter_email"  placeholder="Escribe lo que buscas " style="border: 0.5px solid">
							<button id="newsletter_submit" class="newsletter_submit_btn trans_300" onclick="select_taller()" >Buscar</button>
						</div>
					</form>
				</div>
				<br>

				<div class="sidebar">
					<div class="sidebar_section">
						<div class="sidebar_section_title">
							<h3>Resultados de "informatica"</h3>
						</div>

						<div class="latest_posts row">

							<div class="col-md-6">
							<!-- Latest Post -->
								<div class="latest_post">
								<div class="latest_post_image">
									<img src="<?= base_url("public/themes/course/images/latest_1.jpg")?>" alt="https://unsplash.com/@dsmacinnes">
								</div>
								<div class="latest_post_title"><a href="news_post.html">Why do you need a qualification?</a></div>
								<div class="latest_post_meta">
									<span class="latest_post_author"><a href="#">By Christian Smith</a></span>
									<span>|</span>
									<span class="latest_post_comments"><a href="#">3 Comments</a></span>
								</div>
							</div>
							</div>
							<div class="col-md-6">
							<!-- Latest Post -->
								<div class="latest_post">
									<div class="latest_post_image">
										<img src="<?= base_url("public/themes/course/images/latest_1.jpg")?>" alt="https://unsplash.com/@dsmacinnes">
									</div>
									<div class="latest_post_title"><a href="news_post.html">Why do you need a qualification?</a></div>
									<div class="latest_post_meta">
										<span class="latest_post_author"><a href="#">By Christian Smith</a></span>
										<span>|</span>
										<span class="latest_post_comments"><a href="#">3 Comments</a></span>
									</div>
								</div>
							</div>

						</div>

					</div>
				</div>
			</div>

			<div class="col-md-4 text-center">
				<div class="sidebar_section">
					<div class="sidebar_section_title">
						<h3>Etiquetas</h3>
					</div>
					<div class="tags d-flex flex-row flex-wrap">
						<div class="tag"><a href="#">Informática</a></div>
						<div class="tag"><a href="#">Excel</a></div>
						<div class="tag"><a href="#">Taller</a></div>
						<div class="tag"><a href="#">CTI</a></div>
						<div class="tag"><a href="#">UNSM</a></div>
						<div class="tag"><a href="#">FISI</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
