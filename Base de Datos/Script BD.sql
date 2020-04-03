CREATE TABLE Administrador(
	correo varchar(32) NOT NULL PRIMARY KEY,
	nombre varchar(32) NOT NULL,
	clave varchar(32) NOT NULL
);

CREATE TABLE DirectorEscuela(
	correo varchar(32) NOT NULL PRIMARY KEY,
	nombre varchar(32) NOT NULL,
	clave varchar(32) NOT NULL
);

CREATE TABLE Profesor(
	correo varchar(32) NOT NULL PRIMARY KEY,
	nombre varchar(32) NOT NULL,
	clave varchar(32) NOT NULL
);

CREATE TABLE Ayudante(
	correo varchar(32) NOT NULL PRIMARY KEY,
	nombre varchar(32) NOT NULL,
	clave varchar(32) NOT NULL,
	matricular varchar(16) NOT NULL
);

CREATE TABLE HorarioAtencion(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	dia int NOT NULL,
	horaInicio varchar(8) NOT NULL,
	horaTermino varchar(8) NOT NULL,
	refProfesor varchar(32) NOT NULL REFERENCES Profesor(correo)
);

CREATE TABLE Asignatura(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nombre varchar(32) NOT NULL,
	estado int NOT NULL
);

CREATE TABLE Contenido(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	refAsignatura int NOT NULL REFERENCES Asignatura(id),
	descripcion text NOT NULL
);

CREATE TABLE InstanciaAsignatura(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	seccion text NOT NULL,
	semestre int NOT NULL,
	anio int NOT NULL,
	refAsignatura int NOT NULL REFERENCES Asignatura(id)
);

CREATE TABLE Documentos(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	refAsignatura int NOT NULL REFERENCES Asignatura(id), 
	semestre int NOT NULL,
	anio int NOT NULL,
	urlDocumento text NOT NULL
);

CREATE TABLE ProfesorAsignatura(
	refProfesor varchar(32) NOT NULL REFERENCES Profesor(correo),
	refInstAsignatura int NOT NULL REFERENCES InstanciaAsignatura(id)
);

CREATE TABLE AyudanteAsignatura(
	refAyudante varchar(32) NOT NULL REFERENCES Ayudante(correo),
	refInstAsignatura int NOT NULL REFERENCES InstanciaAsignatura(id)
);

CREATE TABLE Alumno(
	matricula varchar(16) NOT NULL PRIMARY KEY,
	nombre varchar(32) NOT NULL,
	correo varchar(32) NOT NULL
);

CREATE TABLE ProfesorObservacion(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	refProfesor varchar(32) NOT NULL REFERENCES Profesor(correo),
	refAlumno varchar(16) NOT NULL REFERENCES Alumno(matricula),
	comentario text NOT NULL
);

CREATE TABLE AyudanteObservacion(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	refProfesor varchar(32) NOT NULL REFERENCES Ayudante(correo),
	refAlumno varchar(16) NOT NULL REFERENCES Alumno(matricula),
	comentario text NOT NULL
);

CREATE TABLE Evaluacion(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	fecha DATE NOT NULL,
	diasAntes int NOT NULL,
	diasDespues int NOT NULL,
	refInstAsignatura int NOT NULL REFERENCES InstanciaAsignatura(id)
);

CREATE TABLE Reunion(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	fecha DATE NOT NULL,
	diasAntes int NOT NULL,
	comentario text NOT NULL
);

CREATE TABLE CalificarEvaluacion(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	refEvaluacion int NOT NULL REFERENCES Evaluacion(id),
	refAlumno varchar(16) NOT NULL REFERENCES Alumno(matricula),
	nota double(2,1) NOT NULL
);

CREATE TABLE RealizarReunion(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	refInstAsignatura int NOT NULL REFERENCES InstanciaAsignatura(id),
	refReunion int NOT NULL REFERENCES Reunion(id),
	refAlumno varchar(16) NOT NULL REFERENCES Alumno(matricula)
);

CREATE TABLE AlumnoAsignatura(
	refAlumno varchar(16) NOT NULL REFERENCES Alumno(matricula),
	refInstAsignatura int NOT NULL REFERENCES InstanciaAsignatura(id)
);