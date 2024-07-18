<?php
require_once('../config/conexion.php');

class Paralelo
{
    public function todos()
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM paralelo";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close(); 
    }

    public function uno($id_Paralelo)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM paralelo WHERE id_paralelo = ?";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('i', $id_Paralelo);
        $stmt->execute();
        $datos = $stmt->get_result()->fetch_assoc(); 
        $con->close(); 
        
        return $datos;
    }

    public function insertar($nombreParalelo)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "INSERT INTO paralelo (nombre) VALUES (?)";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('s', $nombreParalelo);
        if ($stmt->execute()) {
        } else {
            return 'Error al insertar:' . $stmt->error;
        }
        $con->close(); 
    }

}