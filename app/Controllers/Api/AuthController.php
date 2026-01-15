<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Libraries\JWTLibrary;
use Config\Services;

class AuthController extends BaseController
{
    use ResponseTrait;
    
    protected $userModel;
    protected $jwt;
    protected $validation;
    
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->jwt = new JWTLibrary();
        $this->validation = Services::validation();
        helper(['form', 'url']);
    }
    
    /**
     * Register new user with JWT
     */
    public function register()
    {
        $rules = [
            'name'     => 'required|min_length[3]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]'
        ];
        
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        
        $userData = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];
        
        try {
            $userId = $this->userModel->insert($userData);
            
            if (!$userId) {
                return $this->failServerError('Failed to create user');
            }
            
            $user = $this->userModel->find($userId);
            unset($user['password']);
            
            // Generate JWT token
            $token = $this->jwt->generateToken($user);
            
            return $this->respondCreated([
                'status'  => 201,
                'message' => 'User registered successfully',
                'data'    => $user,
                'token'   => $token
            ]);
            
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }
    
    /**
     * Login with JWT
     */
public function login()
{
    $rules = [
        'email'    => 'required|valid_email',
        'password' => 'required|min_length[6]'
    ];

    if (!$this->validate($rules)) {
        return $this->failValidationErrors($this->validator->getErrors());
    }

    $email    = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $user = $this->userModel->where('email', $email)->first();

  

    if (!$user) {
        return $this->failNotFound('User not found');
    }

    if (!password_verify($password, $user['password'])) {
        return $this->failUnauthorized('Invalid password');
    }

    unset($user['password']);

    $token = $this->jwt->generateToken($user);

    return $this->respond([
        'status'  => 200,
        'message' => 'Login successful',
        'data'    => $user,
        'token'   => $token,
        'expires_in' => 3600
    ]);
}

    
    /**
     * Refresh Token
     */
    public function refreshToken()
    {
        $token = $this->jwt->getTokenFromHeader();
        
        if (!$token) {
            return $this->failUnauthorized('No token provided');
        }
        
        $newToken = $this->jwt->refreshToken($token);
        
        if (!$newToken) {
            return $this->failUnauthorized('Invalid or expired token');
        }
        
        return $this->respond([
            'status'  => 200,
            'message' => 'Token refreshed successfully',
            'token'   => $newToken,
            'expires_in' => 3600
        ]);
    }
    
    /**
     * Get current user profile
     */
    public function profile()
    {
        // This endpoint should be protected by JWT filter
        $token = $this->jwt->getTokenFromHeader();
        $decoded = $this->jwt->validateToken($token);
        
        if (!$decoded) {
            return $this->failUnauthorized('Invalid token');
        }
        
        $userData = (array) $decoded['data'];
        $user = $this->userModel->find($userData['user_id']);
        
        if (!$user) {
            return $this->failNotFound('User not found');
        }
        
        unset($user['password']);
        
        return $this->respond([
            'status' => 200,
            'data'   => $user
        ]);
    }
    
    /**
     * Logout (invalidate token - optional)
     * Note: JWT is stateless, so you might need a token blacklist
     */
    public function logout()
    {
        // In a stateless JWT system, logout happens client-side
        // by deleting the token. If you need server-side invalidation,
        // implement a token blacklist system.
        
        return $this->respond([
            'status'  => 200,
            'message' => 'Logged out successfully. Please delete the token client-side.'
        ]);
    }
}