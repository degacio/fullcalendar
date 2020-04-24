<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Título -->
        <title>Sistema Escola</title>
        <!-- FontAwesome -->
        <script defer src="./node_modules/@fortawesome/fontawesome-free/js/all.js"></script>
         <!-- Icon title --> 
        <link rel="icon" type="imagem/svg" href="assets/img/TitleIcon.svg">

        <meta charset='utf-8' />
        <link href='css/core/main.min.css' rel='stylesheet' />
        <link href='css/daygrid/main.min.css' rel='stylesheet' />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
        <link rel="stylesheet" href="css/personalizado.css">

        <!-- My CSS -->
        <link rel="stylesheet" href="css/main.css">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
        <script src='js/core/main.min.js'></script>
        <script src='js/interaction/main.min.js'></script>
        <script src='js/daygrid/main.min.js'></script>
        <script src='js/core/locales/pt-br.js'></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="js/personalizado.js"></script>
    
        <!-- My JS -->
        <script defer src="js/main.js"></script>  

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="../node_modules/popper.js/dist/umd/popper.min.js" ></script>
        <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        
    </head>
    <body>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>

        <div id='calendar'></div>
        <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detalhes do Evento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="visevent">
                            <dl class="row">
                                <dt class="col-sm-3">ID do evento</dt>
                                <dd class="col-sm-9" id="id"></dd>

                                <dt class="col-sm-3">Título do evento</dt>
                                <dd class="col-sm-9" id="title"></dd>

                                <dt class="col-sm-3">Início do evento</dt>
                                <dd class="col-sm-9" id="start"></dd>

                                <dt class="col-sm-3">Fim do evento</dt>
                                <dd class="col-sm-9" id="end"></dd>
                            </dl>
                            <button class="btn btn-warning btn-canc-vis">Editar</button>
                            <a href="" id="apagar_evento" class="btn btn-danger">Apagar</a>
                        </div>
                        <div class="formedit">
                            <span id="msg-edit"></span>
                            <form id="editevent" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" id="id" >
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Título</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Título do evento">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Color</label>
                                    <div class="col-sm-10">
                                        <select name="color" class="form-control" id="color">
                                            <option value="">Selecione</option>			
                                            <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                            <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                                            <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                            <option style="color:#8B4513;" value="#8B4513">Marrom</option>	
                                            <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                            <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                                            <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                            <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                                            <option style="color:#228B22;" value="#228B22">Verde</option>
                                            <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Início do evento</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="start" class="form-control" id="start" onkeypress="DataHora(event, this)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Final do evento</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="end" class="form-control" id="end"  onkeypress="DataHora(event, this)">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="button" class="btn btn-primary btn-canc-edit">Cancelar</button>
                                        <button type="submit" name="CadEvent" id="CadEvent" value="CadEvent" class="btn btn-warning">Salvar</button>                                    
                                    </div>
                                </div>
                            </form>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Evento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span id="msg-cad"></span>
                        <form id="addevent" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Título</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Título do evento">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Color</label>
                                <div class="col-sm-10">
                                    <select name="color" class="form-control" id="color">
                                        <option value="">Selecione</option>			
                                        <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                        <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                                        <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                        <option style="color:#8B4513;" value="#8B4513">Marrom</option>	
                                        <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                        <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                                        <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                        <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                                        <option style="color:#228B22;" value="#228B22">Verde</option>
                                        <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Início do evento</label>
                                <div class="col-sm-10">
                                    <input type="text" name="start" class="form-control" id="start" onkeypress="DataHora(event, this)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Final do evento</label>
                                <div class="col-sm-10">
                                    <input type="text" name="end" class="form-control" id="end"  onkeypress="DataHora(event, this)">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" name="CadEvent" id="CadEvent" value="CadEvent" class="btn btn-success">Cadastrar</button>                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<!-- Sidebar -->
<div class="vertical-nav " id="sidebar">

	<!-- Login Info -->
  	<div class="py-3 px-3 mb-4 ">
		<div class="media d-flex align-items-center"><img src="assets/img/foto.png" alt="..." width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm">
			<div class="media-body">
				<h5 class="m-0">Wesley H. Araújo</h5>
				<p class="font-weight-light text-muted mb-0">Aluno</p>
			</div>
		</div>
  	</div>

	<!-- Menu -->
 	<p class="text-gray font-weight-bold text-uppercase px-3 pb-2">Menu</p>

		<ul class="nav flex-column  mb-0">

			<!-- Iten 1 -->
			<li class="nav-item">
				<a id="cal" href="#" class="nav-link text-dark font-italic ">
					<i class="fas fa-calendar-alt mr-3 text-primary fa-fw"></i>
					Calendário
				</a>
			</li>

			<!-- Iten 2 -->
			<li class="nav-item">
				<a id="demo" href="demo.html" class="nav-link text-dark font-italic ">
					<i class="fas fa-chess-knight mr-3 text-primary fa-fw"></i>
					Demo
				</a>
			</li>

			<!-- Iten 3 -->
			<li class="nav-item">
				<a href="#" class="nav-link text-dark font-italic ">
					<i class="far fa-times-circle mr-3 text-primary fa-fw"></i>
					Vazio
				</a>
			</li>

			<!-- Iten 4 -->
			<li class="nav-item">
				<a href="#" class="nav-link text-dark font-italic ">
					<i class="far fa-times-circle mr-3 text-primary fa-fw"></i>
					Vazio
				</a>
			</li>

		</ul>
	<!-- Mensagens -->
	<p class="text-gray font-weight-bold text-uppercase px-3 p-3">Mensagens<span class="badge badge-primary ml-2 p-2 ">4</span></p>
	
	<ul class="nav   mb-0">

		<!-- Msg 1 -->
		<li class="nav-item">
			<a href="#" class="nav-link text-dark font-italic">
				<div class="alert alert-success alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Success!</strong> This alert box could indicate a successful or positive action.
				</div>
			</a>
		</li>
	</ul>
</div>
<!-- End vertical navbar -->
	<!-- Content -->
	<div class="page-content p-3" id="content">
	
		<!-- header -->
		<header class="row">

			<!-- Toggle button -->
			<div class="col-md-2 ">
				<button id="sidebarCollapse" type="button" class="btn rounded-pill shadow-sm px-4 mb-4">
					<i class="fa fa-bars mr-2"></i>
					<small class="text-uppercase font-weight-bold">Menu</small>
				</button>
			</div>
			<div class="col-md-10 pr-5">
			</div>
			<div class="col-md-3">
			</div>
		</header>
		
	</div>
    </body>
</html>
