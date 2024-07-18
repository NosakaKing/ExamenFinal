/*==============================================================*/
/* Database: sistema_cursos                                     */
/*==============================================================*/

/*==============================================================*/
/* Table: Curso                                                 */
/*==============================================================*/
CREATE TABLE curso
(
   id_curso INT AUTO_INCREMENT NOT NULL,
   id_personal INT NOT NULL,
   id_especialidad INT NOT NULL COMMENT '',
   id_paralelo INT NOT NULL COMMENT '',
   nombre VARCHAR(100) NOT NULL COMMENT '',
   descripcion VARCHAR(200) NOT NULL COMMENT '',
   fecha_inicio DATE NOT NULL COMMENT '',
   fecha_fin DATE NOT NULL COMMENT '',
   PRIMARY KEY (id_curso)
);

/*==============================================================*/
/* Table: paralelo                                             */
/*==============================================================*/
CREATE TABLE paralelo
(
    id_paralelo INT AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(50) NOT NULL COMMENT '',
    PRIMARY KEY (id_paralelo)
);

/*==============================================================*/
/* Table: especialidad                                             */
/*==============================================================*/
CREATE TABLE especialidad
(
    id_especialidad INT AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(100) NOT NULL COMMENT '',
    descripcion VARCHAR(200) COMMENT '',
    PRIMARY KEY (id_especialidad)
);


/*==============================================================*/
/* Table: Estudiante                                             */
/*==============================================================*/
CREATE TABLE estudiante
(
   c INT AUTO_INCREMENT NOT NULL, 
   identificacion VARCHAR(13) NOT NULL COMMENT '',
   tipo_identificacion VARCHAR(15) COMMENT '',
   nombre VARCHAR(30) NOT NULL COMMENT '',
   primer_apellido VARCHAR(20) NOT NULL COMMENT '',
   segundo_apellido VARCHAR(20) COMMENT '',
   fecha_nacimiento DATE NOT NULL COMMENT '',
   telefono VARCHAR(15) NULL COMMENT '',
   direccion VARCHAR(100) NOT NULL COMMENT '',
   correo VARCHAR(60) NOT NULL COMMENT '',
   PRIMARY KEY (id_estudiante)
);

/*==============================================================*/
/* Table: Inscripciones                                         */
/*==============================================================*/
CREATE TABLE inscripcion
(
   id_inscripcion INT AUTO_INCREMENT NOT NULL,  
   id_curso INT NOT NULL,
   id_estudiante INT NOT NULL,
   fecha_inscripcion DATE NULL COMMENT '',
   PRIMARY KEY (id_inscripcion)
);

/*==============================================================*/
/* Table: Personal                                              */
/*==============================================================*/
CREATE TABLE personal
(
   id_personal INT AUTO_INCREMENT NOT NULL,
   identificacion VARCHAR(13) NOT NULL COMMENT '',
   id_cargo INT NOT NULL,
   tipo_identificacion VARCHAR(15) COMMENT '',
   nombre VARCHAR(30) NOT NULL COMMENT '',
   primer_apellido VARCHAR(20) NOT NULL COMMENT '',
   segundo_apellido VARCHAR(20) COMMENT '',
   fecha_nacimiento DATE NOT NULL COMMENT '',
   telefono VARCHAR(15) NULL COMMENT '',
   direccion VARCHAR(100) NOT NULL COMMENT '',
   correo VARCHAR(60) NOT NULL COMMENT '',
   clave VARCHAR(100) NOT NULL COMMENT '',
   PRIMARY KEY (id_personal)
);

/*==============================================================*/
/* Table: Cargo                                                 */
/*==============================================================*/
CREATE TABLE cargo
(
   id_cargo INT AUTO_INCREMENT NOT NULL,  
   cargo VARCHAR(30) NOT NULL COMMENT '',
   PRIMARY KEY (id_cargo)
);

/*==============================================================*/
/* Relaciones                                                   */
/*==============================================================*/
ALTER TABLE inscripcion 
ADD CONSTRAINT fk_inscripcion_curso FOREIGN KEY (id_curso) REFERENCES curso (id_curso);

ALTER TABLE inscripcion 
ADD CONSTRAINT fk_inscripcion_estudiante FOREIGN KEY (id_estudiante) REFERENCES estudiante (id_estudiante);

ALTER TABLE personal 
ADD CONSTRAINT fk_personal_cargo FOREIGN KEY (id_cargo) REFERENCES cargo (id_cargo);

ALTER TABLE curso 
ADD CONSTRAINT fk_curso_personal FOREIGN KEY (id_personal) REFERENCES personal (id_personal);

ALTER TABLE curso
ADD CONSTRAINT fk_curso_especialidad FOREIGN KEY (id_especialidad) REFERENCES especialidad (id_especialidad);

ALTER TABLE curso
ADD CONSTRAINT fk_curso_paralelo FOREIGN KEY (id_paralelo) REFERENCES paralelo (id_paralelo);

