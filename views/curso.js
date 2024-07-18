// Codigo para abrir modal
const btnAbrirModal = document.querySelector('#btn-abrir-modal');
const btnCerrarModal = document.querySelector('#btn-cerrar-modal');
const btnAbrirModalEspecialidad = document.querySelector('#btn-abrir-modal-especialidad');
const btnCerrarModalEspecialidad = document.querySelector('#btn-cerrar-modal-especialidad');
const btnAbrirModalParalelo = document.querySelector('#btn-abrir-modal-paralelo');
const btnCerrarModalParalelo = document.querySelector('#btn-cerrar-modal-paralelo');
const modal2 = document.querySelector('#modal');
const modalEspecialidad = document.querySelector('#modalEspecialidad');
const modalParalelo = document.querySelector('#modalParalelo');

btnAbrirModal.addEventListener('click', () => {
    limpiarCampos();
    modal2.showModal();
});

btnCerrarModal.addEventListener('click', () => {
    modal2.close();
});

btnAbrirModalEspecialidad.addEventListener('click', () => {
    limpiarCampos();
    modalEspecialidad.showModal();
});

btnCerrarModalEspecialidad.addEventListener('click', () => {
    modalEspecialidad.close();
});

btnAbrirModalParalelo.addEventListener('click', () => {
    limpiarCampos();
    modalParalelo.showModal();
});

btnCerrarModalParalelo.addEventListener('click', () => {
    modalParalelo.close();
});


//Backend de curso

//Inicializacionp
function init() {
    $("#frm_especialidad").on('submit', function(e) {
        guardarEspecialidad(e);
    });
    $("#frm_paralelo").on('submit', function(e) {
        guardarParalelo(e);
    });
    $("#frm_curso").on('submit', function(e) {
        limpiarCampos();
        guardarCurso(e);
    });
}

$(document).ready(() => {
    cargarTabla();
    cargarEspecialidad();
    cargarParalelo();

});



//Cargar Tabla
var cargarTabla = () => {
    var html = '';

    $.get("../controllers/curso.controller.php?op=todos",(listaCurso) => {
        console.log(listaCurso);
        $.each(listaCurso, (i, curso) => {
            html += `
                <tr>
                    <td>${i + 1}</td>
                    <td>${curso.curso_nombre}</td>
                    <td>${curso.curso_descripcion}</td>
                    <td>${curso.personal_identificacion}</td>
                    <td>${curso.especialidad_nombre}</td>
                    <td>${curso.paralelo_nombre}</td>
                    <td>${curso.fecha_inicio}</td>
                    <td>${curso.fecha_fin}</td>
                    <td>
                    <button class="px-5" onclick="eliminar(${curso.id_curso})"><span class="material-symbols-outlined"> delete </span></button>
                    </td>
                </tr>
            `;
        });
        $("#cuerpoCurso").html(html);    
    });
};

// Cargar Especialidad
var cargarEspecialidad = () => {
    $.get("../controllers/especialidad.controller.php?op=todos",(listaEspecialidad) => {
        console.log(listaEspecialidad);
        $.each(listaEspecialidad, (i, especialidad) => {
            $("#idEspecialidad").append(`<option value="${especialidad.id_especialidad}">${especialidad.nombre}</option>`);
        });
    });
};

// Cargar Paralelo
var cargarParalelo = () => {
    $.get("../controllers/paralelo.controller.php?op=todos",(listaParalelo) => {
        console.log(listaParalelo);
        $.each(listaParalelo, (i, paralelo) => {
            $("#idParalelo").append(`<option value="${paralelo.id_paralelo}">${paralelo.nombre}</option>`);
        });
    });
};

//Guardar y Editar

var guardarCurso = (e) => {
    e.preventDefault();
    var frm_curso = new FormData($("#frm_curso")[0]);

    $.ajax({
        url: "../controllers/curso.controller.php?op=insertar",
        type: "POST",
        data: frm_curso,
        contentType: false,
        processData: false,
        success: function (datos) {
            // Recargar Pagina
            location.reload();
            modal2.close();
        },
        error: function (xhr, status, error) {
            console.error("Error al guardar curso:", error);
        }
    });
};

//Guardar Especialidad
var guardarEspecialidad = (e) => {
    e.preventDefault();
    var frm_especialidad = new FormData($("#frm_especialidad")[0]);

    $.ajax({
        url: "../controllers/especialidad.controller.php?op=insertar",
        type: "POST",
        data: frm_especialidad,
        contentType: false,
        processData: false,
        success: function (datos) {
            // Recargar Pagina
            location.reload();
            modalEspecialidad.close();
        },
        error: function (xhr, status, error) {
            console.error("Error al guardar especialidad:", error);
        }
    });
};

//Guardar Paralelo
var guardarParalelo = (e) => {
    e.preventDefault();
    var frm_paralelo = new FormData($("#frm_paralelo")[0]);

    $.ajax({
        url: "../controllers/paralelo.controller.php?op=insertar",
        type: "POST",
        data: frm_paralelo,
        contentType: false,
        processData: false,
        success: function (datos) {
            // Recargar Pagina
            location.reload();
            modalParalelo.close();
        },
        error: function (xhr, status, error) {
            console.error("Error al guardar cargo:", error);
        }
    });
};



//Eliminar
var eliminar = (cursoId) => {
    Swal.fire({
        title: "Curso",
        text: "¿Estas seguro de eliminar el Curso?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Eliminar",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `../controllers/curso.controller.php?op=eliminar`,
                type: "POST",
                data: { id: cursoId },
                success: (resultado)=> {
                    var resultadoMessage = resultado;
                    console.log(resultadoMessage);
                   if(resultado === resultadoMessage) {
                          cargarTabla();
                       Swal.fire({
                            title: "Curso",
                            text: "Curso eliminado correctamente",
                            icon: "success",
                          });
                   }else{
                       Swal.fire({
                           title: "Curso",
                           text: "Error al intentar eliminar el Curso",
                           icon: "error",
                       });
                   }
                },
                error: ()=> {
                    Swal.fire({
                        title: "Curso",
                        text: "Error al intentar eliminar el Curso", 
                        icon: "error",
                    });
                },
            });
        }
    });
};

//Buscar profesor
document.querySelector('#btn-buscar').addEventListener('click', function() {
    var profesorId = document.querySelector('#profesorId').value;
    console.log(profesorId);

    if (profesorId) {
        $.ajax({
            url: `../controllers/personal.controller.php?op=profesores&id=${profesorId}`,
            type: 'GET',
            success: function (data) {
                console.log(data);
                if (data) {
                    document.querySelector('#profesorNombre').value = data.nombre + ' ' + data.primer_apellido;
                    document.querySelector('#idProfesor').value = data.id_personal;
                    document.getElementById('mensaje').textContent = 'Profesor encontrado';
                } else {
                    document.getElementById('mensaje').textContent = 'Profesor no encontrado';
                }
            },
            error: function () {
                document.getElementById('mensaje').textContent = 'Error al buscar profes';
            },
        });
    } else {
        document.getElementById('mensaje').textContent = 'Ingrese una identificación válida';
    }
});

init();

//Limpiar campos
function limpiarCampos() {
    $("#idCurso").val(''); 
    $("#nombreCurso").val('');
    $("#descripcionCurso").val(''); 
    $("#profesorId").val(''); 
    $("#idProfesor").val(''); 
    $("#profesorNombre").val('');
    $("#fechaInicio").val(''); 
    $("#fechaFin").val(''); 
    $("#idEspecialidad").val(0);
    $("#idParalelo").val(0);
}
