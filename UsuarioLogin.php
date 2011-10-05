<?php
require_once dirname(__FILE__).'/includes/config.php';
require_once dirname(__FILE__).'/includes/session.php';
require_once dirname(__FILE__).'/includes/i18n/i18n.php';
require_once dirname(__FILE__).'/includes/db.php';
require_once dirname(__FILE__).'/view/PageView.php';
require_once dirname(__FILE__).'/utils/Message.php';
require_once dirname(__FILE__).'/controller/UsuarioController.php';

class LoginView extends PageView{

	public function __construct(){
		parent::__construct();
	}
	
	public function handleRequest(){

		$this->getMenu()->setSelectedItem("inicio");
		
		$action = $this->getQueryParameter("action");
		if( $action == login ){
			$usuario = new Usuario();
			$usuario->setAlias($this->getPostParameter("userName"));
			$usuario->setPassword($this->getPostParameter("userPassword"));
			
			$login = UsuarioController::inciarSesion($usuario);
			if( $login == UsuarioController::$LOGIN_OK ){
				$usuario_actual=UsuarioController::obtener($usuario);
				$this->setUsuarioActual($usuario_actual);
				//Quien acaba de entrar al sistema? ... abajo se establece quien y se le redirecciona al lugar que le corresponde
				switch($usuario_actual->getTipo()){
					case 0: //TODOS
						break;
					case 1: //ADMINISTRADOR
						break;
					case 2: //PONENTE
						break;
					case 3: //COAUTOR
						break;
					case 4: //EVALUADOR
						
						break;
					case 5: //ASISTENTE
							$this->redirect("PonenciasAll.php");
						break;
					case 6: //REGISTRADO
						break;
					case 7: //PUBLICO
						break;
				}
			} else if ( $login == UsuarioController::$LOGIN_NO_USER_EXIST ) {
				$this->addMessage(new Message("El usuario no existe", Message::$ERROR));
				$this->setContent(new HtmlPage("./view/index.php"));
			} else if ( $login == UsuarioController::$LOGIN_WRONG_PASSWORD ) {
				$this->addMessage(new Message("Contraseña incorrecta", Message::$ERROR));
				$this->setContent(new HtmlPage("./view/index.php"));
			}
		} else if( $action == logout ){
			$this->setUsuarioActual(new Usuario());
			$this->redirect("UsuarioLogin.php");
		} else {
			if( $this->getUsuario()->getTipo() == UsuarioType::$PUBLICO ){
				$this->setContent(new HtmlPage("./view/index.php"));
				$this->getMenu()->setSelectedSubItem("inicio");
				$this->getMenu()->setTitle("Entrar al Sistema");
			} 
			//Las lineas debajo comentadas no me quedan muy claras, son necesarias?, porque?
			/*else {
				$this->redirect("PonenciasAll.php");
			}*/
		}
	}
}
$view = new LoginView();
$view->renderAll();
?>