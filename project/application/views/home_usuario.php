   
<body class="">
  <div class="wrapper ">
    <div class="sidebar">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
      <<div class="sidebar-wrapper">
        <div class="logo">
          <a href="javascript:void(0)" class="simple-text logo-mini">
            <i class="tim-icons icon-settings"></i>
          </a>
          <a href="javascript:void(0)" class="simple-text logo-normal">
            Help Desk
          </a>
        </div>
        <ul class="nav">
          <!--<li >
            <a href="./dashboard.html">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Dashboard</p>
            </a>
          </li>-->
          
          
          <li id ="li_chamados" class="active ">
            <a id="a_chamados">
              <i class="tim-icons icon-bell-55"></i>
              <p>Meus Chamados</p>
            </a>
          </li>
          
          
          
          
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class=" navbar navbar-expand-lg navbar-absolute navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button> 
            </div>
            <h6  class="navbar-brand" style="font-size: 14px;">Bem vindo,<br/> <?php echo $nome_completo  ?> !</h6>
          </div>          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
               <!-- <li class="search-bar input-group">
                <button class="btn btn-link" id="search-button" data-toggle="modal" data-target="#searchModal"><i class="tim-icons icon-zoom-split" ></i>
                  <span class="d-lg-none d-md-block">Search</span>
                </button>
              </li> -->
              <!-- <li class="dropdown nav-item">
                <a href="javascript:void(0)" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="notification d-none d-lg-block d-xl-block"></div>
                  <i class="tim-icons icon-sound-wave"></i>
                  <p class="d-lg-none">
                    Notifications
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-menu-right dropdown-navbar">
                  <li class="nav-link"><a href="#" class="nav-item dropdown-item">Mike John responded to your email</a></li>
                  <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">You have 5 more tasks</a></li>
                  <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Your friend Michael is in town</a></li>
                  <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Another notification</a></li>
                  <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Another one</a></li>
                </ul>
              </li> -->
              <li class="dropdown nav-item ">
                <a href="" class="dropdown-toggle nav-link "  data-toggle="dropdown">
                  <div class="photo ">
                    <img src="public/assets/img/anime3.png"  alt="Profile Photo">
                  </div>
                  <b class="caret d-none d-lg-block d-xl-block"></b>
                  <p class="d-lg-none">
                    Log out
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                  <li class="nav-link"><a href="javascript:void(0)" id="btn_your_user" class="nav-item dropdown-item" user_id="<?=$user_id?>" >Perfil</a></li>
                  <li class="nav-link"><button href="javascript:void(0)" class="nav-item dropdown-item">Configurações</button></li>
                  <li class="dropdown-divider"></li>
                  <li class="nav-link"><a href="login/logoff" class="nav-item dropdown-item">Sair</a></li>
                </ul>
              </li>
              <li class="separator d-lg-none"></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
      </div>


<!-- Corpo -->
 


  
    

  <div class="content" id="div_chamados">
      <div class="usuario" >
        <ul class="nav nav-tabs">
          <li class="active nav-item">
              <a class="active nav-link " href="#" role="tab" data-toggle="tab">Chamados</a>
          </li>
        </ul>


    </br>
    <form class="form-inline" method="post" hidden>
      <div class="form-group mb-2">
        <label style="color: #fff">Filtrar por: </label>&nbsp;&nbsp;
        <select  name="status_sl" id="status_sl"  class="form-control ">
                      
                      <option class="text-dark">Todos</option>
                      <option class="text-dark">Aberto</option>
                      <option class="text-dark">Em andamento</option>
                      <option class="text-dark">Concluído</option>
                      <option class="text-dark">Resolvido</option>
                      
        </select>
      </div>
    </form>
    <button  id="add_chamado" class="btn btn-primary">Abrir chamado</button>
    <div class="float-right">
    <a id="reload_datatable_chamados"><i class="btn tim-icons icon-refresh-02"> </i></a>
    </div>

    <div class="tab-content">
        
      <div id="usuarios_cadastrados" class="tab-pane nav-item active" >

        <div class="  ">
      
        <table class=" table-active table-hover tablesorter " id="dt_chamado">
          <thead class="text-white">
            <tr>
              <th scope="col" title="Clique para ordenar por ID">Nº</th>
              <th scope="col" title="Clique para ordenar por Solicitante">Solicitante</th>
              <th scope="col" title="Clique para ordenar por Criação">Criação</th>
              <th scope="col" title="Clique para ordenar por Problema">Problema</th>
              <th scope="col" title="Clique para ordenar por Tipo">Tipo</th>
              <th scope="col" title="Clique para ordenar por Setor">Setor</th>
              <th scope="col" title="Clique para ordenar por Prioridade">Prioridade</th>             
              <th scope="col" title="Clique para ordenar por Status">Status</th>
              <th scope="col" class="no-sort dt-center" >Ações</th>
            </tr>
          </thead>
          <tbody class="users text-white">
            <div>
            <tr class="table-secondary user-tr">
              

            </tr>
            </div>       
          </tbody>
        </table>
      
      </div>
    </div>
  </div>

     

   
  </div>
  </div>
