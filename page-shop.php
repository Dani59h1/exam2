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
      grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
      gap: 2rem;
	  margin-inline: 5rem;
    }

	h1 {
		font-size: 4rem;
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
  padding: 10px 24px; /* Some padding */
  margin-bottom: 0.5rem;
  cursor: pointer; /* Pointer/hand icon */
  width: 100%; /* Set a width if needed */
  display: block; /* Make the buttons appear below each other */
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
		<button data-produkt="alle" class="selected">Alle</button>	</nav>
			<section id="container"></section>
		

</section>
</main>

<script>
let produkter;
let categories;
let filterProdukt = "alle";
const select = document.querySelector("#filtrering");

			const dbUrl = "https://nicknadeemkaastrup.dk/kea/2_semester_eksamen/wordpress/wp-json/wp/v2/produkt?per_page=100";
			const catUrl = "https://nicknadeemkaastrup.dk/kea/2_semester_eksamen/wordpress/wp-json/wp/v2/categories";

async function getJson (){
	console.log("array")
	const data = await fetch(dbUrl);
	const catdata = await fetch(catUrl);
	produkter = await data.json();
	categories = await catdata.json();
	visProdukter();
	opretknapper();
	addEventListenersToButtons();
}

//Opretter knapper udover ALLE
function opretknapper (){
	categories.forEach(cat =>{
	document.querySelector("#filtrering").innerHTML += `<button class="filtrering" data-produkt="${cat.id}">${cat.name}</button>`
	})
}

function addEventListenersToButtons(){
	document.querySelectorAll("#filtrering button").forEach(elm =>{
		elm.addEventListener("click", filtrering);
	})

};

function filtrering(){
	filterProdukt = this.dataset.produkt;
	console.log (filterProdukt);
	visProdukter();

}

function visProdukter(){
	let temp = document.querySelector("template");
	let container = document.querySelector ("#container")
	console.log("produkter")
	container.innerHTML = "";
	produkter.forEach(produkt => {
		if (filterProdukt == "alle" || produkt.categories.includes(parseInt(filterProdukt))) {
			let klon = temp.cloneNode(true).content;
			klon.querySelector(".title").textContent = produkt.title.rendered;
			klon.querySelector("img").src = produkt.billede.guid;
			klon.querySelector(".pris").textContent = produkt.pris + " kr";
			klon.querySelector(".grid-menu").addEventListener("click", ()=> {location.href = produkt.link;})
			container.appendChild(klon);


	}
})
}
getJson();
</script>				
</section>

<?php
get_footer();