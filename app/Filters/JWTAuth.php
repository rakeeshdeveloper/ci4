<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\JWTLibrary;
use Config\Services;   // ✅ IMPORTANT

class JWTAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $jwt = new JWTLibrary();
        $token = $jwt->getTokenFromHeader();

        if (!$token) {
            return Services::response()
                ->setJSON([
                    'status'  => 401,
                    'message' => 'Access denied. No token provided.',
                    'error'   => 'UNAUTHORIZED'
                ])
                ->setStatusCode(401);
        }

        $decoded = $jwt->validateToken($token);

        if (!$decoded) {
            return Services::response()
                ->setJSON([
                    'status'  => 401,
                    'message' => 'Invalid or expired token.',
                    'error'   => 'INVALID_TOKEN'
                ])
                ->setStatusCode(401);
        }

        // attach user data to request
        $request->user = (array) $decoded['data'];

        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return $response;
    }
}
