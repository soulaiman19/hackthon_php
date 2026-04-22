<?php
session_start();
require 'db.php';

function isLoggedIn(): bool
{
    return !empty($_SESSION['user']);
}

function currentUser(): ?array
{
    return $_SESSION['user'] ?? null;
}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function textLength(string $value): int
{
    return function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);
}

function normalizeText(string $value): string
{
    $value = trim($value);
    return preg_replace('/\s+/', ' ', $value) ?? $value;
}

function isValidName(string $value): bool
{
    return (bool) preg_match("/^[\\p{L} '-]+$/u", $value);
}

function isValidDateOfBirth(string $value): bool
{
    $date = DateTime::createFromFormat('Y-m-d', $value);
    $errors = DateTime::getLastErrors();

    if (!$date || $errors['warning_count'] > 0 || $errors['error_count'] > 0) {
        return false;
    }

    $today = new DateTime('today');
    $minDate = (clone $today)->modify('-120 years');

    return $date <= $today && $date >= $minDate;
}

function validateRegistrationData(array $input): array
{
    $data = [
        'name' => normalizeText((string) ($input['name'] ?? '')),
        'family_name' => normalizeText((string) ($input['family_name'] ?? '')),
        'date_of_birth' => trim((string) ($input['date_of_birth'] ?? '')),
        'email' => filter_var(trim((string) ($input['email'] ?? '')), FILTER_SANITIZE_EMAIL),
        'password' => (string) ($input['password'] ?? ''),
    ];

    $errors = [];

    if ($data['name'] === '') {
        $errors[] = 'Veuillez saisir votre prenom.';
    } elseif (textLength($data['name']) > 100) {
        $errors[] = 'Le prenom ne doit pas depasser 100 caracteres.';
    } elseif (!isValidName($data['name'])) {
        $errors[] = 'Le prenom contient des caracteres non autorises.';
    }

    if ($data['family_name'] === '') {
        $errors[] = 'Veuillez saisir votre nom.';
    } elseif (textLength($data['family_name']) > 100) {
        $errors[] = 'Le nom ne doit pas depasser 100 caracteres.';
    } elseif (!isValidName($data['family_name'])) {
        $errors[] = 'Le nom contient des caracteres non autorises.';
    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Veuillez saisir un email valide.';
    }

    if (strlen($data['password']) < 8) {
        $errors[] = 'Le mot de passe doit contenir au moins 8 caracteres.';
    }

    if ($data['date_of_birth'] === '') {
        $errors[] = 'Veuillez renseigner votre date de naissance.';
    } elseif (!isValidDateOfBirth($data['date_of_birth'])) {
        $errors[] = 'La date de naissance est invalide.';
    }

    return [
        'is_valid' => empty($errors),
        'errors' => $errors,
        'data' => $data,
    ];
}

function getUser(string $email): ?array
{
    global $pdo;

    try {
        $stmt = $pdo->prepare(
            'SELECT id, name, family_name, date_of_birth, email, password, verified, verification_code
             FROM users
             WHERE email = :email'
        );
        $stmt->execute(['email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    } catch (PDOException $e) {
        return null;
    }
}

function createUser(array $input): array
{
    global $pdo;

    $validation = validateRegistrationData($input);
    if (!$validation['is_valid']) {
        return [
            'success' => false,
            'message' => implode(' ', $validation['errors']),
            'errors' => $validation['errors'],
        ];
    }

    $data = $validation['data'];

    try {
        if (getUser($data['email'])) {
            return ['success' => false, 'message' => 'Ce compte existe deja.'];
        }

        $code = bin2hex(random_bytes(16));
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare(
            'INSERT INTO users (name, family_name, date_of_birth, email, password, verification_code, verified)
             VALUES (:name, :family_name, :date_of_birth, :email, :password, :verification_code, 0)'
        );
        $stmt->execute([
            'name' => $data['name'],
            'family_name' => $data['family_name'],
            'date_of_birth' => $data['date_of_birth'],
            'email' => $data['email'],
            'password' => $hashedPassword,
            'verification_code' => $code,
        ]);

        return [
            'success' => true,
            'code' => $code,
            'email' => $data['email'],
        ];
    } catch (PDOException $e) {
        return ['success' => false, 'message' => 'Erreur lors de l\'inscription.'];
    }
}

function verifyUserEmail(string $email, string $code): bool
{
    global $pdo;

    try {
        $user = getUser($email);
        if (!$user) {
            return false;
        }

        if (!hash_equals((string) $user['verification_code'], $code)) {
            return false;
        }

        $stmt = $pdo->prepare('UPDATE users SET verified = 1, verification_code = NULL WHERE email = :email');
        $stmt->execute(['email' => $email]);

        return true;
    } catch (PDOException $e) {
        return false;
    }
}

function authenticate(string $email, string $password)
{
    global $pdo;

    try {
        $user = getUser($email);
        if (!$user || !password_verify($password, $user['password'])) {
            return null;
        }

        if (!$user['verified']) {
            return 'not_verified';
        }

        return $user;
    } catch (PDOException $e) {
        return null;
    }
}

function loginUser(array $user): void
{
    $_SESSION['user'] = [
        'id' => $user['id'],
        'name' => $user['name'],
        'family_name' => $user['family_name'],
        'date_of_birth' => $user['date_of_birth'],
        'email' => $user['email'],
        'verified' => $user['verified'],
    ];
}

function logout(): void
{
    session_unset();
    session_destroy();
}
