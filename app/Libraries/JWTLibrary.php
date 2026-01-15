<?php

namespace App\Libraries;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\Services;

class JWTLibrary
{
    protected $key;
    protected $algorithm;
    protected $tokenExpiration;
    
    public function __construct()
    {
        // Load configuration
        $this->key = env('JWT_SECRET_KEY', 'your-secret-key-change-this-123');
        $this->algorithm = 'HS256';
        $this->tokenExpiration = 3600; // 1 hour in seconds
        
        // For production, set secret key in .env
        // JWT_SECRET_KEY=your-very-strong-secret-key-here
    }
    
    /**
     * Generate JWT Token
     */
    public function generateToken($userData)
    {
        $issuedAt = time();
        $expire = $issuedAt + $this->tokenExpiration;
        
        $payload = [
            'iss' => base_url(), // Issuer
            'aud' => base_url(), // Audience
            'iat' => $issuedAt, // Issued at
            'exp' => $expire,   // Expiration time
            'data' => [         // Custom data
                'user_id' => $userData['id'],
                'email' => $userData['email'],
                'name' => $userData['name']
            ]
        ];
        
        return JWT::encode($payload, $this->key, $this->algorithm);
    }
    
    /**
     * Validate and Decode Token
     */
    public function validateToken($token)
    {
        try {
            $decoded = JWT::decode($token, new Key($this->key, $this->algorithm));
            return (array) $decoded;
        } catch (\Exception $e) {
            return false;
        }
    }
    
    /**
     * Get Token from Header
     */
    public function getTokenFromHeader()
    {
        $request = Services::request();
        $header = $request->getHeaderLine('Authorization');
        
        if (!empty($header)) {
            if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
                return $matches[1];
            }
        }
        
        return null;
    }
    
    /**
     * Refresh Token
     */
    public function refreshToken($token)
    {
        $decoded = $this->validateToken($token);
        
        if (!$decoded) {
            return false;
        }
        
        // Generate new token with same user data
        return $this->generateToken((array) $decoded['data']);
    }
}