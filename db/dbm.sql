SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `categorias` (`id_categoria`, `nombre`) VALUES
(1, 'Motion'),
(2, 'Photoshop'),
(3, 'Illustrator'),
(4, 'Modelado');

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `meGusta` int(11) NOT NULL,
  `detalle` varchar(256) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `descripcion` varchar(512) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `foto`, `id_categoria`) VALUES

(1, 'Donación CRUZ ROJA', 'Video realizado en After Effects; Compuesto de divertidas ilustraciones animadas que invitan de modo no convencional a las personas a donar sangre y a ayudar a otros sumándose a ala campaña de donación realizada por La Cruz Roja.', 'images/motion/mot1.mp4', 1),
(2, 'F1 Publicidad', 'Video realizado en After Effects; compuesto de diferentes ilustraciones y Efectos para lograr una publicidad hecha en motion graphics divertida y llamativa.', 'images/motion/mot2.mp4', 1),
(3, 'Cursada CRUZ ROJA', 'Video realizado en After Effects; Publicidad de La cruz roja que invita a interesados en cursar carreras relacionadas a la enfermería, a informarse para poder anotarse de forma exitosa', 'images/motion/mot3.mp4', 1),
(4, 'Gran Turismo', 'Video realizado en After Effects; Video publicitario, dinámico y llamativo de la última edición del juego Gran turismo.', 'images/motion/mot4.mp4', 1),
(5, 'BPlay Publicidad', 'Video realizado en After Effects; Hecho completamente de ilustraciones y animaciones en motion, Este video es una publicidad dinámica y divertida sobre la app de apuestas Bplay.', 'images/motion/mot5.mp4', 1),
(6, 'Baby Driver - Poster Montaje complejo', 'Poster creado con imágenes individuales con el fin de generar una composicion que funcione como poster de cartelera.', 'images/photoshop/photo1.jpg', 2),
(7, 'Montaje de Escena Simple', 'Composición simple a base de diferentes imágenes, con retoque de luz para crear un entorno digital, o escenario.', 'images/photoshop/photo2.jpg', 2),
(8, 'La Princesa y El Sapo - Montaje doble exposición', 'Trabajo con doble exposición, con un cello que deja  ver la composición en el fondo. Junyo, todo cuenta una historia, que en este caso hace referencia a una película.', 'images/photoshop/photo3.jpg', 2),
(9, 'El Encargado - Poster Montaje complejo', 'Poster creado con imágenes individuales con el fin de generar una composicion que funcione como poster de cartelera.', 'images/photoshop/photo4.jpg', 2),
(10, 'EMILIA - Montaje realista ', 'Pensado para una campaña de mkt, este montaje se compone de dos imágenes, por un lado la lata creada para la campaña y por otrolado la base, es decir la foto de Emilia.', 'images/photoshop/photo5.jpg', 2),
(11, 'Montaje de Escena Simple', 'Trabajo en el que mediante el tratamiento digital, se pudo crear una composición de fondo y personaje armoniosa, proveniente de dos imágenes separadas.', 'images/photoshop/photo6.jpg', 2),
(12, 'La princesa y el sapo - Montaje complejo', 'Montaje base para trabajo de doble exposición. Este montaje está compuesto por varias imágenes de diferentes escenarios y fueron adaptadas mediante procesos digitales para que funcionaran en el escenario planteado.', 'images/photoshop/photo7.jpg', 2),
(13, 'Montaje de escena simple', 'Trabajo de integración simple, elaborado con pocos componentes pero con retoques digitales que crean la pieza y con ella una armonía visual.', 'images/photoshop/photo8.jpg', 2),
(14, 'Ilustración Londres - Artística', 'Ilustración de colores vivos, que nos lleva a un paisaje Inglés muy atractivo. Tratada con illustrator de forma artística y con una influencia en un estilo de pintura.', 'images/illustrator/ill1.jpg', 3),
(15, 'Ilustración Ironman - Hiperrealista', 'Ilustración tratada de forma hiperrealista, utilizando recursos de pintado e ilustrado en Illustrator para lograr la ilusión de un 3D.', 'images/illustrator/ill2.jpg', 3),
(16, 'Casco Ayrton Senna - Modelado 3D simple', 'Homejane al corredor Ayrton Senna. casco y fondo modelados en blender, utilizando de referencia los diferentes cascos que ha llevado el corredor a a lo largo de su carrera.', 'images/modelado/mod1.jpg', 4),
(17, 'Valentines Candy - Modelado 3D simple', 'Modelado simple, idea aleatoria inspirada por una paleta de colores romántica para el día de los enamorados.', 'images/modelado/mod2.jpg', 4),
(18, 'Restaurante Argentino - Modelado 3D complejo', 'Modelado complejo, elaborado de forma detallada e inspirado en el sentimiento argentino, usando de referencia figuras importantes de nuestra historia futbolística.', 'images/modelado/mod3.png', 4);


CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `descripcion` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO `roles` (`id_rol`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Visitante');

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `clave` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_usuario` (`id_usuario`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);  

ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
