<?php
//inicia a sessão
session_start();
//verifica se há usuario logado e seta as variaveis de sessão.
if(isset($_SESSION['UsuarioLogado'])){

$logado = true;
$nome = $_SESSION['NomeUsuarioLogado'];
$perfil = $_SESSION['PerfilEmpresa'];
$cnpj = $_SESSION['cnpj'];
$email = $_SESSION['EmailEmpresa'];
$telefone = $_SESSION['telefoneEmpresa'];
$local = $_SESSION['LocalEmpresa'];
header("/painel_empresa/index.php");
}else{//caso não haja ninguém logado
  $logado = false;

}
if (isset($_SESSION['MoradorLogado'])) {
  $moradorlogado = true;
  $nome_morador = $_SESSION['NomeMoradorLogado'];
  $perfil = $_SESSION['PerfilMorador'];
  $id_cond = $_SESSION['Condominio_Morador'];
  $email = $_SESSION['EmailMorador'];
  $senha = $_SESSION['SenhaMorador'];
  $telefone = $_SESSION['telefoneMorador'];
}else{
  $moradorlogado = false;
}
if(isset($_GET['mensagem'])){//verifica se está sendo passada alguma mensagem pela url
    $msg =$_GET['mensagem'];
   $mensagemCliente =  "M.toast({html:'".$msg."'})";
}else{
    $mensagemCliente = null;
}
?>

<!DOCTYPE html>
<html lang="en">
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
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="../index.php" class="brand-logo">Recicle</a>
      <ul class="right hide-on-med-and-down">
        <?php if($logado == true && $perfil = 1): ?>
        <li><a href="../painel_empresa/index.php">Painel de Controle</a></li>
        <?php elseif($moradorlogado == false):?>
        <li><a href="../views/form_cadastro_empresa.php">Cadastrar Empresa</a></li>
        <li><a class="modal-trigger" href="#demo-modal-fixed-footer">Login</a></li>
      <?php endif;?>
      <?php if($moradorlogado ==true):?>
        <li><a href="../controllers/login_morador.php?logout=true">Logout</a></li>
        <?php else:?>
          <li></li>
        <?php endif; ?>

</ul>
        <div id="demo-modal-fixed-footer" class="modal">
          
       
          <div class="modal-content">
       
            <div class="row">
                <form class="col s12" action="../tcc_jean/controllers/login.php" method="post">
                <div class="row">
                  <div class="input-field col s12">
                    <input name="emailEmpresa" type="email" class="validate"/>
                    <label for="text" data-error="preencha o campo corretamente" data-success="tudo certo">Email
                    </label>
                  </div>
                </div>
            
                <div class="row">
                  <div class="input-field col s12">
                      <input id="senha" name="senhaEmpresa" type="password" class="validate"/>
                    <label for="senha" data-error="preencha o campo corretamente" data-success="tudo certo">Senha</label>
                  </div>
                </div>
            </div>
                <div class="carousel-fixed-item center">
                 <button id="submit-form" type="submit" class="waves-effect waves-light btn modal-trigger">Logar</button>
                </div>     
        </div>
              </form>
              Para cadastrar sua empresa, <a href="views/form_cadastro_morador.php">Clique aqui</a>!!
       
       
      
      </div>


      <ul id="nav-mobile" class="sidenav">
        <li><a href="#">Navbar Link</a></li>
      </ul>

      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">Coleta Condominial</h1>
      <div class="row center">
        <h5 class="header col s12 light">Verifique aqui os dias, horários e locais de cada coleta!</h5>
      </div>
  <?php if($moradorlogado == false): ?>
      <div class="row center">
        <a href="#demo-modal-fixed-footer1" id="download-button" class="btn-large waves-effect modal-trigger waves-light orange">Login Morador</a>
      </div>
      <br><br>
<?php else: ?>
              <div id="work-collections">
                <div class="row">
                    <div class="col s12">
                      <h5>Coletas a Serem realizadas em seu condomínio!</h5>
                      <table class="responsive-table">
                        <thead>
                          <tr>

                            <th data-field="name">Local</th>
                            <th data-field="name">Residuo</th>

                            <th data-field="date">Data</th>
                            <th data-field="time">Hora</th>
                            <th data-field="name">Situação</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            require_once '../models/DAO/bd_coleta.php';
                            $cole = new bd_coleta;
                         if(isset($_POST['pesquisa'])){
                          $pesq = $_POST['pesquisa'];

                          $col = $cole->pesquisarcoletaMorador($id_cond,$pesq);
                         }else{
                          $col = $cole->pesquisarcoletaM($id_cond);
                         }

                            
                          
                            foreach ($col as $c) {
                              # code...
                            
                          ?>
                          <tr>

                            <td><?php echo $c->local_coleta ?></td>
                            <td><?php echo $c->tipo ?></td>
                            <td><?php echo date("d/m/Y", strtotime($c->data_coleta)); ?></td>
                            <td><?php echo date("h:m", strtotime($c->hora)); ?></td>
                            <?php if($c->feito == 0): ?>
                              <td>Em Coleta</td>
                              <?php else:?>
                                <td>Concluído</td>
                              <?php endif;?>
                            
                         
                          </tr>
  <?php }?>
                        </tbody>
                      </table>
                    </div>
                  </div>
              </div>
<?php endif;?>
    </div>
  </div>
    <div id="demo-modal-fixed-footer1" class="modal">
   
      <div class="modal-content">
   
        <div class="row">
            <form class="col s12" action="../tcc_jean/controllers/login_morador.php" method="post">
            <div class="row">
              <div class="input-field col s12">
                <input name="emailMorador" type="email" class="validate"/>
                <label for="text" data-error="preencha o campo corretamente" data-success="tudo certo">Email
                </label>
              </div>
            </div>
        
            <div class="row">
              <div class="input-field col s12">
                  <input id="senha" name="senhaMorador" type="password" class="validate"/>
                <label for="senha" data-error="preencha o campo corretamente" data-success="tudo certo">Senha</label>
              </div>
            </div>
        </div>
            <div class="carousel-fixed-item center">
             <button id="submit-form" type="submit" class="waves-effect waves-light btn modal-trigger">Logar</button>
            </div>     
          </form>
          Se vc não é cadastrado, <a href="views/form_cadastro_morador.php">Clique aqui</a>!!
   
    </div>
   
  </div>    
  


  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Speeds up development</h5>

            <p class="light">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
            <h5 class="center">User Experience Focused</h5>

            <p class="light">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Easy to work with</h5>

            <p class="light">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p>
          </div>
        </div>
      </div>

    </div>
    <br><br>
  </div>

  <footer class="page-footer orange">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Company Bio</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../js/materialize.js"></script>
  <script src="../js/init.js"></script>
<script>
  
  $(document).ready(function(){
   
      $('.modal').modal();
   
    })

  <?php echo $mensagemCliente; ?>


</script>
  </body>
</html>
