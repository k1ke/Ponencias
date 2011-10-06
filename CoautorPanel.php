<?php
require_once dirname(__FILE__).'/includes/config.php';
require_once dirname(__FILE__).'/includes/session.php';
require_once dirname(__FILE__).'/includes/i18n/i18n.php';
require_once dirname(__FILE__).'/includes/db.php';
require_once dirname(__FILE__).'/view/PageView.php';
require_once dirname(__FILE__).'/controller/UsuarioController.php';
require_once dirname(__FILE__).'/controller/PonenciaController.php';
require_once dirname(__FILE__).'/controller/EvaluacionController.php';

class LoginView extends PageView{

	public function __construct(){
		parent::__construct();
	}
	
	public function handleRequest(){
	
		
			$this->getMenu()->setSelectedItem("evaluar"); //aqui hay algo raro :S, si quito esta linea no hace render, sin embargo para "deseleccionar"
														  //un MenuItem hay que poner alguno que no este en esta vista que es de coautor.
			$action = $this->getQueryParameter("action");
		
			global $ponencias;
			$ponencias = PonenciaManager::listar();//aqui se obtiene toda la lista de ponencias
			$this->getMenu()->setSelectedSubItem("inicio");
			$this->setContent(new HtmlPage("./view/Coautor/ViewPonencias.php"));
			$this->getMenu()->setTitle("Panel de control del Coautor");
			
		if($action == viewPonencias)
		{
			$this->getMenu()->setSelectedItem("Todas las ponencias");
			$this->setContent(new HtmlPage("./view/Coautor/ViewPonencias.php"));
		}
		else if($action == viewAprobadas)
		{
			$this->getMenu()->setSelectedItem("Ponencias aprobadas");
			$this->setContent(new HtmlPage("./view/Coautor/ViewPonencias.php"));
			//aqui va algo como: select* from ponencias where estado=aprobado and usuario=$this->getID()
		}
		else if($action == viewPendientes)
		{
			$this->getMenu()->setSelectedItem("Ponencias pendientes");
			$this->setContent(new HtmlPage("./view/Coautor/ViewPonencias.php"));
			//aqui va algo como: select* from ponencias where estado=pendiente and usuario=$this->getID()
		}
			/*
			if($action == sendmail)
			{
				$mail=UsuarioController::enviarMail($this->getUsuario());
				if($mail == UsuarioController::$MAIL_OK){
					$this->addMessage(new Message("Correo enviado con exito", Message::$ERROR));//existe algun Message::$OK ?
					$this->setContent(new HtmlPage("./view/Asistente/ListPonencias.php"));
				}
				else if($mail == UsuarioController::$MAIL_FAILURE){
					$this->addMessage(new Message("Ocurrio un error al enviar el mensaje, intentelo de nuevo", Message::$ERROR));
					$this->setContent(new HtmlPage("./view/Asistente/ListPonencias.php"));
					}
			}
			*/
	}
}
$view = new LoginView();
$view->renderAll();
?>