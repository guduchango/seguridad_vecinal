<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        //Aca se van ingresando todas las tablas para truncarlas
        //siempre antes de arrancar un seeder se truncara se reiniciara el id y la tabla estara como
        //el principio
        /*DB::table('provincias')->truncate();
*/
        $faker = Faker\Factory::create();

        /*for ($i = 0; $i < 25; $i++) {
            DB::table('provincias')->insert(
                array(
                    'pro_nombre' => $faker->lastName
                ));
        }*/


        //array provincias con los que se llenara la tabla
        $provincias = array(
            'Buenos Aires',
            'Catamarca',
            'Chaco',
            'Chubut',
            'Córdoba',
            'Corrientes',
            'Entre Ríos',
            'Formosa',
            'Jujuy',
            'La Pampa',
            'La Rioja',
            'Mendoza',
            'Misiones',
            'Neuquén',
            'Río Negro',
            'Salta',
            'San Juan',
            'San Luis',
            'Santa Cruz',
            'Santa Fe',
            'Santiago del Estero',
            'Tierra del Fuego',
            'Tucumán');
        //bucle que recorre el array para ir insertando en la tabla provincias
        foreach ($provincias as $var => $key) {
            DB::table('provincias')->insert(
                array(
                    'pro_nombre' => strtolower($key)
                ));
        }

         $localidades = array(
             'capital' => '1',
             'general alvear' => '1',
             'godoy cruz' => '1',
             'guaymallen' => '1',
             'junin' => '1',
             'la paz' => '1',
             'las heras' => '1',
             'lavalle' => '1',
             'lujan de cuyo' => '1',
             'maipu' => '1',
             'malargue' => '1',
             'rivadavia' => '1',
             'san carlos' => '1',
             'san martin' => '1',
             'santa rosa' => '1',
             'tunuyan' => '1',
             'tupungato' => '1',
         );

         //alimentar tabla localidades
         foreach ($localidades as $key => $value) {
             DB::table('localidades')->insert(
                 array(
                     'loc_nombre' => $key,
                     'loc_pro_id' => $value
                 ));
         }

         /*
         $configueracion1 = array(
             'con_nombre' => 'General',
             'con_credito_maximo' => '5',
             'con_dias_vencimiento' => '45',
             'con_tna' => '160',
             'con_detalle' => 'Configuración para personas en general'
         );
         $configueracion2 = array(
             'con_nombre' => 'Especial',
             'con_credito_maximo' => '5',
             'con_dias_vencimiento' => '45',
             'con_tna' => '50',
             'con_detalle' => 'Configuración especial 50% menos'
         );
         $configueracion3 = array(
             'con_nombre' => 'Amigos',
             'con_credito_maximo' => '20',
             'con_dias_vencimiento' => '45',
             'con_tna' => '0.1',
             'con_detalle' => 'No se cobra interes'
         );

         //alimentar tabla configuracioens
         DB::table('configuraciones')->insert($configueracion1);
         DB::table('configuraciones')->insert($configueracion2);
         DB::table('configuraciones')->insert($configueracion3);

         //alimentar cuentas_bancos
         $cuenta_banco = array(
             'cb_nombre' => 'Daniel totoras',
             'cb_sucursal' => '3300',
             'cb_cuenta_tipo' => '10',
             'cb_cuenta_numero' => '4851227605'
         );

         DB::table('cuentas_bancos')->insert($cuenta_banco);

*/
         
         for ($i = 0; $i < 25; $i++) {
             DB::table('clientes')->insert(
                 array(
                     'cli_razon_social' => $faker->firstName,
                     'cli_domicilio' => $faker->streetName,
                     'cli_cuit' => $faker->unixTime,
                     'cli_reg_id' => 'responsable inscripto',
                     'cli_telefono' => $faker->phoneNumber,
                     'cli_email'=> $faker->email,
                     /*
                     'cli_dni_tipo' => 'dni',
                     'cli_dni_numero' => $faker->unixTime,
                     'cli_cuit_tipo' => 'cuit',
                     'cli_fecha_nacimiento' => $faker->date($format = 'Y-m-d'),
                     'cli_nacionalidad' => 'argentino',
                     'cli_estado_civil' => 'soltero',
                     'cli_sexo' => 'masculino',
                     'cli_hijo' => '4',
                     'cli_cbu' => $faker->numberBetween($min = 4123456789, $max = 4555555555),
                     'cli_sucursal' => '3300',
                     'cli_cuenta_tipo' => 'ca',
                     'cli_estado' => 'alta'*/
                 ));
         }

             /*

             DB::table('clientes_domicilio')->insert(
                 array(
                     'clidom_cli_id' => $i + 1,
                     'clidom_calle' => $faker->streetName,
                     'clidom_calle_numero' => $faker->buildingNumber,
                     'clidom_piso' => $faker->buildingNumber,
                     'clidom_departamento' => '2',
                     'clidom_pro_id' => '2',
                     'clidom_loc_id' => '2',
                     'clidom_telefono_fijo' => $faker->phoneNumber,
                     'clidom_telefono_celular' => $faker->phoneNumber,
                     'clidom_email' => $faker->email,
                     'clidom_donde_vive' => $faker->streetName,
                     'clidom_importe_mensual_tipo' => '5000',
                     'clidom_importe_mensual_monto' => '8000',
                     'clidom_tiempo_domicilio' => '2',
                     'clidom_propietario_inmueble' => $faker->name,
                     'clidom_situacion_inmueble' => 'Hipoteca',
                     'clidom_propietario_vehiculo' => $faker->name
                 ));


             DB::table('clientes_domicilio_anterior')->insert(
                 array(
                     'cliant_cli_id' => $i + 1,
                     'cliant_calle' => $faker->streetName,
                     'cliant_calle_numero' => $faker->buildingNumber,
                     'cliant_piso' => $faker->buildingNumber,
                     'cliant_departamento' => '2',
                     'cliant_pro_id' => '2',
                     'cliant_loc_id' => '2',
                     'cliant_codigo_postal' => $faker->postcode,
                 ));


             DB::table('clientes_laboral')->insert(
                 array(
                     'clilab_cli_id' => $i + 1,
                     'clilab_actividad' => $faker->city,
                     'clilab_nombre_empresa_profesion' => $faker->city,
                     'clilab_fecha_ingreso_empresa' => $faker->date($format = 'Y-m-d'),
                     'clilab_tipo_empresa_profesion' => $faker->city,
                     'clilab_puesto' => $faker->city,
                     'clilab_puesto_monto' => '6000',
                     'clilab_otra_fuente_monto' => '8000',
                     'clilab_tel_fijo' => '123-123131',
                     'clilab_cuit_empresa' => '202898138111',
                     'clilab_domicilio_laboral_numero' => 'alguna calle 225',
                     'clilab_pro_id' => '2',
                     'clilab_loc_id' => '2'
                 ));



             DB::table('clientes_garante')->insert(
                 array(
                     'cligar_cli_id' => $i + 1,
                     'cligar_apellido' => $faker->lastName,
                     'cligar_nombre' => $faker->firstName,
                     'cligar_calle' => $faker->streetName,
                     'cligar_dni_tipo' => "DNI",
                     'cligar_dni_numero' => 262652514,
                     'cligar_calle_numero' => $faker->buildingNumber,
                     'cligar_piso' => $faker->buildingNumber,
                     'cligar_departamento' => '5',
                     'cligar_pro_id' => '2',
                     'cligar_loc_id' => '2',
                     'cligar_telefono_fijo' => $faker->phoneNumber,
                     'cligar_telefono_celular' => $faker->phoneNumber,
                     'cligar_email' => $faker->email,
                     'cligar_donde_vive' => $faker->streetName,
                     'cligar_importe_mensual_tipo' => '2500',
                     'cligar_importe_mensual_monto' => '2700',
                     'cligar_tiempo_domicilio' => '2',
                     'cligar_propietario_inmueble' => $faker->firstName,
                     'cligar_situacion_inmueble' => '',
                     'cligar_propietario_vehiculo' => $faker->firstName
                 ));

             DB::table('clientes_conyuge')->insert(
                 array(
                     'clicon_cli_id' => $i + 1,
                     'clicon_apellido' => $faker->lastName,
                     'clicon_nombre' => $faker->firstName,
                     'clicon_dni_tipo' => 'dni',
                     'clicon_dni_numero' => $faker->unixTime,
                     'clicon_fecha_nacimiento' => '',
                     'clicon_nacionalidad' => 'argentino',
                     'clicon_actividad' => 'Gerente',
                     'clicon_ingreso_mensual' => '70000',
                     'clicon_propietario_inmueble' => $faker->lastName,
                     'clicon_propietario_vehiculo' => $faker->lastName,
                 ));
         }

         //Alimentar la table creditos

         for ($i = 0; $i < 40; $i++) {

             $estado = $faker->randomElement($array = array('pendiente', 'confirmado', 'cancelado'));
             $capital = $faker->randomElement($array = array('2000', '2500', '3000', '3500', '1500', '500', '700', '1600', '3600', '1000', '1200'));
             $cuotas = $faker->numberBetween($min = 3, $max = 10);
             $dias_vencimiento = 45;
             $tna = 160;
             $fecha_credito = date('Y-m-d', strtotime('-' . mt_rand(0, 12) . ' days'));
             $cli_id = $faker->numberBetween($min = 1, $max = 80);




             DB::table('creditos')->insert(
                 array(
                     'cre_fecha' => $fecha_credito,
                     'cre_numero_asignado' => $i,
                     'cre_capital' => $capital,
                     'cre_cuotas' => $cuotas,
                     'cre_estado' => $estado,
                     'cre_detalle' => $faker->paragraph($nbSentences = 3),
                     'cre_cli_id' => $cli_id,
                     'cre_con_id' => 1,
                     'cre_fiscal' => Crehelper::capital_fiscal($capital, $cuotas)
                 ));

             $cre_id = DB::getPdo()->lastInsertId();

             $cuotas_list = Crehelper::calcular_cuotas($capital, $cuotas, $dias_vencimiento, $tna, $fecha_credito, 'actual');

             foreach ($cuotas_list as $var) {

                 DB::table('cuotas')->insert(
                     array(
                         'cuo_numero' => $var['cuota'],
                         'cuo_capital' => $var['capital'],
                         'cuo_intereses' => $var['intereses'],
                         'cuo_iva' => $var['iva_field'],
                         'cuo_capital_ajustado' => $var['capital_ajustado'],
                         'cuo_cuota_sin_iva' => $var['cuotas_sin_iva'],
                         'cuo_cuota_con_iva' => $var['cuota_con_iva'],
                         'cuo_cuota_modificada' => round($var['cuota_modificada'], 0) . ".99",
                         'cuo_amortizacion_periodo' => $var['amortizacion_periodo'],
                         'cuo_cuota_acumulado' => $var['amortizacion_acumulado'],
                         'cuo_saldo_deuda' => $var['saldo_deuda'],
                         'cuo_seguro_vida' => $var['seguro_vida'],
                         'cuo_seguro_iva' => $var['seguro_iva'],
                         'cuo_cuota_sin_iva_vida' => $var['cuota_sin_iva_vida'],
                         'cuo_cuota_con_iva_vida' => $var['cuota_con_iva_vida'],
                         'cuo_capital_fiscal' => $var['capital_fiscal'],
                         'cuo_interes_fiscal' => $var['interes_fiscal'],
                         'cuo_interes_fiscal_iva' => $var['interes_fiscal_iva'],
                         'cuo_fecha_vencimiento' => $var['fecha_vencimiento'],
                         'cuo_cre_id' => $cre_id,
                         'cuo_cli_id' => $cli_id,
                     ));
             }
         }


         //alimentar tabla pagos
         for ($i = 0; $i < 190; $i++) {

             $estado = $faker->randomElement($array = array('realizado', 'realizado', 'realizado','bloqueado', 'mayor_al_disponible'));//, 'bloqueado', 'mayor_al_disponible'
             //$pag_cli_id = $faker->numberBetween($min = 1, $max = 100);
             //$query_credito = sprintf("select * from creditos where ")
             $query = "select * from cuotas inner join clientes on cuo_cli_id = cli_id order by rand() limit 1;";
             $var = DB::select($query);
             $cuo_fecha_vencimiento = $var[0]->cuo_fecha_vencimiento;
             $cuo_fecha_vencimiento = $cuo_fecha_vencimiento[5] . $cuo_fecha_vencimiento[6];



             $query = sprintf("select *, (cuo_id) as count from cuotas inner join clientes on cli_id = cuo_cli_id where cli_cbu='%s' and cuo_cuota_modificada=%s", $var[0]->cli_cbu, $var[0]->cuo_cuota_modificada);
             $row = DB::select($query);

             if (!empty($row)) {
                 $query = sprintf("select  count(pag_id) as count from pagos where pag_cli_id = %s and pag_monto = %s AND pag_cuo_id = '%s';  ", $row[0]->cli_id, $row[0]->cuo_cuota_modificada, $row[0]->cuo_id);


                 $row_pago = DB::select($query);

                 $pag_monto = 0;


                 if ($estado == 'realizado') {
                     $pag_monto = $row[0]->cuo_cuota_modificada;
                     $pag_cuo_id = $row[0]->cuo_id;
                 } else {
                     $pag_monto = 0;
                     $pag_cuo_id = 0;
                 }


                 if ($row_pago[0]->count == 0) {
                     DB::table('pagos')->insert(
                         array(
                             'pag_cli_id' => $row[0]->cuo_cli_id,
                             'pag_cre_id' => $row[0]->cuo_cre_id,
                             'pag_cuo_id' => $pag_cuo_id,
                             'pag_factura_numero' => $i,
                             'pag_fecha' => date('Y-m-d', strtotime('-' . mt_rand(0, 60) . ' days')),
                             'pag_estado' => $estado,
                             'pag_monto' => $pag_monto,
                             'pag_detalle' => $faker->paragraph($nbSentences = 3)
                         ));
                 }
             }
         }



         //alimentar tabla usuarios
         for ($i = 0; $i < 10; $i++) {
             DB::table('usuarios')->insert(
                 array(
                     'usu_nombre' => $faker->lastName,
                     'usu_rol' => 'admin',
                     'usu_clave' => $faker->unixTime
                 ));
         }

         DB::table('users')->insert(
             array(
                 'username' => 'admin',
                 'rol' => 'admin',
                 'password' => Hash::make('123456')
             ));

         DB::table('users')->insert(
             array(
                 'username' => 'user',
                 'rol' => 'user',
                 'password' => Hash::make('123456')
             ));

         DB::table('users')->insert(
             array(
                 'username' => 'root',
                 'rol' => 'root',
                 'password' => Hash::make('123456')
             ));*/
         
          

	}

}
