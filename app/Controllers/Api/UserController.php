<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use Config\Services;

class UserController extends BaseController
{
    use ResponseTrait;
    
    protected $userModel;
    protected $validation;
    
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->validation = Services::validation();
        helper(['form', 'url', 'text']);
        
        header('Content-Type: application/json');
    }
    
    /**
     * Get all users - GET /api/users
     */
    public function index()
    {
        try {
            $users = $this->userModel->findAll();
            
            foreach ($users as &$user) {
                unset($user['password']);
            }
            
            return $this->respond([
                'status' => true,
                'code' => 200,
                'message' => 'Users retrieved',
                'data' => $users
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Server error');
        }
    }
    
    /**
     * Get single user - GET /api/users/{id}
     */
    public function show($id = null)
    {
        try {
            if (!$id) return $this->fail('ID required', 400);
            
            $user = $this->userModel->find($id);
            if (!$user) return $this->failNotFound('User not found');
            
            unset($user['password']);
            
            return $this->respond([
                'status' => true,
                'code' => 200,
                'message' => 'User retrieved',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Server error');
        }
    }
    
    /**
     * Create user - POST /api/users
     */
    public function store()
    {
        try {
            // Get input
            $input = $this->request->getJSON(true);
            if (!$input) $input = $this->request->getPost();
            
            // Validation
            $rules = [
                'name' => 'required|min_length[3]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]'
            ];
            
            if (!$this->validate($rules)) {
                return $this->failValidationErrors($this->validator->getErrors());
            }
            
            // Handle image
            $imageName = $this->handleImageUpload();
            
            // Save user
            $userData = [
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => password_hash($input['password'], PASSWORD_DEFAULT),
                'profile_image' => $imageName,
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $userId = $this->userModel->insert($userData);
            
            if (!$userId) {
                return $this->fail('Failed to create user', 500);
            }
            
            $user = $this->userModel->find($userId);
            unset($user['password']);
            
            return $this->respondCreated([
                'status' => true,
                'code' => 201,
                'message' => 'User created',
                'data' => $user
            ]);
            
        } catch (\Exception $e) {
            return $this->failServerError('Server error: ' . $e->getMessage());
        }
    }
    
    /**
     * Update user - PUT /api/users/{id}
     */
    public function update($id = null)
    {
        try {
            if (!$id) return $this->fail('ID required', 400);
            
            $user = $this->userModel->find($id);
            if (!$user) return $this->failNotFound('User not found');
            
            // Get input
            $input = $this->request->getJSON(true);
            if (!$input) $input = $this->request->getPost();
            
            // Validation
            $rules = [
                'name' => 'required|min_length[3]',
                'email' => 'required|valid_email'
            ];
            
            // Check email uniqueness
            if (isset($input['email']) && $input['email'] !== $user['email']) {
                $rules['email'] .= '|is_unique[users.email]';
            }
            
            if (!$this->validate($rules)) {
                return $this->failValidationErrors($this->validator->getErrors());
            }
            
            // Handle image
            $imageName = $user['profile_image'];
            $newImage = $this->handleImageUpload();
            
            if ($newImage) {
                // Delete old image
                if ($imageName && file_exists(FCPATH . 'uploads/' . $imageName)) {
                    unlink(FCPATH . 'uploads/' . $imageName);
                }
                $imageName = $newImage;
            }
            
            // Update data
            $updateData = [
                'name' => $input['name'],
                'email' => $input['email'],
                'profile_image' => $imageName,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            // Update password if provided
            if (!empty($input['password'])) {
                $updateData['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
            }
            
            $this->userModel->update($id, $updateData);
            
            $updatedUser = $this->userModel->find($id);
            unset($updatedUser['password']);
            
            return $this->respond([
                'status' => true,
                'code' => 200,
                'message' => 'User updated',
                'data' => $updatedUser
            ]);
            
        } catch (\Exception $e) {
            return $this->failServerError('Server error: ' . $e->getMessage());
        }
    }
    
    /**
     * Delete user - DELETE /api/users/{id}
     */
    public function destroy($id = null)
    {
        try {
            if (!$id) return $this->fail('ID required', 400);
            
            $user = $this->userModel->find($id);
            if (!$user) return $this->failNotFound('User not found');
            
            // Delete image
            if ($user['profile_image'] && file_exists(FCPATH . 'uploads/' . $user['profile_image'])) {
                unlink(FCPATH . 'uploads/' . $user['profile_image']);
            }
            
            $this->userModel->delete($id);
            
            return $this->respondDeleted([
                'status' => true,
                'code' => 200,
                'message' => 'User deleted'
            ]);
            
        } catch (\Exception $e) {
            return $this->failServerError('Server error');
        }
    }
    
    /**
     * Helper: Handle image upload
     */
    private function handleImageUpload()
    {
        $file = $this->request->getFile('profile_image');
        
        if ($file && $file->isValid()) {
            // Validate
            $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($file->getMimeType(), $allowedTypes)) {
                return null;
            }
            
            if ($file->getSize() > 2048000) { // 2MB
                return null;
            }
            
            // Save
            $imageName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $imageName);
            
            return $imageName;
        }
        
        // Check for base64
        $input = $this->request->getJSON(true);
        if ($input && !empty($input['profile_image_base64'])) {
            return $this->handleBase64Image($input['profile_image_base64']);
        }
        
        return null;
    }
    
    /**
     * Helper: Handle base64 image
     */
    private function handleBase64Image($base64Image)
    {
        if (empty($base64Image)) return null;
        
        if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
            $data = substr($base64Image, strpos($base64Image, ',') + 1);
            $type = strtolower($type[1]);
            
            if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
                return null;
            }
            
            $data = base64_decode($data);
            if ($data === false) return null;
            
            if (strlen($data) > 2048000) return null;
            
            $filename = random_string('alnum', 16) . '.' . $type;
            $filepath = FCPATH . 'uploads/' . $filename;
            
            if (file_put_contents($filepath, $data)) {
                return $filename;
            }
        }
        
        return null;
    }
}