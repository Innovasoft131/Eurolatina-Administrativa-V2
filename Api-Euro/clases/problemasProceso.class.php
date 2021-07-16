<?php
require_once 'conexion/conexion.php';
require_once 'clases/respuestas.class.php';

class ProblemasProceso extends Conexion{
    private $id = "";
    private $idPedido = "";
    private $idUsuario = "";
    private $idprimerModulo = "";
    private $idSegundoModulo = "";
    private $idtercerModulo = "";

    public function insert($json){
        $respuestas = new Respuestas();
        $datos = json_decode($json, true);
        
        if(!isset($datos['id']) ||
            !isset($datos['idPedido']) ||
            !isset($datos['idUsuario']) ||
            !isset($datos['idprimerModulo']) ||
            !isset($datos['idSegundoModulo']) ||
            !isset($datos['idtercerModulo'])){
     
                return $respuestas->error_400();
        }else {
            $this->id = $datos['id'];
            $this->idPedido = $datos['idPedido'];
            $this->idUsuario = $datos['idUsuario'];
            $this->idprimerModulo = $datos['idprimerModulo'];
            $this->idSegundoModulo = $datos['idSegundoModulo'];
            $this->idtercerModulo = $datos['idtercerModulo'];

            $res = $this->insertar();
        
            if($res > 1){
                $respuesta = $respuestas -> response;
                    $respuesta['result'] = array(
                        "idProblemaProceso" => $res,
                        "resultado" => "Guardado"
                    );
                    return $respuesta;
            }else {
                return $respuestas->error_500();
            }
        }
    }

    private function insertar(){
        if($this->id == "" && $this->idprimerModulo == "" && $this->idSegundoModulo == "" && $this->idtercerModulo == "" && $this->idPedido == "" ){
            $query = 'INSERT INTO problemasProceso(id, idPedido, idUsuario, idprimerModulo, idSegundoModulo, idtercerModulo) VALUES
            (null, null, '.$this->idUsuario.', null, null, null)';
            
        }elseif($this->idprimerModulo == "" && $this->idSegundoModulo == "" && $this->idtercerModulo == ""){
            $query = 'INSERT INTO problemasProceso(id, idPedido, idUsuario, idprimerModulo, idSegundoModulo, idtercerModulo) VALUES
            (null, '.$this->idPedido.', '.$this->idUsuario.', null, null, null)';
            
        }elseif($this->idprimerModulo != "" && $this->idSegundoModulo == "" && $this->idtercerModulo == ""){
            $query = 'INSERT INTO problemasProceso(id, idPedido, idUsuario, idprimerModulo, idSegundoModulo, idtercerModulo) VALUES
            (null, '.$this->idPedido.', '.$this->idUsuario.', '.$this->idprimerModulo.', null, null)';
            
        }elseif($this->idSegundoModulo != "" && $this->idprimerModulo == "" && $this->idtercerModulo == ""){
            if($this->idPedido == ""){
                $query = 'INSERT INTO problemasProceso(id, idPedido, idUsuario, idprimerModulo, idSegundoModulo, idtercerModulo) VALUES
            (null, null, '.$this->idUsuario.', null, '.$this->idSegundoModulo.', null)';
            }else{
                $query = 'INSERT INTO problemasProceso(id, idPedido, idUsuario, idprimerModulo, idSegundoModulo, idtercerModulo) VALUES
            (null, '.$this->idPedido.', '.$this->idUsuario.', null, '.$this->idSegundoModulo.', null)';
            }
            
        }elseif($this->idtercerModulo != "" && $this->idprimerModulo == "" && $this->idSegundoModulo == ""){
            if($this->idPedido == ""){
                $query = 'INSERT INTO problemasProceso(id, idPedido, idUsuario, idprimerModulo, idSegundoModulo, idtercerModulo) VALUES
                (null, null, '.$this->idUsuario.', null, null, '.$this->idtercerModulo.')';
            }else{
                $query = 'INSERT INTO problemasProceso(id, idPedido, idUsuario, idprimerModulo, idSegundoModulo, idtercerModulo) VALUES
                (null, '.$this->idPedido.', '.$this->idUsuario.', null, null, '.$this->idtercerModulo.')';
            }

        }elseif($this->idPedido == "" && $this->idPedido == null){
            
                $query = 'INSERT INTO problemasProceso(id, idPedido, idUsuario, idprimerModulo, idSegundoModulo, idtercerModulo) VALUES
                (null, NULL, '.$this->idUsuario.', '.$this->idprimerModulo.',  '.$this->idSegundoModulo.', '.$this->idtercerModulo.')';
        }else{
            
            $query = 'INSERT INTO problemasProceso(id, idPedido, idUsuario, idprimerModulo, idSegundoModulo, idtercerModulo) VALUES
            (null, '.$this->idPedido.', '.$this->idUsuario.', '.$this->idprimerModulo.', '.$this->idSegundoModulo.', '.$this->idtercerModulo.')';
        }
        
        
        
      

       
        $res = parent::nonQueryIds($query);

        return $res;
    }
}