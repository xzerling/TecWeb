

INSERT INTO asignatura(nombre,estado) VALUES('Solucion Algoritmica', 1);
INSERT INTO asignatura(nombre,estado) VALUES('Pensamiento Algoritmico', 1);
INSERT INTO asignatura(nombre,estado) VALUES('Redes de Computadoras', 1);
INSERT INTO asignatura(nombre,estado) VALUES('Sistemas Operativos', 1);
INSERT INTO asignatura(nombre,estado) VALUES('Construccion de Software', 1);

INSERT INTO instanciaasignatura(seccion,semestre,anio,refAsignatura) VALUES('A',1,2020,1);
INSERT INTO instanciaasignatura(seccion,semestre,anio,refAsignatura) VALUES('A',1,2020,2);
INSERT INTO instanciaasignatura(seccion,semestre,anio,refAsignatura) VALUES('A',1,2020,3);
INSERT INTO instanciaasignatura(seccion,semestre,anio,refAsignatura) VALUES('A',1,2020,4);
INSERT INTO instanciaasignatura(seccion,semestre,anio,refAsignatura) VALUES('A',1,2020,5);

INSERT INTO evaluacion(fecha,diasAntes,diasDespues,refInstAsignatura) VALUES('2020-04-13',3,3,1);
INSERT INTO evaluacion(fecha,diasAntes,diasDespues,refInstAsignatura) VALUES('2020-04-13',4,4,2);
INSERT INTO evaluacion(fecha,diasAntes,diasDespues,refInstAsignatura) VALUES('2020-04-13',5,5,3);
INSERT INTO evaluacion(fecha,diasAntes,diasDespues,refInstAsignatura) VALUES('2020-04-13',6,6,4);
INSERT INTO evaluacion(fecha,diasAntes,diasDespues,refInstAsignatura) VALUES('2020-04-13',4,4,5);


INSERT INTO profesor(correo,nombre,clave) VALUES('rpavez@utalca.cl','Rodrigo Pavez','rpavez');
INSERT INTO profesor(correo,nombre,clave) VALUES('riperez@utalca.cl','Ricardo Perez','riperez');
INSERT INTO profesor(correo,nombre,clave) VALUES('rgarrido@utalca.cl','Ruth Garrido','rgarrido');
INSERT INTO profesor(correo,nombre,clave) VALUES('fvaras@utalca.cl','Felipe Varas','fvaras');
INSERT INTO profesor(correo,nombre,clave) VALUES('robustamante@utalca.cl','Rodrigo Bustamante','robustamante');

INSERT INTO alumno(matricula,nombre,correo) VALUES('2013407602','Nicolas Pradenas','npradenas13@utalca.cl');
INSERT INTO alumno(matricula,nombre,correo) VALUES('2014407015','Juan Cordero','jucordero14@utalca.cl');
INSERT INTO alumno(matricula,nombre,correo) VALUES('2014407016','Alvaro Elgueda','aelgueda14@utalca.cl');
INSERT INTO alumno(matricula,nombre,correo) VALUES('2014407017','Cristobal Henriquez','chenriquez14@utalca.cl');
INSERT INTO alumno(matricula,nombre,correo) VALUES('2013407023','Eugenio Peredo','eperedo13@utalca.cl');

INSERT INTO profesorobservacion(refProfesor,refAlumno,comentario) VALUES('rpavez@utalca.cl','2014407015', 'Falta de motivacion para realizar actividades');
INSERT INTO profesorobservacion(refProfesor,refAlumno,comentario) VALUES('riperez@utalca.cl','2014407015', 'Falta de motivacion para realizar actividades');
INSERT INTO profesorobservacion(refProfesor,refAlumno,comentario) VALUES('rgarrido@utalca.cl','2014407015', 'Falta de motivacion para realizar actividades');
INSERT INTO profesorobservacion(refProfesor,refAlumno,comentario) VALUES('fvaras@utalca.cl','2014407015', 'Falta de motivacion para realizar actividades');
INSERT INTO profesorobservacion(refProfesor,refAlumno,comentario) VALUES('robustamante@utalca.cl','2014407015', 'Falta de motivacion para realizar actividades');