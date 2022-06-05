<?php
/**
 * The template for displaying front page
 */

get_header();
?>



<template>
	<article class="grid-menu">
      	<img src="" alt="" />

      	<div class="tekst">
			  <img src="" alt="">
			<h3 class="title"></h3>
			<p class="pris"></p>
			<p class="beskrivelse"></p>
      </div>
    </article>
</template>

<style>

	 #container {
      display: grid;
      /* grid-template-columns: repeat(auto-fill, minmax(400px, 1fr)); */
	  grid-template-columns: 1fr 1fr;
      gap: 1rem;
	  margin-inline: 5rem;
    }

	h1 {
		font-size: 4rem;
	}

	#filtrering {
		flex-wrap: wrap;
	}

	.filtrering {
		text-transform: uppercase;
	}

	@media (min-width: 1100px) {
		 #container {
	  grid-template-columns: 1fr 1fr 1fr;
	  margin-inline: 10rem;
	}
}
	
	 @media (max-width: 921px) {
	  #container {
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
	  margin-inline: 0;
	  padding-inline: 1rem;
      }
	}

	h1, h2 {
		margin: 0;
		text-align: center;
	}

	h1 {
		margin-bottom: 1rem;
		font-size: 3rem:
	}

	.centrermigskat {
		max-width: 700px;
		margin: 0 auto;	
		padding-inline: 1rem;
	}

	.grid-menu img {
	}

	.selected {
	}

	@media (max-width: 770px) {

	

	.filtrering, .selected {
  background-color: #ffe5e9; 
  border: 2px solid #997fa3;
  color: #1f5373; 
  padding: 10px 24px; 
  margin-bottom: 0.5rem;
  cursor: pointer; 
  width: 100%; 
  display: block; 
	}


.filtrering:hover, .selected:hover {
}

}

</style>

<section id ="primary" class="content-area">
	<main id ="main" class="site-main">

	<h1>SHOP</h1>
	<h2>NYT INTERIØR</h2>
	<div class="centrermigskat">
	<p>Her kan du finde en unik og bred produktpalette. Alt fra glas og kopper til vægdekorationer. Produkterne er håndplukket med samme omhu og sans for detalje, som butikkens vintage afdeling.</p>
	</div>

		<nav id="filtrering">
		<button data-produkt="alle" class="selected filtrering">Alle</button>	</nav>

			<section id="container"></section>
		

</section>
</main>

<script>
let produkter;
let categories;

// Produkter sorteres i starten som Alle
let filterProdukt = "alle";
const select = document.querySelector("#filtrering");

			//URL for alle produkter i rest API og viser op til 100 produkter på siden  (?per_page=100)
			const dbUrl = "https://nicknadeemkaastrup.dk/kea/2_semester_eksamen/wordpress/wp-json/wp/v2/produkt?per_page=100";
			//find kategorier oprettet i WP
			const catUrl = "https://nicknadeemkaastrup.dk/kea/2_semester_eksamen/wordpress/wp-json/wp/v2/categories";


async function getJson (){

	// henter produkter
	const data = await fetch(dbUrl);
	// henter kategorier
	const catdata = await fetch(catUrl);

	// variablerne fyldes med hentet data 
	produkter = await data.json();
	categories = await catdata.json();

	visProdukter();
	opretknapper();
	// addEventListenersToButtons();
}

//Opretter knapper udover ALLE
function opretknapper (){
	// for hver kategori laves der en knap 
	categories.forEach(cat =>{

		// knapper bliver sat ind i nav #filtrering i html (+= betyder tilføjer). Finder ID og indsætter navn
	document.querySelector("#filtrering").innerHTML += `<button class="filtrering" data-produkt="${cat.id}">${cat.name}</button>`
	})

	addEventListenersToButtons();

}

function addEventListenersToButtons(){
	// for hvert element tilføjes en event listener der ved klik laver en filtrering
	document.querySelectorAll("#filtrering button").forEach(elm =>{
		elm.addEventListener("click", filtrering);
	})
};

function filtrering(){
	//  = Ud fra det element, der er klikket på, sorteres retter tilføjet til denne kategori.
	filterProdukt = this.dataset.produkt;
	visProdukter();

}

function visProdukter(){

	let temp = document.querySelector("template");

	// produkterne sættes i container 
	let container = document.querySelector ("#container")

	// tøm efter hver visning 
	container.innerHTML = "";

	// looper JSON Filen igennem og sætter ind i HTML 
	produkter.forEach(produkt => {
		// Hvis filterProdukt er lig alle eller den givne kategori, tæller nedenstående (parseInt() fortolker som tal)
		if (filterProdukt == "alle" || produkt.categories.includes(parseInt(filterProdukt))) {
			let klon = temp.cloneNode(true).content;

			// Henter og viser udfyldt produktinformation på siden: 
			klon.querySelector(".title").textContent = produkt.title.rendered;
			klon.querySelector("img").src = produkt.billede.guid;
			klon.querySelector(".pris").textContent = produkt.pris + " kr";

			// link til single page 
			klon.querySelector(".grid-menu").addEventListener("click", ()=> {location.href = produkt.link;})

			// Tilføjer til html 
			container.appendChild(klon);


	}
})
}
getJson();
</script>				
</section>

<?php
get_footer();