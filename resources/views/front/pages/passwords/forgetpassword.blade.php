<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    #header {
        padding: 30px 0;
        height: 22px;
        left: 0;
        top: 0;
        right: 0;
        transition: all 0.5s;
        z-index: 997;
        background-color: #fff;
        box-shadow: 5px 0px 15px #c3c3c3;
    }
    #header #logo h1 {
        font-size: 24px;
        margin: 0;
        padding: 0;
        line-height: 1;
        font-family: "Montserrat", sans-serif;
        font-weight: 700;
        letter-spacing: 3px;
    }
    #header #logo h1 a, #header #logo h1 a:hover {
        color: #000;
        padding-left: 10px;
        border-left: 4px solid rgb(255, 138, 128);
    }

</style>
<header id="header">
    <div class="container">
        <div id="logo" class="pull-left">
            <h1><a href="{{ url('/') }}" style="color:rgb(255, 138, 128)" class="scrollto">Seizop</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->
        </div>
    </div>
</header><!-- #header -->
<div class="container" style="margin-top:20px">
    <div class="row">
        <b> Hi
            @if(isset($name)){{ $name->username }}@endif </b>
        <div class ="clearfix"></div>
        <br>
        Vous avez soumis une demande de réinitialisation de votre mot de passe!<br>
        <div class ="clearfix"></div>
        <br>
        <div class="col-md-4">
            <a href="{{ $baseUrl }}" type="button" class="btn btn-azure btn-block" >Réinitialisez votre mot de passe</a>
        </div>
        <div class ="clearfix"></div>
        <br>
        Thank you for using <br>
              The  team

    </div>
    <div class ="clearfix"></div>
    <br>
   <!--  <div class="row" style="background:#f6f7f8;">
        Ce lien de réinitialisation de mot de passe expirera dans 2 heures. Après cela, vous devrez soumettre une  
        <a href="{{ url('/forgetPassword') }}">nouvelle demande</a> .
        Si vous n'avez pas demandé de réinitialisation de mot de passe, aucune autre action n'est requise.
    </div> -->

</div>