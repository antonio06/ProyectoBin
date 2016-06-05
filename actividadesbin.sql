-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2016 a las 09:30:09
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `actividadesbin`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `codigo_actividad` int(50) NOT NULL,
  `titulo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` set('En proyecto','Abierto plazo de solicitud','Finalizado plazo de solicitud','Actividades en desarrollo','Terminadas') COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'En proyecto',
  `coordinador` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `ponente` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `ubicacion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `horario_inicio` time NOT NULL,
  `horario_fin` time NOT NULL,
  `n_Total_Horas` int(50) NOT NULL,
  `precio` int(50) NOT NULL,
  `IVA` set('Si','No') COLLATE utf8_spanish2_ci NOT NULL,
  `descriptor` set('Infantil','Primaria','Profesores de primaria','Profesores de secundaria','Padres','Madres') COLLATE utf8_spanish2_ci NOT NULL,
  `observaciones` varchar(500) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`codigo_actividad`, `titulo`, `estado`, `coordinador`, `ponente`, `ubicacion`, `fecha_inicio`, `fecha_fin`, `horario_inicio`, `horario_fin`, `n_Total_Horas`, `precio`, `IVA`, `descriptor`, `observaciones`) VALUES
(1, 'Alimentación personas mayores', 'En proyecto', 'Alejandro Molina', 'Antonio Mendoza', 'C/Random nº8', '2016-02-21', '2016-02-23', '13:45:00', '14:30:00', 1, 7, 'Si', 'Padres', 'sfasfasfdasfsdfs'),
(4, 'Nuevas formas de educación', 'Abierto plazo de solicitud', 'Álvaro Fernandez ', 'Jose Montiel', 'C/Salitre', '2016-03-16', '2016-03-18', '13:30:00', '14:30:00', 1, 5, 'Si', 'Profesores de primaria', 'La actividad tiene plazo abierto'),
(5, 'Curso de cocina Infantil', 'Abierto plazo de solicitud', 'Manuel ', 'Isabel', 'C/ Ayala nº 21', '2016-03-10', '2016-03-10', '10:00:00', '14:00:00', 4, 5, 'Si', 'Primaria', 'Cocina para los más pequeños de la casa'),
(6, 'Clases de matemáticas', 'En proyecto', 'Juan Martinez', 'Manuel Sanchez', 'C/Los Majarones', '2016-03-21', '2016-03-23', '13:00:00', '14:00:00', 1, 5, 'Si', 'Primaria', 'Clases de matemáticas para niños'),
(7, 'Clases de lengua', 'Abierto plazo de solicitud', 'Sergio Banderas', 'Luis Sanchez', 'C/ Ayala nº 21', '2016-05-02', '2016-05-07', '19:29:00', '20:29:00', 5, 6, 'Si', 'Infantil', 'Clases de lengua para niños'),
(8, 'Curso Comida para embarazadas', 'En proyecto', 'Edurne', 'Pedro', 'C/Los Majarones', '2016-04-01', '2016-04-03', '13:00:00', '14:30:00', 1, 3, 'Si', 'Madres', 'Curso de cocina indicada para mujeres embarazadas'),
(9, 'Curso contra el maltrato escolar', 'Abierto plazo de solicitud', 'Miguel Angel', 'David', 'C/Random 7', '2016-03-30', '2016-03-31', '09:00:00', '11:00:00', 2, 3, 'No', 'Profesores de secundaria', 'Curso para profesores para prevenir el maltrato entre los jóvenes'),
(10, 'Cursos para maquillaje saludable', 'Finalizado plazo de solicitud', 'Eva', 'Pedro', 'C/Random 10', '2016-04-05', '2016-03-06', '09:00:00', '11:00:00', 2, 3, 'No', 'Madres', 'Curso de maquillaje con productos naturales y sin perjuicios para la piel '),
(11, 'Curso Reciclaje', 'En proyecto', 'Juan y Medio', 'Eva Sanchez', 'C/Los Sevillanos', '2016-03-11', '2016-03-13', '07:00:00', '13:00:00', 6, 3, 'No', 'Madres', 'Cursos para aprender a reciclar en casa'),
(12, 'Curso Móviles ', 'Abierto plazo de solicitud', 'Eva H', 'Manuel Orta', 'Antonio', '2016-03-11', '2016-03-12', '13:00:00', '15:00:00', 2, 5, 'No', 'Primaria', 'Curso de móviles para niños '),
(13, 'Internet para padres ', 'Actividades en desarrollo', 'Conchi Román', 'María Victoria Contreras', 'C/Random 9', '2016-04-15', '2016-04-16', '09:30:00', '11:30:00', 2, 3, 'No', 'Padres', 'Curso de internet para padres nivel principiante '),
(14, 'Costura para pequeños', 'Abierto plazo de solicitud', 'Leticia', 'Pablo', 'C/Random 4', '2016-03-11', '2016-03-13', '12:00:00', '14:00:00', 2, 2, 'Si', 'Infantil', 'Costura para pequeños'),
(15, 'Practicas Para Embarazos', 'En proyecto', 'Susana', 'Luis', 'C/Salitre', '2016-03-31', '2016-04-02', '13:00:00', '14:00:00', 1, 5, 'No', 'Padres', 'Practicas para madres embarazadas'),
(23, 'kukfhh', 'Abierto plazo de solicitud', 'asd', 'dsa', 'asd', '2016-05-01', '2016-05-15', '08:00:00', '10:00:00', 17, 2, 'Si', 'Primaria', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participa`
--

