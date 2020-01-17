<?php 

  namespace App\Helpers;

  //-----------------------------------------------------
  // Helper para el uso rápido de funciones
  //

  use DB;
  use App\Models\Red;

  class Redes {

    /**
     * Funcion para encontrar y proporcionar la red de un socio en especifico
     *
     * @param  int $socio_id
     * @return red
     */
    public static function getRedSocio($socio_id){
      //socio que se mostrará su nivel
      $socio = red::where('user_id', '=', $socio_id)
              ->first();
    
      $data['nivel1'] = DB::select("SELECT t1.user_id, name, email, t1.status, t1.level, (t1.level - ?) AS nivel_relativo
        FROM red AS t1
        INNER JOIN users ON t1.user_id = users.id 
        WHERE t1.parent= ?", [ $socio['nivel'], $socio_id]);
/*
      $data['nivel2'] = DB::select("SELECT t2.user_id, name, email, t2.status, t2.level, (t2.level - ?) AS nivel_relativo 
        FROM red AS t1
        INNER JOIN red AS t2 ON t2.parent = t1.user_id
        INNER JOIN users ON t2.user_id = users.id 
        WHERE t1.parent= ?", [ $socio['nivel'], $socio_id]);

      $data['nivel3'] = DB::select("SELECT  t3.user_id, name, email, t3.status, t3.level , (t3.level - ?) AS nivel_relativo 
        FROM red AS t1
        INNER JOIN red AS t2 ON t2.parent = t1.user_id
        INNER JOIN red AS t3 ON t3.parent = t2.user_id
        INNER JOIN users ON t3.user_id = users.id 
        WHERE t1.parent= ?", [ $socio['nivel'], $socio_id]);

      $data['nivel4'] = DB::select("SELECT t4.user_id, name, email, t4.status, t4.level, (t4.level - ?) AS nivel_relativo 
        FROM red AS t1
        INNER JOIN red AS t2 ON t2.parent = t1.user_id
        INNER JOIN red AS t3 ON t3.parent = t2.user_id
        INNER JOIN red AS t4 ON t4.parent = t3.user_id
        INNER JOIN users ON t4.user_id = users.id 
        WHERE t1.parent= ?", [ $socio['nivel'], $socio_id]);
*/
      $data['socio'] = $socio;
      return $data;

    }

    public static function getComisionSocio($socio_id){
      
      
      $nivel1= DB::select("SELECT sum(price) as comision
        FROM red AS t1
        INNER JOIN user_courses ON t1.user_id = user_courses.user_id
        INNER JOIN courses ON course_id = courses.id
        WHERE t1.parent= ? AND user_courses.status=1", [ $socio_id]);
      $data[1] = $nivel1[0]->comision;

/*
      $nivel2 = DB::select("SELECT sum(price) as comision
        FROM red AS t1
        INNER JOIN red AS t2 ON t2.parent = t1.user_id
        INNER JOIN user_courses ON t2.user_id = user_courses.user_id
        INNER JOIN courses ON course_id = courses.id
        WHERE t1.parent= ? AND user_courses.status=1", [$socio_id]);
      $data[2] = $nivel2[0]->comision;

      $nivel3 = DB::select("SELECT sum(price) as comision
        FROM red AS t1
        INNER JOIN red AS t2 ON t2.parent = t1.user_id
        INNER JOIN red AS t3 ON t3.parent = t2.user_id
        INNER JOIN user_courses ON t3.user_id = user_courses.user_id
        INNER JOIN courses ON course_id = courses.id
        WHERE t1.parent= ? AND user_courses.status=1", [$socio_id]);
      $data[3] = $nivel3[0]->comision;

      $nivel4 = DB::select("SELECT  sum(price) as comision
        FROM red AS t1
        INNER JOIN red AS t2 ON t2.parent = t1.user_id
        INNER JOIN red AS t3 ON t3.parent = t2.user_id
        INNER JOIN red AS t4 ON t4.parent = t3.user_id
        INNER JOIN user_courses ON t4.user_id = user_courses.user_id
        INNER JOIN courses ON course_id = courses.id
        WHERE t1.parent= ? AND user_courses.status=1", [$socio_id]);
      $data[4] = $nivel4[0]->comision;
*/
      return $data;
    }

    public static function getCursosSocio($socio_id){
      
      
      $nivel1= DB::select("SELECT count(courses.name) as cursos
        FROM red AS t1
        INNER JOIN user_courses ON t1.user_id = user_courses.user_id
        INNER JOIN courses ON course_id = courses.id
        WHERE t1.parent= ? AND user_courses.status=1", [ $socio_id]);
      $data[1] = $nivel1[0]->cursos;

/*
      $nivel2 = DB::select("SELECT count(courses.name) as cursos
        FROM red AS t1
        INNER JOIN red AS t2 ON t2.parent = t1.user_id
        INNER JOIN user_courses ON t2.user_id = user_courses.user_id
        INNER JOIN courses ON course_id = courses.id
        WHERE t1.parent= ? AND user_courses.status=1", [$socio_id]);
      $data[2] = $nivel2[0]->cursos;

      $nivel3 = DB::select("SELECT count(courses.name) as cursos
        FROM red AS t1
        INNER JOIN red AS t2 ON t2.parent = t1.user_id
        INNER JOIN red AS t3 ON t3.parent = t2.user_id
        INNER JOIN user_courses ON t3.user_id = user_courses.user_id
        INNER JOIN courses ON course_id = courses.id
        WHERE t1.parent= ? AND user_courses.status=1", [$socio_id]);
      $data[3] = $nivel3[0]->cursos;

      $nivel4 = DB::select("SELECT  count(courses.name) as cursos
        FROM red AS t1
        INNER JOIN red AS t2 ON t2.parent = t1.user_id
        INNER JOIN red AS t3 ON t3.parent = t2.user_id
        INNER JOIN red AS t4 ON t4.parent = t3.user_id
        INNER JOIN user_courses ON t4.user_id = user_courses.user_id
        INNER JOIN courses ON course_id = courses.id
        WHERE t1.parent= ? AND user_courses.status=1", [$socio_id]);
      $data[4] = $nivel4[0]->cursos;
*/
      return $data;
    }
    
  }
?>