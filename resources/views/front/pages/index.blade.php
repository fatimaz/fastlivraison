
@extends('layouts.site')

@section('content')


 <header class="masthead">
    <div class="container h-100">
      <div class="row h-100">
        <div class="col-lg-7 my-auto">
          <div class="header-content mx-auto">
            <h1 class="mb-5">Partagé des manèges remarquables</h1>
          <!--   <h3 class="mb-5">PStopi est une solution abordable, pratique et fiable qui valorise 
                    le secteur des déplacements domicile-travail en offrant des solutions partagées 
                    pour les particuliers et les entreprises. Téléchargez Bus et découvrez plus.</h3> -->

                     <h3 class="mb-5"> STOPP est une solution abordable, pratique, fiable et partagée mise au service des particuliers et les entreprises pour faciliter 
                                  les déplacements domicile-travail  . Téléchargez Bus et découvrez plus.</h3>
            <a href="#download" class="btn btn-outline btn-xl js-scroll-trigger">Commencez maintenant!</a>
          </div>
        </div>
        <div class="col-lg-5 my-auto">
          <div class="device-container">
            <div class="device-mockup iphone6_plus portrait white">
              <div class="device">
                <div class="screen">
                  <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                  <img src="{{asset('assets/front/assets/img/demo-screen-1.jpg')}}" class="img-fluid" alt="">
                </div>
                <div class="button">
                  <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>



     <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">POURQUOI STPI?</h2>
                    <h3 class="section-subheading text-muted">Parce que ton temps de tous les jours,
                        le confort et l'argent comptent.</h3>
                        Stopp est une solution qui permet avant tout aux utilisateurs d'économiser du temps et de l'argent 
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-road fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">COURTS RIDES</h4>
                        <p class="text-muted"> Stopp est Construit sur une innovation technologique intelligente pour permettre aux utilisateurs de passer par des itinéraires plus courts, 
                          gagner du temps et arriver plus rapidement à destination</p>
                        <!-- <p class="text-muted">Construit sur une technologie intelligente pour ne pas passer par toutes les stations et arriver plus rapidement..</p> -->
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-chair fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">SIÈGES CONFORTABLES</h4>
                        <p class="text-muted"> Stopp met à votre disposition des
                              bus climatisés (AC) avec des sièges espacés et confortables.</p>
                        <!-- <p class="text-muted">Montez à bord d'un bus climatisé (AC) avec des sièges confortables et un espacement..</p> -->
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-phone fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">NOUS SOMMES ICI POUR VOUS</h4>
                       <p class="text-muted"> Stopp dispose d'un Support client personnalisé disponible 24 heures sur 24, 7 jours sur 7</p>
                        <!-- <p class="text-muted"> Support client personnalisé disponible 24 heures sur 24, tous les jours..</p> -->
                    </div>
                </div>
            </div>
      </section>
      <section class="download bg-primary text-center" id="download">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto">
          <!-- <h2 class="section-heading">Facilitez vos déplacements quotidiens et laissez Stopy s'en occuper.</h2> -->
          <h2 class="section-heading"> Laissez Stopp organiser vos déplacements quotidiens et ne plus vous en occuper</h2>
          <p>Notre application est disponible sur n'importe quel appareil mobile! Téléchargez maintenant pour commencer!</p>
          <div class="badges">
            <a class="badge-link" href="#"><img src="{{asset('assets/front/assets/img/google-play-badge.svg')}}" alt=""></a>
            <a class="badge-link" href="#"><img src= "{{asset('assets/front/assets/img/app-store-badge.svg')}}" alt=""></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="features" id="features">
    <div class="container">
      <div class="section-heading text-center">
        <h2>APPLICATIONS SERVICES</h2>
        <p class="text-muted">Stopp vous permet de faire votre choix  parmi la variété de services que le bus peut vous offrir.</p>
        <!-- <p class="text-muted">Naviguez parmi la variété de services que le bus a à offrir.</p> -->
        <hr>
      </div>
      <div class="row">
        <div class="col-lg-4 my-auto">
          <div class="device-container">
            <div class="device-mockup iphone6_plus portrait white">
              <div class="device">
                <div class="screen">
                  <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                  <img src="{{asset('assets/front/assets/img/demo-screen-1.jpg')}}" class="img-fluid" alt="">
                </div>
                <div class="button">
                  <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8 my-auto">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-6">
                <div class="feature-item">
                  <i class="icon-map text-primary"></i>
                  <h3>Trajets quotidiens</h3>
                    <p class="text-muted">  Stopp vous permet de trouver en ville chaque jour un bus pour le trajet adapté à votre destination</p>
                  <!-- <p class="text-muted"> Trouvez un trajet adapté tous les jours en bus autour de la ville</p> -->
                </div>
              </div>
              <div class="col-lg-6">
                <div class="feature-item">
                  <i class="icon-briefcase text-primary"></i>
                  <h3>Business</h3>
                   <p class="text-muted">Stopp est une solution qui offrent une gestion efficace du transport du personnel pour tous les types d'entreprises.</p>
                 <!--  <p class="text-muted">Des solutions qui gèrent le transport plus efficacement pour tous les
                                types d'entreprises</p> -->
                </div>
              </div>
            </div>
            <div class="row">
        
              <div class="col-lg-6">
                <div class="feature-item">
                  <i class="fa fa-bus text-primary"></i>
                  <h3>Voyage</h3>
                 <p class="text-muted">  Stopp c'est le Transport  interurbain, sur et abordable tous les jours entre les villes</p>
                  <!-- <p class="text-muted"> Trajets interurbains abordables entre les villes tous les jours</p> -->
                </div>
              </div>
                <div class="col-lg-6">
                <div class="feature-item">
                  <i class="icon-present text-primary"></i>
                  <h3>Demandes spéciales</h3>
                  <p class="text-muted"> Stopp peut mettre à la disposition de ceux qui en font la demande des véhicules personnalisés pour des
                   événements spéciaux et des rassemblements pour des durées déterminées.</p>
                  <!-- <p class="text-muted"> Demandez des véhicules personnalisés pour des événements spéciaux et des rassemblements.</p> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="cta" id="captains">
    <div class="cta-content">
      <div class="container">
        <h2>Devenir capitaine</h2>
        <p style="color:#fff">
            Un Salaire stable.<br>
            Paiements mensuels réguliers<br>
            Horaires, itinéraires et prix fixes
         </p>
        <a href="#contact" class="btn btn-outline btn-xl js-scroll-trigger">Let's Get Started!</a>
      </div>
    </div>
    <div class="overlay"></div>
  </section>
  

  <section class="contact bg-primary" id="business">
    <div class="container">
      <h2>VOUS VOULEZ UN BUSEET POUR VOTRE ENTREPRISE?</h2>
      <p> Nous fournissons des solutions durables, des startups aux entreprises,
       garantissant une expérience de type voiture privée à un coût abordable.</p>
       ------
       <p>BUS construit les mégapoles des marchés émergents un système de transport en commun privé qui comble le fossé entre les transports publics cassés et les services à la demande coûteux. Chez BUS, nous exploitons des itinéraires fixes / dynamiques qui offrent un prix abordable, la fiabilité, la commodité et la sécurité. Alimenter les programmes de transport en commun et de transport des organisations. Bus organise le transport B2B grâce à des solutions logistiques avancées optimisées 
        par technologies avancées pour faciliter l'organisation d'un grand nombre de personnes</p>
        ----
        <p>est une solution abordable, pratique et fiable qui valorise 
                    le secteur des déplacements domicile-travail en offrant des solutions partagées 
                    pour les particuliers et les entreprises. Téléchargez Bus et découvrez plus</p>

           <a href="#contact" class="btn btn-outline btn-xl js-scroll-trigger">Contactez nous!</a>

      <ul class="list-inline list-social">
        <li class="list-inline-item social-twitter">
          <a href="#">
            <i class="fab fa-twitter"></i>
          </a>
        </li>
        <li class="list-inline-item social-facebook">
          <a href="#">
            <i class="fab fa-facebook-f"></i>
          </a>
        </li>
        <li class="list-inline-item social-google-plus">
          <a href="#">
            <i class="fab fa-google-plus-g"></i>
          </a>
        </li>
      </ul>
    </div>
  </section>


    <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center" style="margin-bottom:20px">
                    <h3 class="section-heading text-uppercase">Buseet Transportation Request Form</h2>
                    <h4 class="section-subheading text-muted">Remplissez le formulaire et nous vous contacterons.</h3>
                </div>
                    @include('admin.includes.alerts.success')
                    @include('admin.includes.alerts.errors')
                    <form class="form"  id="contactForm" name="sentMessage" novalidate="novalidate"
                          action="{{route('admin.demandes.store')}}"
                           method="POST">
                           @csrf    
              
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" id="name"  name ="name"  type="text" placeholder="Your Name *" required="required" data-validation-required-message="Please enter your name."/>
                                   @error('name')
                                                <span class="text-danger">{{$message}}</span>
                                    @enderror
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control"  name ="email" id="email" type="email" placeholder="Your Email *" required="required" data-validation-required-message="Please enter your email address." required/>
                                 @error('email')
                                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group mb-md-0">
                                <input class="form-control" id="phone" name="phone" type="tel" placeholder="Votre telephone*" required="required" data-validation-required-message="Please enter your phone number." required />
                                @error('phone')
                                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <textarea class="form-control" id="message" name="message" placeholder="Votre Message *" required="required" data-validation-required-message="Please enter a message." required></textarea>
                                @error('message')
                                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div id="success"></div>
                        <button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">Send Message</button>
                    </div>
                </form>
            </div>
        </section>
  @endsection