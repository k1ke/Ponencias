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

		$this->getMenu()->setSelectedItem("evaluar");

		$action = $this->getQueryParameter("action");
		
			global $ponencias;
			$ponencias = PonenciaManager::listar();//aqui se obtiene toda la lista de ponencias
			$this->setContent(new HtmlPage("./view/Asistente/ListPonencias.php"));
			$this->getMenu()->setSelectedSubItem("inicio");
			$this->getMenu()->setTitle("Lista de ponencias");
			
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
		
	}
}
$view = new LoginView();
$view->renderAll();
?>