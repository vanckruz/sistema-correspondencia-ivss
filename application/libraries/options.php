<?php if ( ! defined('BASEPATH')) exit('Acceso denegado a este script');

class options{
	private $menu;
	
	public function __construct($menu){
		$this->menu=$menu;

	}

/*Menu dinamico*/
	public function vermenus(){
		$opciones_menu="<div id='menu'><ul id='menuLateral' class='nav nav-pills nav-stacked'>";
		foreach ($this->menu as $opcion) {
			$opciones_menu.=$opcion;
		}
		$opciones_menu.="</ul></div>";

		return $opciones_menu;
	}
/*Menu dinamico*/
}