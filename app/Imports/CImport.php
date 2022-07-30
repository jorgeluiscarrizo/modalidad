<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
//use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Carbon\Carbon;

class CImport implements ToModel, WithHeadingRow
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //dd($row);
        return new Customer([

            'nro_agencia' => $row['nro_agencia'],
            'departamento' => $row['departamento'],
            'agencia' => $row['agencia'],
            'codigo_agenda' => $row['codigo_agenda'],
            'tipo_cliente' => $row['tipo_cliente'],
            'tipo_de_cliente' => $row['tipo_de_cliente'],
            'nombre_completo' => $row['nombre_completo'],
            'nombres' => $row['nombres'],
            'primer_apellido' => $row['primer_apellido'],
            'segundo_apellido' => $row['segundo_apellido'],
            'apellido_del_esposo' => $row['apellido_del_esposo'],
            'nacionalidad' => $row['nacionalidad'],
            'pais_de_procedencia' => $row['pais_de_procedencia'],
            'tipo_doc' => $row['tipo_doc'],
            'ci_completo' => $row['ci_completo'],
            'nro_doc' => $row['nro_doc'],
            'ext' => $row['ext'],
            'nit' => $row['nit'],
            'fecha_nac' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_nac']),
            'lugar_nac' => $row['lugar_nac'],
            'estado_civil' => $row['estado_civil'],
            'genero' => $row['genero'],
            'nombre_conyuge' => $row['nombre_conyuge'],
            'actividad_conyuge' => $row['actividad_conyuge'],
            'celular_conyuge' => $row['celular_conyuge'],
            'cordenadas_domicilio' => $row['cordenadas_domicilio'],
            'direccion_domicilio' => $row['direccion_domicilio'],
            'cordenadas_negocio' => $row['cordenadas_negocio'],
            'direccion_negocio' => $row['direccion_negocio'],
            'fono_dom' => $row['fono_dom'],
            'fono_ofic' => $row['fono_ofic'],
            'celular' => $row['celular'],
            'correo' => $row['correo'],
            'profesion' => $row['profesion'],
            'codigo_actividad' => $row['codigo_actividad'],
            'actividad' => $row['actividad'],
            'detalle_actividad' => $row['detalle_actividad'],
            'lugar_trabajo' => $row['lugar_trabajo'],
            'cargo' => $row['cargo'],
            'ingreso_fijo' => $row['ingreso_fijo'],
            'ingreso_variable' => $row['ingreso_variable'],
            'ingreso_por_ventas' => $row['ingreso_por_ventas'],
            'moneda_ingreso' => $row['moneda_ingreso'],
            'monto_ingreso' => $row['monto_ingreso'],
            'monto_ingreso_sus' => $row['monto_ingreso_sus'],
            'fecha_ingreso' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_ingreso']),
            'telefono_ref' => $row['telefono_ref'],
            'celular_ref' => $row['celular_ref'],
            'tipo_riesgo' => $row['tipo_riesgo'],
            'fecha_registro_sistema' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_registro_sistema']),
            'fecha_modificacion_sistema' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_modificacion_sistema']),
            'nro_de_credito' => $row['nro_de_credito'],
            'nro_prestamo_individual' => $row['nro_prestamo_individual'],
            'estado' => $row['estado'],
            'fdesem' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fdesem']),
            'desembolso' => $row['desembolso'],
            'saldo' => $row['saldo'],
            'nombre_asesor_de_cliente' => $row['nombre_asesor_de_cliente'],
            'digitador_cliente' => $row['digitador_cliente'],
            'digitador_credito' => $row['digitador_credito'],

            'state' => 'ACTIVE'

            /*
            'nro_agencia' => $row[0],
            'departamento' => $row[1],
            'agencia' => $row[2],
            'codigo_agenda' => $row[3],
            'tipo_cliente' => $row[4],
            'tipo_de_cliente' => $row[5],
            'nombre_completo' => $row[6],
            'nombres' => $row[7],
            'primer_apellido' => $row[8],
            'segundo_apellido' => $row[9],
            'apellido_del_esposo' => $row[10],
            'nacionalidad' => $row[11],
            'pais_de_procedencia' => $row[12],
            'tipo_doc' => $row[13],
            'ci_completo' => $row[14],
            'nro_doc' => $row[15],
            'ext' => $row[16],
            'nit' => $row[17],

            'fecha_nac' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[18]),

            'lugar_nac' => $row[19],
            'estado_civil' => $row[20],
            'genero' => $row[21],
            'nombre_conyuge' => $row[22],
            'actividad_conyuge' => $row[23],
            'celular_conyuge' => $row[24],
            'cordenadas_domicilio' => $row[25],

            'direccion_domicilio' => $row[26],
            'cordenadas_negocio' => $row[27],
            'direccion_negocio' => $row[28],
            'fono_dom' => $row[29],
            'fono_ofic' => $row[30],
            'celular' => $row[31],
            'correo' => $row[32],
            'profesion' => $row[33],
            'codigo_actividad' => $row[34],
            'actividad' => $row[35],
            'detalle_actividad' => $row[36],
            'lugar_trabajo' => $row[37],
            'cargo' => $row[38],
            'ingreso_fijo' => $row[39],
            'ingreso_variable' => $row[40],
            'ingreso_por_ventas' => $row[41],
            'moneda_ingreso' => $row[42],
            'monto_ingreso' => $row[43],
            'monto_ingreso_sus' => $row[44],

            'fecha_ingreso' =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[45]),

            'telefono_ref' => $row[46],
            'celular_ref' => $row[47],
            'tipo_riesgo' => $row[48],

            'fecha_registro_sistema' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[49]),
            'fecha_modificacion_sistema' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[50]),

            'nro_de_credito' => $row[51],

            'nro_prestamo_individual' => $row[52],
            'estado' => $row[53],

            'fdesem' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[54]),

            'desembolso' => $row[55],
            'saldo' => $row[56],
            'nombre_asesor_de_cliente' => $row[57],
            'digitador_cliente' => $row[58],
            'digitador_credito' => $row[59],

            'state' => 'ACTIVE'

            */
        ]);
    }
}
