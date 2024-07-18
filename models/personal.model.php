<?php
require_once('../config/conexion.php');

class Personal
{
    public function todos()
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT per.id_personal, per.identificacion, ca.id_cargo, ca.cargo,per.id_cargo, per.tipo_identificacion, per.nombre, per.primer_apellido, per.segundo_apellido, per.fecha_nacimiento, per.telefono, per.direccion, per.correo, per.clave FROM personal AS per INNER JOIN cargo AS ca ON per.id_cargo = ca.id_cargo";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function uno($idPersonal)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT per.id_personal, per.identificacion, ca.id_cargo, ca.cargo,per.id_cargo, per.tipo_identificacion, per.nombre, per.primer_apellido, per.segundo_apellido, per.fecha_nacimiento, per.telefono, per.direccion, per.correo, per.clave FROM personal AS per INNER JOIN cargo AS ca ON per.id_cargo = ca.id_cargo WHERE per.id_personal = ?;
";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('i', $idPersonal);
        $stmt->execute();
        $datos = $stmt->get_result()->fetch_assoc();
        $con->close();

        return $datos;
    }

    public function insertar($identificacion, $cargo, $tipoIdentificacion, $nombre, $primerApellido, $segundoApellido, $fecha_nacimiento, $telefono, $direccion, $correo, $clave)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "INSERT INTO personal (identificacion, id_cargo, tipo_identificacion, nombre, primer_apellido, segundo_apellido, fecha_nacimiento, telefono, direccion, correo, clave) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('sssssssssss', $identificacion, $cargo, $tipoIdentificacion, $nombre, $primerApellido, $segundoApellido, $fecha_nacimiento, $telefono, $direccion, $correo, $clave);
        if ($stmt->execute()) {
        } else {
            return 'Error al insertar personal:' . $stmt->error;
        }
        $con->close();
    }

    public function actualizar($id, $identificacion, $cargo, $tipoIdentificacion, $nombre, $primerApellido, $segundoApellido, $fecha_nacimiento, $telefono, $direccion, $correo, $clave)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "UPDATE personal SET identificacion = ?, id_cargo = ?, tipo_identificacion = ?,  nombre = ?, primer_apellido = ?, segundo_apellido = ?, fecha_nacimiento = ?, telefono = ?, direccion = ?, correo = ?, clave = ?  WHERE id_personal  = ?";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('sssssssssssi', $identificacion, $cargo, $tipoIdentificacion,  $nombre, $primerApellido, $segundoApellido, $fecha_nacimiento, $telefono, $direccion, $correo, $clave, $id);
        if ($stmt->execute()) {
            return $id;
        } else {
            return 'Error al actualizar personal:' . $stmt->error;
        }
        $con->close();
    }

    public function eliminar($idPersonal)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "DELETE FROM personal WHERE id_personal = ?";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('i', $idPersonal);
        if ($stmt->execute()) {
            return $idPersonal;
        } else {
            return 'Error al eliminar:' . $stmt->error;
        }
        $con->close();
    }

    // Buscar por identificacion solo a profesores
    public function buscar($identificacion)
    {
        $con = new Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT per.id_personal, per.identificacion, ca.id_cargo, ca.cargo,per.id_cargo, per.tipo_identificacion, per.nombre, per.primer_apellido, per.segundo_apellido, per.fecha_nacimiento, per.telefono, per.direccion, per.correo, per.clave FROM personal AS per INNER JOIN cargo AS ca ON per.id_cargo = ca.id_cargo WHERE per.identificacion = ? AND ca.id_cargo = 2";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('i', $identificacion);
        $stmt->execute();
        $datos = $stmt->get_result()->fetch_assoc();
        $con->close();

        return $datos;
    }
    
}
