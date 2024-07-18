<?php
include './layout/layout.php';
include './components/SideBar.php';
include './components/Header.php';
  

?>
<div class="dashboard flex flex-col gap-10">
  <!-- <h2>Estudiante</h2> -->
  <h2 class="text-accent text-2xl uppercase">Menú de Estudiantes</h2>
<!-- Form de Estudiante -->
<div class="flex flex-col gap-10">
    <!-- Button -->
    <div>
    <button class="bg-primary text-white px-10" id="btn-abrir-modal">Nuevo Estudiante</button>
    </div>
    <!-- Table -->
     <div class="flex flex-col xl:flex-row xl:items-center gap-10">
     <div>
    <h2 class="text-xl">Lista de Estudiantes</h2>
     </div>
    <table class="w-full xl:w-4/5">
        <thead>
            <tr class="bg-accent text-white">
                <th>#</th>
                <th>Identificación</th>
                <th>Tipo de Identificación</th>
                <th>Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>Fecha de Nacimiento</th>
                <th>Telefono</th>
                <th>Dirección</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="text-center" id="cuerpoEstudiante">
        </tbody>
    </table>
     </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Modal -->

<dialog class="rounded px-10 py-5 border shadow-custom2" id="modal">
  <form id="frm_estudiante">
    <h3 class="text-center py-5 text-2xl">Registro o Modificación de Estudiante</h3>
   <div class="flex flex-col gap-10"> 
   <input type="hidden" name="idEstudiante" id="idEstudiante">
    <div>
    <label for="identificacion">Identificación:</label>
    <input class="border rounded text-accent" type="text" name="identificacion" id="identificacion" required>
   </div>
   <div>
    <label for="tipoIdentificacion">Tipo de Identificación:</label>
    <select name="tipo_identificacion" id="tipo_identificacion" class="border rounded">
    <option value="Cedula">Cédula</option>
    <option value="Pasaporte">Pasaporte</option>
    </select>
   </div>
   <div>
    <label for="nombre">Nombre del Estudiante:</label>
    <input class="border rounded text-accent" type="text" name="nombre" id="nombre" required>
   </div>
   <div>
    <label for="primer_apellido">Primer Apellido:</label>
    <input class="border rounded text-accent" type="text" name="primer_apellido" id="primer_apellido" required>
   </div>
   <div>
    <label for="segundo_apellido">Segundo Apellido:</label>
    <input class="border rounded text-accent" type="text" name="segundo_apellido" id="segundo_apellido" required>
   </div>
   <div>
    <label for="apellido">Direccion:</label>
    <input class="border rounded text-accent" type="text" name="direccion" id="direccion" required>
   </div>
   <div>
    <label for="apellido">Fecha de Nacimiento:</label>
    <input class="border rounded text-accent" type="date" name="fecha_nacimiento" id="fecha_nacimiento" required>
   </div>
   <div class="flex flex-col">
    <label for="correo">Correo del Cliente:</label>
    <input class="border rounded text-accent" type="email" name="correo" id="correo" required>
   </div>
   <div>
    <label for="apellido">Telefono</label>
    <input class="border rounded text-accent" type="text" name="telefono" id="telefono" required>
   </div>
   <div class="modal-footer flex items-center justify-center">
   <button type="submit" class="btn btn-secondary px-10">Guardar</button>
    <button type="button" class="btn btn-secondary" id="btn-cerrar-modal">Cancelar</button>
  </div>
   </div>
  </form>
</dialog>

<?php require_once('./components/scripts.php') ?>
<script src="estudiante.js"></script>