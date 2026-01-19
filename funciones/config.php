<?php
$array_tipo_licitacion = array(1 => 'Licitación publica', 2 => 'Licitación restringida/invitación');
$array_normatividad = array(1 => 'Estatal', 2 => 'Federal');
$array_eventos = array(1 => 'Vista a la obra', 2 => 'Junta de aclaraciones', 3 => 'Apertura de propuestas', 4 => 'Fallo', 5=> 'Convocatoria');
$array_modalidad = array(1 => mb_strtoupper('Licitación Pública', "UTF-8"), 2 => mb_strtoupper('Licitación Simplificada/Invitación Restringida', "UTF-8"), 3 => mb_strtoupper('Adjudicación Directa basada en normatividad', "UTF-8"), 4 => mb_strtoupper('Administración Directa', "UTF-8"));
$array_momentos= array(1 => 'Disponible', 2 => 'Modificado', 3 => 'Reservado', 4 => 'Comprometido', 5 => 'Devengado', 6 => 'Ejercido', 7 => 'Pagado', 8 => 'Original', 9 => 'Orig-Amp-Red-Mod');
$array_momentosDesglose= array( 1 => 'Comprometido', 2 => 'Devengado', 3 => 'Ejercido', 5 => 'Pagado', 5 => 'Reservado');
$array_estatus= array(0 => '-- Todos --', 1 => 'Capturada', 2 => 'Autorizada', 3 => 'Pago solicitado', 4 => 'Pagada parcialmente', 5 => 'Pagada totalmente', 6 => 'Cancelada');