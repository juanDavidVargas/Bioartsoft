<?php

	class mdlConfiguracionPago
	{

		private $tipo_pago;
		private $tiempo_pago;
		private $porcentaje_comision;
		private $valor_base;
		private $Valor_dia;
		private $valor_dia_temporal;
		private $idTbl_Configuracion;
		private $db;

		public static function getConfiguraciones(){
			$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
			$db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
			require_once('mdlVentas.php');
			$mdl = new mdlConfiguracionPago($db);
			$mdl2 = new mdlVentas($db);
			return [
				'config1' => $mdl->listarConfiguracion(),
				'config2' => $mdl2->listarConfiguracionVentas(),
			];
		}

		public static function getNotificaciones(){
			$notificaciones = [];

			$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
			$db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);

			self::consultaStock($notificaciones, $db);
			self::consultaCreditos($notificaciones, $db);
			if($_SESSION['ROL'] == 3){
				self::consultaPrestamos($notificaciones, $db);
			}else{
				
			}

			return $notificaciones;
		}



		public static function consultaCreditos(&$notificaciones, $db){
			#Consultar créditos de clientes que se cumplen en 5 días
			$sql = "CALL SP_Notificacion_Creditos()";
			$stm = $db->prepare($sql);
			$stm->execute();
			$resultado = $stm ->fetchAll(PDO::FETCH_ASSOC);

			if(count($resultado) > 0){
				$notificaciones[] = [
					'icono' => 'fa fa-credit-card',
					'url' => URL . 'Ventas/listarClientesCredito',
					'texto' => 'Hay créditos a punto de vencer ',
				];
			}
	}


	public static function consultaPrestamos(&$notificaciones, $db){
		#Consultar préstamos de empleados que se cumplen en 5 días
		$sql = "CALL SP_Notificacion_Prestamos()";
		$stm = $db->prepare($sql);
		$stm->execute();
		$resultado = $stm ->fetchAll(PDO::FETCH_ASSOC);

		if(count($resultado) > 0){
			$notificaciones[] = [
				'icono' => 'fa fa-money',
				'url' => URL . 'Empleados/listarPrestamosVencer',
				'texto' => 'Hay Préstamos a punto de vencer ',
			];
		}
}



		public static function consultaStock(&$notificaciones, $db){
				# consultar productos en stock minimo
				//$sql = "SELECT * FROM tbl_productos WHERE cantidad <= stock_minimo";
				$sql = "CALL SP_Notificacion_Stock_Minimo()";
				$stm = $db->prepare($sql);
				$stm->execute();
				$resultados = $stm->fetchAll(2);

				if(count($resultados) > 0){
					$notificaciones[] = [
						'icono' => 'fa fa-cubes',
						'url' => URL . 'producto/listarStock',
						'texto' => 'Hay productos por debajo del stock mínimo',
					];
				}
		}

		public function __SET($atributo, $valor)
		{
			$this->$atributo = $valor;
		}

		public function __GET($atributo)
		{
			return $this->$atributo;
		}

		function __construct($db)
		{
			try {
				$this->db = $db;
			} catch (Exception $e) {
				exit("No se pudo establecer conexión con la base de datos");
			}
		}


		public function listarConfiguracion()
		{
			$sql = "CALL SP_Listar_configuracion()";
			$stm = $this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function listarConfiguracion2()
		{
			$sql = "CALL SP_Listar_Configuracion2()";
			$stm = $this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function listarconfiguracion3()
		{
			$sql = "CALL SP_Listar_Configuracion3()";
			$stm = $this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function listarConfiguracionPagos()
		{
			$sql = "CALL SP_Listar_Configuracion_Pagos()";
			$stm = $this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function modificarConfiguracion()
		{
			$sql = "CALL SP_Modificar_Configuracion(?, ?, ?, ?, ?)";
			$stm = $this->db->prepare($sql);
			$stm->bindParam(1, $this->tiempo_pago);
			$stm->bindParam(2, $this->Valor_dia);
			$stm->bindParam(3, $this->valor_dia_temporal);
			$stm->bindParam(4, $this->porcentaje_comision);
			$stm->bindParam(5, $this->valor_base);
			return $stm->execute();
		}

		public function modificarValorBase()
		{
			$sql = "CALL SP_Modificar_Valor_Base(?)";
			$stm = $this->db->prepare($sql);
			$stm->bindParam(1, $this->valor_base);
			$stm->execute();
			return $stm;
		}
	}
