<?php 

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $allowedFields = false;

    public function dataget($table,$namakolom = null,$tipe=null)
    {
        if($namakolom != null && $tipe != null) {
            $result = $this->db->table($table)->orderBy($namakolom, $tipe)->get();
        } else {
            $result = $this->db->table($table)->get();
        }
        return $result;
    }

    public function datainsert($table,$arrayData,$where = null)
    {
        if(!empty($where)){
            $result = $this->db->table($table)->where($where)->insert($arrayData);
        } else {
            $result = $this->db->table($table)->insert($arrayData);
        }
        return $result;
    }

    public function dataupdate($table,$arrayData,$where)
    {
        return $this->db->table($table)->update($arrayData,$where);
    }

    public function datadelete($table,$where)
    {
       return $this->db->table($table)->where($where)->delete();
    }

    public function dataempty($table)
    {
        return $this->db->table($table)->truncate();
    }

    public function datagetWhere($table,$where , $namakolom = null)
    {
        $query = $this->db->table($table);

        foreach ($where as $column => $value) {
            if(is_array($value)){
                $query->whereIn($column,$value);
            }else {
                $query->where($column,$value);
            }
        }   

        if(empty($namakolom)){
            return $query->get();
        } else {
            return $query->orderBy($namakolom,'DESC')->get();
        }
    }
}