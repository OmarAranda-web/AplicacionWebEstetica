create table locales
(
    id_local        int auto_increment
        primary key,
    nombre_local    varchar(255) not null,
    direccion_local varchar(255) not null,
    estatus         bit          not null
)
    charset = latin1;

create table servicio
(
    id_servicio     tinyint auto_increment
        primary key,
    nombre_servicio varchar(255) not null,
    precio          float        not null,
    estatus         bit          null,
    tiempo          varchar(255) null
)
    charset = latin1;

create table usuario
(
    id_usuarios bigint auto_increment
        primary key,
    nombre      varchar(255) not null,
    apellido1   varchar(255) not null,
    telefono    varchar(14)  not null,
    email       varchar(255) null,
    contrasenia varchar(255) not null,
    token       varchar(50)  not null,
    permiso     bit          not null,
    confirmado  tinyint      null
)
    charset = latin1;

create table cita
(
    id_cita    bigint auto_increment
        primary key,
    alias      varchar(255) null,
    fecha      date         not null,
    hora       time         not null,
    status     varchar(3)   not null,
    idUsuarios bigint       not null,
    idlocal    int          not null,
    total_cita float        not null,
    constraint idUsuarios
        foreign key (idUsuarios) references usuario (id_usuarios),
    constraint idlocal
        foreign key (idlocal) references locales (id_local)
)
    charset = latin1;

create table detalle_cita
(
    id_dtalle_cita    bigint auto_increment
        primary key,
    id_cita_dcita     bigint  not null,
    id_servicio_dcita tinyint not null,
    cantidad_cita     tinyint not null,
    constraint id_cita_dcita
        foreign key (id_cita_dcita) references cita (id_cita)
            on update cascade,
    constraint id_servicio_dcita
        foreign key (id_servicio_dcita) references servicio (id_servicio)
            on update cascade
)
    charset = latin1;

create
    definer = root@localhost procedure cambiar_password(IN p_token varchar(255), IN p_password varchar(255))
begin
if EXISTS( select token from usuario where  token=p_token )
then
    update usuario set contrasenia=(p_password),token=('0') where token=p_token ;
else
     select 'no existe' as msj;
end if;


end;

create
    definer = root@localhost procedure editar_cita(IN p_idCita int, IN p_alias varchar(255), IN p_fecha varchar(255),
                                                   IN p_hora varchar(255), IN p_local varchar(255))
BEGIN
  UPDATE cita set alias=(p_alias),fecha=(p_fecha),hora=(p_hora),idlocal=(p_local),total_cita='0'
	where id_cita=p_idCita;
	
	delete from detalle_cita WHERE id_cita_dcita=p_idCita;
END;

create
    definer = root@localhost procedure proc_autenticar_user(IN p_token varchar(255))
begin
if EXISTS( select token from usuario where  token=p_token )
then
    update usuario set confirmado=('1'),token=('0') where token=p_token ;
else
     select 'no existe' as msj;
end if;


end;

create
    definer = root@localhost procedure proc_cancelar_cita(IN p_cita int)
BEGIN
UPDATE cita set cita.`status`='0' where cita.id_cita=p_cita;
select 'se cancelo la cita' as Mensaje_BD;
END;

create
    definer = root@localhost procedure proc_consu_etidar_servicio(IN p_idServicio tinyint)
begin
	select servicio.id_servicio,servicio.nombre_servicio, servicio.precio, servicio.tiempo, servicio.estatus from servicio WHERE servicio.id_servicio=p_idServicio;
end;

create
    definer = root@localhost procedure proc_consul_citasTotales()
begin
	SELECT cita.alias, cita.fecha, cita.hora, cita.total_cita, usuario.nombre, locales.nombre_local from cita inner join usuario on
cita.idUsuarios = usuario.id_usuarios INNER JOIN locales on locales.id_local=cita.idlocal;
END;

create
    definer = root@localhost procedure proc_consul_edita_local(IN p_idLocal tinyint)
begin
	Select locales.id_local,locales.nombre_local, locales.direccion_local, locales.estatus from locales where locales.id_local=p_idLocal;
end;

create
    definer = root@localhost procedure proc_consul_locales()
begin
Select * from locales where estatus='1';
end;

create
    definer = root@localhost procedure proc_consul_servicios()
begin
select id_servicio,nombre_servicio, precio, tiempo from servicio where estatus='1';
end;

create
    definer = root@localhost procedure proc_editar_local(IN p_idLocal tinyint, IN p_nomLocal varchar(255),
                                                         IN p_direccionLocla varchar(255))
begin
	UPDATE locales set locales.nombre_local=p_nomLocal, locales.direccion_local=p_direccionLocla
	WHERE locales.id_local=p_idLocal ;
end;

create
    definer = root@localhost procedure proc_editar_servicio(IN p_idServicio tinyint, IN p_nomServicio varchar(255),
                                                            IN p_precioServ float, IN p_tiempoServ varchar(255))
begin
UPDATE servicio set servicio.nombre_servicio=p_nomServicio, servicio.precio= p_precioServ, servicio.tiempo=p_tiempoServ WHERE servicio.id_servicio=p_idServicio;
end;

create
    definer = root@localhost procedure proc_insertar_cita(IN p_alias varchar(255), IN p_fecha varchar(255),
                                                          IN p_hora varchar(255), IN p_usuario int,
                                                          IN p_local varchar(255))
begin


