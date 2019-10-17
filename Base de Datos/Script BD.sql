
/**
Script para crear Base de Datos
**/ 

CREATE TABLE Administrador(
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
	nombre varchar(32) NOT NULL
);

CREATE TABLE Contenido(
	refAsignatura int NOT NULL REFERENCES Asignatura(id),
	descripcion text NOT NULL
);

CREATE TABLE InstanciaAsignatura(
	semestre int NOT NULL,
	anio int NOT NULL,
	refAsignatura int NOT NULL REFERENCES Asignatura(id)
);

CREATE TABLE Documentos(
	refAsignatura int NOT NULL REFERENCES Asignatura(id),
	semestre int NOT NULL,
	anio int NOT NULL,
	urlDocumento text NOT NULL
);

CREATE TABLE ProfesorAsignatura(
	refProfesor varchar(32) NOT NULL REFERENCES Profesor(correo),
	refAsignatura int NOT NULL REFERENCES Asignatura(id),
	semestre int NOT NULL,
	anio int NOT NULL
);

CREATE TABLE AyudanteAsignatura(
	refAyudante varchar(32) NOT NULL REFERENCES Ayudante(correo),
	refAsignatura int NOT NULL REFERENCES Asignatura(id),
	semestre int NOT NULL,
	anio int NOT NULL
);

CREATE TABLE Alumno(
	matricula varchar(16) NOT NULL PRIMARY KEY,
	nombre varchar(32) NOT NULL,
	correo varchar(32) NOT NULL
);

CREATE TABLE Evaluacion(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	fecha DATE NOT NULL,
	diasAntes int NOT NULL,
	diasDespues int NOT NULL
);

CREATE TABLE Reunion(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	fecha DATE NOT NULL,
	diasAntes int NOT NULL
);


CREATE TABLE CalificarEvaluacion(
	refAsignatura int NOT NULL REFERENCES Asignatura(id),
	semestre int NOT NULL,
	anio int NOT NULL,
	refEvaluacion int NOT NULL REFERENCES Evaluacion(id),
	refAlumno varchar(16) NOT NULL REFERENCES Alumno(matricula),
	nota decimal NOT NULL
);

CREATE TABLE RealizarReunion(
	refAsignatura int NOT NULL REFERENCES Asignatura(id),
	semestre int NOT NULL,
	anio int NOT NULL,
	refEvaluacion int NOT NULL REFERENCES Evaluacion(id),
	refAlumno varchar(16) NOT NULL REFERENCES Alumno(matricula)
);


