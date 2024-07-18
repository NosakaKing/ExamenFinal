<?php
  include './layout/layout.php';
  include './components/SideBar.php';
  include './components/Header.php';
?>

<div class="dashboard flex flex-col gap-10">
  <!-- <h2>Estudiante</h2> -->
  <h2 class="text-accent text-2xl uppercase">Menú de Inscripciones</h2>
<!-- Form de Estudiante -->
<div class="flex flex-col gap-10">
    <!-- Button -->
    <div>
    <button class="bg-primary text-white px-10" id="btn-abrir-modal">Nueva Inscripcion</button>
    </div>
    <!-- Table -->
     <div class="flex flex-col xl:flex-row xl:items-center gap-10">
     <div>
    <h2 class="text-xl">Lista de Inscripciones</h2>
     </div>
    <table class="w-full xl:w-4/5">
        <thead>
            <tr class="bg-accent text-white">
                <th>#</th>
                <th>Estudiante</th>
                <th>Curso</th>
                <th>Fecha Inscripcion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="text-center" id="cuerpoInscripcion">
        </tbody>
    </table>
     </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Modal -->

<dialog class="rounded px-10 py-5 border shadow-custom2" id="modal">
  <form id="frm_inscripcion">
    <h3 class="text-center py-5 text-2xl">Registro o Modificación de Inscripcion</h3>
   <div class="flex flex-col gap-10"> 
   <input type="hidden" name="idInscripcion" id="idInscripcion">
    <div>
    <label for="curso">Curso:</label>
    <select name="curso" id="curso" class="border rounded">
    <option value="0">Seleccione un curso</option>
    </select>
   </div>
   <div>
    <label for="estudiante">Estudiante:</label>
    <select name="estudiante" id="estudiante" class="border rounded">
    <option value="0">Seleccione un estudiante</option>
    </select>
   </div>
   <div>
    <label for="fecha_inscripcion">Fecha de Inscripcion:</label>
    <input class="border rounded text-accent" type="date" name="fecha_inscripcion" id="fecha_inscripcion" required>
   </div>
   <div class="flex justify-center gap-10">
    <button class="bg-primary text-white px-10" type="submit">Guardar</button>
    <button class="bg-primary text-white px-10" id="btn-cerrar-modal">Cerrar</button>
   </div>
   </div>
  </form>
</dialog>

<?php require_once('./components/scripts.php') ?>
<script src="inscripcion.js"></script>