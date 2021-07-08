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
if(isset($_GET['mensagem'])){
    $mensagemCliente =  "Materialize.toast('".$_GET['mensagem']."', 5000)";
}else{
    $mensagemCliente = null;
}
require_once '../models/DAO/bd_coleta.php';
$coleta = new bd_coleta;
$col = $coleta->pesquisarcoletaid($id_empresa);
$colUni = $coleta->pesquisarcoletaidUni($id_empresa);
$colNot = $coleta->pesquisarcoletaNot($id_empresa);
?>
<!DOCTYPE html>
<html lang="en">
  <!--================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 4.0
	Author: PIXINVENT
	Author URL: https://themeforest.net/user/pixinvent/portfolio
  ================================================================================ -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
    <title>Recicle - Coleta de Resíduos</title>
    <!-- Favicons-->
    <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
    <!-- For Windows Phone -->
    <!-- CORE CSS-->
    <link href="css//materialize.css" type="text/css" rel="stylesheet">
    <link href="css//style.css" type="text/css" rel="stylesheet">
    <!-- Custome CSS-->
    <link href="css/custom/custom.css" type="text/css" rel="stylesheet">
    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="vendors/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet">
    <link href="vendors/flag-icon/css/flag-icon.min.css" type="text/css" rel="stylesheet">
  </head>
  <body>
    <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START HEADER -->
    <header id="header" class="page-topbar">
      <!-- start header nav-->
      <div class="navbar-fixed">
        <nav class="navbar-color gradient-45deg-light-blue-cyan">
          <div class="nav-wrapper">
            <ul class="left">
              <li>
                <h1 class="logo-wrapper">
                  <a href="index.php" class="brand-logo darken-1">
                    <img src="images/logo/materialize-logo.png" alt="materialize logo">
                    <span class="logo-text hide-on-med-and-down">Recicle</span>
                  </a>
                </h1>
              </li>
            </ul>

            <ul class="right hide-on-med-and-down">
              <li>
                <a href="javascript:void(0);" class="waves-effect waves-block waves-light translation-button" data-activates="translation-dropdown">
                  <span class="flag-icon flag-icon-gb"></span>
                </a>
              </li>
              <li>
                <a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen">
                  <i class="material-icons">settings_overscan</i>
                </a>
              </li>
              <li>
              <?php if (count($colNot) >0): ?>
                <a href="javascript:void(0);" class="waves-effect waves-block waves-light notification-button" data-activates="notifications-dropdown">
                  <i class="material-icons">notifications_none
                    <small class="notification-badge pink accent-2"><?php echo count($colNot);?></small>
                  </i>
                </a>
                <?php else:?>
                  <a href="javascript:void(0);" class="waves-effect waves-block waves-light notification-button" data-activates="notifications-dropdown">
                    <i class="material-icons">notifications_none
                      <small class="notification"></small>
                    </i>
                  </a>
              <?php endif; ?>
              </li>
              <li>
                <a href="javascript:void(0);" class="waves-effect waves-block waves-light profile-button" data-activates="profile-dropdown">
                  <span class="avatar-status avatar-online">
                    <img src="images/avatar/avatar-7.png" alt="avatar">
                    <i></i>
                  </span>
                </a>
              </li>
              <li>
                <a href="#" data-activates="chat-out" class="waves-effect waves-block waves-light chat-collapse">
                  <i class="material-icons">format_indent_increase</i>
                </a>
              </li>
            </ul>
            <!-- translation-button -->

         
            <!-- notifications-dropdown -->
                
              
            <ul id="notifications-dropdown" class="dropdown-content">
                
              <li>
                <h6>NOTIFICATIONS
                  <span class="new badge"><?php echo count($colNot);?></span>
                </h6>
              </li>
              <li class="divider"></li>
            <?php
              foreach ($col as $k) {

             ?>
                <?php if($k->feito == 0){?>
              <li>
                <a href="#!" class="grey-text text-darken-2">
                  <span class="material-icons icon-bg-circle red small">today</span> Coleta no condominio: <?php echo $k->nome ?></a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00"><?php echo date("d/m/Y", strtotime($k->data_coleta)) ?></time>
              </li>
                <?php }else{?>
                  <li>
                    
                  <a href="#!" class="grey-text text-darken-2">
                    <span class="material-icons icon-bg-circle cyan small">stars</span> Coleta no condominio: <?php echo $k->nome ?></a>
                  <time class="media-meta" datetime="2015-06-12T20:50:48+08:00"><?php echo date("d/m/Y", strtotime($k->data_coleta)) ?></time>

                  </li>
                <?php } ?>
<?php }?>
            </ul>
            <!-- profile-dropdown -->
            <ul id="profile-dropdown" class="dropdown-content">
              <li>
                <a href="#" class="grey-text text-darken-1">
                  <i class="material-icons">face</i> <?php echo $nome; ?></a>
              </li>
              <li>
                <a href="#" class="grey-text text-darken-1">
                  <i class="material-icons">settings</i> Settings</a>
              </li>
              <li>
                <a href="#" class="grey-text text-darken-1">
                  <i class="material-icons">live_help</i> Help</a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="#" class="grey-text text-darken-1">
                  <i class="material-icons">lock_outline</i> Lock</a>
              </li>
              <li>
                <a href="#" class="grey-text text-darken-1">
                  <i class="material-icons">keyboard_tab</i> Logout</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
      <!-- end header nav-->
    </header>
    <!-- END HEADER -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START MAIN -->
    <div id="main">
      <!-- START WRAPPER -->
      <div class="wrapper">
        <!-- START LEFT SIDEBAR NAV-->
        <aside id="left-sidebar-nav">
          <ul id="slide-out" class="side-nav fixed leftside-navigation">
            <li class="user-details cyan darken-2">
              <div class="row">
                <div class="col col s4 m4 l4">
                  <img src="images/avatar/avatar-7.png" alt="" class="circle responsive-img valign profile-image cyan">
                </div>
                <div class="col col s8 m8 l8">
                  <ul id="profile-dropdown-nav" class="dropdown-content">
                    <li>
                      <a href="#" class="grey-text text-darken-1">
                        <i class="material-icons">face</i> <?php echo $nome; ?></a>
                    </li>
                    <li>
                      <a href="#" class="grey-text text-darken-1">
                        <i class="material-icons">settings</i> Settings</a>
                    </li>
                    <li>
                      <a href="#" class="grey-text text-darken-1">
                        <i class="material-icons">live_help</i> Help</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                      <a href="#" class="grey-text text-darken-1">
                        <i class="material-icons">lock_outline</i> Lock</a>
                    </li>
                    <li>
                      <a href="../controllers/login.php?logout=true" class="grey-text text-darken-1">
                        <i class="material-icons">keyboard_tab</i> Logout</a>
                    </li>
                  </ul>
                  <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown-nav"><?php echo $nome; ?><i class="mdi-navigation-arrow-drop-down right"></i></a>
                  <p class="user-roal">Administrator</p>
                </div>
              </div>
            </li>
            <li class="no-padding">
              <ul class="collapsible" data-collapsible="accordion">
                <li class="bold">
                  <a href="index.php" class="waves-effect waves-cyan">
                      <i class="material-icons">pie_chart_outlined</i>
                      <span class="nav-text">Painel de Controle</span>
                    </a>
                </li>
            <ul class="collapsible">
              <li>
                <div class="collapsible-header"><i class="material-icons">list</i>Coleta</div>
                <div class="collapsible-body"><span>
                  <a href="../views/form_cadastro_coleta.php" class="waves-effect waves-cyan">
                      <i class="material-icons">add</i>Cadastrar Coleta</a>
                </span></div>
                <div class="collapsible-body">
                  <a href="lista_coleta.php" class="waves-effect waves-cyan">
                      <i class="material-icons">list</i>Lista de Coletas</a>
                </div>
              </li>
              <li>
                <div class="collapsible-header"><i class="material-icons">list</i>Resíduo</div>
                <div class="collapsible-body">
                  <a href="../views/form_cadastro_residuo.php" class="waves-effect waves-cyan">
                      <i class="material-icons">add</i>Cadastrar Residuo</a></div>
                      <div class="collapsible-body">
                        <a href="listar_residuo.php" class="waves-effect waves-cyan">
                            <i class="material-icons">list</i>Lista de Residuos</a>
                      </div>

              </li>
            </ul>
                
               <!-- <li class="bold">
                  <a href="form-layouts.php" class="waves-effect waves-cyan">
                      <i class="material-icons">format_color_text</i>
                      <span class="nav-text">Forms</span>
                    </a>
                </li>
                <li class="bold">
                  <a href="css-typography.php" class="waves-effect waves-cyan">
                      <i class="material-icons">format_size</i>
                      <span class="nav-text">Typography</span>
                    </a>
                </li>
                <li class="bold">
                  <a href="css-color.php" class="waves-effect waves-cyan">
                      <i class="material-icons">invert_colors</i>
                      <span class="nav-text">Color</span>
                    </a>
                </li>
                <li class="bold">
                  <a href="table-basic.php" class="waves-effect waves-cyan">
                      <i class="material-icons">border_all</i>
                      <span class="nav-text">Table</span>
                    </a>
                </li>
                <li class="bold">
                  <a href="ui-icons.php" class="waves-effect waves-cyan">
                    <i class="material-icons">lightbulb_outline</i>
                    <span class="nav-text">Icons</span>
                  </a>
                </li>
                <li>
                  <a class="btn waves-effect waves-light gradient-45deg-red-pink" href="https://pixinvent.com/materialize-material-design-admin-template/landing/" target="_blank">
                    <i class="material-icons white-text">file_upload</i>Upgrade to Pro!
                  </a>
                </li>
              </ul>
            </li>-->
          </ul>
          <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only">
            <i class="material-icons">menu</i>
          </a>
        </aside>
        <!-- END LEFT SIDEBAR NAV-->
        <!-- //////////////////////////////////////////////////////////////////////////// -->
        <!-- START CONTENT -->
        <section id="content">
          <!--start container-->
          <div class="container">
            <!--card stats start-->
            <div id="card-stats">
             <!-- <div class="row mt-1">
               <div class="col s12 m6 l3">
                  <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text">
                    <div class="padding-4">
                      <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">add_shopping_cart</i>
                        <p>Orders</p>
                      </div>
                      <div class="col s5 m5 right-align">
                        <h5 class="mb-0">690</h5>
                        <p class="no-margin">New</p>
                        <p>6,00,00</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l3">
                  <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text">
                    <div class="padding-4">
                      <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">perm_identity</i>
                        <p>Clients</p>
                      </div>
                      <div class="col s5 m5 right-align">
                        <h5 class="mb-0">1885</h5>
                        <p class="no-margin">New</p>
                        <p>1,12,900</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l3">
                  <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text">
                    <div class="padding-4">
                      <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">timeline</i>
                        <p>Sales</p>
                      </div>
                      <div class="col s5 m5 right-align">
                        <h5 class="mb-0">80%</h5>
                        <p class="no-margin">Growth</p>
                        <p>3,42,230</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l3">
                  <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text">
                    <div class="padding-4">
                      <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">attach_money</i>
                        <p>Profit</p>
                      </div>
                      <div class="col s5 m5 right-align">
                        <h5 class="mb-0">$890</h5>
                        <p class="no-margin">Today</p>
                        <p>$25,000</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>-->
            </div>
            <!--<div id="card-stats">-->
            <!--  <div class="row">-->
            <!--    <div class="col s12 m6 l3">-->
            <!--      <div class="card">-->
            <!--        <div class="card-content cyan white-text">-->
            <!--          <p class="card-stats-title">-->
            <!--            <i class="material-icons">person_outline</i> New Clients</p>-->
            <!--          <h4 class="card-stats-number">566</h4>-->
            <!--          <p class="card-stats-compare">-->
            <!--            <i class="material-icons">keyboard_arrow_up</i> 15%-->
            <!--            <span class="cyan text text-lighten-5">from yesterday</span>-->
            <!--          </p>-->
            <!--        </div>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--    <div class="col s12 m6 l3">-->
            <!--      <div class="card">-->
            <!--        <div class="card-content red accent-2 white-text">-->
            <!--          <p class="card-stats-title">-->
            <!--            <i class="material-icons">attach_money</i>Total Sales</p>-->
            <!--          <h4 class="card-stats-number">$8990.63</h4>-->
            <!--          <p class="card-stats-compare">-->
            <!--            <i class="material-icons">keyboard_arrow_up</i> 70%-->
            <!--            <span class="red-text text-lighten-5">last month</span>-->
            <!--          </p>-->
            <!--        </div>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--    <div class="col s12 m6 l3">-->
            <!--      <div class="card">-->
            <!--        <div class="card-content teal accent-4 white-text">-->
            <!--          <p class="card-stats-title">-->
            <!--            <i class="material-icons">trending_up</i> Today Profit</p>-->
            <!--          <h4 class="card-stats-number">$806.52</h4>-->
            <!--          <p class="card-stats-compare">-->
            <!--            <i class="material-icons">keyboard_arrow_up</i> 80%-->
            <!--            <span class="teal-text text-lighten-5">from yesterday</span>-->
            <!--          </p>-->
            <!--        </div>-->
                    
            <!--      </div>-->
            <!--    </div>-->
            <!--    <div class="col s12 m6 l3">-->
            <!--      <div class="card">-->
            <!--        <div class="card-content deep-orange accent-2 white-text">-->
            <!--          <p class="card-stats-title">-->
            <!--            <i class="material-icons">content_copy</i> New Invoice</p>-->
            <!--          <h4 class="card-stats-number">1806</h4>-->
            <!--          <p class="card-stats-compare">-->
            <!--            <i class="material-icons">keyboard_arrow_down</i> 3%-->
            <!--            <span class="deep-orange-text text-lighten-5">from last month</span>-->
            <!--          </p>-->
            <!--        </div>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--</div>-->
            <!--card stats end-->
            
            <!--card widgets start-->
            <div id="card-widgets">
              <div class="row">

                <div class="col s12 m4 l4">
                  <ul id="task-card" class="collection with-header">
                    <li class="collection-header teal accent-4">
                      <h4 class="task-card-title">Checklist de Coletas</h4>
                      <p class="task-card-date"></p>
                    </li>
                    <?php 


                    foreach ($col as $c) {
                      # code...
                        if($c->feito == 0):
                    ?>
                    <li class="collection-item dismissable">
                      <input type="checkbox" id="task<?php echo $c->id_coleta; ?>" />
                      <label for="task<?php echo $c->id_coleta; ?>"><?php echo $c->local_coleta; ?>
                        <a href="#" class="secondary-content">
                          <span class="ultra-small"><?php echo date("d/m/Y", strtotime($c->data_coleta)); ?></span>
                        </a>                        
                      </label>
                            <br>
                            <a href="../controllers/coleta/ctrl_fim_coleta.php?id_coleta=<?php echo $c->id_coleta;?>" class="secondary-content">
                              <span class="ultra-small"> Concluir </span>
                            </a>

                      <span class="task-cat cyan"><?php echo $c->nome; ?> </span>
                    </li>
                      <?php else:?>
                        <li class="collection-item dismissable">
                          <input type="checkbox" id="task<?php echo $c->id_coleta; ?>" checked />
                          <label for="task<?php echo $c->id_coleta; ?>"><?php echo $c->local_coleta; ?>
                            <a href="#" class="secondary-content">
                              <span class="ultra-small"><?php echo date("d/m/Y", strtotime($c->data_coleta)); ?></span>
                            </a>

                          </label>
                            <br>
                            <a href="#" class="secondary-content">
                              <span class="ultra-small teal-text">Concluido</span>
                            </a>

                          <span class="task-cat cyan"><?php echo $c->nome; ?> </span>
                        </li>
                      <?php endif;?>

              <?php }?>
                  </ul>
                </div>
                <?php foreach ($colUni as $c) {
                  # code...
                 ?>
                <div class="col s12 m12 l4">
                  <div id="flight-card" class="card">
                    <div class="card-header deep-orange accent-2">
                      <div class="card-title">
                        <h4 class="flight-card-title">Coleta no Condomínio: <?php echo $c->nome ?></h4>
                        <p class="flight-card-date"></p>
                      </div>
                    </div>
                    <div class="card-content-bg white-text">
                      <div class="card-content">
                        <div class="row flight-state-wrapper">
                          <div class="col s5 m5 l5 center-align">
                            <div class="flight-state">
                              <h4 class="margin"><?php echo $c->cidade; ?></h4>
                              <p class="ultra-small">Cidade</p>
                            </div>
                          </div>
                          <div class="col s2 m2 l2 center-align">
                            
                          </div>
                          <div class="col s5 m5 l5 center-align">
                            <div class="flight-state">
                              <h4 class="margin"><?php echo $c->estado; ?></h4>
                              <p class="ultra-small">Estado</p>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col s6 m6 l6 center-align">
                            <div class="flight-info">
                              <p class="small">
                                <span class="grey-text text-lighten-4">Sindico: </span> <?php echo $c->sindico; ?></p>
                              <p class="small">
                                <span class="grey-text text-lighten-4">Horário: </span><?php echo date("h:m", strtotime($c->hora)); ?> </p>
                              <p class="small">
                                <span class="grey-text text-lighten-4">Local: </span><?php echo $c->local_coleta; ?> </p>
                            </div>
                          </div>
                          <div class="col s6 m6 l6 center-align flight-state-two">
                            <div class="flight-info">
                              <p class="small">
                                <span class="grey-text text-lighten-4">Telefone: </span><?php echo $c->telefone;?></p>
                              <p class="small">
                                <span class="grey-text text-lighten-4">Data: </span> <?php echo date("d/m/Y", strtotime($c->data_coleta)); ?> </p>
                              <p class="small">
                                <span class="grey-text text-lighten-4">Residuo: </span><?php echo $c->tipo;?> </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
                <div class="col s12 m4 l4">
                  <div id="profile-card" class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                      <img class="activator" src="images/gallary/3.png" alt="user bg">
                    </div>
                    <?php 
                      require_once '../models/DAO/bd_condominio.php';
                      $cond = new bd_condominio;
                      $con = $cond->pesquisarcondominio();
                      $co = $cond->pesquisarcondominioUni();
                      foreach ($co as $c ) {
                        # code...
                      
                    ?>

                    <div class="card-content">
                      <img src="images/avatar/avatar-7.png" alt="" class="circle responsive-img activator card-profile-image cyan lighten-1 padding-2">
                      <a class="btn-floating activator btn-move-up waves-effect waves-light red accent-2 z-depth-4 right">
                        <i class="material-icons">visibility</i>
                      </a>
                      <span class="card-title activator grey-text text-darken-4"><?php echo $c->nome; ?></span>
                      <p>
                        <i class="material-icons">perm_identity</i> <?php echo $c->sindico; ?></p>
                      <p>
                        <i class="material-icons">perm_phone_msg</i> <?php echo $c->telefone;?></p>
                      <p>
                        <i class="material-icons">home</i> <?php echo $c->cidade;?></p>
                    </div>
                    <div class="card-reveal">
                      <span class="card-title grey-text text-darken-4">Condominios Registrados
                        <i class="material-icons right">close</i>
                      </span>
                      <p>Condominios Registrados em nosso sistema</p>
                  <?php }
                    foreach ($con as $d) {
                      # code...
                    
                  ?>
                      <p>
                        <i class="material-icons">business</i> <?php echo $d->nome;?></p>
                  <?php }?>
                      
                      <p>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--card widgets end-->
            

                  </ul>
                </div>
              </div>
            </div>
            <!--work collections end-->
            
            <!-- //////////////////////////////////////////////////////////////////////////// -->
          </div>
          <!--end container-->
        </section>
        <!-- END CONTENT -->
        <!-- START RIGHT SIDEBAR NAV-->
        <aside id="right-sidebar-nav">
          <ul id="chat-out" class="side-nav rightside-navigation">
            <li class="li-hover">
              <div class="row">
                <div class="col s12 border-bottom-1 mt-5">
                  <ul class="tabs">
                    <li class="tab col s4">
                      <a href="#activity" class="active">
                        <span class="material-icons">graphic_eq</span>
                      </a>
                    </li>
                    <li class="tab col s4">
                      <a href="#chatapp">
                        <span class="material-icons">face</span>
                      </a>
                    </li>
                    <li class="tab col s4">
                      <a href="#settings">
                        <span class="material-icons">settings</span>
                      </a>
                    </li>
                  </ul>
                </div>
                <div id="settings" class="col s12">
                  <h6 class="mt-5 mb-3 ml-3">GENERAL SETTINGS</h6>
                  <ul class="collection border-none">
                    <li class="collection-item border-none">
                      <div class="m-0">
                        <span class="font-weight-600">Notifications</span>
                        <div class="switch right">
                          <label>
                            <input checked type="checkbox">
                            <span class="lever"></span>
                          </label>
                        </div>
                      </div>
                      <p>Use checkboxes when looking for yes or no answers.</p>
                    </li>
                    <li class="collection-item border-none">
                      <div class="m-0">
                        <span class="font-weight-600">Show recent activity</span>
                        <div class="switch right">
                          <label>
                            <input checked type="checkbox">
                            <span class="lever"></span>
                          </label>
                        </div>
                      </div>
                      <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                    </li>
                    <li class="collection-item border-none">
                      <div class="m-0">
                        <span class="font-weight-600">Notifications</span>
                        <div class="switch right">
                          <label>
                            <input type="checkbox">
                            <span class="lever"></span>
                          </label>
                        </div>
                      </div>
                      <p>Use checkboxes when looking for yes or no answers.</p>
                    </li>
                    <li class="collection-item border-none">
                      <div class="m-0">
                        <span class="font-weight-600">Show recent activity</span>
                        <div class="switch right">
                          <label>
                            <input type="checkbox">
                            <span class="lever"></span>
                          </label>
                        </div>
                      </div>
                      <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                    </li>
                    <li class="collection-item border-none">
                      <div class="m-0">
                        <span class="font-weight-600">Show your emails</span>
                        <div class="switch right">
                          <label>
                            <input type="checkbox">
                            <span class="lever"></span>
                          </label>
                        </div>
                      </div>
                      <p>Use checkboxes when looking for yes or no answers.</p>
                    </li>
                    <li class="collection-item border-none">
                      <div class="m-0">
                        <span class="font-weight-600">Show Task statistics</span>
                        <div class="switch right">
                          <label>
                            <input type="checkbox">
                            <span class="lever"></span>
                          </label>
                        </div>
                      </div>
                      <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                    </li>
                  </ul>
                </div>
                <div id="chatapp" class="col s12">
                  <div class="collection border-none">
                    <a href="#!" class="collection-item avatar border-none">
                      <img src="images/avatar/avatar-1.png" alt="" class="circle cyan">
                      <span class="line-height-0">Elizabeth Elliott </span>
                      <span class="medium-small right blue-grey-text text-lighten-3">5.00 AM</span>
                      <p class="medium-small blue-grey-text text-lighten-3">Thank you </p>
                    </a>
                    <a href="#!" class="collection-item avatar border-none">
                      <img src="images/avatar/avatar-2.png" alt="" class="circle deep-orange accent-2">
                      <span class="line-height-0">Mary Adams </span>
                      <span class="medium-small right blue-grey-text text-lighten-3">4.14 AM</span>
                      <p class="medium-small blue-grey-text text-lighten-3">Hello Boo </p>
                    </a>
                    <a href="#!" class="collection-item avatar border-none">
                      <img src="images/avatar/avatar-3.png" alt="" class="circle teal accent-4">
                      <span class="line-height-0">Caleb Richards </span>
                      <span class="medium-small right blue-grey-text text-lighten-3">9.00 PM</span>
                      <p class="medium-small blue-grey-text text-lighten-3">Keny ! </p>
                    </a>
                    <a href="#!" class="collection-item avatar border-none">
                      <img src="images/avatar/avatar-4.png" alt="" class="circle cyan">
                      <span class="line-height-0">June Lane </span>
                      <span class="medium-small right blue-grey-text text-lighten-3">4.14 AM</span>
                      <p class="medium-small blue-grey-text text-lighten-3">Ohh God </p>
                    </a>
                    <a href="#!" class="collection-item avatar border-none">
                      <img src="images/avatar/avatar-5.png" alt="" class="circle red accent-2">
                      <span class="line-height-0">Edward Fletcher </span>
                      <span class="medium-small right blue-grey-text text-lighten-3">5.15 PM</span>
                      <p class="medium-small blue-grey-text text-lighten-3">Love you </p>
                    </a>
                    <a href="#!" class="collection-item avatar border-none">
                      <img src="images/avatar/avatar-6.png" alt="" class="circle deep-orange accent-2">
                      <span class="line-height-0">Crystal Bates </span>
                      <span class="medium-small right blue-grey-text text-lighten-3">8.00 AM</span>
                      <p class="medium-small blue-grey-text text-lighten-3">Can we </p>
                    </a>
                    <a href="#!" class="collection-item avatar border-none">
                      <img src="images/avatar/avatar-7.png" alt="" class="circle cyan">
                      <span class="line-height-0">Nathan Watts </span>
                      <span class="medium-small right blue-grey-text text-lighten-3">9.53 PM</span>
                      <p class="medium-small blue-grey-text text-lighten-3">Great! </p>
                    </a>
                    <a href="#!" class="collection-item avatar border-none">
                      <img src="images/avatar/avatar-8.png" alt="" class="circle red accent-2">
                      <span class="line-height-0">Willard Wood </span>
                      <span class="medium-small right blue-grey-text text-lighten-3">4.20 AM</span>
                      <p class="medium-small blue-grey-text text-lighten-3">Do it </p>
                    </a>
                    <a href="#!" class="collection-item avatar border-none">
                      <img src="images/avatar/avatar-9.png" alt="" class="circle teal accent-4">
                      <span class="line-height-0">Ronnie Ellis </span>
                      <span class="medium-small right blue-grey-text text-lighten-3">5.30 PM</span>
                      <p class="medium-small blue-grey-text text-lighten-3">Got that </p>
                    </a>
                    <a href="#!" class="collection-item avatar border-none">
                      <img src="images/avatar/avatar-1.png" alt="" class="circle cyan">
                      <span class="line-height-0">Gwendolyn Wood </span>
                      <span class="medium-small right blue-grey-text text-lighten-3">4.34 AM</span>
                      <p class="medium-small blue-grey-text text-lighten-3">Like you </p>
                    </a>
                    <a href="#!" class="collection-item avatar border-none">
                      <img src="images/avatar/avatar-2.png" alt="" class="circle red accent-2">
                      <span class="line-height-0">Daniel Russell </span>
                      <span class="medium-small right blue-grey-text text-lighten-3">12.00 AM</span>
                      <p class="medium-small blue-grey-text text-lighten-3">Thank you </p>
                    </a>
                    <a href="#!" class="collection-item avatar border-none">
                      <img src="images/avatar/avatar-3.png" alt="" class="circle teal accent-4">
                      <span class="line-height-0">Sarah Graves </span>
                      <span class="medium-small right blue-grey-text text-lighten-3">11.14 PM</span>
                      <p class="medium-small blue-grey-text text-lighten-3">Okay you </p>
                    </a>
                    <a href="#!" class="collection-item avatar border-none">
                      <img src="images/avatar/avatar-4.png" alt="" class="circle red accent-2">
                      <span class="line-height-0">Andrew Hoffman </span>
                      <span class="medium-small right blue-grey-text text-lighten-3">7.30 PM</span>
                      <p class="medium-small blue-grey-text text-lighten-3">Can do </p>
                    </a>
                    <a href="#!" class="collection-item avatar border-none">
                      <img src="images/avatar/avatar-5.png" alt="" class="circle cyan">
                      <span class="line-height-0">Camila Lynch </span>
                      <span class="medium-small right blue-grey-text text-lighten-3">2.00 PM</span>
                      <p class="medium-small blue-grey-text text-lighten-3">Leave it </p>
                    </a>
                  </div>
                </div>
                <div id="activity" class="col s12">
                  <h6 class="mt-5 mb-3 ml-3">RECENT ACTIVITY</h6>
                  <div class="activity">
                    <div class="col s3 mt-2 center-align recent-activity-list-icon">
                      <i class="material-icons white-text icon-bg-color deep-purple lighten-2">add_shopping_cart</i>
                    </div>
                    <div class="col s9 recent-activity-list-text">
                      <a href="#" class="deep-purple-text medium-small">just now</a>
                      <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">Jim Doe Purchased new equipments for zonal office.</p>
                    </div>
                    <div class="recent-activity-list chat-out-list row mb-0">
                      <div class="col s3 mt-2 center-align recent-activity-list-icon">
                        <i class="material-icons white-text icon-bg-color cyan lighten-2">airplanemode_active</i>
                      </div>
                      <div class="col s9 recent-activity-list-text">
                        <a href="#" class="cyan-text medium-small">Yesterday</a>
                        <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">Your Next flight for USA will be on 15th August 2015.</p>
                      </div>
                    </div>
                    <div class="recent-activity-list chat-out-list row mb-0">
                      <div class="col s3 mt-2 center-align recent-activity-list-icon medium-small">
                        <i class="material-icons white-text icon-bg-color green lighten-2">settings_voice</i>
                      </div>
                      <div class="col s9 recent-activity-list-text">
                        <a href="#" class="green-text medium-small">5 Days Ago</a>
                        <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">Natalya Parker Send you a voice mail for next conference.</p>
                      </div>
                    </div>
                    <div class="recent-activity-list chat-out-list row mb-0">
                      <div class="col s3 mt-2 center-align recent-activity-list-icon">
                        <i class="material-icons white-text icon-bg-color amber lighten-2">store</i>
                      </div>
                      <div class="col s9 recent-activity-list-text">
                        <a href="#" class="amber-text medium-small">1 Week Ago</a>
                        <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">Jessy Jay open a new store at S.G Road.</p>
                      </div>
                    </div>
                    <div class="recent-activity-list row">
                      <div class="col s3 mt-2 center-align recent-activity-list-icon">
                        <i class="material-icons white-text icon-bg-color deep-orange lighten-2">settings_voice</i>
                      </div>
                      <div class="col s9 recent-activity-list-text">
                        <a href="#" class="deep-orange-text medium-small">2 Week Ago</a>
                        <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">voice mail for conference.</p>
                      </div>
                    </div>
                    <div class="recent-activity-list chat-out-list row mb-0">
                      <div class="col s3 mt-2 center-align recent-activity-list-icon medium-small">
                        <i class="material-icons white-text icon-bg-color brown lighten-2">settings_voice</i>
                      </div>
                      <div class="col s9 recent-activity-list-text">
                        <a href="#" class="brown-text medium-small">1 Month Ago</a>
                        <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">Natalya Parker Send you a voice mail for next conference.</p>
                      </div>
                    </div>
                    <div class="recent-activity-list chat-out-list row mb-0">
                      <div class="col s3 mt-2 center-align recent-activity-list-icon">
                        <i class="material-icons white-text icon-bg-color deep-purple lighten-2">store</i>
                      </div>
                      <div class="col s9 recent-activity-list-text">
                        <a href="#" class="deep-purple-text medium-small">3 Month Ago</a>
                        <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">Jessy Jay open a new store at S.G Road.</p>
                      </div>
                    </div>
                    <div class="recent-activity-list row">
                      <div class="col s3 mt-2 center-align recent-activity-list-icon">
                        <i class="material-icons white-text icon-bg-color grey lighten-2">settings_voice</i>
                      </div>
                      <div class="col s9 recent-activity-list-text">
                        <a href="#" class="grey-text medium-small">1 Year Ago</a>
                        <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">voice mail for conference.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </aside>
        <!-- END RIGHT SIDEBAR NAV-->
      </div>
      <!-- END WRAPPER -->
    </div>
    <!-- END MAIN -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START FOOTER -->
    <footer class="page-footer gradient-45deg-light-blue-cyan">

    </footer>
    <!-- END FOOTER -->
    <!-- ================================================
    Scripts
    ================================================ -->
    <!-- jQuery Library -->
    <script type="text/javascript" src="vendors/jquery-3.2.1.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
    <script>
     <?php echo $mensagemCliente; ?>
    </script>
  </body>
</html>