CREATE TABLE `participa` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo_persona` int(11) NOT NULL,
  `codigo_actividad` int(11) NOT NULL,
  `codigo_perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `participa`
--

INSERT INTO `participa` (`id`, `codigo_persona`, `codigo_actividad`, `codigo_perfil`) VALUES
(5, 24, 8, 3),
(6, 24, 9, 3),
(7, 24, 13, 3),
(8, 27, 9, 4),
(9, 27, 11, 3),
(10, 27, 12, 4),
(11, 32, 13, 1),
(12, 34, 1, 4),
(13, 34, 5, 4),
(14, 34, 6, 4),
(15, 34, 14, 3),
(16, 36, 15, 4),
(17, 36, 4, 4),
(18, 36, 5, 4),
(19, 36, 9, 4),
(20, 36, 11, 4),
(21, 36, 12, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `codigo` int(15) NOT NULL,
  `descripcion` varchar(15) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`codigo`, `descripcion`) VALUES
(1, 'socio'),
(2, 'ponente'),
(3, 'monitor'),
(4, 'participante'),
(5, 'colaborador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `codigo` int(50) NOT NULL,
  `DNI` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido1` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido2` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `perfil` int(15) NOT NULL,
  `foto` longblob NOT NULL,
  `sexo` set('hombre','mujer') COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_nac` date NOT NULL,
  `direccion` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `municipio` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `provincia` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `pais` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_alta` date NOT NULL,
  `fecha_baja` date NOT NULL,
  `n_Seguridad_Social` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `n_Cuenta_Bancaria` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `perfil_usuario` set('Administrador','Limitado','Usuario') COLLATE utf8_spanish2_ci NOT NULL,
  `observaciones` varchar(500) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`codigo`, `DNI`, `nombre`, `apellido1`, `apellido2`, `perfil`, `foto`, `sexo`, `fecha_nac`, `direccion`, `municipio`, `provincia`, `pais`, `fecha_alta`, `fecha_baja`, `n_Seguridad_Social`, `n_Cuenta_Bancaria`, `email`, `password`, `perfil_usuario`, `observaciones`) VALUES
