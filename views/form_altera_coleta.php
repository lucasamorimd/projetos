<?php
session_start();
if(isset($_SESSION['UsuarioLogado']) && $_SESSION['PerfilEmpresa'] == 1){
  $logado = true;
  $id_empresa = $_SESSION['id_empresa'];
  $nome = $_SESSION['NomeUsuarioLogado'];
  $perfil = $_SESSION['PerfilEmpresa'];
  $cnpj = $_SESSION['cnpj'];
  $email = $_SESSION['EmailEmpresa'];
  $senha = $_SESSION['SenhaEmpresa'];
  $telefone = $_SESSION['telefoneEmpresa'];
  $local = $_SESSION['LocalEmpresa']; 
}else{
  $resultado = "VOCÊ NÃO É AUTORISADO!";
  Header("Location:../index.php?mensagem={$resultado}");
}
if(isset($_GET['id_coleta'])){
	require_once '../models/DAO/bd_coleta.php';
	$id_coleta = $_GET['id_coleta'];
	$coletinha = new bd_coleta;
	$coleti = $coletinha->pesquisarcoletaidAlt($id_coleta);
foreach ($coleti as $coletin) {
	# code...
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Recicle</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

</head>
  
  <body>

  	<nav class="blue" role="navigation">
  	  <div class="nav-wrapper container">
  	    <a id="logo-container" href="../painel_empresa/index.php" class="brand-logo">Logo</a>


  	    <ul id="nav-mobile" class="sidenav">
  	      <li><a href="#">Navbar Link</a></li>
  	    </ul>
  	    <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
  	  </div>
  	</nav>
    <main>
    <section class="content">
      
      <div class="container">
        <h3>Informações da Coleta</h3>
        <br>
        <form class="col s12" action="../controllers/coleta/alt_coleta.php" method="post">
                        <div class="row">
                          <label>Data da Coleta</label>
                          <div class="input-field col s12">
                              <input id="data" name="data_coleta" type="date" value="<?php echo $coletin->data_coleta;?>">
                            
                          </div>
                        </div>
                    
                        <div class="row">
                          <label>Horário da Coleta</label>
                          <div class="input-field col s12">
                              <input id="hora" value="<?php echo $coletin->hora;?>" name="hora" type="time">
                            
                          </div>
                        </div>                        
                        <div class="row">
                          <label>Local</label>
                          <div class="input-field col s12">
                              <input id="local" value="<?php echo $coletin->local_coleta; ?>" name="local_coleta" type="text">
                            
                          </div>
                          <div class="input-field col s12">
                              <input id="coleta" value="<?php echo $coletin->id_coleta; ?>" name="id_coleta" type="hidden">
                            
                          </div>

                        <div class="input-field col s12">
                            <select class="browser-default" name="id_condominio" disabled="disabled" >
                                <option selected value=""><?php echo $coletin->nome;?></option>
                                <?php
                                require_once '../models/DAO/bd_morador.php';

                                $condominio = new bd_morador;//objeto da clase

                                $cond = $condominio->pesquisarCondominio(); //executando função do objeto

                                foreach ($cond as $key) {
                                	# code...
                                
                                ?>
                                <option value="<?php echo $key->id_condominio; ?>"><?php echo $key->nome; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input-field col s12">
                            <select class="browser-default" name="id_residuo" disabled="disabled">
                                <option selected value=""><?php echo $coletin->tipo;?></option>
                                <?php
                                require_once '../models/DAO/bd_residuo.php';

                                $residuo = new bd_residuo;//objeto da clase

                                $resi = $residuo->pesquisarresiduoid($id_empresa); //executando função do objeto

                                foreach ($resi as $k) {
                                  # code...
                                
                                ?>
                                <option value="<?php echo $k->id_residuo; ?>"><?php echo $k->tipo; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                      
                        
                        <div class="carousel-fixed-item center">
                            <button id="submit-form" type="reset" class="btn btn-sucsses">limpar</button> 
                            <input class="btn btn-success" type="submit" value="Alterar" />
                            
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

      $(document).ready(function(){
        $('select').formSelect();
      });

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
  </body>
</html>