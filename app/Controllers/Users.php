<?php namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
	public function index()
	{
			$data = [];
		helper(['form']);

		if($this->request->getMethod() == 'post') {

			$rules = [
				'email' => 'required|min_length[6]|max_length[50]|valid_email',
				'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
				
			];

			$errors = [
				'password' => [
					'validateUser' => 'Email or Password don\'t match'
				]
			];

			if(! $this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new UserModel();

				$user = $model->where('email', $this->request->getvar('email'))
							->first();

				$this->setUserSession($user);
				//$session->setFlashdata('success', 'Successfully LoggedIn')
				return redirect()->to('dashboard');			
			}
		}


		echo view('templates/header', $data);
		echo view('login');
		echo view('templates/footer');


	}

	private function setUserSession($user){
		$data = [
			'id' => $user['id'],
			'firstname' => $user['firstname'],
			'lastname' => $user['lastname'],
			'email' => $user['email'],
			'isLoggedIn' => true,

		];

		session()->set($data);
		return true;
	}


	public function register(){
		$data = [];
		helper(['form']);

		if($this->request->getMethod() == 'post') {

			$rules = [
				'firstname' => 'required|min_length[3]|max_length[20]',
				'lastname' => 'required|min_length[3]|max_length[20]',
				'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
				'password' => 'required|min_length[8]|max_length[255]',
				'password_confirm' => 'matches[password]',
			];

			if(!$this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new UserModel();

				$newData = [
					'firstname' => $this->request->getvar('firstname'),
					'lastname' => $this->request->getvar('lastname'),
					'email' => $this->request->getvar('email'),
					'password' => $this->request->getvar('password'),
				];
				$model->save($newData);
				$session = session();
				$session->setFlashdata('success', 'Successfully Registration');
				return redirect()->to('/');
			}
		}
		echo view('templates/header', $data);
		echo view('register');
		echo view('templates/footer');


	}

	//--------------------------------------------------------------------

}
