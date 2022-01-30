<script>
	document.addEventListener("DOMContentLoaded", function () {

		let images = [];
		images[1] = "<img src='img/customer_opinion_person_photo/customer_opinion_person_photo1.png' alt=''>";
		images[2] = "<img src='img/customer_opinion_person_photo/customer_opinion_person_photo2.png' alt=''>";
		images[3] = "<img src='img/customer_opinion_person_photo/customer_opinion_person_photo3.png' alt=''>";
		images[4] = "<img src='img/customer_opinion_person_photo/customer_opinion_person_photo4.png' alt=''>";
		images[5] = "<img src='img/customer_opinion_person_photo/customer_opinion_person_photo5.png' alt=''>";
		images[6] = "<img src='img/customer_opinion_person_photo/customer_opinion_person_photo6.png' alt=''>";
		images[7] = "<img src='img/customer_opinion_person_photo/customer_opinion_person_photo7.png' alt=''>";
		images[8] = "<img src='img/customer_opinion_person_photo/customer_opinion_person_photo8.png' alt=''>";
		let liczba = Math.floor((Math.random() * 5) + 1);
		document.getElementById('obraz').innerHTML = images[liczba];

		let opis_komentarza = [];
		opis_komentarza[1] =
			"<p> Jest to <strong>najwygodniejszy klimatyzator</strong>, z jakim miałam dotychczas doczynienia! Naprawdę fajne urządzenie. </p><h3> Janina Nowak </h3>";
		opis_komentarza[2] =
			"<p> Nareszcie mogę <strong>normalnie funkcjonować</strong>, w letnie upalne dni. Bardzo polecam to urządzenie!. </p><h3> Janina Nowak </h3>";
		opis_komentarza[3] =
			"<p> Zdecydowanie! <strong>mogę polecić to urządzenie każdemu</strong>, kto wychowując małe dzieci, boi się, że to urządzenie będzie głośne. </p><h3> Janina Nowak </h3>";
		opis_komentarza[4] =
			"<p> Komfort który sprawił mi ten produkt, sprawił, żem moje życie <strong> stało się bardziej komfortowe</strong> </p><h3> Janina Nowak </h3>";
		let okres = Math.floor((Math.random() * 4) + 1);
		document.getElementById('komenatarz').innerHTML = opis_komentarza[okres];

	});
</script>

<section class="sec-block pb-0">
	<div class="fixed-bg"></div>
	<div class="container">
		<div class="testimonial-section">
			<div class="row">
				<div class="col-lg-4">
					<div id="obraz" class="testi-img" data-aos="fade-up" data-aos-duration="1000">
						<img load="lazy" src="img/customer_opinion_person_photo/customer_opinion_person_photo8.png"
							alt="">
					</div>
				</div>
				<div class="col-lg-8">
					<div class="testi-slides">
						<div id="komenatarz" class="testi-comment">
							<p> Jest to <strong>najwygodniejszy klimatyzator</strong>, z jakim miałam dotychczas
								doczynienia! Naprawdę fajne urządzenie. </p>
							<h3> Janina Nowak </h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>