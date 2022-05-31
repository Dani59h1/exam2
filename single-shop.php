<?php
/**
 * The template for displaying front page
 */

get_header();
?>

	<!-- <style>
		.devider {
			width: 100%;
			height: 3rem;
			background: lightgrey;
			grid-area: devider;
			align-self: end;
   			color: white;
    		font-weight: bold;
    		padding: 0 1rem;
    		display: flex;
    		align-items: center;
		}
		.globalt-medborgerskab {
			background: #C2202F;
		}
		.baeredygtig-udvikling {
			background: #4AA047;
		}
		.unesco-verdensmalsskoler {
			background: #186B9D;
		}
		.short {
			display: flex;
			flex-direction: column;
			grid-area: short;
		}
		.short a {
			padding: 1rem 2rem;
			background: white;
			color: black;
			align-self: flex-start;
			margin: 1rem 0;
		}
		.info {
			background: #eee;
			padding: 1rem;
			grid-area: info;
		}
		.info p {
			margin: 0;
		}
		article.single {
			align-items: start;
   			display: grid;
    		grid-template-areas: "img title title"
								 "img devider devider"
								 "info short short";
    		gap: 1rem;
		}
		.img {
			min-width: 200px;
			grid-area: img;
			object-fit: cover;
			height: 100%;
		}
		.title {
			grid-area: title;
		}
		@media (max-width: 770px) {
			article.single {
				grid-template-areas: "title"
									 "devider"
									 "img"
									 "info"
									 "short"

			}
		}
	</style> -->

	<div id="primary" class="content-area">

		<main id="main" class="site-main">
			<article class="single">

				<img class="img" src="" alt="" />

					<div class="title">
						<h1>Titel</h1>
					</div>

					<p class="beskrivelse"></p>

					<p class="pris"> </p>


			</article>
		</main><!-- #main -->


		<script>
			let vare;

			const dbUrl = "https://nicknadeemkaastrup.dk/kea/2_semester_eksamen/wordpress/wp-json/wp/v2/vare"+<?php echo get_the_ID() ?>;

			async function getJson() {
				const data = await fetch(dbUrl);
				vare = await data.json();
				// console.log(vare)
				visVarer();
			}

			function visVarer() {
				document.querySelector(".img").src = vare.billede.guid;
				document.querySelector(".title h1").textContent = vare.overskrift;
				document.querySelector(".beskrivelse").innerHTML = vare.beskrivelse;
				document.querySelector(".pris").innerHTML = vare.pris;

				// document.querySelector(".beskrivelse").innerHTML = `<b>beskrivelse</b> ${vare.beskrivelse}`
				// document.querySelector(".uddannelse").innerHTML = `<b>Uddannelsestrin</b> ${vare.uddannelsestrin}`
				// document.querySelector(".skole").innerHTML = `<b>Skolenavn</b> ${vare.skolenavn}`
				// document.querySelector(".kontakt").innerHTML = `<b>Kontakt</b> ${vare.kontakt}`
			
				// if (vare.categories.includes(6)) {
				// 	document.querySelector(".devider").classList.add("globalt-medborgerskab");
				// 	document.querySelector(".devider").textContent = "Globalt Medborgerskab"
				// } else if (vare.categories.includes(5)) {
				// 	document.querySelector(".devider").classList.add("baeredygtig-udvikling");
				// 	document.querySelector(".devider").textContent = "Bæredygtig Udvikling"
				// } else if (vare.categories.includes(24)) {
				// 	document.querySelector(".devider").classList.add("unesco-verdensmalsskoler");
				// 	document.querySelector(".devider").textContent = "UNESCO Verdensmålsskoler"
				// }
			}
			getJson();
		</script>
	</div><!-- #primary -->

<?php
get_footer();