<div class="container-fluid">
          <ul class="nav">
            
          </ul>
          <div class="copyright float-right">
            ©
            <script>
              document.write(new Date().getFullYear())
            </script><i class="tim-icons "></i> Sistema desenvolvido por
            <a href="javascript:void(0)" target="_blank">@Jonas Bastani</a>
          </div>
</div>
<br/>


</body>


<!--modal usuário-->

<div id="modal_usuario" class="modal fade">
  <div class="modal-dialog modal-lg"  >
    <div class="modal-content">
      <div class="modal-reader">


        <title>
          Help Desk
        </title>

        <link rel="stylesheet" type="text/css" href="public/css/stylefuncionario.css">
        <div class="container">
          <br/>
          <button type="button" class="close" data-dismiss="modal">X</button>

          <h4 class="modal-title">usuarios</h4>
        </div>
        
      </div>

      <div class="modal-body">
        <form id="form_users" method="post">
        <div class="form-row">
          <div class="col">
            <input id="user_id" name="user_id" hidden>
            <label class="control-label" ><b>Nome Completo</b></label>
              <input id="nome_completo" name="nome_completo"  maxlength="150" class="form-control" placeholder="Digite o nome completo">
              <span class="help-block text-white"></span>
          </div>
          <div class="col">
            <div class="form-group">
              <label class="control-label" ><b>Email</b></label>
                <input id="email" name="email"  maxlength="100" class="form-control" placeholder="Digite o e-mail do usuário">
                <span class="help-block text-white"></span>
            </div>

          </div>
        </div>
        <br/>
        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <label class="control-label" for="senha"><b>Senha</b></label>
                <input type="password" name="senha" id="senha"  class="form-control" placeholder="Digite a senha">
                <span class="help-block text-white"></span>
            </div>

          </div>
          <div class="col">
            <div class="form-group">
              <label class="control-label" for="senha"><b>Repita a senha</b></label>
                <input type="password"  name="senha_confirma" id="senha_confirma"  class="form-control" placeholder="Digite a senha">
                <span class="help-block text-white"></span>
            </div>
          </div>
          <div class="col" id="div_permissao">
            <div class="form-group">
              <label class="control-label" id="permissao_lb" for="permissao" ><b>Permissão</b></label>
              <select id="permissao" name="permissao"  class="form-control ">
                  
                  <option class="text-dark">Administrador</option>
                  <option class="text-dark">Suporte</option>
                  <option class="text-dark">Usuário</option>
                  
              </select>
              <span class="help-block text-white"></span>
              <input name="ativo" id="ativo" hidden>
            </div>
            
          </div>
        </div>
        <br/>
        <div class=text-right>

          <span class="help-block"></span>
          <button type="submit" id="btn_save_users"  class="btn btn-success">Salvar</button>
          
        </div>
      </form>
      </div>
    </div>
  </div>
</div>




