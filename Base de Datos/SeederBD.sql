
TRUNCATE TABLE CalificarEvaluacion;
TRUNCATE TABLE Evaluacion;
TRUNCATE TABLE Administrador;
TRUNCATE TABLE Profesor;
TRUNCATE TABLE Ayudante;

TRUNCATE TABLE Contenido;
TRUNCATE TABLE Asignatura;
TRUNCATE TABLE InstanciaAsignatura;



TRUNCATE TABLE Alumno;



INSERT INTO Administrador (correo, nombre, clave) 
	VALUES ('admin_007@hotmail.com', 'admin_007', '123123123')
;

INSERT INTO DirectorEscuela(correo, nombre, clave)
	VALUES('director@hotmail.com', 'Director Escuela', '123123123');


INSERT INTO Profesor (correo, nombre, clave)
	VALUES ('jmartinez@hotmail.com', 'Juan Martinez P.', '123123123'),
		   ('nbarriga@hotmail.com', 'Nicolas Barriga D.', '123123123'),
		   ('idreyer@hotmail.com', 'Ingo Dreyer N.', '123123123'),
		   ('jcaballero@hotmail.com', 'Julio Caballero O.', '123123123'),
		   ('jhumberto@hotmail.com', 'Jans Humberto', '123123123'),
		   ('marenas@hotmail.com', 'Mauricio Arenas S.', '123123123'),
		   ('jsolorza@hotmail.com', 'Jocelyn Constanza S.', '123123123'),
		   ('mbravo@hotmail.com', 'Maria Bravo D.', '123123123'),
		   ('rhenzi@hotmail.com', 'Rodolfo Henzi', '123123123'),
		   ('jreyes@hotmail.com', 'Jose Reyes', '123123123'),
		   ('gnunez@hotmail.com', 'Gabriel Nunez', '123123123'),
		   ('lbasoalto@hotmail.com', 'Lisette Basoalto', '123123123'),
		   ('wgonzalez@hotmail.com', 'Wendy Gonzalez', '123123123'),
		   ('kjara@hotmail.com', 'Karla Jara', '123123123'),
		   ('bvaldebenito@hotmail.com', 'Braulio Valdebenito', '123123123'),
		   ('cvillalobos@hotmail.com', 'Camila Villalobos', '123123123'),
		   ('egonzalez@hotmail.com', 'Elizabeth Gonzalez', '123123123'),
		   ('kschnettler@hotmail.com', 'Karina Schnettler', '123123123'),
		   ('dtoledo@hotmail.com', 'Diego Toledo', '123123123'),
		   ('esepulveda@hotmail.com', 'Edison Sepulveda', '123123123')
;


INSERT INTO Ayudante (correo, nombre, clave, matricular) 
	VALUES ('mparedes14@hotmail.com', 'Miguel Paredes S.', '123123123', '201040001'),
		   ('aperez14@hotmail.com', 'Andres Perez M', '123123123', '201040002'),
		   ('mgonzalez@hotmail.com', 'Maria Gonzalez', '123123123', '201040003'),
		   ('jmunoz@hotmail.com', 'Julieta Muñoz', '123123123', '201040004'),
		   ('projas@hotmail.com', 'Patricio Rojas', '123123123', '201040005'),
		   ('adiaz@hotmail.com', 'Andres Diaz', '123123123', '201040006'),
		   ('eperez@hotmail.com', 'Eugenio Perez', '123123123', '201040007'),
		   ('asoto@hotmail.com', 'Alejandra Soto', '123123123', '201040008'),
		   ('asilva@hotmail.com', 'Andrea Silva', '123123123', '201040009'),
		   ('econtreras@hotmail.com', 'Eugenia Contreras', '123123123', '201040010')
;

/*
INSERT INTO HorarioAtencion (id, dia, horaInicio, horaTermino, refProfesor)
	VALUES ('', '', '', '', '', '');
*/


INSERT INTO Asignatura (id, nombre, estado)
	VALUES ('1', 'Calculo I', '1'),
		   ('2', 'Calculo II', '1'),
		   ('3', 'Diseño De Base De Datos', '1'),
		   ('4', 'Ing. economica y ev. de Proyectos', '1'),
		   ('5', 'Fisica I', '1'),
		   ('6', 'Visualizacion de datos', '1'),
		   ('7', 'Ingles I', '1'),
		   ('8', 'Algoritmos y estructuras de datos', '1'),
		   ('9', 'Calculo III', '0')
