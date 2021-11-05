<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
	protected $table                = 'posts';
	protected $primaryKey           = 'post_id';
	protected $allowedFields        = ['judul', 'deskripsi', 'gambar', 'author', 'kategori', 'slug', 'created_at', 'updated_at'];
	protected $useTimestamps        = true;
	public function getPosts($id = false)
    {
        if($id === false){
            return $this->table('posts')
                        ->get()
                        ->getResultArray();
        } else {
            return $this->table('posts')
                        ->where('post_id', $id)
                        ->get()
                        ->getRowArray();
        }   
	}
}