<div id="modal_chamado" class="modal fade">
  <div class="modal-dialog modal-lg"  >
    <div class="modal-content">
      <div class="modal-reader">


        <title>
          Help Desk
        </title>

        <link rel="stylesheet" type="text/css" href="public/css/stylefuncionario.css">
        <div class="container">
          <br/>
          <button type="button" class="close" data-dismiss="modal">X</button>

          <h4 class="modal-title">Chamado</h4>
        </div>
        
      </div>

      <div class="modal-body">
        <form id="form_chamado" method="post">
        <div id="div_save_chamado">  
        <div class="form-row">
          <div class="col">
            <input id="chamado_id" name="chamado_id" hidden>
            <input  id="status" name="status" hidden>
            <label class="control-label" ><b>Problema</b></label>
              <input id="problema" name="problema"  maxlength="30" class="form-control" placeholder="Máximo 30 caracteres">
              <span class="help-block text-white"></span>
          </div>

          
          <div class="col" id="div_setor">
            <div class="form-group">
              <label  id="setor_lb" for="setor" ><b>Setor</b></label>
              <select id="setor" name="setor"  class="form-control ">
                  
                  <option class="text-dark">RH</option>
                  <option class="text-dark">Financeiro</option>
                  <option class="text-dark">Vendas</option>
                  <option class="text-dark">FAQ</option>
                  
              </select>
              <span class="help-block text-white"></span>

            </div>
            
          </div>
        </div>
        
        <br/>
        <div class="form-row">
          <div class="col" id="div_tipo">
            <div class="form-group">
              <label class="control-label" id="tipo_lb" for="tipo" ><b>Tipo</b></label>
              <select id="tipo" name="tipo"  class="form-control ">
                  
                  <option class="text-dark">Melhoria</option>
                  <option class="text-dark">Problema de Hardware</option>
                  <option class="text-dark">Problema de Software</option>

                  
              </select>
              <span class="help-block text-white"></span>

            </div>
            
        </div>
        <div class="col" id="div_urgencia">
            <div class="form-group">
              <label class="control-label" id="urgencia_lb" for="urgencia" ><b>Urgência</b></label>
              <select id="urgencia" name="urgencia"  class="form-control ">
                  
                  <option class="text-dark">Baixa</option>
                  <option class="text-dark">Média</option>
                  <option class="text-dark">Alta</option>
                  <option class="text-dark">Altíssima</option>
                  
              </select>
              <span class="help-block text-white"></span>

            </div>
            
          </div>
        <div class="col" id="div_impacto">
            <div class="form-group">
              <label class="control-label" id="impacto_lb" for="impacto" ><b>Impacto</b></label>
              <select id="impacto" name="impacto"  class="form-control ">
                  
                  <option class="text-dark">Baixo</option>
                  <option class="text-dark">Médio</option>
                  <option class="text-dark">Alto</option>
                  <option class="text-dark">Altíssimo</option>

                  
              </select>
              <span class="help-block text-white"></span>
              
            </div>
            
        </div>
        </div>

        <br/>

        <div class="form-row">
          <div class="col">
            <label class="control-label" ><b>Descrição</b></label>
              <textarea id="descricao" name="descricao" class="form-control" placeholder="Descreva com detalhes seu problema"></textarea>
              <span class="help-block text-white"></span>
          </div>
        </div>

        
        <br/>
        <div class="form-row">
          <div class="col">
              <center><img id="imagem_path" src="" style="max-height: 600px; max-width: 100vh"></center>

              <label id="btn_add_img" class="btn btn-block btn-primary">
                <i class="tim-icons icon-upload"></i>&nbsp;&nbsp;Adicione uma imagem do problema
                <input type="file" id="btn_upload_imagem" accept="image/*" style="display: none;">
              </label>

              <input id="imagem" name="imagem" hidden>
              <span class="help-block text-white"></span>
          </div>
        </div>
        </div>

        
        <br/>
        <div class=text-right>

          <span class="help-block"></span>
          <button type="submit" id="btn_save_chamados"  class="btn btn-success">Salvar</button>
          
        </div>
      </form>
      </div>
    </div>
  </div>
</div>




