<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tisses extends Model
{
    protected $fillable = [
        'id',
        'cod_operadora', //cnpj da empresa, ex Elifas - ok
        'num_guia',//numero da guia - ok
        'nome_executante', //nome da empresa, ex Laboratorio Mult-Test - ok
        'cnes', //code do lab no Cadastro Nacional de Estabelecimentos de Saúde - oks
        'tipo_atendimento', //exame, consulta - ok
        'indica_acidente', //ex acidente no trabalho - ok
        'indica_saida', //ok
        'tipo_consulta', //ex pre natal
        'ans', // registro da empresa na ans - ok
        'patient_id', //id do paciente
        'nome_paciente', //nome do paciente q sera gerado a guia - ok
        'rescem_nascido', //- ok
        'num_carteira', //numero da carteira do plano do paciente - ok
        'validade_carteira', // validade da carteira do plano do paciente - ok
        'cns', //conselho nacional de saude - ok
        'plano', // plano do paciente dentro do convenio, ex plano basico, executivo - ok
        'crm', //codigo do medico na operadora -ok
        'medical_id', // id do medco q solicitou a guia - ok
        'conselho', // se e crm, crf, crv... - ok
        'num_conselho', //numero do medico no conselho escolhido - ok
        'cbos', // codigo da especialidade do medico - ok
        'data_solicita', //data da solicitação - ok
        'uf_conselho', //uf do conselho escolhido - ok
        'carater_internacao',// eletivo ou emerencia - ok
        'obs', //obs sobre a guia - ok







    ];

    public $timestamps = true;

    public function patient()
    {
        return $this->hasMany(\App\Patient::class, 'patient_id');
    }

    public function medic()
    {
        return $this->belongsTo(\App\Medic::class,'medical_id');
    }

}

