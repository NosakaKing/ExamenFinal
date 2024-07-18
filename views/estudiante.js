// Codigo para abrir modal de nuevo cliente y editar cliente
const btnAbrirModal = document.querySelector('#btn-abrir-modal');
const btnCerrarModal = document.querySelector('#btn-cerrar-modal');
const modal2 = document.querySelector('#modal');

btnAbrirModal.addEventListener('click', () => {
    limpiarCampos();
    modal2.showModal();
});

btnCerrarModal.addEventListener('click', () => {
    modal2.close();
});

//Fin de codigo para abrir modal de nuevo cliente y editar cliente

//Backend de cliente

//Inicializacion
function init() {
    $("#frm_estudiante").on('submit', function(e) {
        guardaryeditar(e);
    });
}

$(document).ready(() => {
    cargarTabla();
});

//Cargar Tabla
var cargarTabla = () => {
    var html = '';

    $.get("../controllers/estudiante.controller.php?op=todos",(listaEstudiante) => {
        console.log(listaEstudiante);
        $.each(listaEstudiante, (i, estudiante) => {
            html += `
                <tr>
                    <td>${i + 1}</td>
                    <td>${estudiante.identificacion}</td>
                    <td>${estudiante.tipo_identificacion}</td>
                    <td>${estudiante.nombre}</td>
                    <td>${estudiante.primer_apellido}</td>
                    <td>${estudiante.segundo_apellido}</td>
                    <td>${estudiante.fecha_nacimiento}</td>
                    <td>${estudiante.telefono}</td>
                    <td>${estudiante.direccion}</td>
                    <td>${estudiante.correo}</td>
                    <td>
                    <button class="px-5" onclick="editar(${estudiante.id_estudiante})"><span class="material-symbols-outlined"> edit </span></button>
                    <button class="px-5" onclick="eliminar(${estudiante.id_estudiante})"><span class="material-symbols-outlined"> delete </span></button>
                    </td>
                </tr>
            `;
        });
        $("#cuerpoEstudiante").html(html);    
    });
};

//Guardar y Editar

var guardaryeditar = (e) => {
    e.preventDefault(); 
   
    var frm_estudiante = new FormData($("#frm_estudiante")[0]);

    var estudianteId = $("#idEstudiante").val(); 

    var ruta = "";
    if (estudianteId == 0) {
        // Insertar
        ruta = '../controllers/estudiante.controller.php?op=insertar';
       
    } else {
        // Editar
        ruta = "../controllers/estudiante.controller.php?op=actualizar";
    }

    $.ajax({
        url: ruta,
        type: "POST",
        data: frm_estudiante,
        contentType: false,
        processData: false,
        
        success: function (datos) {
            modal2.close();
            cargarTabla();
        },
        error: function (xhr, status, error) {

            console.error("Error al guardar o editar:", error);
        }
    });
};

//Editar
var editar = (estudianteId) => { 
    $.ajax({
        url: `../controllers/estudiante.controller.php?op=uno&id=${estudianteId}`,
        type: "GET",
        success: function (data) {
            $("#idEstudiante").val(data.id_estudiante); 
            $("#identificacion").val(data.identificacion);
            $("#tipo_identificacion").val(data.tipo_identificacion);
            $("#nombre").val(data.nombre); 
            $("#primer_apellido").val(data.primer_apellido);
            $("#segundo_apellido").val(data.segundo_apellido);
            $("#fecha_nacimiento").val(data.fecha_nacimiento);
            $("#telefono").val(data.telefono);
            $("#direccion").val(data.direccion);
            $("#correo").val(data.correo);
            modal2.showModal();
        },
        error: function () {
            
            Swal.fire({
                title: "Estudiante",
                text: "Error al intentar obtener los datos del cliente", 
                icon: "error",

            });
        },
    });
};

//Eliminar
var eliminar = (estudianteId) => {
    Swal.fire({
        title: "Estudiante",
        text: "¿Estas seguro de eliminar el estudiante?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Eliminar",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `../controllers/estudiante.controller.php?op=eliminar`,
                type: "POST",
                data: { id: estudianteId },
                success: (resultado)=> {
                    var resultadoMessage = resultado;
                    console.log(resultadoMessage);
                   if(resultado === resultadoMessage) {
                          cargarTabla();
                       Swal.fire({
                            title: "Estudiante",
                            text: "Estudiante eliminado correctamente",
                            icon: "success",
                          });
                   }else{
                       Swal.fire({
                           title: "Estudiante",
                           text: "Error al intentar eliminar el estudiante",
                           icon: "error",
                       });
                   }
                },
                error: ()=> {
                    Swal.fire({
                        title: "Estudiante",
                        text: "Error al intentar eliminar el estudiante", 
                        icon: "error",
                    });
                },
            });
        }
    });
};

init();

// Limpiar campos

function limpiarCampos() {
    $("#idEstudiante").val(''); 
    $("#identificacion").val(''); 
    $("#tipo_identificacion").val(''); 
    $("#nombre").val(''); 
    $("#primer_apellido").val(''); 
    $("#segundo_apellido").val(''); 
    $("#fecha_nacimiento").val(''); 
    $("#direccion").val(''); 
    $("#correo").val(''); 
    $("#telefono").val('');
}
