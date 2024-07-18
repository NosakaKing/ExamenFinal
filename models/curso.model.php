<?php
require_once('../config/conexion.php');

class Curso
{
    public function todos()
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT curso.id_curso, personal.id_personal, personal.identificacion AS personal_identificacion, especialidad.id_especialidad,especialidad.nombre AS especialidad_nombre, paralelo.id_paralelo, paralelo.nombre AS paralelo_nombre, curso.nombre AS curso_nombre,curso.descripcion AS curso_descripcion,curso.fecha_inicio, curso.fecha_fin FROM curso INNER JOIN paralelo ON curso.id_paralelo = paralelo.id_paralelo INNER JOIN especialidad ON curso.id_especialidad = especialidad.id_especialidad INNER JOIN personal ON curso.id_personal = personal.id_personal";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close(); 
    }

    public function uno($idCurso)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT curso.id_curso, personal.id_personal, personal.nombre, personal.primer_apellido,  personal.identificacion AS personal_identificacion, especialidad.id_especialidad,especialidad.nombre AS especialidad_nombre, paralelo.id_paralelo, paralelo.nombre AS paralelo_nombre, curso.nombre AS curso_nombre,curso.descripcion AS curso_descripcion,curso.fecha_inicio, curso.fecha_fin FROM curso INNER JOIN paralelo ON curso.id_paralelo = paralelo.id_paralelo INNER JOIN especialidad ON curso.id_especialidad = especialidad.id_especialidad INNER JOIN personal ON curso.id_personal = personal.id_personal WHERE id_curso = ?";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('i', $idCurso);
        $stmt->execute();
        $datos = $stmt->get_result()->fetch_assoc(); 
        $con->close(); 
        
        return $datos;
    }

    public function insertar($idPersonal, $idParalelo, $idEspecialidad, $nombreCurso, $descripcionCurso, $fechaInicio, $fechaFin)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "INSERT INTO curso (id_personal, id_especialidad,  id_paralelo, nombre, descripcion, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('sssssss', $idPersonal, $idEspecialidad, $idParalelo, $nombreCurso, $descripcionCurso, $fechaInicio, $fechaFin);
        if ($stmt->execute()) {
        } else {
            return 'Error al insertar:' . $stmt->error;
        }
        $con->close(); 
    }
    
    public function eliminar($idCurso)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "DELETE FROM curso WHERE id_curso = ?";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('i', $idCurso);
        if ($stmt->execute()) {
            return $idCurso;
        } else {
            return 'Error al eliminar:' . $stmt->error;
        }
        $con->close(); 
    }
}