<div id="modal_chamado_detalhes" class="modal fade">
  <div class="modal-dialog modal-lg"  >
    <div class="modal-content">
      <div class="modal-reader">


        <title>
          HelpDesk
        </title>

        <link rel="stylesheet" type="text/css" href="public/css/stylefuncionario.css">
        <div class="container">
          <br/>
          <button type="button" class="close" data-dismiss="modal">X</button>

          <h4 class="modal-title">Detelahes do chamado</h4>
        </div>
        
      </div>

      <div class="modal-body">
        <form id="form_chamado_list" method="post">
        <div id="div_detalhes">  
        <div class="form-row">

          <div class="col">
            <label class="control-label"  ><b>Número</b></label>
            <input id="numero_list" readonly="readonly" class="form-control text-white" name="numero_list">
          </div>
          <div class="col">
            <label class="control-label" ><b>Problema</b></label>
              <input id="problema_list" name="problema_list"  maxlength="40" readonly="readonly" class="form-control text-white">
          </div>
        

          <div class="col" id="div_setor">
            
              <label  class="control-label" ><b>Setor</b></label>
              <input id="setor_list" readonly="readonly" class="form-control text-white" name="setor_list"  >

            
          </div>
        </div>
        <br/>
        <div class="form-row">
          <div class="col">
            <label class="control-label" ><b>Responsável</b></label>
            <input id="responsavel_list" readonly="readonly" class="form-control text-white" name="responsavel_list">
          </div>
          <div class="col">
            <label class="control-label" ><b>Data Abertura</b></label>
            <input id="data_abertura_list" readonly="readonly" class="form-control text-white" name="data_abertura_list">
          </div>
          <div class="col">
            <label class="control-label" ><b>Data Solução</b></label>
            <input id="data_solucao_list" readonly="readonly" class="form-control text-white" name="data_solucao_list">
          </div>

        </div>
        
        <br/>
        <div class="form-row">
          <div class="col" id="div_tipo">
            <div class="form-group">
              <label class="control-label" id="tipo_lb" for="tipo" ><b>Tipo</b></label>
              <input id="tipo_list" name="tipo_list"  class="form-control text-white" readonly="readonly">

            </div>
            
        </div>
        <div class="col" id="div_urgencia">
            <div class="form-group">
              <label class="control-label" id="urgencia_lb" for="urgencia" ><b>Urgência</b></label>
              <input id="urgencia_list" name="urgencia_list"  class="form-control text-white" readonly="readonly">


            </div>
            
          </div>
        <div class="col" id="div_impacto">
            <div class="form-group">
              <label class="control-label" id="impacto_lb" for="impacto" ><b>Impacto</b></label>
              <input type="" name="impacto_list" id="impacto_list"  class="form-control text-white" readonly="readonly">

              
            </div>
            
        </div>
        </div>

        <br/>
        <div class="form-row">
          <div class="col" id="div_tipo">
            <div class="form-group">
              <label class="control-label" id="tipo_lb" for="tipo" ><b>Prioridade</b></label>
              <input id="prioridade_list" name="prioridade_list"  class="form-control text-white" readonly="readonly">

            </div>
            
        </div>
        <div class="col" id="div_urgencia">
            <div class="form-group">
              <label class="control-label" id="urgencia_lb" for="urgencia" ><b>Status</b></label>
              <input id="status_list" name="status_list"  class="form-control text-white" readonly="readonly">
            </div>
            
          </div>
        </div>

        <br/>

        <div class="form-row">
          <div class="col">
            <label class="control-label" ><b>Descrição</b></label>
              <textarea id="descricao_list" name="descricao_list" value="aaaaaaaaa" class="form-control text-white" disabled=""></textarea>
              <span class="help-block text-white"></span>
          </div>
        </div>

        
        
        <br/>
        <div class="form-row">
          <div class="col">
             <label class="control-label"><b>Imagem</b></label>
              <center><img id="imagem_path_list" alt="" name="" src="imagem_path" style="max-height: 600px; max-width: 100vh"></center>
          </div>
        </div>
        </div>
        <div class="form-row" id="div_contesta_list">
          <div class="col">
            <label class="control-label" ><b>Contestação</b></label>
              <textarea id="contesta_list" name="contesta_list" value="aaaaaaaaa" class="form-control text-white" disabled=""></textarea>
              <span class="help-block text-white"></span>
          </div>
        </div>

        </div>


        <br/>
      </form>
      </div>
    </div>
  </div>
</div>


<div id="modal_contesta_chamado" class="modal fade">
  <div class="modal-dialog modal-lg"  >
    <div class="modal-content">
      <div class="modal-reader">


        <title>
          Help Desk
        </title>

        <link rel="stylesheet" type="text/css" href="public/css/stylefuncionario.css">
        <div class="container">
          <br/>
          <button type="button" class="close" data-dismiss="modal">X</button>

          <h4 class="modal-title">Chamado</h4>
        </div>
        
      </div>

      <div class="modal-body">
        <form id="form_contesta_chamado" method="post">
        

        <div class="form-row" >
          <div class="col">
            <label class="control-label" ><b>Contestação</b></label>
              <input id="chamado_id_contesta" name="chamado_id_contesta" hidden>
              <textarea id="contesta" name="contesta" class="form-control" placeholder="Descreva o motivo da sua contestação"></textarea>
              <span class="help-block text-white"></span>
          </div>
        </div>
        <br/>
        <div class=text-right>

          <span class="help-block"></span>
          <button type="submit" id="btn_contestar_chamados"  class="btn btn-success">Contestar</button>
          
        </div>
      </form>
      </div>
    </div>
  </div>
</div>

      