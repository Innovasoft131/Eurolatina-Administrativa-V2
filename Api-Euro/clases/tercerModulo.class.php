<?php
require_once 'conexion/conexion.php';
require_once 'clases/respuestas.class.php';

class TercerModulo extends Conexion{
    private $id = "";
    private $idPrimerModulo = "";
    private $idPieza = "";
    private $idColor = "";
    private $idsegundoModulo = "";
    private $idTalla = "";
    private $idPrimerModuloD = "";
    private $idPedido = "";
    private $idMaquinaProceso = "";
    private $idUsuario = "";
    private $descripcio = "";
    private $CantidadRecibida = "";
    private $cantidadInicio = "";
    private $cantidadFinal = "";
    private $cantidadefectuosas = "";
    private $fechainicio = "0000-00-00 00:00:00";
    private $fechaFin = "0000-00-00 00:00:00";
    private $estado = "";
/*
    public function mostrar($id){
        $query = 'select pmd.*, mp.cantidad as cantidad_pieza, c.nombre as color, pt.talla, ph.fecha as fecha_pedido, pm.idPedido, p.nombre as nombre_pieza, sm.id as idSegundoModulo, sm.idPrimerModuloD, sm.idMaquinaProceso, sm.descripcio as descripcionSegundoModulo  from primerModulo pm join primerModuloDesglose pmd on pmd.idPrimerModulo=pm.id join maquinasProceso mp on mp.idPrimerModuloD=pmd.id
        join colorPieza cp on pmd.idColor = cp.id join color c on c.id = cp.idColor join piezaTalla pt on  pmd.idTalla = pt.id join pedidosHechos ph on ph.id = pm.idPedido
        join pieza p on p.id = pmd.idPieza  join segundoModulo sm on sm.idPrimerModulo=pmd.idPrimerModulo
        where mp.idMaquina ="'.$id.'" and ( pm.estado = 1 and mp.estado = 1 and sm.estado=1)';

        $datos = parent::obtenerDatos($query);
        return $datos;
    }
    */
        public function mostrar($id){
            /*
        $query = 'SELECT sm.*, c.nombre as color, mp.cantidad as cantidad_pieza, ph.fecha as fecha_pedido,  pt.talla, p.nombre as nombre_pieza, sm.id as idSegundoModulo from segundoModulo sm join primerModulo pm on pm.id=sm.idPrimerModulo join pedidosHechos ph on ph.id=sm.idPedido 
            join maquinasProceso mp on sm.idMaquinaProceso = mp.id join colorPieza cp on cp.id=sm.idColor join color c on c.id = cp.idColor join piezaTalla pt on pt.id=sm.idTalla join pieza p on p.id = sm.idPieza
            where (sm.estado = 1 and mp.estado = 1 ) and  mp.idMaquina ='.$id;
        
        */
        
        $query = 'SELECT tm.*, p.nombre as nombre_pieza, sm.idPrimerModulo, tm.id as idTercerModulo, c.nombre as color, c.id as idColores, pt.talla, ph.fecha as fecha_pedido, mp.cantidad as cantidad_pieza FROM tercerModulo tm join pieza p on p.id = tm.idPieza join segundoModulo sm on sm.id=tm.idsegundoModulo
        join colorPieza cp on cp.id = tm.idColor JOIN color c on c.id = cp.idColor join piezaTalla pt on pt.id=tm.idTalla join pedidosHechos ph on ph.id=tm.idPedido
        join maquinasProceso mp on mp.id=tm.idMaquinaProceso
        WHERE mp.idMaquina ="'.$id.'" and (tm.estado = 0 and (sm.estado = 1 or sm.estado = 0)) and tm.cantidadInicio > 0 order by tm.id asc';

        $datos = parent::obtenerDatos($query);
        return $datos;
    }
/*
    public function mostrarEnProceso($id){
        $query = 'select pmd.*, mp.cantidad as cantidad_pieza, c.nombre as color, pt.talla, ph.fecha as fecha_pedido, pm.idPedido, p.nombre as nombre_pieza, m.nombre as nombre_modelo, sm.id as idSegundoModulo, sm.idPrimerModuloD, sm.idMaquinaProceso, sm.descripcio as descripcionSegundoModulo, tm.CantidadRecibida, tm.id as idTercerModulo  from primerModulo pm join primerModuloDesglose pmd on pmd.idPrimerModulo=pm.id join maquinasProceso mp on mp.idPrimerModuloD=pmd.id
        join colorPieza cp on pmd.idColor = cp.id join color c on c.id = cp.idColor join piezaTalla pt on  pmd.idTalla = pt.id join pedidosHechos ph on ph.id = pm.idPedido
        join pieza p on p.id = pmd.idPieza join modelo m on m.id = p.idModelo join segundoModulo sm on sm.idPrimerModulo=pmd.idPrimerModulo join tercerModulo tm on tm.idsegundoModulo = sm.id
        where mp.idMaquina ="'.$id.'" and ( pm.estado = 1 and mp.estado = 2 and sm.estado=1 and tm.estado = 0)';

        $datos = parent::obtenerDatos($query);
        return $datos;
    }
*/
    public function mostrarEnProceso($id){
        /*
        $query = 'SELECT tm.*, p.nombre as nombre_pieza, sm.idPrimerModulo, tm.id as idTercerModulo, c.nombre as color, pt.talla, ph.fecha as fecha_pedido, mp.cantidad as cantidad_pieza FROM tercerModulo tm join pieza p on p.id = tm.idPieza join segundoModulo sm on sm.id=tm.idsegundoModulo
        join colorPieza cp on cp.id = tm.idColor JOIN color c on c.id = cp.idColor join piezaTalla pt on pt.id=tm.idTalla join pedidosHechos ph on ph.id=tm.idPedido
        join maquinasProceso mp on mp.id=tm.idMaquinaProceso
        WHERE mp.idMaquina ="'.$id.'" and (tm.estado = 0 and sm.estado = 1)';
        
        */
        
         $query = 'SELECT tm.*, p.nombre as nombre_pieza, sm.idPrimerModulo, tm.id as idTercerModulo, c.nombre as color, c.id as idColores, pt.talla, ph.fecha as fecha_pedido, mp.cantidad as cantidad_pieza FROM tercerModulo tm join pieza p on p.id = tm.idPieza join segundoModulo sm on sm.id=tm.idsegundoModulo
        join colorPieza cp on cp.id = tm.idColor JOIN color c on c.id = cp.idColor join piezaTalla pt on pt.id=tm.idTalla join pedidosHechos ph on ph.id=tm.idPedido
        join maquinasProceso mp on mp.id=tm.idMaquinaProceso
        WHERE mp.idMaquina ="'.$id.'" and (tm.estado = 1 and sm.estado = 1) order by tm.id asc';

        $datos = parent::obtenerDatos($query);
        return $datos;
    }
    
