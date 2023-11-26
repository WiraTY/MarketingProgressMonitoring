<?php

namespace App\Middlewares;

use CodeIgniter\Config\Services;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Middleware\BaseMiddleware;

class AuthMiddleware extends BaseMiddleware
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = Services::session();
        $isLoggedIn = $session->get('isLoggedIn');

        // Check if the user is not logged in
        if (!$isLoggedIn) {
            // Save the current URL to session for redirection after login
            $session->set('redirect_url', current_url());

            // Redirect the user to the login page
            $response = new RedirectResponse(base_url('member/login'));
            return $response;
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
