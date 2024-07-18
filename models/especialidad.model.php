<?php
require_once('../config/conexion.php');

class Especialidad
{
    public function todos()
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM especialidad";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close(); 
    }

    public function uno($id_Especialidad)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM especialidad WHERE id_especialidad = ?";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('i', $id_Especialidad);
        $stmt->execute();
        $datos = $stmt->get_result()->fetch_assoc(); 
        $con->close(); 
        
        return $datos;
    }

    public function insertar($nombreEspecialidad, $descripcionEspecialidad)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "INSERT INTO especialidad (nombre, descripcion) VALUES (?, ?)";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('ss', $nombreEspecialidad, $descripcionEspecialidad);
        if ($stmt->execute()) {
        } else {
            return 'Error al insertar:' . $stmt->error;
        }
        $con->close(); 
    }

}