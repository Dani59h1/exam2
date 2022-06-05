<?php
/**
 * The template for displaying front page
 */

get_header();
?>

	<style>

		.singleshop { 
			margin-inline: 1rem;
			padding-top: 1rem;
		}

		.singleshop .itemm h1 {
			color: black;
			font-size: 3rem;
			padding-top: 0;
			margin-top: 0;
			
		}

		.pris {
			color: black;
			font-size: 1rem;
			padding: 0;
			margin-bottom: 0.5rem;
		}

		.pecture .img {
			/* margin: 0 auto; */
			border-style: solid;
  			border-width: 10px;
  			border-image: linear-gradient(45deg, #ffed3f, #a6d47f) 1;
		}

		.kurv {
			background-color: #a6d47f;
			color: black;
			border-radius: 2px;
			padding: 10px 20px;
			margin-bottom: 1rem;
		}

		.kurv:hover {
			background-color: #a6d47f;
			transform: scale(1.1);
			transition: 0.2s;
			color: white;
		}
		
		#tilbage {
			background-color: #a6d47f;
			color: black;
			border-radius: 2px;
			padding: 7px 10px;
			font-size: 0.8rem;
		}

		#tilbage:hover {
			background-color: #a6d47f;
			transform: scale(1.1);
			transition: 0.2s;
			color: white;
		}

		.kurv:active, .kurv:focus  {
			background-color: #e8bef9;
			color: #1f5373;
		}

		@media (min-width: 770px) {
		
			.singleshop {
				display: grid;
				grid-template-columns: 1fr 1fr;
				gap: 1rem;
			}

				.pecture {
			max-width: 450px;
			justify-self: center;
			}

			.pecture img {
					max-width: 400px;
			}

			.beskrivelse {
				max-width: 700px;
			}

			/* .kurv {
				float: right;
				margin-right: 2rem;
			} */

			#tilbage {
				margin-left: 2rem;
			}

			.mal, .farve, .materiale {
				font-size: 0.8rem;
			}

		}
		
	</style>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<form>
 		<input id="tilbage" type="button" value="Tilbage" onclick="history.back()">
		</form>

			<article class="single">

				<div class="singleshop">

				<div class="pecture">
				<img class="img" src="" alt="" />
				</div>

				<div class="itemm">
					
					<h1>Titel</h1>
					<p class="beskrivelse"></p>
					<p class="pris"></p>

					<button class="kurv">Læg i kurv</button>

					<h4 class="praktisk">PRAKTISK INFO</h4>
					<p class="mal"> </p>
					<p class="farve"></p>
					<p class="materiale"></p>

				</div>

				</div>

			</article>
		</main><!-- #main -->


		<script>
			let produkt;
			const url = "https://nicknadeemkaastrup.dk/kea/2_semester_eksamen/wordpress/wp-json/wp/v2/produkt/"+<?php echo get_the_ID()?>;
       
			async function getJson() {
				const jsonData = await fetch(url); 
                produkt = await jsonData.json();
				visProdukter();
			}

			function visProdukter() {
				console.log("produkter") 
				document.querySelector(".img").src = produkt.billede.guid;
				document.querySelector("h1").textContent = produkt.overskrift;
				document.querySelector(".beskrivelse").textContent = produkt.beskrivelse;
				document.querySelector(".itemm .pris").textContent = produkt.pris + " kr";
				document.querySelector(".mal").textContent = "MÅL: " + produkt.mal;
				document.querySelector(".farve").textContent = "FARVE: " + produkt.farve;
				document.querySelector(".materiale").textContent = "MATERIALE: " + produkt.materiale;
		

			}
			getJson();
		</script>
	</section><!-- #primary -->

<?php
get_footer();