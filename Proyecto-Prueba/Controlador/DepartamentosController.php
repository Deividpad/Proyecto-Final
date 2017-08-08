<?php

/**
 * Created by PhpStorm.
 * User: Equipo13
 * Date: 25/07/2017
 * Time: 14:08
 */
class DepartamentosController
{

    static public function SelectDepartamentos ($isRequired=true, $id="idDepartamentos", $nombres="idDepartamentos", $class=""){
        $arrayDepartamentos = departamentos::getAll(); /*  */
        $htmlSelect = "";
        $htmlSelect .= "<select ".(($isRequired) ? "required" : "")." id= '".$id."' name='".$nombres."' class='".$class."'>";

        if (count($arrayDepartamentos)>=1) {
            foreach ($arrayDepartamentos as $ObjDepartamentos) {
                $htmlSelect .= "<option value='" . $ObjDepartamentos->getIdDepartamentos() . "' id='" . $ObjDepartamentos->getIdDepartamentos() . "'>" . $ObjDepartamentos->getDepartamentos() . "</option>";;
            }
            $htmlSelect .= "</select>";
            return $htmlSelect;
        }else {
            $htmlSelect .= "<option>No hay Departamentos Disponibles</option>";
            $htmlSelect .= "</select>";
            return $htmlSelect;
        }
    }
}