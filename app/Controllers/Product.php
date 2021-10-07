<?php 
 
namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\ProductModel;
 
class Product extends Controller
{
 
    public function __construct() {
 
        // Mendeklarasikan class ProductModel menggunakan $this->product
        $this->product = new ProductModel();
        /* Catatan:
        Apa yang ada di dalam function construct ini nantinya bisa digunakan
        pada function di dalam class Product 
        */
    }
 
    public function index()
    {
        $data['product'] = $this->product->getProduct();
        echo view('product/index', $data);
    } 
}