<?php
require_once('../config/conexion.php');

class Inscripcion
{
    public function todos()
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT ins.id_inscripcion, ins.id_curso, ins.id_curso, cur.nombre as nombre_curso, ins.id_estudiante, es.identificacion, ins.fecha_inscripcion FROM inscripcion as ins INNER JOIN estudiante es ON ins.id_estudiante = es.id_estudiante INNER JOIN curso as cur ON ins.id_curso = cur.id_curso";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close(); 
    }

    public function uno($idInscripcion)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM inscripcion WHERE id_inscripcion = ?";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('i', $idInscripcion);
        $stmt->execute();
        $datos = $stmt->get_result()->fetch_assoc(); 
        $con->close(); 
        return $datos;
    }

    public function insertar($curso, $estudiante, $fecha_inscripcion)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "INSERT INTO inscripcion (id_curso, id_estudiante, fecha_inscripcion) VALUES (?, ?, ?)";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('sss', $curso, $estudiante, $fecha_inscripcion);
        if ($stmt->execute()) {
        } else {
            return 'Error al insertar inscripcion:' . $stmt->error;
        }
        $con->close(); 
    }

    public function actualizar($id, $curso, $estudiante, $fecha_inscripcion)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "UPDATE inscripcion SET id_curso = ?, id_estudiante = ?, fecha_inscripcion = ? WHERE id_inscripcion  = ?";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('sssi', $curso, $estudiante, $fecha_inscripcion, $id);
        if ($stmt->execute()) {
            return $id;
        } else {
            return 'Error al actualizar inscripcion:' . $stmt->error;
        }
        $con->close(); 

    }

    public function eliminar($idInscripcion)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "DELETE FROM inscripcion WHERE id_inscripcion = ?";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('i', $idInscripcion);
        if ($stmt->execute()) {
            return $idInscripcion;
        } else {
            return 'Error al eliminar inscripcion:' . $stmt->error;
        }
        $con->close(); 
    }
}