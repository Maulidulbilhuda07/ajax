<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function getbarang()
	{
		$data = $this->Barang_m->get()->result();
		echo json_encode($data);
	}
	public function save()
	{
		$post = $this->input->post(null, true);
		$data = $this->Barang_m->save($post);
		echo json_encode($data);
	}
	public function update()
	{
		$post = $this->input->post(null, true);
		$data = $this->Barang_m->update($post);
		echo json_encode($data);
	}
	public function barangid($id)
	{
		$data = $this->Barang_m->get($id)->row();
		echo json_encode($data);
	}
	public function delete()
	{
		$post = $this->input->post(null, true);
		$data = $this->Barang_m->delete($post);
		echo json_encode($data);
	}
}
