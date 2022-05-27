<?php
/**
 * The template for displaying front page
 */

get_header();
?>

<template>
	<article class="grid-menu">
      	<img src="" alt="" />

      	<div class="info">
			  <img src="" alt="">
			<h3 class="title"></h3>
			<p class="pris"></p>
      </div>
    </article>
</template>

<style>
	/* #content {
		background: #dee5c8;
	}

	h2::before {
		display: none;
	}

	

    article {
      cursor: pointer;
	  background: white;
	  display: flex;
	  flex-direction: column;
	  border-radius: 10px;
    }

    .grid-menu img {
      width: 100%;
	  height: 100%;
      border-radius: 10px 10px 0 0;
      object-fit: cover;
      aspect-ratio: 8/5;
    }

    .info {
      padding: 1rem;
	  background: grey;
	  border-radius: 0 0 10px 10px;
    }

	.info h3, .info p {
		color: white;
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

	p.desc {
		margin: 0;
	}

	#filter {
		display: flex;
		flex-wrap: wrap;
		flex-direction: row;
		gap: 1rem;
		margin: 1rem 0;
	}
	
	.ast-container {
		max-width: 1500px;
	}

	.selected, .selected:hover, .selected:focus {
		background: #315743;
		color: white;
	}

	 */

	 #container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
      gap: 1rem;
    }
	
	 @media (max-width: 921px) {
	  #container {
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      }
	}

</style>

	<div id="primary" class="content-area">
		<main id="main" class="site-main"></main><!-- #main -->
		
		<nav id="filter">

			<button data-projekt="alle" class="selected">Alle</button>
			<button data-projekt="9">Glas</button>
			<button data-projekt="6">Lamper</button>
			<button data-projekt="7">Møbler</button>
			<button data-projekt="8">Opbevaring</button>
		

			<!-- <select>
				<option value="alle">Verdensmål</option>
				<option value="7">1 - Afskaf fattigdom</option>
				<option value="8">2 - Stop sult</option>
				<option value="9">3 - Sundhed og trivsel</option>
				<option value="10">4 - Kvalitetsuddannelse</option>
				<option value="11">5 - Ligestilling mellem kønnene</option>
				<option value="12">6 - Rent vand og sanitet</option>
				<option value="13">7 - Bæredygtig energi</option>
				<option value="14">8 - Anstændige jobs og økonomisk vækst</option>
				<option value="15">9 - Industri innovation og infrastruktur</option>
				<option value="16">10 - Mindre ulighed</option>
				<option value="17">11 - Bæredygtige byer og lokalsamfund</option>
				<option value="18">12 - Ansvarligt forbrug og produktion</option>
				<option value="19">13 - Klimaindsats</option>
				<option value="20">14 - Livet i havet</option>
				<option value="21">15 - Livet på land</option>
				<option value="22">16 - Fred retfærdighed og stærke institutioner</option>
				<option value="23">17 - Partnerskaber for handling</option>
			</select> -->

		</nav>
		<section id="container"></section>
		

<!-----------------------SCRIPT------------------------------------>


		<script>
			let varer;
			let categories;
			let filterVare = "alle";
			const select = document.querySelector("#filter select");

			const dbUrl = "https://nicknadeemkaastrup.dk/kea/2_semester_eksamen/wordpress/wp-json/wp/v2/vare?per_page=100";
			const catUrl = "https://nicknadeemkaastrup.dk/kea/2_semester_eksamen/wordpress/wp-json/wp/v2/categories";

			async function getJson() {
				const data = await fetch(dbUrl);
				const catdata = await fetch(catUrl);
				varer = await data.json();
				categories = await catdata.json();
				console.log(varer);
				console.log(categories);
				visVarer();
				addEventListenerToButtons();
				// addEventListenerToSelector();
			}

			//Buttons
			function addEventListenerToButtons() {
				document.querySelectorAll("#filter button").forEach(element => {
					element.addEventListener("click", filtrering)
				})
			}


			function filtrering() {
				filterVare = this.dataset.vare;
				document.querySelector(".selected").classList.remove("selected");
     			this.classList.add("selected");
				// document.querySelector("select").value = "alle";
				visVarer();
				console.log(filterVare);
			}

			// function addEventListenerToSelector() {
			// 	select.addEventListener("click", filtreringSelect)
			// }

			// function filtreringSelect() {
			// 	filterVare = select.options[select.selectedIndex].value;
			// 	document.querySelector(".selected").classList.remove("selected");
			// 	document.querySelector("#filter button:first-of-type").classList.add("selected");
			// 	visVarer();
			// }

			function visVarer() {
				let container = document.querySelector("#container");
     			let temp = document.querySelector("template");

				 //tøm visning: 
				container.innerHTML = ""; 

				varer.forEach(vare => {
					if (filterVare == "alle" || vare.categories.includes(parseInt(filterVare))) {
						console.log(vare.categories);
						let klon = temp.cloneNode(true).content;
						klon.querySelector("img").src = vare.billede.guid;
						klon.querySelector(".title").textContent = vare.overskrift;
						klon.querySelector(".pris").textContent = vare.pris;

						if (vare.categories.includes(9)) {
							klon.querySelector(".info").classList.add("Glas");
						} else if (vare.categories.includes(6)) {
							klon.querySelector(".info").classList.add("Lamper");
						} else if (vare.categories.includes(7)) {
							klon.querySelector(".info").classList.add("Møbler");
						} else if (vare.categories.includes(8)) {
							klon.querySelector(".info").classList.add("Opbevaring");
						}
						
						//Beskrivelse:
						// klon.querySelector(".desc").textContent = vare.beskrivelse;

						klon.querySelector("article").addEventListener("click", () => {
							location.href = vare.link;
						})
						container.appendChild(klon);
					}
				})
			}
			getJson();
			


		</script>
	</div><!-- #primary -->

<?php
get_footer();
