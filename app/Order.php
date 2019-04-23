<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'city_id',
        'patient_id',
        'date',
        'medic_id',
        'form',
        'user_id',
        'value',
        'clinic_id',
        'protocol',
        'covenant_id',
        'type_id',
        'value_entry',
        'delivery',
        'dt_retire',
        'states_id',
        'qtd',
        'status',
        'entregue',
        'delivery_person',
        'delivery_user',
        'id_unity',
    ];

    public $timestamps = true;

    public function delivery()
    {
        return $this->belongsTo(\App\Delivery::class);
    }

    public function state()
    {
        return $this->belongsTo(\App\State::class);
    }

    public function patient()
    {
        return $this->belongsTo(\App\Patient::class);
    }

    public function medic()
    {
        return $this->belongsTo(\App\Medic::class);
    }

    public function clinic()
    {
        return $this->belongsTo(\App\Clinic::class);
    }

    public function covenant()
    {
        return $this->belongsTo(\App\Covenant::class);
    }

    public function city()
    {
        return $this->belongsTo(\App\City::class);
    }

    public function type()
    {
        return $this->belongsTo(\App\Type::class);
    }

    public function reports()
    {
        return $this->hasMany(\App\Report::class, 'order_article_id');
    }

    public function exams()
    {
        return $this->belongsTo(\App\Exam::class);
    }

    public function values(){
        return $this->belongsToMany(\App\Value::class);
    }

    public function filial(){
        return $this->belongsTo(\App\Unitys::class);
    }
}