    public function obtenerCombinacion($idColor){

        $query = 'select cc.* from colorPieza cp join color c on cp.idColor=c.id join combinacionColor cc on cc.idColor = c.id where cp.idColor ='.$idColor;

        $datos = parent::obtenerDatos($query);
        return $datos;
    }

    public function insert($json){
        $respuestas = new Respuestas();
        $datos = json_decode($json, true);
        
        if(!isset($datos['id']) ||
            !isset($datos['idsegundoModulo']) ||
            !isset($datos['idPedido']) ||
            !isset($datos['idMaquinaProceso']) ||
            !isset($datos['idUsuario']) ||
            !isset($datos['idPieza']) ||
            !isset($datos['idColor']) ||
            !isset($datos['idTalla']) ||
            !isset($datos['idPrimerModuloD']) ||
            !isset($datos['descripcio']) ||
            !isset($datos['CantidadRecibida']) ||
            !isset($datos['cantidadInicio']) ||
            !isset($datos['cantidadFinal']) ||
            !isset($datos['cantidadefectuosas']) ||
            !isset($datos['fechainicio']) ||
            !isset($datos['fechaFin']) ||
            !isset($datos['estado'])){
                return $respuestas->error_400();
        }else {
            $this->id = $datos['id'];
            $this->idsegundoModulo = $datos['idsegundoModulo'];
            $this->idPedido = $datos['idPedido'];
            $this->idMaquinaProceso = $datos['idMaquinaProceso'];
            $this->idUsuario = $datos['idUsuario'];
            $this->idPieza = $datos['idPieza'];
            $this->idColor = $datos['idColor'];
            $this->idTalla = $datos['idTalla'];
            $this->idPrimerModuloD = $datos['idPrimerModuloD'];
            $this->descripcio = $datos['descripcio'];
            $this->CantidadRecibida = $datos['CantidadRecibida'];
            $this->cantidadInicio = $datos['cantidadInicio'];
            $this->cantidadFinal = $datos['cantidadFinal'];
            $this->cantidadefectuosas = $datos['cantidadefectuosas'];
            $this->fechainicio = $datos['fechainicio'];
            $this->fechaFin = $datos['fechaFin'];
            $this->estado = $datos['estado'];
            $res = $this->insertar();
            
         //   echo $res;

            if($res > 0){
                $respuesta = $respuestas -> response;
                    $respuesta['result'] = array(
                        "idTercerModulo" => $res,
                        "resultado" => "Guardado"
                    );
                    return $respuesta;
            }else {
                return $respuestas->error_500();
            }
        }

    }

