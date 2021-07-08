<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Recicle</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

</head>
  
  <body>
  	<nav class="light-blue" role="navigation">
  	  <div class="nav-wrapper container">
  	    <a id="logo-container" href="../index.php" class="brand-logo">Recicle</a>



 
  	  </div>
  	</nav>
    <main>
    <section class="content">
      
      <div class="container">
        <h3>Informações da Empresa</h3>
        <br>
        <form class="col s12" action="../controllers/empresa/ctrl_empresa.php" method="post">
                        <div class="row">
                          <div class="input-field col s12">
                              <input id="nome" name="nome" type="text" placeholder="Nome">
                            
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                              <input id="cnpj" placeholder="CNPJ" name="cnpj" type="number">
                            
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                              <input id="email" placeholder="Email" name="email" type="text">
                            
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                              <input id="local" placeholder="Local" name="local" type="text">
                            
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                              <input id="telefone" placeholder="Telefone" name="telefone" type="text">
                            
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                              <input type="password" name="senha" id="senha" placeholder="Digite uma Senha" />
                            
                          </div>
                          <div class="input-field col s12">
                              <input type="password" name="confirme_senha" id="confirme_senha" placeholder="Confirme sua senha" />
                            
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                              <input id="perfil" value="1" name="perfil" type="hidden">
                            
                          </div>
                        </div>
                      
                        
                        <div class="carousel-fixed-item center">
                            <button id="submit-form" type="reset" class="btn btn-sucsses">limpar</button> 
                            <input class="btn btn-success" type="submit" value="Cadastrar" />
                            
                        </div>
                        </div>                       
                    </form>
        <br><br>
        
        
      </div>
    </section>
    </main>
    <footer class="page-footer grey darken-4">
      <div class="footer-copyright">
        <div class="container">
         
        </div>
      </div>
    </footer>
    
    <!-- So this is basically a hack, until I come up with a better solution. autocomplete is overridden
    in the materialize js file & I don't want that.
    -->
    <!-- Yo dawg, I heard you like hacks. So I hacked your hack. (moved the sidenav js up so it actually works) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
    <script>
    // Hide sideNav
    $('.button-collapse').sideNav({
    menuWidth: 300, // Default is 300
    edge: 'left', // Choose the horizontal origin
    closeOnClick: false, // Closes side-nav on <a> clicks, useful for Angular/Meteor
      draggable: true // Choose whether you can drag to open on touch screens
      });
      $(document).ready(function(){
      $('.tooltipped').tooltip({delay: 50});
      });
      $('select').material_select();
      $('.collapsible').collapsible();
      var password = document.getElementById("senha"),
       confirm_password = document.getElementById("confirme_senha");

      function validatePassword(){
        if(password.value != confirm_password.value) {
          confirm_password.setCustomValidity("Senhas diferentes!");
        } else {
          confirm_password.setCustomValidity('');
        }
      }
        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
      
      </script>
      <div class="fixed-action-btn horizontal tooltipped" data-position="top" dattooltipped" data-position="top" data-delay="50" data-tooltip="Quick Links">
        <a class="btn-floating btn-large red">
          <i class="large material-icons">mode_edit</i>
        </a>
        <ul>
          <li><a class="btn-floating red tooltipped" data-position="top" data-delay="50" data-tooltip="Handbook" href="#"><i class="material-icons">insert_chart</i></a></li>
          <li><a class="btn-floating yellow darken-1 tooltipped" data-position="top" data-delay="50" data-tooltip="Staff Applications" href="#"><i class="material-icons">format_quote</i></a></li>
          <li><a class="btn-floating green tooltipped" data-position="top" data-delay="50" data-tooltip="Name Guidelines" href="#"><i class="material-icons">publish</i></a></li>"
          <li><a class="btn-floating blue tooltipped" data-position="top" data-delay="50" data-tooltip="Issue Tracker" href="#"><i class="material-icons">attach_file</i></a></li>
          <li><a class="btn-floating orange tooltipped" data-position="top" data-delay="50" data-tooltip="Support" href="#"><i class="material-icons">person</i></a></li>
        </ul>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--Scripts
    ================================================ -->
    <!-- jQuery Library -->
    <script type="text/javascript" src="vendors/jquery-3.2.1.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="../assets/js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="../assets/js/plugins.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="../assets/js/custom-script.js"></script>
  </body>
</html>