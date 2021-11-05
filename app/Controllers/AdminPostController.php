<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminPostController extends BaseController
{
	public function index()
	{
		$PostModel = model('PostModel');
		$data = [
			'posts' => $PostModel->findAll()
		];
		return view("posts/index", $data);
	}

	public function create()
	{
		session();
		$data = [
			'validation' => \Config\Services::validation()
		];
		return view("posts/create", $data);
	}

	public function store()
	{
		$valid = $this->validate([
			'judul' => [
				'label' => 'Judul',
				'rules' => 'required',
				'errors' => [
					'required' =>'{field} Harus diisi!'
				]
			],
			'slug' => [
				'label' => 'Slug',
				'rules' => 'required|is_unique[posts.slug]',
				'errors' => [
					'required' => '{field} Harus diisi!',
					'is_unique' => '{field} Sudah ada!'
				]
			],
			'kategori' => [
				'label' => 'Kategori',
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Harus diisi!'
				]
			],
			'author' => [
				'label' => 'Author',
				'rules' => 'required',
				'errors' => [
				'required' => '{field} Harus diisi!'
				]
			],
			'deskripsi' => [
				'label' => 'Deskripsi',
				'rules' => 'required',
				'errors' => [
				'required' => '{field} Harus diisi!'
			]
		]
		]);

		if($valid) {
			$data = [
				'judul' => $this->request->getVar('judul'),
				'slug' => $this->request->getVar('slug'),
				'kategori' => $this->request->getVar('kategori'),
				'author' => $this->request->getVar('author'),
				'deskripsi' => $this->request->getVar('deskripsi')
			];

			$PostModel = model("PostModel");
			$PostModel->insert($data);

			session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!!');
			return redirect()->to(base_url('admin/posts'));
		}else {
			return redirect()->to(base_url('admin/posts/create'))->withInput()->with('validation', $this->validator);
		}
	}

	public function delete($post_id)
	{
		$PostModel = model('PostModel');
		$PostModel->delete($post_id);
		session()->setFlashdata('pesan', 'Data Berhasil Dihapus!!');
		return redirect()->to(base_url('admin/posts'));
	}

	public function edit($post_id)
	{
		$PostModel = model('PostModel');
		session();
		$data = [
			'post' => $PostModel -> find($post_id)
		];
		return view("posts/edit", $data);
	}

	public function update($post_id)
	{
		$PostModel = model('PostModel');
		$data=[
			'judul' => $this->request->getPost('judul'),
			'slug' => $this->request->getPost('slug'),
			'kategori' => $this->request->getPost('kategori'),
			'author' => $this->request->getPost('author'),
			'deskripsi' => $this->request->getPost('deskripsi')
		];
		$PostModel->update($post_id, $data);
		return redirect()->to(base_url('admin/posts'))->with('pesan', 'Data Berhasil diubah!!');
	}
}