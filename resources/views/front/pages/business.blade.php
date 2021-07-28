@extends('layouts.site')

@section('content')

      <header class="maphead">

            <div class="container">

            <div class="col-md-6">
                <div class="masthead-subheading">Bus Business</div>
                <div class="">Stopi est une solution abordable, pratique et fiable qui valorise 
                    le secteur des déplacements domicile-travail en offrant des solutions partagées 
                    pour les particuliers et les entreprises. Téléchargez Bus et découvrez plus</div><br>
                
             <div class="col-md-6">
            </div>
        </div>
        </header>
            <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">TRANSPORTATION FOR COMPANY EMPLOYEES</h2>
                    <h3 class="section-subheading text-muted">BUS construit les mégapoles des marchés émergents un système 
                        de transport en commun privé qui comble le fossé entre les transports publics cassés et les services à la demande coûteux.

Chez BUS, nous exploitons des itinéraires fixes / dynamiques qui offrent un prix abordable, la fiabilité, la commodité et la sécurité.
 Alimenter les programmes de transport en commun et de transport des organisations.
 Bus organise le transport B2B grâce à des solutions 
                                    logistiques avancées optimisées par
technologies avancées pour faciliter l'organisation d'un grand nombre de personnes</h3>
                </div>
           
            </div>
        </section>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                 
                    <h2 class="section-subheading text-align">MODÈLES FLEXIBLES POUR TOUTES LES TAILLES D'ENTREPRISE</h2>
                    <h3 class="section-subheading text-align">Choisissez le modèle qui vous convient. Vous n'avez que 4 employés? Donnez-leur un avantage de Buseet et évitez les tracas de trajet. Vous avez des centaines d'employés?
                     Offrez-leur une flotte privée avec des itinéraires personnalisables.</h3>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-road fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Lignes de bus dédiées</h4>
                        <p class="text-muted">Fournit des bus privés dédiés avec des itinéraires personnalisés</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-chair fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Manèges scolaires</h4>
                        <p class="text-muted">Des trajets quotidiens plus sûrs et plus fiables vers les écoles pour les étudiants.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-phone fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Codes promotionnels spéciaux</h4>
                        <p class="text-muted">Fournit des codes promotionnels mensuels pour chaque employé avec des prix réduits autres que les prix de réservation normaux sur demande </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Portfolio Grid-->
    

        <!-- Clients-->
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid d-block mx-auto" src="{{asset('assets/assets/img/logos/envato.jpg')}}" alt="" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid d-block mx-auto" src="{{asset('assets/assets/img/logos/designmodo.jpg')}}" alt="" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid d-block mx-auto" src="{{asset('assets/assets/img/logos/themeforest.jpg')}}" alt="" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid d-block mx-auto" src="{{asset('assets/assets/img/logos/creative-market.jpg')}}" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Buseet Transportation Request Form</h2>
                    <h3 class="section-subheading text-muted">Remplissez le formulaire et nous vous contacterons..</h3>
                </div>
                <form id="contactForm" name="sentMessage" novalidate="novalidate">
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" id="name" type="text" placeholder="Nom*" required="required" data-validation-required-message="Please enter your name." />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="email" type="email" placeholder=" Email *" required="required" data-validation-required-message="Please enter your email address." />
                                <p class="help-block text-danger"></p>
                            </div>
                                <div class="form-group">
                                <input class="form-control" id="name" type="text" placeholder="Nom de la Societe*" required="required" data-validation-required-message="Please enter your name." />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group mb-md-0">
                                <input class="form-control" id="phone" type="tel" placeholder="Mobile *" required="required" data-validation-required-message="Please enter your phone number." />
                                <p class="help-block text-danger"></p>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <textarea class="form-control" id="message" placeholder=" Message (Optionel) *" required="required" data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div id="success"></div>
                        <button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">Envoyer</button>
                    </div>
                </form>
            </div>
        </section>
@endsection