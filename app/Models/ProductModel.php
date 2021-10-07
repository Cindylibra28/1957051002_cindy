<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class ProductModel extends Model
{
    protected $table = "product";
 
    public function getProduct($id = false)
    {
        if($id === false){
            return $this->table('products')
                        ->get()
                        ->getResultArray();
        } else {
            return $this->table('products')
                        ->where('product_id', $id)
                        ->get()
                        ->getRowArray();
        }   
    } 
}