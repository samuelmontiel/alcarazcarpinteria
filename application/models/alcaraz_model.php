<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alcaraz_model extends CI_Model {
public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		
	}
 //************************************************ FUNCION DE LOGIN *********************************
     
	public function login($Usuario,$Password){
		//select *from usuarios where usuario=$usuario and password=$password;
		
		return $this->db->where('Usuario',$Usuario)
								->where('Password',$Password)
								->where('Web',1)
								->get('usuario')
								->row();
	}


	public function accesoTclientes($IdCliente){
		return $Query = $this->db->where('IdCliente',$IdCliente)
		->get('clientes_web')
		->row();
	}
	public function verTproductos(){
       return $this->db->get('productos')
						 ->result();

}


		public function update($time,$idUsuario){
 		 $this->db->set('UltAceWeb',$time)->where('idUsuario',$idUsuario)
										  ->update('usuario');

	}




	 public function inserTemProducto($IdCliente,$idProducto,$Cantidad,$Codigo,$Nombre,$Categoria,$Precio,$Descripcion){
							
              return $this->db->set('IdCliente',$IdCliente)
              			      ->set('idProducto',$idProducto)
                              ->set('cantidad',$Cantidad)
              				  ->set('idCodigo',$Codigo)
                              ->set('nombreProducto',$Nombre) 
                              ->set('categoria',$Categoria)
                              ->set('precioEstimado',$Precio)
                              ->set('observaciones',$Descripcion)
                              ->insert('productostemp');
                              
  }
}