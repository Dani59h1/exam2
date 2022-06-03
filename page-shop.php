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

<section id ="primary" class="content-area">
	<main id ="main" class="site-main">
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