;

INSERT INTO Contenido(id, refAsignatura, descripcion)
	VALUES ('1', '2', 'Derivadas, integrales simples, Integrales dobles...'),
		   ('2', '3', 'Modelo ER, diseño Relacional, Comandos sql'),
		   ('3', '4', 'Conceptos y teoria, flujos de caja, evaluacion de proyectos'),
		   ('4', '1', 'Funciones, derivadas.....'),
		   ('5', '8', 'Algoritmos de busqueda, arboles binarios, grafos'),
		   ('6', '7', 'Vocabulary, Speaking-lv1, Listening-lv1')
;

INSERT INTO InstanciaAsignatura(id, seccion, semestre, anio, refAsignatura)
	VALUES ('1', 'C', '1', '2010', '7'),
		   ('2', 'B', '1', '2010', '7'),
		   ('3', 'A', '1', '2010', '7'),

		   ('4', 'B', '2', '2011', '5'),
		   ('5', 'C', '2', '2011', '5'),
		   ('6', 'A', '2', '2011', '5'),

		   ('7', 'A', '2', '2013', '3'),

		   ('8', 'C', '1', '2020', '1'),
		   ('9', 'B', '1', '2020', '1'),
		   ('10', 'A', '1', '2020', '1'),
		   ('11', 'A', '1', '2020', '7'),
		   ('12', 'B', '1', '2020', '7'),
		   ('13', 'C', '1', '2020', '7')

;
/*
INSERT INTO Documentos(id, refAsignatura, semestre, anio, urlDocumento)
	VALUES ('', '', '', '', '');

INSERT INTO ProfesorAsignatura(refProfesor, refAsignatura, semestre, anio)
	VALUES ('', '', '', '');

INSERT INTO AyudanteAsignatura(refAyudante, refAsignatura, semestre, anio)
	VALUES ('', '', '', '');
*/

-- 40 alumnos en total
INSERT INTO Alumno(matricula, nombre, correo)
	VALUES ('201040001', 'Miguel Paredes S', 'mparedes14@hotmail.com'),
		   ('201040002', 'Andres Perez M', 'aperez14@hotmail.com'),
		   ('201040003', 'Maria Gonzalez', 'mgonzalez@hotmail.com'),
		   ('201040004', 'Julieta Muñoz', 'jmunoz@hotmail.com'),
		   ('201040005', 'Patricio Rojas', 'projas@hotmail.com'),
		   ('201040006', 'Andres Diaz', 'adiaz@hotmail.com'),
		   ('201040007', 'Eugenio Perez', 'eperez@hotmail.com'),
		   ('201040008', 'Alejandra Soto', 'asoto@hotmail.com'),
		   ('201040009', 'Andrea Silva', 'asilva@hotmail.com'),
		   ('201040010', 'Eugenia Contreras', 'econtreras@hotmail.com'),
		   ('201140001', 'Alejandra Lopez', 'alopez@hotmail.com'),
		   ('201140002', 'Mario Rodriguez', 'mrodriguez@hotmail.com'),
		   ('201140003', 'Maura Morales', 'mmorales@hotmail.com'),
		   ('201140004', 'Patricia Martinez', 'pmartinez@hotmail.com'),
		   ('201140005', 'Jocelin Fuentes', 'jfuentes@hotmail.com'),
		   ('201140006', 'Jocelyn Valenzuela', 'jvalenzuela@hotmail.com'),
		   ('201140007', 'Roberto Araya', 'raraya@hotmail.com'),
		   ('201140008', 'Carlos Sepulveda', 'csepulveda@hotmail.com'),
		   ('201140009', 'Karen Espinoza', 'kespinoza@hotmail.com'),
		   ('201140010', 'Carla Torres', 'ctorres@hotmail.com'),
		   ('201240001', 'Marcelo Castillo', 'mcastillo@hotmail.com'),
		   ('201240002', 'Ramiro Reyes', 'rreyes@hotmail.com'),
		   ('201240003', 'Javiera Ramirez', 'jramirez@hotmail.com'),
		   ('201240004', 'Marcela Flores', 'mflores@hotmail.com'),
		   ('201240005', 'Josefina Castro', 'jcastro@hotmail.com'),
		   ('201240006', 'Daniela Fernandez', 'dfernandez@hotmail.com'),
		   ('201240007', 'Daniel Alvarez', 'dalvarez@hotmail.com'),
		   ('201240008', 'Antonio Hernandez', 'ahernandez@hotmail.com'),
		   ('201240009', 'Juan Herrera', 'jherrera@hotmail.com'),
		   ('201240010', 'Nicolas Vargas', 'nvargas@hotmail.com'),
		   ('201340001', 'Nicol Gutierrez', 'ngutierrez@hotmail.com'),
		   ('201340002', 'Martina Gomez', 'mgomez@hotmail.com'),
		   ('201340003', 'Mauro Tapia', 'mtapia@hotmail.com'),
		   ('201340004', 'Matias Vergara', 'mvergara@hotmail.com'),
		   ('201340005', 'Florencia Carrasco', 'fcarrasco@hotmail.com'),
		   ('201340006', 'Katherine Bravo', 'kbravo@hotmail.com'),
		   ('201340007', 'Pablo Sanchez', 'psanchez@hotmail.com'),
		   ('201340008', 'Gustavo Garcia', 'ggarcia@hotmail.com'),
		   ('201340009', 'Sebastian Vasquez', 'svasquez@hotmail.com'),
		   ('201340010', 'Guillermo Figueroa', 'gfigueroa@hotmail.com')