if EXISTS (SELECT cita.id_cita from cita where cita.fecha=p_fecha and cita.hora=p_hora)
then
		SELECT 'FECHA NO DISPONIBLE' AS MENSAJE_BD;
else
	insert cita VALUES(default,trim(p_alias), p_fecha, p_hora, '1', p_usuario, p_local,0);
	select MAX(id_cita) FROM cita WHERE idUsuarios=p_usuario;
end if;
end;

create
    definer = root@localhost procedure proc_insertar_detCita(IN p_idCita bigint, IN p_servicio bigint)
begin
declare pcatiCita tinyint;
DECLARE totaciata float;
Declare actuacita float;
Select cantidad_cita into pcatiCita from detalle_cita WHERE detalle_cita.id_cita_dcita=p_idCita;

Select total_cita into totaciata from cita where cita.id_cita=p_idCita;

SELECT servicio.precio into actuacita from servicio where servicio.id_servicio = p_servicio;

if EXISTS (Select detalle_cita.id_cita_dcita from detalle_cita where detalle_cita.id_cita_dcita=p_idCita and detalle_cita.id_servicio_dcita=p_servicio)
then
	UPDATE detalle_cita set cantidad_cita=(pcaticita+1) where detalle_cita.id_cita_dcita=p_idCita;
	UPDATE cita set total_cita=(totaciata+actuacita) where cita.id_cita=p_idCita;
else
	insert detalle_cita values (DEFAULt,p_idCita, p_servicio, 1);
	UPDATE cita set total_cita=(totaciata+actuacita) where cita.id_cita=p_idCita;
end if;
end;

create
    definer = root@localhost procedure proc_insertar_detalle_cita(IN p_id_cita bigint, IN p_servicio varchar(255))
BEGIN
	declare id_servicio int;
	select servicio.id_servicio into id_servicio from servicio where servicio.nombre_servicio=p_servicio;
	insert into detalle_cita VALUES(default,p_id_cita, id_servicio);
	select 'Se inserto Detalle de Cita' as 'Mensaje_DB';
END;

create
    definer = root@localhost procedure proc_insertar_local(IN p_nom_local varchar(255), IN p_direccion_local varchar(255))
begin
if EXISTS(Select locales.nombre_local from locales where locales.nombre_local=trim(p_nom_local))
then
	SELECT 'Ya existe ese local' as Mensaje_BD;
else
	insert locales values(default, trim(p_nom_local),trim(p_direccion_local),1);
	SELECT 'Se inserto Local' as Mensaje_BD;
end if;
end;

create
    definer = root@localhost procedure proc_insertar_servicio(IN p_nom_servicio varchar(255), IN p_precio_serv float,
                                                              IN p_tiempo varchar(255))
begin
if EXISTS(Select servicio.nombre_servicio from servicio where servicio.nombre_servicio=trim(p_nom_servicio))
then
	SELECT 'Ya exite este servicio' as Mensaje_BD;
else
	insert servicio VALUES(DEFAULT, trim(p_nom_servicio), trim(p_precio_serv), 1, trim(p_tiempo));
	Select 'Se inserto nuevo servicio' as Mensaje_BD;
end if;
end;

create
    definer = root@localhost procedure proc_insertar_usuario(IN p_nombre varchar(255), IN p_apellido1 varchar(255),
                                                             IN p_telefono varchar(255), IN p_correo varchar(255),
                                                             IN p_contrasenia varchar(255), IN p_token varchar(255))
begin
if p_nombre='' or p_apellido1='' or p_telefono='' or p_contrasenia=''
then
SELECT 'No dejes campos en blanco' as MENSAJE_BD;
else
insert into usuario (nombre, apellido1, telefono, email, contrasenia, token, permiso, confirmado) values (p_nombre,p_apellido1,p_telefono,p_correo,p_contrasenia,p_token,0,0);
SELECT 'SE REGISTRO DE FOMRA ADECUADA EL USUARIO' AS MENSAJE_BD;
end if;

end;

create
    definer = root@localhost procedure proc_validar_usuario(IN p_usuario varchar(255), IN p_contra varchar(255))
begin
declare id_usuario int;
if EXISTS(select usuario.id_usuarios from usuario where usuario.nombre=p_usuario and usuario.contrasenia=p_contra)
then
	SELECT 'Puedes ingresar' as Mensaje_BD;
	select usuario.id_usuarios into id_usuario from usuario where usuario.nombre=p_usuario and usuario.contrasenia=p_contra;
else
	Select "El usuario o la contraseña son incorrectos" as Mensaje_BD;
end if;
end;

create
    definer = root@localhost procedure ver_citas_admin()
BEGIN
SELECT
cita.id_cita,
	cita.alias,
	CONCAT(usuario.nombre, ' ',
	usuario.apellido1), 
	cita.fecha, 
	cita.hora,
	cita.total_cita
FROM
	cita
	INNER JOIN
	usuario
	ON 
		cita.idUsuarios = usuario.id_usuarios
		where cita.status='1';
		
END;

create
    definer = root@localhost procedure ver_citas_user(IN idUser int)
BEGIN
SELECT
cita.id_cita,
	cita.alias,
	cita.fecha, 
	cita.hora,
	cita.total_cita
FROM
	cita
	INNER JOIN
	usuario
	ON 
		cita.idUsuarios = usuario.id_usuarios
		where cita.status='1' and usuario.id_usuarios= idUser;
		
END;


