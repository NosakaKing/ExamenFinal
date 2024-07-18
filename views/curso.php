<?php
include './layout/layout.php';
  include './components/SideBar.php';
  include './components/Header.php';
  

?>
<div class="dashboard flex flex-col gap-10">
  <h2 class="text-accent text-2xl uppercase">Menú de Cursos</h2>
<!-- Form de Curso -->
<div class="flex flex-col gap-10">
    <!-- Button -->
    <div class="flex gap-10">
    <div>
    <button class="bg-primary text-white px-10" id="btn-abrir-modal">Nuevo Curso</button>
    </div>
    <div>
    <button class="bg-primary text-white px-10" id="btn-abrir-modal-especialidad">Nueva Especialidad</button>
    </div>
    <div>
    <button class="bg-primary text-white px-10" id="btn-abrir-modal-paralelo">Nuevo Paralelo</button>
    </div>
    </div>
    <!-- Table -->
     <div class="flex flex-col xl:flex-row xl:items-center gap-10">
     <div>
    <h2 class="text-xl">Lista de Cursos</h2>
     </div>
    <table class="w-full xl:w-4/5">
        <thead>
            <tr class="bg-accent text-white py-5">
                <th>#</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Profesor</th>
                <th>Especialidad</th>
                <th>Paralelo</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="text-center" id="cuerpoCurso">
        </tbody>
    </table>
     </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Modal -->

<dialog class="rounded px-10 py-5 border shadow-custom2 -z-10" id="modal">
  <form id="frm_curso" enctype="multipart/form-data">
    <h3 class="text-center py-5 text-2xl">Registro o Modificación de Curso</h3>
   <div class="flex flex-col gap-10"> 
   <input type="hidden" name="idCurso" id="idCurso">
   <span id="mensaje" class="text-center font-semibold text-primary"></span>
    <div>
    <label for="nombreCurso">Nombre del Curso</label>
    <input class="border rounded text-accent" type="text" name="nombreCurso" id="nombreCurso" required>
   </div>
   <div>
    <label for="descripcionCurso">Descripcion del Curso</label>
    <input class="border rounded text-accent" type="text" name="descripcionCurso" id="descripcionCurso" required>
   </div>
   <div>
    <label for="idEspecialidad">Especialidad:</label>
    <select name="idEspecialidad" id="idEspecialidad" class="border rounded">
    <option value="0">Seleccione una especialidad</option>
    </select>
   </div>
   <div>
   <input type="hidden" name="idProfesor" id="idProfesor">
    <label for="profesorId">Profesor:</label>
    <input class="border rounded text-accent" type="text" name="profesorId" id="profesorId" required>
    <button type="button" class="" id="btn-buscar">Buscar</button>
   </div>
   <div>
    <label for="profesorNombre">Profesor Nombre:</label>
    <input class="border rounded text-accent" type="text" name="profesorNombre" id="profesorNombre" required readonly>
   </div>
   <div>
    <label for="idParalelo">Paralelo:</label>
    <select name="idParalelo" id="idParalelo" class="border rounded">
    <option value="0">Seleccione un paralelo</option>
    </select>
   </div>
   <div>
    <label for="fechaInicio">Fecha de Inicio:</label>
    <input class="border rounded text-accent" type="date" name="fechaInicio" id="fechaInicio" required>
   </div>
   <div>
    <label for="fechaFin">Fecha de Fin:</label>
    <input class="border rounded text-accent" type="date" name="fechaFin" id="fechaFin" required>
   </div>
   <div class="modal-footer flex items-center justify-center">
   <button type="submit" class="btn btn-secondary px-10">Guardar</button>
    <button type="button" class="btn btn-secondary" id="btn-cerrar-modal">Cancelar</button>
  </div>
   </div>
  </form>
</dialog>

<!-- Modal Especialidad -->

<dialog class="rounded px-10 py-5 border shadow-custom2" id="modalEspecialidad">
  <form id="frm_especialidad">
    <h3 class="text-center py-5 text-2xl">Agregar nueva Especialidad</h3>
   <div class="flex flex-col gap-10"> 
   <input type="hidden" name="idEspe" id="idEspe">
    <div>
    <label for="nombreEspecialidad">Nombre de la Especialidad</label>
    <input class="border rounded text-accent" type="text" name="nombreEspecialidad" id="nombreEspecialidad" required>
   </div>
   <div>
    <label for="descripcionEspecialidad">Descripcion de la Especialidad</label>
    <input class="border rounded text-accent" type="text" name="descripcionEspecialidad" id="descripcionEspecialidad" required>
   </div>
   <div class="modal-footer flex items-center justify-center">
   <button type="submit" class="btn btn-secondary px-10">Guardar</button>
    <button type="button" class="btn btn-secondary" id="btn-cerrar-modal-especialidad">Cancelar</button>
  </div>
   </div>
  </form>
</dialog>

<!-- Modal Paralelo -->

<dialog class="rounded px-10 py-5 border shadow-custom2" id="modalParalelo">
  <form id="frm_paralelo">
    <h3 class="text-center py-5 text-2xl">Agregar nuevo Paralelo</h3>
   <div class="flex flex-col gap-10"> 
   <input type="hidden" name="idParal" id="idPidParal">
    <div>
    <label for="nombreParalelo">Nombre del Paralelo</label>
    <input class="border rounded text-accent" type="text" name="nombreParalelo" id="nombreParalelo" required>
   </div>
   <div class="modal-footer flex items-center justify-center">
   <button type="submit" class="btn btn-secondary px-10">Guardar</button>
    <button type="button" class="btn btn-secondary" id="btn-cerrar-modal-paralelo">Cancelar</button>
  </div>
   </div>
  </form>
</dialog>


<?php require_once('./components/scripts.php') ?>
<script src="curso.js"></script>