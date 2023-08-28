<?php

/**
 * Se omiten ~ ´ ¨ [] {} | etc ya que son dificiles de escribir
 * Se omite la letra o, ya que se confunde con 0 (cero)
 * Se omite la letra i ya que se confude con 1 (uno)
 * Se omite el número 0 ya que se confunde on o (ó)
 * Se omite el número 1 ya que se confunde on l (ele)
 */

if (!empty($_POST['largo'])) {

   $largo = $_POST['largo'];

   if ($largo < 4) {

      $response["status"] = "error";
      $response["message"] = "El password debe ser mayor a 3";
   } else {

      $patrones = [
         'mayusculas' => ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'],
         'minusculas' => ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'j', 'k', 'm', 'n', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'],
         'numeros' => [2, 3, 4, 5, 6, 4, 5, 6, 7, 8, 9],
         'signos' => ['+', '-', '.', '*', ',', '/', ';', '=', '_', '(', ')']
      ];

      $totalCaracteres = 0;
      foreach (array_keys($patrones) as $patron) {
         $totalCaracteres += count($patrones[$patron]);
      }

      function generaPassword($largo, $patrones)
      {
         $password = array();
         for ($i = 0; $i < $largo; $i += count($patrones)) {
            foreach (array_keys($patrones) as $patron) {
               shuffle($patrones[$patron]);
               if ($patrones[$patron]) {
                  $password[] = $patrones[$patron][0];
                  unset($patrones[$patron][0]);
               }
            }
         }

         shuffle($password);
         return implode($password);
      }

      $password = generaPassword($largo, $patrones);

      do {
         $password = str_pad($password, $largo, $password);
         $password = substr($password, 0, $largo);
         $password = str_shuffle($password);
         $totalCaracteres++;
      } while ($totalCaracteres < $largo);

      $response["status"] = "success";
      $response["message"] = $password;
   }

   echo json_encode($response);
}