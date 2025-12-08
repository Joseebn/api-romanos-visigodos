<?php

namespace App\Application\Actions\Auth;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use GrahamCampbell\ResultType\Success;
use Respect\Validation\Validator;

class LoginAction
{
    public function __invoke(Request $request, Response $response): Response
    {
        $userValidation = $this->authenticateUser($request);

        if (isset($userValidation['errors'])) {
            $response->getBody()->write(json_encode([
                'errors' => $userValidation['errors']
            ]));
            return $response->withStatus($userValidation['code'])
                ->withHeader('Content-Type', 'application/json');
        }

        $response->getBody()->write(json_encode($userValidation['body']));

        return $response->withHeader('Content-Type', 'application/json');
    }

    private function authenticateUser(Request $request): array
    {
        $params = (array)$request->getParsedBody();

        $email = $params['email'] ?? null;
        $password = $params['password'] ?? null;

        $errors = $this->requestValidator($email, $password);

        if (!empty($errors['errors'])) {
            return $errors;
        }

        $user = $this->verifyUserCredentials($email, $password);

        return $user;
    }

    private function requestValidator($email, $password): array
    {
        $emailValidator = Validator::notEmpty()->email();
        $passwordValidator = Validator::notEmpty()->length(6, null); // at least 6 characters

        $errors = [];

        if (!$emailValidator->validate($email)) {
            $errors['email'] = 'The email is mandatory and must be valid';
        }

        if (!$passwordValidator->validate($password)) {
            $errors['password'] = 'The password is required and must be at least 6 characters';
        }

        return [
            'errors' => $errors,
            'code' => 422,
        ];
    }

    private function verifyUserCredentials($email, $password): array
    {
        $user = User::where('email', $email)->first();

        if (!$user || !password_verify($password, $user->password)) {
            return [
                'errors' => [
                    'type' => 'Invalid credentials'
                ],
                'code' => 401,
            ];
        }

        return $this->getJwtResponse($user);
    }

    private function getJwtResponse(User $user): array
    {
        // Crear JWT
        $payload = [
            'email' => $user->email,
            'role' => $user->role,
            'iat' => time(),
            'exp' => time() + 3600 // 1 hour expiration
        ];

        $token = JWT::encode($payload, $_ENV['JWT_SECRET'], 'HS256');

        return [
            'code' => 200,
            'success' => true,
            'body' => [
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'email' => $user->email,
                    'role' => $user->role,
                    'permissions' => $user->permissions
                ]
            ]
        ];
    }
}
