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
  <link href="assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Recicle</a>
      <ul class="right hide-on-med-and-down">
        <?php if($logado == true && $perfil = 1): ?>
        <li><a href="painel_empresa/index.php">Painel de Controle</a></li>
        <?php elseif($moradorlogado == false):?>
        <li><a href="views/form_cadastro_empresa.php">Cadastrar Empresa</a></li>
        <li><a class="modal-trigger" href="#demo-modal-fixed-footer">Login</a></li>
      <?php endif;?>
      <?php if($moradorlogado ==true):?>
        <li><a href="controllers/login_morador.php?logout=true">Logout</a></li>
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
  <p> <h1 class="center light-blue-text">Seja bem-vindo, <?php echo $nome_morador;?></h1></p>
  <div class="row center">
    <a href="#demo-modal-fixed-footer2" id="download-button" class="btn-large waves-effect modal-trigger waves-light orange">Pesquisar Coleta</a>
  </div>
  <br><br>
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
  <div id="demo-modal-fixed-footer2" class="modal">
   
      <div class="modal-content">
            <div class="row">
                <form action="views/pesquisa_morador.php" method="post" >
                <div class="input-field col s0" style="width:40%; margin-left: 25%;">
                    <input type="date" placeholder="Pesquisar Data" name="pesquisa">               
                                  
                </div>
                <div class="input-field col s1">
                    <button type="submit" class="btn waves-effect waves-light orange darken-1"><i class="material-icons ">search</i></button>
                </div>
                    
                </form>
             
        
        </div>
   
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
                                  require_once 'models/DAO/bd_coleta.php';
                                  $cole = new bd_coleta;
                               
                                    $col = $cole->pesquisarcoletaM($id_cond);

                                  
                                
                                  foreach ($col as $c) {
                                    # code...
                                  
                                ?>
                                <tr>

                                  <td><?php echo $c->local_coleta ?></td>
                                  <td><?php echo $c->tipo ?></td>
                                  <td><?php echo date("d/m/Y", strtotime($c->data_coleta)); ?></td>
                                  <td><?php echo date("h:m", strtotime($c->hora)); ?></td>
                                  <?php if($c->feito == 1): ?>
                                  <td>Concluído</td>
                                  <?php else: ?>
                                    <td>Em Coleta</td>
                                  <?php endif;?>
                               
                                </tr>
        <?php }?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
   
    </div>
   
  </div>


  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Marque Coletas Rapidamente</h5>

            <p class="light">Aqui sua empresa de coletas condominiais poderá marcar suas coletas nos condomínios filiados rapidamente. Específicar quais os tipos de resíduos que coletará e o local de suas coletas no condomínio.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
            <h5 class="center">É também para os moradores</h5>

            <p class="light">Moradores dos condomínios filiados ao sistema poderam consultar as coletas feitas para o condomínio onde reside, com detalhes de data, hora e situação da coleta.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Fácil de trabalhar</h5>

            <p class="light">Com um design bem fácil, o painel da empresa tem toda uma estrutura pensada na facilidade em marcar um horário remover ou alterar horário, tudo de forma simples.</p>
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
          <h5 class="white-text">LAD566</h5>
          <p class="grey-text text-lighten-4">Meu nome é Lucas amorim, desenvolvi este sistema para ajudar um amigo em seu tcc do curso técnico e está aqui como portfólio, estou iniciando profissionalmente na área de desenvolvimento backend. Esse sistema foi desenvolvido com PHP e o template com o framework Materialize.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Vamos conversar melhor por aqui.</h5>
          <ul>
            <li><a class="white-text" href="http://instagram.com/lucaasamoorim">Instagram</a></li>
            <li><a class="white-text" href="https://www.linkedin.com/in/lucas-amorim-b87541128/">LinkedIn</a></li>
          </ul>
        </div>

      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Template utilizado <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="assets/js/materialize.js"></script>
  <script src="assets/js/init.js"></script>
<script>
  
  $(document).ready(function(){
   
      $('.modal').modal();
   
    })

  <?php echo $mensagemCliente; ?>


</script>
  </body>
</html>
