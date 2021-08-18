<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Massive.mn</title>
    <link href="https://fonts.googleapis.com/css?family=Heebo:400,700|IBM+Plex+Sans:600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/dist/css/style.css')}}">
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
</head>

<style>

    .hero-media-image{
        width: 35vw;
    }

</style>
<body class="is-boxed has-animations">
    <div class="body-wrap boxed-container">
        <header class="site-header">
            <div class="container">
                <div class="site-header-inner">
                    <div class="brand header-brand">
                        <h1 class="m-0">
                            <a href="#">
								
                                Massive
                            </a>
                        </h1>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <section class="hero">
                <div class="container">
                    <div class="hero-inner">
						<div class="hero-copy">
	                        <h1 class="hero-title mt-0">Gps хяналт систем</h1>
	                        <p class="hero-paragraph">Бүх төрлийн аж ахуйн нэгж болон хувь хүнд зориулсан хяналтын систем. Яг одоогийн байршил төлөв харах мөн явсан замын түүх хурд, хугцаа тооцоолж харуулна.</p>
	                        <div class="hero-cta">
								<a class="button button-primary" href="#">Дэлгэрэгүй</a>
                                <a class="button button-info" href="{{url('/login')}}">Системд нэвтрэх</a>
								<!-- <div class="lights-toggle">
									<input id="lights-toggle" type="checkbox" name="lights-toggle" class="switch" checked="checked">
									<label for="lights-toggle" class="text-xs"><span>Turn me <span class="label-text">dark</span></span></label>
								</div> -->
							</div>
						</div>
						<div class="hero-media">
							<div class="header-illustration">
								<img class="header-illustration-image asset-light" src="{{asset('assets/dist/images/header-illustration-light.svg')}}" alt="Header illustration">
								<img class="header-illustration-image asset-dark" src="{{asset('assets/dist/images/header-illustration-dark.svg')}}" alt="Header illustration">
							</div>
							<div class="hero-media-illustration">
								<img class="hero-media-illustration-image asset-light" src="{{asset('assets/dist/images/hero-media-illustration-light.svg')}}" alt="Hero media illustration">
								<img class="hero-media-illustration-image asset-dark" src="{{asset('assets/dist/images/hero-media-illustration-dark.svg')}}" alt="Hero media illustration">
							</div>
							<div class="hero-media-container">
								<img class="hero-media-image asset-light" src="{{asset('images/hero-media-light.jpg')}}" alt="Hero media">
								<img class="hero-media-image asset-dark" src="{{asset('images/hero-media-light.jpg')}}" alt="Hero media">
							</div>
						</div>
                    </div>
                </div>
            </section>

            <section class="features section">
                <div class="container">
					<div class="features-inner section-inner has-bottom-divider">
						<div class="features-header text-center">
							<div class="container-sm">
								<h2 class="section-title mt-0">Хөгжүүлэлтийн үйлчилгээ</h2>
	                            <p class="section-paragraph">Манай байгууллага нь компаны веб сайт, гар утасны аппликэйшин, веб аппликэйшин /Зарийн сайт, Худалдааны сайт, Онлайн захиалгийн сайт / системын интеграци гэх мэт программ хөгжүүлэх үйлчилгээ явуулна. </p>
								<div class="features-image">
									<img class="features-illustration asset-dark" src="{{asset('assets/dist/images/features-illustration-dark.svg')}}" alt="Feature illustration">
									<img class="features-box asset-dark" src="{{asset('assets/dist/images/features-box-dark.svg')}}" alt="Feature box">
									<img class="features-illustration asset-dark" src="{{asset('assets/dist/images/features-illustration-top-dark.svg')}}" alt="Feature illustration top">
									<img class="features-illustration asset-light" src="{{asset('assets/dist/images/features-illustration-light.svg')}}" alt="Feature illustration">
									<img class="features-box asset-light" src="{{asset('assets/dist/images/features-box-light.svg')}}" alt="Feature box">
									<img style="width:40vw" class="features-illustration asset-light" src="{{asset('images/resposive-web-design.png')}}" alt="Feature illustration top">
								</div>
							</div>
                        </div>
                        <div class="features-wrap">
                            <div class="feature is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
										<img class="asset-light" src="{{asset('assets/dist/images/feature-01-light.svg')}}" alt="Feature 01">
										<img class="asset-dark" src="{{asset('assets/dist/images/feature-01-dark.svg')}}" alt="Feature 01">
                                    </div>
									<div class="feature-content">
                                    	<h3 class="feature-title mt-0">Interface</h3>
                                    	<p class="text-sm mb-0">Сүүлийн үеийн программ хамгамжын технологи ашиглах харилцагчийн хүссэн өнгө дизайнаар хийж гүйцэтгэнэ. Мөн хэрэглэгчид ойлгомжтой ашиглахад хялбар байдлаар шийдэж өгөх бөгөөд бүх төрлийн дэлгэцийн хэмжээнд тохирон ажиллана. </p>
									</div>
								</div>
                            </div>
							<div class="feature is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
										<img class="asset-light" src="{{asset('assets/dist/images/feature-02-light.svg')}}" alt="Feature 02">
										<img class="asset-dark" src="{{asset('assets/dist/images/feature-02-dark.svg')}}" alt="Feature 02">
                                    </div>
									<div class="feature-content">
                                    	<h3 class="feature-title mt-0">Security</h3>
                                    	<p class="text-sm mb-0">Системын аюулгүй үйл ажилгаа ба нууцлал нь хамгийн нэн түрүүнд шаардагдах хэсэг бөгөөд бид системийн аюулгүй байдлийг түрүүнд тавиж өндөр түвшин гүйцэтгэнэ. Мөн харилцагчийн хүсэлтээр нэмэлт encryption, SSL тохиргоо,Firewall ip додоод холболт хийж өгнө.</p>
									</div>
								</div>
                            </div>
							<div class="feature is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
										<img class="asset-light" src="{{asset('assets/dist/images/feature-03-light.svg')}}" alt="Feature 03">
										<img class="asset-dark" src="{{asset('assets/dist/images/feature-03-dark.svg')}}" alt="Feature 03">
                                    </div>
									<div class="feature-content">
                                    	<h3 class="feature-title mt-0">Price</h3>
                                    	<p class="text-sm mb-0">Хэт хямд биш, хэт үнтэй биш. Харилцагчийн шаардлагын дагуу системийн үйл ажиллагаанд тулгуурлан хугацаа тодорхойлох ба шаардагдах хугцаанаас хамаарч үнийн санал боловсруулна.</p>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

			<section class="cta section">
                <div class="container-sm">
                    <div class="cta-inner section-inner">
                        <div class="cta-header text-center">
                            <h2 class="section-title mt-0">Биндий тухай</h2>
                            <p class="section-paragraph">Манай компани нь 2020 онд байгуулагдсан бөгөөд 5 жилийн туршлагатай хийж гүйцэтсэн ажил 20+ веб болон аппликешин, 30+ автоматжуулалт, сүлжээ зохион байгуулалт, ханалтын камер суурлуулатын ажил амжилттай гүйцэтгэсэн</p>
							<!-- <div class="cta-cta">
								<a class="button button-primary" href="#">Buy it now</a>
							</div> -->
					    </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="site-footer has-top-divider">
            <div class="container">
                <div class="site-footer-inner">
                    <div class="brand footer-brand">
                        <a href="#">
							Massive.mn
                        </a>
                    </div>
                    <ul class="footer-links list-reset">
                        <li>
                            Массив смарт системс ХХК
                            <br>Холбоо барих  <br> Майл : info@massive.mn <br> Утас 99859535, 88599990
                        </li>
                    </ul>
                    <ul class="footer-social-links list-reset">
                        <li>
                            <a href="#">
                                <span class="screen-reader-text">Facebook</span>
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.023 16L6 9H3V6h3V4c0-2.7 1.672-4 4.08-4 1.153 0 2.144.086 2.433.124v2.821h-1.67c-1.31 0-1.563.623-1.563 1.536V6H13l-1 3H9.28v7H6.023z" fill="#FFF"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="screen-reader-text">Twitter</span>
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 3c-.6.3-1.2.4-1.9.5.7-.4 1.2-1 1.4-1.8-.6.4-1.3.6-2.1.8-.6-.6-1.5-1-2.4-1-1.7 0-3.2 1.5-3.2 3.3 0 .3 0 .5.1.7-2.7-.1-5.2-1.4-6.8-3.4-.3.5-.4 1-.4 1.7 0 1.1.6 2.1 1.5 2.7-.5 0-1-.2-1.5-.4C.7 7.7 1.8 9 3.3 9.3c-.3.1-.6.1-.9.1-.2 0-.4 0-.6-.1.4 1.3 1.6 2.3 3.1 2.3-1.1.9-2.5 1.4-4.1 1.4H0c1.5.9 3.2 1.5 5 1.5 6 0 9.3-5 9.3-9.3v-.4C15 4.3 15.6 3.7 16 3z" fill="#FFF"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="screen-reader-text">Google</span>
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.9 7v2.4H12c-.2 1-1.2 3-4 3-2.4 0-4.3-2-4.3-4.4 0-2.4 2-4.4 4.3-4.4 1.4 0 2.3.6 2.8 1.1l1.9-1.8C11.5 1.7 9.9 1 8 1 4.1 1 1 4.1 1 8s3.1 7 7 7c4 0 6.7-2.8 6.7-6.8 0-.5 0-.8-.1-1.2H7.9z" fill="#FFF"/>
                                </svg>
                            </a>
                        </li>
                    </ul>
                    <div class="footer-copyright">&copy; Massive smart systems LLC 2020 all rights reserved</div>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{asset('assets/dist/js/main.min.js')}}"></script>
</body>
</html>
