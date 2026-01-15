<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // List all users
    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        return view('users/index', $data);
    }

    // Show create user form
    public function create()
    {
        return view('users/create');
    }

    // Save new user
    public function store()
    {
        helper(['form']);

        $rules = [
            'name'     => 'required|min_length[3]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'profile_image' => 'permit_empty|is_image[profile_image]|max_size[profile_image,2048]|mime_in[profile_image,image/jpg,image/jpeg,image/png]'
        ];

        if (! $this->validate($rules)) {
            return view('users/create', ['validation' => $this->validator]);
        }

        // Handle image
        $imageName = null;
        if ($file = $this->request->getFile('profile_image')) {
            if ($file->isValid() && ! $file->hasMoved()) {
                $imageName = $file->getRandomName();
                $file->move(FCPATH . 'uploads', $imageName);
            }
        }

        $this->userModel->save([
            'name'          => $this->request->getPost('name'),
            'email'         => $this->request->getPost('email'),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'profile_image' => $imageName
        ]);

        return redirect()->to('/users')->with('success', 'User created successfully');
    }

    // Show edit form
    public function edit($id)
    {
        $data['user'] = $this->userModel->find($id);
        return view('users/edit', $data);
    }

    // Update user
    public function update($id)
    {
        helper(['form']);

        $rules = [
            'name'     => 'required|min_length[3]',
            'email'    => 'required|valid_email',
            'profile_image' => 'permit_empty|is_image[profile_image]|max_size[profile_image,2048]|mime_in[profile_image,image/jpg,image/jpeg,image/png]'
        ];

        if (! $this->validate($rules)) {
            $data['user'] = $this->userModel->find($id);
            return view('users/edit', array_merge($data, ['validation' => $this->validator]));
        }

        $user = $this->userModel->find($id);

        // Handle new image
        $imageName = $user['profile_image'];
        if ($file = $this->request->getFile('profile_image')) {
            if ($file->isValid() && ! $file->hasMoved()) {
                $imageName = $file->getRandomName();
                $file->move(FCPATH . 'uploads', $imageName);
            }
        }

        $this->userModel->update($id, [
            'name'          => $this->request->getPost('name'),
            'email'         => $this->request->getPost('email'),
            'profile_image' => $imageName
        ]);

        return redirect()->to('/users')->with('success', 'User updated successfully');
    }

    // Delete user
    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/users')->with('success', 'User deleted successfully');
    }
}
