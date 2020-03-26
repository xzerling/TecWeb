

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