-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2016 a las 04:49:13
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(20) NOT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidoP` varchar(50) DEFAULT NULL,
  `apellidoM` varchar(50) DEFAULT NULL,
  `correoE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `nombres`, `apellidoP`, `apellidoM`, `correoE`) VALUES
(1, 'Rebeca Renata', 'Pérez', 'Damián', 'admin1'),
(2, 'uuuu', 'uuuu', 'yyyy', 'admin1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id` int(20) NOT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidoP` varchar(50) DEFAULT NULL,
  `apellidoM` varchar(50) DEFAULT NULL,
  `correoE` varchar(50) DEFAULT NULL,
  `carrera_nombre` varchar(250) DEFAULT NULL,
  `semestre` int(11) DEFAULT NULL,
  `grupo_nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id`, `nombres`, `apellidoP`, `apellidoM`, `correoE`, `carrera_nombre`, `semestre`, `grupo_nombre`) VALUES
(12, 'Lizbeth Yadira', 'Colores', 'Guzmán', 'ic2013020131', 'Ingeniería en Alimentos', 1, '103-A'),
(13, 'Luis', 'Cruz', 'Martínez', 'ic2013020132', 'Ingeniería en Alimentos', 1, '106-A'),
(14, 'Frida', 'Ortíz', 'Gómez', 'ic2013020133', 'Ingeniería en Alimentos', 1, '106-A'),
(15, 'Deysy', 'Martínez', 'Guzmán', 'ic2013020143', 'Ingeniería en Computación', 3, '302-A'),
(16, 'h', 'hh', 'hh', '777', 'Ingeniería en Mecánica Automotriz', 1, '902-A'),
(17, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Alma Rosa', 'Ramírez', 'Vega', 'ic2013020026', 'Ingeniería en Alimentos', 1, '106-A'),
(19, 'Rubi', 'Colores', 'Mendez', 'ic2013020134', 'Ingeniería en Alimentos', 1, '103-A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

CREATE TABLE `autor` (
  `id` int(20) NOT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidoM` varchar(50) DEFAULT NULL,
  `apellidoP` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id` int(20) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id`, `nombre`) VALUES
(1, 'Ingeniería en Mecánica Automotriz'),
(2, 'Ingeniería en Alimentos'),
(3, 'Ingeniería en Computación'),
(4, 'Ingeniería en Diseño'),
(5, 'Ingeniería en Electrónica'),
(6, 'Ingeniería en Mecatrónica'),
(7, 'Ingeniería Industrial'),
(8, 'Ingeniería en Física Aplicada'),
(9, 'Licenciatura en Ciencias Empresariales'),
(10, 'Licenciatura en Matemáticas Aplicadas'),
(11, 'Licenciatura en Estudios Mexicanos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE `editorial` (
  `id` int(20) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `correoE` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fecha`
--

CREATE TABLE `fecha` (
  `id` int(20) NOT NULL,
  `Primera` date DEFAULT NULL,
  `Segunda` date DEFAULT NULL,
  `Tercera` date DEFAULT NULL,
  `gc_id` int(11) DEFAULT NULL,
  `semestre` int(11) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `periodo` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fecha`
--

INSERT INTO `fecha` (`id`, `Primera`, `Segunda`, `Tercera`, `gc_id`, `semestre`, `anio`, `periodo`) VALUES
(1, '2016-10-17', '2016-11-22', '2017-01-10', 1, 1, 2017, 'A'),
(2, '2016-10-18', '2016-11-23', '2017-01-11', 2, 1, 2017, 'A'),
(3, '2016-10-18', '2016-11-23', '2017-01-11', 3, 3, 2017, 'A'),
(4, '2016-10-19', '2016-11-24', '2017-01-12', 4, 3, 2017, 'A'),
(5, '2016-10-19', '2016-11-24', '2017-01-12', 5, 5, 2017, 'A'),
(6, '2016-10-20', '2016-11-25', '2017-01-13', 6, 7, 2017, 'A'),
(7, '2016-10-20', '2016-11-25', '2017-01-13', 7, 9, 2017, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato`
--

CREATE TABLE `formato` (
  `id` int(20) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `libro_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id` int(20) NOT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `carrera_id` int(11) DEFAULT NULL,
  `semestre` int(11) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `periodo` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id`, `codigo`, `carrera_id`, `semestre`, `anio`, `periodo`) VALUES
(12, '103-A', 4, 1, 2017, 'A'),
(13, '103-B', 4, 1, 2017, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_lectura`
--

CREATE TABLE `grupo_lectura` (
  `id` int(11) NOT NULL,
  `id1` int(11) DEFAULT NULL,
  `id2` int(11) DEFAULT NULL,
  `id3` int(11) DEFAULT NULL,
  `id4` int(11) DEFAULT NULL,
  `id5` int(11) DEFAULT NULL,
  `id6` int(11) DEFAULT NULL,
  `id7` int(11) DEFAULT NULL,
  `id8` int(11) DEFAULT NULL,
  `id9` int(11) DEFAULT NULL,
  `id10` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo_lectura`
--

INSERT INTO `grupo_lectura` (`id`, `id1`, `id2`, `id3`, `id4`, `id5`, `id6`, `id7`, `id8`, `id9`, `id10`) VALUES
(1, 4, 9, 7, 6, 1, NULL, NULL, NULL, NULL, NULL),
(2, 3, 5, 10, 2, 8, NULL, NULL, NULL, NULL, NULL),
(3, 3, 4, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 5, 2, 10, 7, 8, NULL, NULL, NULL, NULL, NULL),
(5, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10),
(6, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10),
(7, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lectura_usuario`
--

CREATE TABLE `lectura_usuario` (
  `id` int(20) NOT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `administrador_id` int(11) DEFAULT NULL,
  `libro_nombre` varchar(50) DEFAULT NULL,
  `resumen` text,
  `fecha` date DEFAULT NULL,
  `lectura` varchar(50) DEFAULT NULL,
  `enviado` int(11) DEFAULT NULL,
  `revision` text,
  `palabras` int(11) DEFAULT NULL,
  `acentos` int(11) DEFAULT NULL,
  `espacios` int(11) DEFAULT NULL,
  `frases` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lectura_usuario`
--

INSERT INTO `lectura_usuario` (`id`, `alumno_id`, `administrador_id`, `libro_nombre`, `resumen`, `fecha`, `lectura`, `enviado`, `revision`, `palabras`, `acentos`, `espacios`, `frases`, `estado`) VALUES
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 12, NULL, 'kkk', 'hola mundo', '2016-10-09', 'Primera', NULL, NULL, 10, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `id` int(20) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `autor_nombre` varchar(250) DEFAULT NULL,
  `editorial_nombre` varchar(250) DEFAULT NULL,
  `resumen` text,
  `numeroP` int(11) DEFAULT NULL,
  `categoria` varchar(250) DEFAULT NULL,
  `biblioteca` tinyint(1) DEFAULT '0',
  `copiadora` tinyint(1) DEFAULT '0',
  `pdf` varchar(255) DEFAULT NULL,
  `epub` varchar(255) DEFAULT NULL,
  `portada` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`id`, `nombre`, `autor_nombre`, `editorial_nombre`, `resumen`, `numeroP`, `categoria`, `biblioteca`, `copiadora`, `pdf`, `epub`, `portada`) VALUES
(192, 'kkk', 'kkkk', 'kkkk', 'kkkkk', 88000, 'mmll', 0, 0, 'NULL', 'NULL', 'NULL'),
(193, 'kkk', 'kkkk', 'kkkk', 'kkkkk', 88000, 'mmll', 0, 0, 'NULL', 'NULL', 'NULL'),
(194, 'quere', 'knkn', 'nb nbn', 'jmbjn,mn', 908, ',bmn m', 0, 0, 'NULL', 'NULL', 'NULL'),
(195, 'll', 'llll', 'llll', 'jbjhb', 999, 'l', 0, 0, 'NULL', 'NULL', 'NULL'),
(196, 'uuu', 'uuuu', 'uuu', 'nnnnn', 87, 'nnnn', 0, 0, 'NULL', 'NULL', 'NULL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revision_usuario`
--

CREATE TABLE `revision_usuario` (
  `id` int(20) NOT NULL,
  `alumno_id` int(20) DEFAULT NULL,
  `administrador_id` int(20) DEFAULT NULL,
  `libro_nombre` varchar(50) DEFAULT NULL,
  `resumen` text,
  `fecha` date DEFAULT NULL,
  `lectura` varchar(50) DEFAULT NULL,
  `enviado` int(11) DEFAULT NULL,
  `revision` text,
  `palabras` int(11) DEFAULT NULL,
  `acentos` int(11) DEFAULT NULL,
  `espacios` int(11) DEFAULT NULL,
  `frases` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `revision_usuario`
--

INSERT INTO `revision_usuario` (`id`, `alumno_id`, `administrador_id`, `libro_nombre`, `resumen`, `fecha`, `lectura`, `enviado`, `revision`, `palabras`, `acentos`, `espacios`, `frases`, `estado`) VALUES
(14, 12, 1, 'Antología Poética', 'Ensayo sobre la ceguera', '2016-10-14', 'Primera', NULL, '', 123, NULL, NULL, NULL, 'Aceptado'),
(15, 13, 1, 'Antología Poética', 'Ensayo sobre la ceguera', '2016-10-14', 'Primera', NULL, '', 123, NULL, NULL, NULL, 'Aceptado'),
(16, 14, 1, 'Antología Poética', 'Ensayo sobre la ceguera', '2016-10-14', 'Primera', NULL, 'Estos son comen', 123, NULL, NULL, NULL, 'Aceptado'),
(17, 12, 1, 'El Libro de los Abrazos', 'El lenguaje como traición; les gritan verdugos. En el\r\nEcuador, los verdugos llaman verdugos a sus víctimas:\r\n- ¡Indios verdugos! -les gritan.\r\nDe cada tres ecuatorianos, uno es indio. Los otros dos\r\nle cobran, cada día la derrota histórica.\r\n- Somos los vencidos. Nos ganaron la guerra. Nosotros\r\nperdimos por creerles. Por eso, -me dice Miguel, nacido\r\nen lo hondo de la selva Amazónica.\r\nLos tratan como a los negros en Sudáfrica: los indios\r\nno pueden entrar a los hoteles ni a los restaurantes.El lenguaje como traición; les gritan verdugos. En el\r\nEcuador, los verdugos llaman verdugos a sus víctimas:\r\n- ¡Indios verdugos! -les gritan.\r\nDe cada tres ecuatorianos, uno es indio. Los otros dos\r\nle cobran, cada día la derrota histórica.\r\n- Somos los vencidos. Nos ganaron la guerra. Nosotros\r\nperdimos por creerles. Por eso, -me dice Miguel, nacido\r\nen lo hondo de la selva Amazónica.\r\nLos tratan como a los negros en Sudáfrica: los indios\r\nno pueden entrar a los hoteles ni a los restaurantes.\r\nEl lenguaje como traición; les gritan verdugos. En el\r\nEcuador, los verdugos llaman verdugos a sus víctimas:\r\n- ¡Indios verdugos! -les gritan.\r\nDe cada tres ecuatorianos, uno es indio. Los otros dos\r\nle cobran, cada día la derrota histórica.\r\n- Somos los vencidos. Nos ganaron la guerra. Nosotros\r\nperdimos por creerles. Por eso, -me dice Miguel, nacido\r\nen lo hondo de la selva Amazónica.\r\nLos tratan como a los negros en Sudáfrica: los indios\r\nno pueden entrar a los hoteles ni a los restaurantes.\r\nEl lenguaje como traición; les gritan verdugos. En el\r\nEcuador, los verdugos llaman verdugos a sus víctimas:\r\n- ¡Indios verdugos! -les gritan.\r\nDe cada tres ecuatorianos, uno es indio. Los otros dos\r\nle cobran, cada día la derrota histórica.\r\n- Somos los vencidos. Nos ganaron la guerra. Nosotros\r\nperdimos por creerles. Por eso, -me dice Miguel, nacido\r\nen lo hondo de la selva Amazónica.\r\nLos tratan como a los negros en Sudáfrica: los indios\r\nno pueden entrar a los hoteles ni a los restaurantes.\r\nEl lenguaje como traición; les gritan verdugos. En el\r\nEcuador, los verdugos llaman verdugos a sus víctimas:\r\n- ¡Indios verdugos! -les gritan.\r\nDe cada tres ecuatorianos, uno es indio. Los otros dos\r\nle cobran, cada día la derrota histórica.\r\n- Somos los vencidos. Nos ganaron la guerra. Nosotros\r\nperdimos por creerles. Por eso, -me dice Miguel, nacido\r\nen lo hondo de la selva Amazónica.\r\nLos tratan como a los negros en Sudáfrica: los indios\r\nno pueden entrar a los hoteles ni a los restaurantes.\r\nEl lenguaje como traición; les gritan verdugos. En el\r\nEcuador, los verdugos llaman verdugos a sus víctimas:\r\n- ¡Indios verdugos! -les gritan.\r\nDe cada tres ecuatorianos, uno es indio. Los otros dos\r\nle cobran, cada día la derrota histórica.\r\n- Somos los vencidos. Nos ganaron la guerra. Nosotros\r\nperdimos por creerles. Por eso, -me dice Miguel, nacido\r\nen lo hondo de la selva Amazónica.\r\nLos tratan como a los negros en Sudáfrica: los indios\r\nno pueden entrar a los hoteles ni a los restaurantes.', '2016-10-07', 'Primera', NULL, '', 2944, NULL, NULL, NULL, 'Aceptado'),
(18, 19, 1, 'El libro de los abrazos', 'Este es el resumen del libro', '2016-10-18', 'Primera', NULL, NULL, 67, NULL, NULL, NULL, 'Aceptado'),
(19, 19, 1, 'Los abrazos', 'knhfsklsadfasdf dsfgsda', '2016-10-18', 'Primera', NULL, 'malll muyy mal', 89, NULL, NULL, NULL, 'Aceptado'),
(20, 12, 1, 'El Libro de los Abrazos', '\r\n\r\n    Categorias\r\n\r\nInicio » Como hacer una barra de paginación (Estatica) con HTML y CSS\r\nComo hacer una barra de paginación (Estatica) con HTML y CSS	\r\nComo hacer una barra de paginación (Estatica) con HTML y CSS\r\n\r\nAprende como hacer una barra de paginación muy básica utilizando HTML y CSS\r\n\r\nFalconMasters Carlos Arturo\r\n\r\n26 agosto, 2014\r\n\r\n    Elementos web\r\n\r\n23\r\n1\r\n0\r\n0\r\n\r\nMuchas personas me han preguntado como he hecho la paginación este este sitio web, y la verdad es que yo no he sido el que ha programado la navegación, es un plugin de WordPress, el CMS que yo utilizo para que todo este sitio funcione. Debido a esta pregunta he decidido explicarles como hacer una paginación sencilla, para que puedan entender el funcionamiento de estas.\r\n\r\nLas paginaciones completas se conectan al servidor y revisan que paginas son las que siguen o cuales son las anteriores, eso es mas avanzado, en este tutorial aprenderemos como hacer una sencilla, sera una paginación estática, que es mas facil de hacer pero tiene un problema, cada que queramos modificar un enlace tendremos que hacerlo a mano, editando el código y por si fuera poco, tenemos que editarlo en cada una de las paginas que tengamos. Es una gran desventaja si tienes un sitio grande, si es uno pequeño con muy pocas paginas no tendrás problema.\r\n\r\n\r\n    Categorias\r\n\r\nInicio » Como hacer una barra de paginación (Estatica) con HTML y CSS\r\nComo hacer una barra de paginación (Estatica) con HTML y CSS	\r\nComo hacer una barra de paginación (Estatica) con HTML y CSS\r\n\r\nAprende como hacer una barra de paginación muy básica utilizando HTML y CSS\r\n\r\nFalconMasters Carlos Arturo\r\n\r\n26 agosto, 2014\r\n\r\n    Elementos web\r\n\r\n23\r\n1', '2016-10-08', 'Primera', NULL, NULL, 1653, NULL, NULL, NULL, 'Aceptado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `editorial`
--
ALTER TABLE `editorial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fecha`
--
ALTER TABLE `fecha`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formato`
--
ALTER TABLE `formato`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupo_lectura`
--
ALTER TABLE `grupo_lectura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lectura_usuario`
--
ALTER TABLE `lectura_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `revision_usuario`
--
ALTER TABLE `revision_usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `autor`
--
ALTER TABLE `autor`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `editorial`
--
ALTER TABLE `editorial`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `fecha`
--
ALTER TABLE `fecha`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `formato`
--
ALTER TABLE `formato`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `grupo_lectura`
--
ALTER TABLE `grupo_lectura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `lectura_usuario`
--
ALTER TABLE `lectura_usuario`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;
--
-- AUTO_INCREMENT de la tabla `revision_usuario`
--
ALTER TABLE `revision_usuario`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