;

/*
INSERT INTO ProfesorObservacion(id, refProfesor, refAlumno, comentario)
	VALUES ('', '', '', '');

INSERT INTO AyudanteObservacion(id, refProfesor, refAlumno, comentario)
	VALUES ('', '', '', '');
*/
INSERT INTO Evaluacion (id, fecha, diasAntes, diasDespues, refInstAsignatura) 
	VALUES ('1', '2010-03-13', '7', '5', '1'),
		   ('2', '2010-03-13', '7', '5', '2'),
		   ('3', '2010-03-13', '7', '5', '3'),


		   ('4', '2011-03-13', '7', '5', '4'),
		   ('5', '2011-03-13', '7', '5', '5'),
		   ('6', '2011-03-13', '7', '5', '6'),

		   ('7', '2020-04-10', '7', '5', '11'),
		   ('8', '2020-04-10', '7', '5', '12'),
		   ('9', '2020-04-10', '7', '5', '13')
;

/*
INSERT INTO Reunion(id, fecha, diasAntes, comentario)
	VALUES ('', '', '', '');
*/

INSERT INTO CalificarEvaluacion(id, refEvaluacion, refAlumno, nota)
	VALUES ('1', '1', '201040001', '2.4'),
		   ('2', '2', '201040002', '6.6'),
		   ('3', '3', '201040003', '4.0'),

		   ('4', '4', '201140003', '4.0'),
		   ('5', '5', '201140004', '5.1'),
		   ('6', '6', '201140005', '4.8')
;

/*
INSERT INTO RealizarReunion(id, refInstAsignatura, refReunion, refAlumno)
	VALUES ('', '', '', '');

*/

INSERT INTO profesorasignatura(refProfesor, refInstAsignatura)
		VALUES('jreyes@hotmail.com', '1'),
		('kjara@hotmail.com','2'),
		('lbasoalto@hotmail.com','3'),
		('marenas@hotmail.com', '4'),
		('mbravo@hotmail.com', '5'),
		('rhenzi@hotmail.com' , '6'),
		('rhenzi@hotmail.com', '11'),
		('rhenzi@hotmail.com', '12'),
		('rhenzi@hotmail.com', '13');


INSERT INTO alumnoasignatura(refAlumno, refInstAsignatura)
	VALUES('201040001', '8'),
		  ('201340010', '9'),
		  ('201340009', '10'),
		  ('201340008', '8'),
		  ('201340007', '9'),
		  ('201040002', '10'),
		  ('201040003', '11'),
		  ('201040004', '12'),
		  ('201040005', '13'),
	 	  ('201140001', '8');