@extends('layouts.site')

@section('content')
 <header class="masthead">
    <div class="container h-100">
      <div class="row h-100">
        <div class="col-lg-7 my-auto">
          <div class="header-content mx-auto">
            <h1 class="mb-5">
            Achetez n'importe où au meilleure qualité prix comme si vous voyagez partout
            </h1>
             <h3 class="mb-5"> Yawy connecte les acheteurs et les voyageurs qui s'entraident pour accéder à des marchandises au meilleur choix partout dans le monde .</h3>
                  <p>Téléchargez Yawy et découvrez plus</p>

            <a href="#download" class="btn btn-outline btn-xl js-scroll-trigger">Commencez maintenant!</a>
          </div>
        </div>
        <div class="col-lg-5 my-auto">
          <div class="device-container">
            <div class="device-mockup iphone6_plus portrait white">
              <div class="device">
                <div class="screen">
                  <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                  <img src="{{asset('assets/front/assets/img/demo-screen-1.jpg')}}" width=100% height=100% alt="">
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
                    <h2 class="section-heading text-uppercase">Nos services</h2>
                    <h3 class="section-subheading text-muted">
                    Un moyen sûr, facile et économique de faire des achats de votre choix de partout dans le monde.</h3>                      
                </div>
                <div class="row text-center">
                    <div class="col-md-3">
                        <span class="fa-stack fa-4x">
                        <!-- <i class="fas fa-shopping-bag  fa-stack-1x text-primary"></i> -->
                        <img src="{{asset('/assets/front/img/shop.png')}}" height="100" width="100" style="float: left">
                            <!-- <i class="fas fa-shop fa-stack-1x text-primary"></i> -->
                        </span>
                        <h4 class="my-3">Toutes les marchandises à travers le monde sont à votre portée.</h4>
                        <!-- Toutes les marchandises à travers le monde sont à votre portée. -->
                        <p class="text-muted">  Choisissez,Achetez de n'importe où dans le monde et nos voyageurs se chargeront du reste.</p>
                        <!-- <p class="text-muted">Construit sur une technologie intelligente pour ne pas passer par toutes les stations et arriver plus rapidement..</p> -->
                    </div>
                    <div class="col-md-3">
                      <span class="fa-stack fa-4x">
                        <img src="{{asset('/assets/front/img/money.png')}}" height="100" width="100" style="float: left">

                        </span>
                        <h4 class="my-3">Gagner de l'argent en voyageant</h4>
                        <p class="text-muted">Joignez l’utile à l’agréable en rendant service à d autres en faisant des achats pour eux. Les fais des services rendus couvriront une partie de vos frais de voyage.</p>
                      </div>
                    <div class="col-md-3">
                        <span class="fa-stack fa-4x">
                        <img src="{{asset('/assets/front/img/bag.png')}}" height="100" width="100" style="float: left">
                        </span>
                        <h4 class="my-3">Livraison garantie</h4>    
                       <p class="text-muted"> Les voyageurs achètent les articles et garantissent la livraison pour le client.</p>
                        <!-- <p class="text-muted"> Support client personnalisé disponible 24 heures sur 24, tous les jours..</p> -->
                    </div>
                    <div class="col-md-3">
                        <span class="fa-stack fa-4x">
                        <img src="{{asset('/assets/front/img/pay.png')}}" height="120" width="120" style="float: left">
                        </span>
                        <h4 class="my-3">
                        Secure et Garantie de payment pour le voyageur</h4>    
                       <p class="text-muted"> Les voyageurs s’assurent de la qualité de ce qu'ils achètent, se chargent du transport et leur paiement est garanti à la livraison.</p>
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
          <h4 class="section-heading" style="color:white; font-weight: bold;"> Yawy est un réseau social qui relie les acheteurs aux voyageurs. Les acheteurs peuvent acheter tous leurs besoins partout dans le monde et expédier avec un voyageur déjà en route. Les acheteurs 
            économisent de l'argent sur l'expédition et les voyageurs gagnent de l'argent en voyageant.</p>
            
        
            <div class="badges">
            <a class="badge-link" href="#"><img src="{{asset('assets/front/assets/img/google-play-badge.svg')}}" alt=""></a>
            <a class="badge-link" href="#"><img src= "{{asset('assets/front/assets/img/app-store-badge.svg')}}" alt=""></a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="features" id="shoppers">
    <div class="container">
      <div class="text-center">
        <h2 style="font-family: Zeichen">FAIRE DU SHOPPING</h2>
        <p class="text-muted">Achetez à l'étranger et recevez des articles en utilisant Yawy.</p>
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
                  <img src="{{asset('assets/front/assets/img/demo-screen-1.jpg')}}" width=100% height=100% alt="">
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
                <i class="span1 text-primary">1</i>
                <!-- <span class="span1"> 1 </span> -->
                  <h3> Ajouter l'article que vous recherchez</h3>
                    <p class="text-muted">                
                       Créez une commande pour un produit que vous voulez et incluez des détails tels que l'endroit où un voyageur peut l'acheter et combien cela coûte.</p>
                  <!-- <p class="text-muted"> Trouvez un trajet adapté tous les jours en bus autour de la ville</p> -->
                </div>
              </div>
              <div class="col-lg-6">
                <div class="feature-item">
                
                  <i class="span1 text-primary">2</i>
                  <h3>Attendre que les voyageurs fassent des offres de livraison</h3>
                   <p class="text-muted">   
                          Les voyageurs feront des offres de livraison et vous pourrez 
                          choisir celle qui vous convient le mieux. Vous pouvez utiliser la fonction
                           de chat de l'application pour discuter et convenir avec le voyageur de tous les détails,
                           y compris la description de l'article et l'heure et le lieu de livraison..</p>
                 <!--  <p class="text-muted">Des solutions qui gèrent le transport plus efficacement pour tous les
                                types d'entreprises</p> -->
                </div>
              </div>
            </div>
            <div class="row">
        
              <div class="col-lg-6">
                <div class="feature-item">
                <i class="span1 text-primary">3</i>
                <!-- <span class="span1"> 2</span> -->
                  <h3>Accepter L'offre et payer</h3>
                 <p class="text-muted"> 
                      Une fois que vous acceptez une offre. Vous paierez le prix de l'article et la récompense convenue sur l'application et le voyageur est invité à acheter l'article pour vous.</p>
                  <!-- <p class="text-muted"> Trajets interurbains abordables entre les villes tous les jours</p> -->
                </div>
              </div>
                <div class="col-lg-6">
                <div class="feature-item">
                <i class="span1 text-primary">4</i>
                  <h3>Rencontrez votre voyageur et recevez votre article</h3>
                  <p class="text-muted"> Coordonnez un moment et un lieu public pour rencontrer votre voyageur. 
                    Lorsque vous recevez votre article, assurez-vous de confirmer la livraison afin que votre 
                    voyageur soit payé.</p>
                  <!-- <p class="text-muted"> Demandez des véhicules personnalisés pour des événements spéciaux et des rassemblements.</p> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <hr class="style18">
  <section class="features" id="travelers">
    <div class="container">
      <div class="text-center">
        <h2 style="font-family: Zeichen">VOYAGE AUTOUR DU MONDE</h2>
        <p class="text-muted">Gagner de l'argent en voyageant</p>
        <!-- <p class="text-muted">Naviguez parmi la variété de services que le bus a à offrir.</p> -->
        <hr>
      </div>
      <div class="row">
      <div class="col-lg-8 my-auto">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-6">
                <div class="feature-item">
                <i class="span1 text-primary">1</i>
                  <h3> Trouvez une commande que vous pouvez livrer et faites une offre</h3>
                    <p class="text-muted">                
                    Ajoutez votre voyage, recherchez des articles qui correspondent à votre emplacement et à vos dates et commencez à faire des offres de livraison.</p>
                  <!-- <p class="text-muted"> Trouvez un trajet adapté tous les jours en bus autour de la ville</p> -->
                </div>
              </div>
              <div class="col-lg-6">
                <div class="feature-item">
                <i class="span1 text-primary">2</i>
                  <h3>
                      Confirmez les détails de la commande</h3>
                   <p class="text-muted">   
                   utilisez la fonction de chat de l'application pour discuter des détails de la commande avec l'acheteur, tels que la description exacte de l'article et l'heure et le lieu de livraison.
                       </p>
                 <!--  <p class="text-muted">Des solutions qui gèrent le transport plus efficacement pour tous les
                                types d'entreprises</p> -->
                </div>
              </div>
            </div>
            <div class="row">
        
              <div class="col-lg-6">
                <div class="feature-item">
                <i class="span1 text-primary">3</i>
                  <h3>Achetez l'article</h3>
                 <p class="text-muted">Une fois que l'acheteur a confirmé l'offre et payé le montant convenu sur l'application, vous pouvez acheter l'article et commencer à l'emballer pour la livraison.</p>
                  <!-- <p class="text-muted"> Trajets interurbains abordables entre les villes tous les jours</p> -->
                </div>
              </div>
                <div class="col-lg-6">
                <div class="feature-item">
                <i class="span1 text-primary">4</i>
                  <h3>Livrez l'article de votre shopper et obtenez une recompense.</h3>
                  <p class="text-muted"> Coordonnez un moment et un lieu public pour rencontrer votre client. Lorsque votre acheteur confirme qu'il a reçu sa commande, nous transférons le paiement sur votre compte enregistré.</p>
                  <!-- <p class="text-muted"> Demandez des véhicules personnalisés pour des événements spéciaux et des rassemblements.</p> -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 my-auto">
          <div class="device-container">
            <div class="device-mockup iphone6_plus portrait white">
              <div class="device">
                <div class="screen">
                  <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                  <img src="{{asset('assets/front/assets/img/demo-screen-1.jpg')}}" width=100% height=100% alt="">
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
  </section>
<!-- 
  <section class="cta" id="captains">
    <div class="cta-content">
      <div class="container">

      <div class="col-lg-5">
              <h2>Devenir capitaine</h2>
        <p style="color:#fff">  
               App est un réseau social qui relie les acheteurs aux voyageurs. Les acheteurs peuvent acheter tous leurs besoins partout dans le monde et expédier avec un voyageur déjà en route. Les acheteurs économisent de l'argent sur l'expédition et les voyageurs gagnent de l'argent en voyageant.
         </p>
        <a href="#contact" class="btn btn-outline btn-xl js-scroll-trigger">Let's Get Started!</a>
      </div>
      </div>
    </div>
    <div class="overlay"></div>
  </section> -->
  <!-- <section class="contact bg-primary" id="business">
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
  </section> -->


    <!-- Contact-->
        <!-- <section class="page-section" id="contact">
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
        </section> -->
  @endsection