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
    .themeBtn4 {
    background: #006eff;
    color: #ffffff !important;
    display: inline-block;
    font-size: 15px;
    font-weight: 500;
    line-height: 0.8;
    padding: 18px 30px;
    text-transform: capitalize;
    border-radius: 1px;
    letter-spacing: 0.5px;
	border:0px !important;
	cursor:pointer;
	border-radius:100px;

}

</style>

<div class="container text-center" style="margin-top:20px">
       <div id="logo" class="pull-left"> 
            <h1><a href="{{ url('/') }}" style="color:rgb(255, 138, 128)" class="scrollto">App</a></h1>
        </div>

        <strong>Vous pouvez maintenant faire vérifier votre e-mail. Il suffit de le confirmer ci-dessous.</strong><br>
        <div class ="clearfix"></div>
        <br>
        <div class="row center">
       <div class="col-md-12">   
        <div class="col-md-2">
            <!-- <a href="{{ $baseUrl }}" type="button" class="btn btn-azure btn-block">Confirmer mon email</a> -->
        </div>

        <div class=" col-md-4 container-fluid margin">
                <a href="{{ $baseUrl }}" target="_blank" class="themeBtn4">Confirmer mon email</a>
         </div>
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