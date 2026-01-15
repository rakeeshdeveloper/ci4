<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        return view('auth/register');
    }

 public function registerPost()
{
    helper(['form']);

    $rules = [
        'name'          => 'required|min_length[3]',
        'email'         => 'required|valid_email|is_unique[users.email]',
        'password'      => 'required|min_length[6]',
        'profile_image' => 'uploaded[profile_image]|max_size[profile_image,2048]|is_image[profile_image]|mime_in[profile_image,image/jpg,image/jpeg,image/png]'
    ];

    if (! $this->validate($rules)) {
        return view('auth/register', [
            'validation' => $this->validator
        ]);
    }

    $userModel = new UserModel();

    // Handle image upload
$imageName = null;
$file = $this->request->getFile('profile_image');

if ($file && $file->isValid() && ! $file->hasMoved()) {
    // Generate a unique filename
    $imageName = $file->getRandomName();

    // Move to public/uploads
    $file->move(FCPATH . 'uploads', $imageName);
}



    // Save user
    $userModel->save([
        'name'          => $this->request->getPost('name'),
        'email'         => $this->request->getPost('email'),
        'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'profile_image' => $imageName
    ]);

    return redirect()->to('/login')->with('success', 'Registration successful');
}


    public function login()
    {
        return view('auth/login');
    }

    public function loginPost()
    {
        $userModel = new UserModel();

        $user = $userModel
            ->where('email', $this->request->getPost('email'))
            ->first();

        if (! $user) {
            return redirect()->back()->with('error', 'Email not found');
        }

        if (! password_verify($this->request->getPost('password'), $user['password'])) {
            return redirect()->back()->with('error', 'Invalid password');
        }

        session()->set([
            'user_id'   => $user['id'],
            'user_name' => $user['name'],
            'logged_in' => true,
        ]);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
