<?php
require_once('../config/conexion.php');

class Cargo
{
    public function todos()
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM cargo";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close(); 
    }

    public function uno($idCategoria)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM cargo WHERE id_cargo = ?";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('i', $idCategoria);
        $stmt->execute();
        $datos = $stmt->get_result()->fetch_assoc(); 
        $con->close(); 
        
        return $datos;
    }

    public function insertar($nombreCargo)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "INSERT INTO cargo (cargo) VALUES (?)";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('s', $nombreCargo);
        if ($stmt->execute()) {
        } else {
            return 'Error al insertar:' . $stmt->error;
        }
        $con->close(); 
    }

}