(24, '77777-P', 'Concepción', 'Román', 'Losada', 1, 0x52306c474f446c6845414151414f5941414f65714d662f62637a47714d662f6a6c4447694d66667a74597a44684447364d66667274625743454a534b637a47794d6665714d656561496666546379463549625743495448444d595278592f2f7a705447534d5447614d6157616844456f495549344d6157536843456745424252454b57696c43474b496156354966666a7063615345434670496565694d6337487661584c6e464a42516e4f534d5952356379475349595369633553715169465a4966664c592f664459324e35496232327066666a6c484e78592b6536557052784964616949534743495346784966666263334e68556d4e685573614b454a534b68474e52557258445574624c74666644557565794d6665365174615345495369517053326a464a354d52425a454e61694d564a52517361614963615349554b4b4961334870656536517565694964616149662f7270662f726c502f6a684c57716c43455145502f7a787257696c502f7a74662f2f2f77414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414143483542414541414667414c4141414141415141424141414165536746694367345346686f654969594d2b5534324e49346c5443466458425442576b4964576d3577636e702b654c316857566156566c464252556a6373507930535742796e6c524e524136757454552b7746724f707436772f515141674f46693942524e517477454f72634d365046675a714d7a504441424f43535854434b6c537a64634144516b59574473497175484332413143486864594368384f4d6b41414e456c4b4542414a486a4d61354a32496b514d4a6867736171436863534558526f5541414f773d3d, 'mujer', '0000-00-00', 'C/Random 7', 'Málaga', 'Málaga', 'España', '0000-00-00', '0000-00-00', '777777-P', '1428236-D', 'conchi@gmail.com', '$2y$10$EXZEJQlxFsxrKc9AeAoAJOKboE0E4erXU88zz2UXNL0i0fnaJb4g.', 'Administrador', 'Una persona llamada Concepción'),
(26, '9999-W', 'Alejandro', 'Sanchez', 'Nuñez', 3, 0x47494638396110001000e60000e7aa31ffdb7331aa31ffe39431a231f7f3b58cc38431ba31f7ebb5b58210948a7331b231f7aa31e79a21f7d373217921b5822131c331847163fff3a5319231319a31a59a84312821423831a59284212010105110a5a294218a21a57921f7e3a5c69210216921e7a231cec7bda5cb9c52414273923184797321922184a27394aa42215921f7cb63f7c363637921bdb6a5f7e394737163e7ba52947121d6a221218221217121f7db73736152636152c68a10948a84635152b5c352d6cbb5f7c352e7b231f7ba42d6921084a24294b68c527931105910d6a231525142c69a21c69221428a21adc7a5e7ba42e7a221d69a21ffeba5ffeb94ffe384b5aa94211010fff3c6b5a294fff3b5ffffff00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000021f90401000058002c000000001000100000079280588283848586878889833e538d8d2389530857570530569087569b9c1c9e9f9e2f585655a55594505152372c3f2d12581ca795135103abad4d4fb016b3a9b7ac3f4100203858bd051350b7010eadc33a3c5819a8cccf0c004e0925d308a952cdd7000d0918583b08aae1c2d80d421e17580a1f0e32400034494a1010091e331ae49d88910309860b1aa8284845d1a140003b, 'hombre', '0000-00-00', 'C/Random 4', 'Málaga', 'Málaga', 'España', '0000-00-00', '0000-00-00', '9999-W', '147235-V', 'alejandro@gmail.com', '$2y$10$ktwrYDGtmAlg0kgjN5wDqeO7EPCs1sBVtODAhz2t1f/K8sKGTWdQG', 'Usuario', 'Usuario Alejandro'),
(27, '22222-J', 'Luis', 'Sanchez', 'Castejón', 2, 0x48796472616e676561732e6a7067, 'hombre', '2016-03-21', 'C/Salmonete 4', 'Málaga', 'Málaga', 'España', '2016-03-14', '2016-03-15', '22222.J', '147529-O', 'luis@gmail.com', '$2y$10$dptckPed2UX/jUZoFa4iMefd418yIXs78iB4Sjb14EE2W0QlIqgnG', 'Usuario', 'Usuario Luis'),
(28, '88888-A', 'Juan', 'Fernandez', 'Ruiz', 2, 0x312e6a7067, 'hombre', '2016-03-14', 'C/Aprobado', 'Málaga', 'Málaga', 'España', '2016-03-14', '2016-03-15', '888888-A', '427639-P', 'juan@gmail.com', '$2y$10$hnK9tunhGtH4u2sHkc2woO3epw7/O7JqQZX4tLYdDOKB3zdsaEqEu', 'Limitado', 'Una persona llamada Juan'),
(29, '2222-PÑ', 'Luisa', 'Gutierrez', 'Franco', 5, 0x4a656c6c79666973682e6a7067, 'mujer', '2016-03-07', 'C/Salmonete 3', 'Málaga', 'Málaga', 'España', '2016-03-08', '2016-03-14', '2222-P', '235871-LO', 'luisa@gmail.com', '$2y$10$BunTXNpnKJNuuYhHd59OIOY6gOw7hCgVHohqwNY8Oc1kpt2yFWwPq', 'Usuario', 'Una persona llamada Luisa'),
(30, '5555-Ñ', 'Carmela', 'Contreras', 'Frias', 3, 0x54756c6970732e6a7067, 'mujer', '2016-03-01', 'C/Aprobado 9', 'Málaga', 'Málaga', 'España', '2016-03-14', '2016-03-20', '8888-Ñ', '748639-P', 'carmela@gmail.com', '$2y$10$sJKbmZEclPBHQ/G.Go6na.v7pLBjRlwGf3nHr.SqaY.h0nny3/MyC', 'Usuario', 'Una persona llamada Carmela'),
(31, '9999-L', 'María', 'Nuñez', 'Lopez', 4, 0x4a656c6c79666973682e6a7067, 'mujer', '2016-03-14', 'C/Aprobado 4', 'Málaga', 'Málaga', 'España', '2016-03-14', '2016-03-15', '9999-L', '15839-O', 'maria@gmail.com', '$2y$10$reUM9RUe2esJ6JubzYJgvOzbCUDvw3xspBrkpSwRBsB9Y6gjwWxGS', 'Limitado', 'Una persona llamada María'),
(32, '77777-I', 'Iñaki', 'Gurruchaga', 'Ñoñez', 1, 0x4c69676874686f7573652e6a7067, 'mujer', '2016-02-15', 'C/Random 11', 'Málaga', 'Málaga', 'España', '2016-03-15', '2016-03-18', '77777-I', '48239-k', 'inaki@gmail.com', '$2y$10$3Bxdq29SFnYrzOeopal0/uhRTw7IEw/0246paREEsJ0Dc8AuZ6/gq', 'Usuario', 'Una persona llamada Iñaki'),
(34, '44444-TT', 'Marta', 'Contreras', 'Ruíz', 2, 0x50656e6775696e732e6a7067, 'mujer', '2016-01-18', 'C/Aprobado 1', 'Málaga', 'Málaga', 'España', '2016-03-08', '2016-03-31', '44444-T', '992571-T', 'marta@gmail.com', '$2y$10$bVAYmU/JsIzaPjVgUCcJC.n2Rpge.B4TND9cTsTc3TMn9ivYSaGrG', 'Usuario', 'Una persona llamada Marta'),
(36, '44444-TPXL', 'Antonio', 'Contreras', 'Román', 1, '', '', '2016-03-14', 'C/Random 12', 'Málaga', 'Málaga', 'España', '2016-03-31', '2016-04-03', '888888-Ao', '38475-Itxñ', 'antonio@gmail.com', '$2y$10$3IWXW0gZdy1GmX.Vs6WUu.iWp1.mt3uQJ/Abq5Rk2aQd0sDT6xumi', 'Administrador', 'Una persona llamada Antonio'),
(37, '33333-LO', 'Pablo', 'Iglesias', 'Turrion', 1, 0x54756c6970732e6a7067, 'hombre', '2016-03-31', 'C/Aprobado 18', 'Málaga', 'Málaga', 'España', '2016-04-01', '2016-04-03', '37418-I', '64172-ÑU', 'pablo@gmail.com', '$2y$10$mV/cddRMHSOeH2fasV.tC.ycbCsBy3LPQCXhkiG9FPzH5Gw9lKHha', 'Administrador', 'Una persona llamada Pablo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`codigo_actividad`);

--
-- Indices de la tabla `participa`
--
ALTER TABLE `participa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codigo_persona` (`codigo_persona`),
  ADD KEY `codigo_actividad` (`codigo_actividad`),
  ADD KEY `codigo_perfil` (`codigo_perfil`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `perfil` (`perfil`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `codigo_actividad` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `participa`
--
ALTER TABLE `participa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `codigo` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `codigo` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `participa`
--
ALTER TABLE `participa`
  ADD CONSTRAINT `participa_ibfk_1` FOREIGN KEY (`codigo_persona`) REFERENCES `persona` (`codigo`),
  ADD CONSTRAINT `participa_ibfk_2` FOREIGN KEY (`codigo_actividad`) REFERENCES `actividad` (`codigo_actividad`),
  ADD CONSTRAINT `participa_ibfk_3` FOREIGN KEY (`codigo_perfil`) REFERENCES `perfil` (`codigo`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`perfil`) REFERENCES `perfil` (`codigo`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
