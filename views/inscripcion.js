// Codigo para abrir modal de nuevo cliente y editar cliente
const btnAbrirModal = document.querySelector('#btn-abrir-modal');
const btnCerrarModal = document.querySelector('#btn-cerrar-modal');
const modal2 = document.querySelector('#modal');

btnAbrirModal.addEventListener('click', () => {
    modal2.showModal();
});

btnCerrarModal.addEventListener('click', () => {
    modal2.close();
});

//Fin de codigo para abrir modal de nueva inscripcion y editar inscripcion

//Backend de inscripcion

//Inicializacion
function init() {
    $("#frm_inscripcion").on('submit', function(e) {
        guardaryeditar(e);
    });
}

$(document).ready(() => {
    cargarTabla();
    cargarCurso();
    cargarEstudiante();
});

//Cargar Tabla
var cargarTabla = () => {
    var html = '';

    $.get("../controllers/inscripcion.controller.php?op=todos",(listaInscripcion) => {
        console.log(listaInscripcion);
        $.each(listaInscripcion, (i, inscripcion) => {
            html += `
                <tr>
                    <td>${i + 1}</td>
                    <td>${inscripcion.identificacion}</td>
                    <td>${inscripcion.nombre_curso}</td>
                    <td>${inscripcion.fecha_inscripcion}</td>
                    <td>
                    <button class="px-5" onclick="editar(${inscripcion.id_inscripcion})"><span class="material-symbols-outlined"> edit </span></button>
                    <button class="px-5" onclick="eliminar(${inscripcion.id_inscripcion})"><span class="material-symbols-outlined"> delete </span></button>
                    </td>
                </tr>
            `;
        });
        $("#cuerpoInscripcion").html(html);    
    });
};

// Cargar curso
var cargarCurso = () => {
    $.get("../controllers/curso.controller.php?op=todos", (listaCurso) => {
        console.log(listaCurso);
        $.each(listaCurso, (i, curso) => {
            $("#curso").append(`<option value="${curso.id_curso}">${curso.curso_nombre}</option>`);
        });
    });
};

// Cargar estudiante
var cargarEstudiante = () => {
    $.get("../controllers/estudiante.controller.php?op=todos", (listaEstudiante) => {
        console.log(listaEstudiante);
        $.each(listaEstudiante, (i, estudiante) => {
            $("#estudiante").append(`<option value="${estudiante.id_estudiante}">${estudiante.nombre}</option>`);
        });
    });
};

//Guardar y Editar

var guardaryeditar = (e) => {
    e.preventDefault();

    var frm_inscripcion = new FormData($("#frm_inscripcion")[0]);

    var id_inscripcion = $("#idInscripcion").val();

    var ruta = "";
    if (id_inscripcion == 0) {
        ruta = "../controllers/inscripcion.controller.php?op=insertar";
    } else {
        ruta = "../controllers/inscripcion.controller.php?op=actualizar";
    }

    $.ajax({
        url: ruta,
        type: "POST",
        data: frm_inscripcion,
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
var editar = (id_inscripcion) => {
    $.ajax({
        url: `../controllers/inscripcion.controller.php?op=uno&id=${id_inscripcion}`,
        type: "GET",
        success: function (data) {
            $("#idInscripcion").val(data.id_inscripcion);
            $("#estudiante").val(data.id_estudiante);
            $("#curso").val(data.id_curso);
            $("#fecha_inscripcion").val(data.fecha_inscripcion);
            modal2.showModal();
        },
        error: function () {
            
            Swal.fire({
                title: "Inscripcion",
                text: "Error al intentar obtener los datos del inscripcion", 
                icon: "error",

            });
        },
    });
};

//Eliminar

var eliminar = (id_inscripcion) => {
    Swal.fire({
        title: "Inscripcion",
        text: "¿Estas seguro de eliminar el Inscripcion?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Eliminar",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `../controllers/inscripcion.controller.php?op=eliminar`,
                type: "POST",
                data: { id: id_inscripcion },
                success: (resultado)=> {
                    var resultadoMessage = resultado;
                    console.log(resultadoMessage);
                   if(resultado === resultadoMessage) {
                          cargarTabla();
                       Swal.fire({
                            title: "Inscripcion",
                            text: "Inscripcion eliminado correctamente",
                            icon: "success",
                          });
                   }else{
                       Swal.fire({
                           title: "Estudiante",
                           text: "Error al intentar eliminar el Inscripcion",
                           icon: "error",
                       });
                   }
                },
                error: ()=> {
                    Swal.fire({
                        title: "Inscripcion",
                        text: "Error al intentar eliminar el Inscripcion", 
                        icon: "error",
                    });
                },
            });
        }
    });
};  

init();