<?php 
session_start();
if (isset($_SESSION['USUARIO_ID']) and $_SESSION['USUARIO_ID']!=null ){
	
echo getHeader(); 
//echo base64_decode($_SESSION['USUARIO_ID']);
echo getMenu();
?>


     <br>   
     <div class="row">
     	<div class="col-md-10">
     		<h1 class="text-right"> Sucursal: xochimilco - Fecha: 00/00/00 </h1><br>
     	</div>
     	
     </div>
     	
     <div class="row">
     	<div class="col-md-1"></div>
     	<div class="col-md-10">
     		<div class="page-header"></div>
     	</div>
     </div>
     	
        <div class="row">
        	<div class="col-md-2"></div>
			<div class="col-md-2">
				<div class="jumbotron">      
						<center><h4>- Clientes -</h4></center><br>
						<center><a class="btn btn-info btn-xs" href='/solaris/index.php/clientes/cClientes/formInsertCliente'><i class="glyphicon glyphicon-user"></i> Alta</a>
						<a class="btn btn-info 	 btn-xs" href='/solaris/index.php/clientes/cClientes/formSelectCliente'><i class="glyphicon glyphicon-search"></i> Consulta</a></center>
				</div>
			</div>
			
			<div class="col-md-2">
				<div class="jumbotron">      
						<center><h4>- Productos -</h4></center><br>
						<center><a class="btn btn-success btn-xs" href='/solaris/index.php/clientes/cClientes/formInsertCliente'><i class="glyphicon glyphicon-search"></i> Consulta</a></center>
				</div>
			</div>
			
			<div class="col-md-2">
				<div class="jumbotron">      
						<center><h4>- Remisiones -</h4></center><br>
						<center><a class="btn btn-warning btn-xs" href='/solaris/index.php/clientes/cClientes/formInsertCliente'><i class="glyphicon glyphicon-user"></i> Alta</a>
						<a class="btn btn-warning btn-xs" href='/solaris/index.php/clientes/cClientes/formSelectCliente'><i class="glyphicon glyphicon-search"></i> Consulta</a></center>
				</div>
			</div>
			
			<div class="col-md-2">
				<div class="jumbotron">      
						<center><h4>- Reportes -</h4></center><br>
						<center><a class="btn btn-danger btn-xs" href='/solaris/index.php/clientes/cClientes/formInsertCliente'><i class="glyphicon glyphicon-file"></i> Mensual </a></center>
				</div>
			</div>
			
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-1"></div>
     	<div class="col-md-10">
     		<div class="page-header"></div>
     	</div>
     </div>
     	
<?php
echo getFooter() ;
}else{
	header('Location: /solaris/index.php/main/cLogin/');
}
?>