    private function insertar(){
         $query = 'INSERT INTO tercerModulo(id, idsegundoModulo, idPedido, idMaquinaProceso, idUsuario, idPieza, idColor, idTalla, idPrimerModuloD, descripcio, CantidadRecibida, cantidadInicio, cantidadFinal, cantidadefectuosas, fechainicio, fechaFin, estado)VALUES
        (NULL,  "'.$this->idsegundoModulo.'", "'.$this->idPedido.'", "'.$this->idMaquinaProceso.'", "'.$this->idUsuario.'", "'.$this->idPieza.'", "'.$this->idColor.'", "'.$this->idTalla.'", "'.$this->idPrimerModuloD.'", "'.$this->descripcio.'", "'.$this->CantidadRecibida.'", "'.$this->cantidadInicio.'", "'.$this->cantidadFinal.'", "'.$this->cantidadefectuosas.'", NOW(), NOW(), "'.$this->estado.'")';
       
        $res = parent::nonQueryIds($query);

        return $res; 
        
    }
    /*
    public function editarCantidad($json){
        $respuestas = new Respuestas();
        $datos = json_decode($json, true);
       
        if(!isset($datos["cantidadDefectuosas"]) ||
            !isset($datos["cantidadFinal"]) ||
            !isset($datos["id"])){
                return $respuestas->error_400();
        }else{
            $this-> cantidadefectuosas = $datos['cantidadDefectuosas'];
            $this->fechaFin = $datos['cantidadFinal'];
            $this-> id = $datos['id'];
            $res = $this->modificarCantidad();

            if($res == "ok"){
                $respuesta = $respuestas -> response;
                    $respuesta['result'] = array(
                        "resultado" => "Guardado"
                    );
                    return $respuesta;
            }else {
                return $respuestas->error_500();
            }
        }
    }
    */
    
    public function editarCantidad($json){
        $respuestas = new Respuestas();
        $datos = json_decode($json, true);
       
        if(!isset($datos["id"])){
                return $respuestas->error_400();
        }else{
            $this-> cantidadefectuosas = $datos['cantidadDefectuosas'];
            $this->fechaFin = $datos['cantidadFinal'];
            $this-> id = $datos['id'];
            $res = $this->modificarCantidad();

            if($res == "ok"){
                $respuesta = $respuestas -> response;
                    $respuesta['result'] = array(
                        "resultado" => "Guardado"
                    );
                    return $respuesta;
            }else {
                return $respuestas->error_500();
            }
        }
    }
    
    public function editarCantidadTercerModulo($json){
        $respuestas = new Respuestas();
        $datos = json_decode($json, true);
       
        if(!isset($datos["id"]) ||
            !isset($datos["cantidad"])){
                return $respuestas->error_400();
        }else{
            $this-> cantidadInicio = $datos['cantidad'];
            $this-> id = $datos['id'];
            $res = $this->modificarCantidadTercerModulo();

            if($res == "ok"){
                $respuesta = $respuestas -> response;
                    $respuesta['result'] = array(
                        "resultado" => "Guardado"
                    );
                    return $respuesta;
            }else {
                return $respuestas->error_500();
            }
        }
    }
    
    private function modificarCantidadTercerModulo(){
        $query = 'UPDATE tercerModulo SET  cantidadInicio = cantidadInicio + '.$this-> cantidadInicio.' WHERE idMaquinaProceso="'.$this->id.'"';
        $res = parent::nonQueryId($query);
        
        
        if($res == "ok"){
           return "ok";
        }else{
            return "error";
        }
    }
    
    /*
    private function modificarCantidad(){
        $query = 'UPDATE tercerModulo SET cantidadefectuosas = "'.$this->cantidadefectuosas.'", cantidadFinal="'.$this->fechaFin.'", estado = 2, fechaFin = NOW() WHERE id="'.$this->id.'"';
        $res = parent::nonQueryId($query);

        if($res == "ok"){
           return "ok";
        }else{
            return "error";
        }
    }
    */
    
