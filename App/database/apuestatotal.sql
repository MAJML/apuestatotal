
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE apuestatotal;

--`bancos`
CREATE TABLE `bancos` (
  `id` int(12) NOT NULL,
  `name` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `bancos` (`id`, `name`, `created_at`, `deleted_at`) VALUES
(1, 'INTERBANK', '2024-05-12 01:56:07', NULL),
(2, 'BBVA', '2024-05-12 01:56:07', NULL),
(3, 'SCOTIABANK PERU', '2024-05-12 01:56:23', NULL),
(4, 'BANCO PICHINCHA', '2024-05-12 01:56:23', NULL),
(5, 'BCP', '2024-05-12 01:56:40', NULL);


--`clientes`
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `dni` varchar(12) NOT NULL,
  `celular` varchar(12) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `password` varchar(350) NOT NULL,
  `player_id` varchar(250) NOT NULL,
  `saldo` varchar(250) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--`historial_recargas`
CREATE TABLE `historial_recargas` (
  `id` int(12) NOT NULL,
  `id_users` varchar(12) NOT NULL,
  `id_clientes` varchar(12) NOT NULL,
  `id_solicitud_recargas` varchar(12) NOT NULL,
  `banco` varchar(12) NOT NULL,
  `medio_pago` varchar(250) DEFAULT NULL,
  `monto` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--`perfiles`
CREATE TABLE `perfiles` (
  `id` int(12) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `perfiles` (`id`, `nombre`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'ASESOR');

--`sedes`
CREATE TABLE `sedes` (
  `id` int(12) NOT NULL,
  `nombres` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
INSERT INTO `sedes` (`id`, `nombres`) VALUES
(1, 'SEDE CENTRAL'),
(2, 'SEDE SURQUILLO'),
(3, 'SEDE SJL');

--`solicitud_recargas`
CREATE TABLE `solicitud_recargas` (
  `id` int(12) NOT NULL,
  `player_id` varchar(15) NOT NULL,
  `monto` varchar(250) NOT NULL,
  `banco` varchar(150) NOT NULL,
  `medio_pago` varchar(100) DEFAULT NULL,
  `codigo_recarga` varchar(250) DEFAULT NULL,
  `estado` varchar(2) DEFAULT '0',
  `voucher` varchar(250) DEFAULT NULL,
  `users_id` varchar(12) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--`users`
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `perfil` int(2) DEFAULT NULL,
  `dni` varchar(8) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `sede` varchar(150) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `users` (`id`, `nombre`, `apellido`, `perfil`, `dni`, `telefono`, `sede`, `usuario`, `password`, `estado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Aaron', 'Ramos', 2, '73076448', '983347365', '2', 'admin', '$2y$10$.RJuBuJzJCo6uHw90dFPeu2JXWqNluh4UM72RfD0ky/XXYLIY/Xa6', '1', '2024-05-11 15:52:13', NULL, NULL);


ALTER TABLE `bancos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `historial_recargas`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `solicitud_recargas`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bancos`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

ALTER TABLE `historial_recargas`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

ALTER TABLE `perfiles`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `sedes`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `solicitud_recargas`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
