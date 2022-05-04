<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;
    protected $fillable = ['value'];


    public function speciesGroupRecordingLevel()
    {
        return $this->hasMany('App\Models\MethodSpeciesgroupRecordinglevel', 'method_id', 'id');
    }
    public function getSpeciesGroupRecordingLevel($speciesgroup_id)
    {
        return $this->speciesGroupRecordingLevel()->where('speciesgroup_id', $speciesgroup_id)->first();
    }
    public static function getMethod($methodSpeciesgroups)
    {
        $value = "";
        foreach(\App\Models\Speciesgroup::all() as $theId)
        {
            $value .= "3"; //initialize at 3 for fun (or because recording level 3 = none (not recorded))
        }
        foreach($methodSpeciesgroups as $msg)
        {
            $recLevel = $msg->recordinglevel_id;
            $value = substr_replace($value, $recLevel, $msg->speciesgroup_id-1, 1);
        }

        $method = \App\Models\Method::where('value', $value)->first();
        if ($method == null)
        {
            $method = \App\Models\Method::create(['value'=>$value]);
            foreach($methodSpeciesgroups as $msg)
            {
                \App\Models\MethodSpeciesgroupRecordinglevel::create(['method_id' => $method->id, 'speciesgroup_id' => $msg->speciesgroup_id, 'recordinglevel_id' => $msg->recordinglevel_id]);
            }
        }
        return $method;
    }
}