    private function modificarCantidad(){
        $query = 'UPDATE tercerModulo SET  estado = 2, fechaFin = NOW() WHERE id="'.$this->id.'"';
        $res = parent::nonQueryId($query);

        if($res == "ok"){
           return "ok";
        }else{
            return "error";
        }
    }

    public function edit($json){
        $respuestas = new Respuestas();
        $datos = json_decode($json, true);

        if(!isset($datos['id']) ||
            !isset($datos['idsegundoModulo']) ||
            !isset($datos['idPedido']) ||
            !isset($datos['idMaquinaProceso']) ||
            !isset($datos['idUsuario']) ||
            !isset($datos['idPieza']) ||
            !isset($datos['idColor']) ||
            !isset($datos['idTalla']) ||
            !isset($datos['idPrimerModuloD']) ||
            !isset($datos['descripcio']) ||
            !isset($datos['cantidadInicio']) ||
            !isset($datos['cantidadFinal']) ||
            !isset($datos['cantidadefectuosas']) ||
            !isset($datos['fechainicio']) ||
            !isset($datos['fechaFin']) ||
            !isset($datos['estado'])){
                return $respuestas->error_400();
        }else {
            $this->id = $datos['id'];
            $this->idsegundoModulo = $datos['idsegundoModulo'];
            $this->idPedido = $datos['idPedido'];
            $this->idMaquinaProceso = $datos['idMaquinaProceso'];
            $this->idUsuario = $datos['idUsuario'];
            $this->idPieza = $datos['idPieza'];
            $this->idColor = $datos['idColor'];
            $this->idTalla = $datos['idTalla'];
            $this->idPrimerModuloD = $datos['idPrimerModuloD'];
            $this->descripcio = $datos['descripcio'];
            $this->cantidadInicio = $datos['cantidadInicio'];
            $this->cantidadFinal = $datos['cantidadFinal'];
            $this->cantidadefectuosas = $datos['cantidadefectuosas'];
            $this->fechainicio = $datos['fechainicio'];
            $this->fechaFin = $datos['fechaFin'];
            $this->estado = $datos['estado'];

            if($res == "ok"){
                $respuesta = $respuestas -> response;
                    $respuesta['result'] = array(
                        "resultado" => "Guardado"
                    );
                    return $respuesta;
            }else {
                return $respuestas->error_500();
            }
        }

    }

    private function modificar(){
        $query = 'UPDATE tercerModulo SET idsegundoModulo= "'.$this->idsegundoModulo.'", idPedido= "'.$this->idPedido.'", idMaquinaProceso= "'.$this->idMaquinaProceso.'", "'.$this->idUsuario.'", descripcio= "'.$this->descripcio.'", cantidadInicio= "'.$this->cantidadInicio.'", cantidadFinal="'.$this->cantidadFinal.'", cantidadefectuosas="'.$this->cantidadefectuosas.'", fechainicio="'.$this->fechainicio.'", fechaFin="'.$this->fechaFin.'", estado="'.$this->estado.'"';
        $res = parent::nonQueryId($query);

        if($res == "ok"){
           return "ok";
        }else{
            return "error";
        }
    }
    
    
       public function editarCantidadRecibida($json){
        $respuestas = new Respuestas();
        $datos = json_decode($json, true);
        if(!isset($datos["id"]) ||
            !isset($datos["CantidadRecibida"])){
                return $respuestas->error_400();
        }else{
            $this-> id = $datos['id'];
            $this->CantidadRecibida = $datos['CantidadRecibida'];
            $res = $this->modificarCantidadRecibida();

            if($res == "ok"){
                $respuesta = $respuestas -> response;
                    $respuesta['result'] = array(
                        "resultado" => "Guardado"
                    );
                    return $respuesta;
            }else {
                return $respuestas->error_500();
            }
        }
    }

    private function modificarCantidadRecibida(){
        $query = 'update tercerModulo set CantidadRecibida = CantidadRecibida - '.$this->CantidadRecibida.' WHERE id="'.$this->id.'"';
        $res = parent::nonQueryId($query);

        if($res == "ok"){
           return "ok";
        }else{
            return "error";
        }
    }
    
        public function obtenercantidadRecibida($id){
  
      //  $query = 'select CantidadRecibida from segundoModulo where id ="'.$id.'"';
        $query = 'select sum(cantidad) as cantidadRestante from CantidadPiezasTomadas where idtercerModulo ="'.$id.'"';
        $datos = parent::obtenerDatos($query);

        return $datos;
    }
    

}