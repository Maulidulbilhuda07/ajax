<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_m extends CI_Controller
{
	public function get($id = null)
	{
		$this->db->select('*');
		$this->db->from('barang');
		if ($id != null) {
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	public function save($post)
	{
		$data = [
			'name' => $post['name'],
			'description' => $post['description'],
		];
		$this->db->insert('barang', $data);
	}
	public function update($post)
	{
		$data = [
			'name' => $post['name_edit'],
			'description' => $post['description_edit'],
		];
		$this->db->where('id', $post['id_edit']);
		$this->db->update('barang', $data);
	}
	public function delete($post)
	{
		$this->db->where('id', $post['id_hapus']);
		$this->db->delete('barang');
	}
}
