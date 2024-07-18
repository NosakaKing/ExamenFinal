<?php
require_once('../config/conexion.php');

class Estudiante
{
    public function todos()
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM estudiante";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close(); 
    }

    public function uno($idEstudiante)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM estudiante WHERE id_estudiante = ?";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('i', $idEstudiante);
        $stmt->execute();
        $datos = $stmt->get_result()->fetch_assoc(); 
        $con->close(); 
        
        return $datos;
    }

    public function insertar($identificacion, $tipoIdentificacion, $nombre, $primerApellido, $segundoApellido, $fecha_nacimiento, $telefono, $direccion, $correo)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "INSERT INTO estudiante (identificacion, tipo_identificacion, nombre, primer_apellido, segundo_apellido, fecha_nacimiento, telefono, direccion, correo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('sssssssss', $identificacion, $tipoIdentificacion, $nombre, $primerApellido, $segundoApellido, $fecha_nacimiento, $telefono, $direccion, $correo);
        if ($stmt->execute()) {
        } else {
            return 'Error al insertar estudiante:' . $stmt->error;
        }
        $con->close(); 
    }

    public function actualizar($id, $identificacion, $tipoIdentificacion, $nombre, $primerApellido, $segundoApellido, $fecha_nacimiento, $telefono, $direccion, $correo)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "UPDATE estudiante SET identificacion = ?, tipo_identificacion = ?,  nombre = ?, primer_apellido = ?, segundo_apellido = ?, fecha_nacimiento = ?, telefono = ?, direccion = ?, correo = ?  WHERE id_estudiante  = ?";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('sssssssssi', $identificacion, $tipoIdentificacion,  $nombre, $primerApellido, $segundoApellido, $fecha_nacimiento, $telefono, $direccion, $correo, $id);
        if ($stmt->execute()) {
            return $id;
        } else {
            return 'Error al actualizar estudiante:' . $stmt->error;
        }
        $con->close(); 
    }

    public function eliminar($idEstudiante)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "DELETE FROM estudiante WHERE id_estudiante = ?";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('i', $idEstudiante);
        if ($stmt->execute()) {
            return $idEstudiante;
        } else {
            return 'Error al eliminar:' . $stmt->error;
        }
        $con->close(); 
    }

}