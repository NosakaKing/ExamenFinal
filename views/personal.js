// Código para abrir modal de nuevo personal y editar personal
const btnAbrirModal = document.querySelector('#btn-abrir-modal');
const btnCerrarModal = document.querySelector('#btn-cerrar-modal');
const btnAbrirModalCargo = document.querySelector('#btn-abrir-modal-cargo');
const btnCerrarModalCargo = document.querySelector('#btn-cerrar-modal-cargo');
const modal2 = document.querySelector('#modal');
const modalCargo = document.querySelector('#modal-cargo');

btnAbrirModal.addEventListener('click', () => {
    limpiarCampos();
    modal2.showModal();
});

btnCerrarModal.addEventListener('click', () => {
    modal2.close();
});

btnAbrirModalCargo.addEventListener('click', () => {
    limpiarCampos();
    modalCargo.showModal();
});

btnCerrarModalCargo.addEventListener('click', () => {
    modalCargo.close();
});

// Fin de código para abrir modal de nuevo personal y editar personal

// Backend de personal

// Inicialización
function init() {
    $("#frm_personal").on('submit', function(e) {
        guardaryeditar(e);
    });

    $("#frm_cargo").on('submit', function(e) {
        guardarCargo(e);
    });
}

// Cargar tabla y cargos
$(document).ready(() => {
    cargarTabla();
    cargarCargos();
});

// Cargar Tabla
var cargarTabla = () => {
    var html = '';

    $.get("../controllers/personal.controller.php?op=todos", (listaPersonal) => {
        console.log(listaPersonal);
        $.each(listaPersonal, (i, personal) => {
            html += `
                <tr>
                    <td>${i + 1}</td>
                    <td>${personal.identificacion}</td>
                    <td>${personal.cargo}</td>
                    <td>${personal.tipo_identificacion}</td>
                    <td>${personal.nombre}</td>
                    <td>${personal.primer_apellido}</td>
                    <td>${personal.segundo_apellido}</td>
                    <td>${personal.fecha_nacimiento}</td>
                    <td>${personal.telefono}</td>
                    <td>${personal.direccion}</td>
                    <td>${personal.correo}</td>
                    <td>
                    <button class="px-5" onclick="editar(${personal.id_personal})"><span class="material-symbols-outlined"> edit </span></button>
                    <button class="px-5" onclick="eliminar(${personal.id_personal})"><span class="material-symbols-outlined"> delete </span></button>
                    </td>
                </tr>
            `;
        });
        $("#cuerpoPersonal").html(html);    
    });
};

// Cargar Cargo
var cargarCargos = () => {
    $.get("../controllers/cargo.controller.php?op=todos", (listaCargo) => {
        console.log(listaCargo);
        $.each(listaCargo, (i, cargo) => {
            $("#cargo").append(`<option value="${cargo.id_cargo}">${cargo.cargo}</option>`);
        });
    });
};

// Guardar y Editar

var guardaryeditar = (e) => {
    e.preventDefault(); 
   
    var frm_personal = new FormData($("#frm_personal")[0]);

    var personalId = $("#idPersonal").val(); 

    var ruta = "";
    if (personalId == 0) {
        // Insertar
        ruta = '../controllers/personal.controller.php?op=insertar';
       
    } else {
        // Editar
        ruta = "../controllers/personal.controller.php?op=actualizar";
    }

    $.ajax({
        url: ruta,
        type: "POST",
        data: frm_personal,
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

// Guardar Cargo
var guardarCargo = (e) => {
    e.preventDefault();
    var frm_cargo = new FormData($("#frm_cargo")[0]);

    $.ajax({
        url: "../controllers/cargo.controller.php?op=insertar",
        type: "POST",
        data: frm_cargo,
        contentType: false,
        processData: false,
        success: function (datos) {
            // Recargar Pagina
            location.reload();
            modalCargo.close();
        },
        error: function (xhr, status, error) {
            console.error("Error al guardar cargo:", error);
        }
    });
};

// Editar
var editar = (personalId) => { 
    $.ajax({
        url: `../controllers/personal.controller.php?op=uno&id=${personalId}`,
        type: "GET",
        success: function (data) {
            $("#idPersonal").val(data.id_personal); 
            $("#identificacion").val(data.identificacion);
            $("#cargo").val(data.id_cargo);
            $("#tipo_identificacion").val(data.tipo_identificacion);
            $("#nombre").val(data.nombre); 
            $("#primer_apellido").val(data.primer_apellido);
            $("#segundo_apellido").val(data.segundo_apellido);
            $("#fecha_nacimiento").val(data.fecha_nacimiento);
            $("#telefono").val(data.telefono);
            $("#direccion").val(data.direccion);
            $("#correo").val(data.correo);
            $("#clave").val(data.clave);
            modal2.showModal();
        },
        error: function () {
            Swal.fire({
                title: "Personal",
                text: "Error al intentar obtener los datos del cliente", 
                icon: "error",
            });
        },
    });
};

// Eliminar
var eliminar = (personalId) => {
    Swal.fire({
        title: "Personal",
        text: "¿Estás seguro de eliminar el personal?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Eliminar",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `../controllers/personal.controller.php?op=eliminar`,
                type: "POST",
                data: { id: personalId },
                success: (resultado) => {
                    if (resultado === 'ok') {
                        cargarTabla();
                        Swal.fire({
                            title: "Personal",
                            text: "Personal eliminado correctamente",
                            icon: "success",
                        });
                    } else {
                        Swal.fire({
                            title: "Personal",
                            text: "Error al intentar eliminar el personal",
                            icon: "error",
                        });
                    }
                },
                error: () => {
                    Swal.fire({
                        title: "Personal",
                        text: "Error al intentar eliminar el personal", 
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
    $("#idPersonal").val(''); 
    $("#identificacion").val('');
    $("#cargo").val(0); 
    $("#tipo_identificacion").val(''); 
    $("#nombre").val(''); 
    $("#primer_apellido").val(''); 
    $("#segundo_apellido").val('');
    $("#fecha_nacimiento").val(''); 
    $("#direccion").val(''); 
    $("#correo").val(''); 
    $("#clave").val('');
    $("#telefono").val('');
}
