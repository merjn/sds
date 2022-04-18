<?php

namespace Sds\Application\Account\Hashing;

use Sds\Application\Account\Hashing\Interfaces\HasherInterface;
use Sds\Application\Account\Hashing\Interfaces\HashServiceInterface;
use Sds\Domain\Models\User;
use function Sodium\crypto_aead_aes256gcm_decrypt;
use function Sodium\crypto_aead_aes256gcm_encrypt;
use function Sodium\randombytes_buf;
use const Sodium\CRYPTO_AEAD_AES256GCM_NPUBBYTES;

final class HashService implements HashServiceInterface
{
    public function __construct(
        private readonly PasswordOptions $passwordOptions,
        private readonly HasherInterface $hasher
    ) {}

    public function verifyPassword(User $user, string $password): bool
    {
        [$nonce, $ciphertext] = explode(":", base64_decode($user->getPassword()));
        $hash = crypto_aead_aes256gcm_decrypt(
            message: $ciphertext,
            assocData: "",
            nonce: $nonce,
            key: $this->passwordOptions->secretKey
        );

        return $this->hasher->check(
            plaintext: $password,
            hash: $hash
        );
    }

    public function hash(string $plaintext): string
    {
        $hash = $this->hasher->hash($plaintext);
        $nonce = randombytes_buf(CRYPTO_AEAD_AES256GCM_NPUBBYTES);

        $ciphertext = crypto_aead_aes256gcm_encrypt(
            message: $hash,
            assocData: "",
            nonce: $nonce,
            key: $this->passwordOptions->secretKey
        );

        return base64_encode($nonce.':'.$ciphertext);
    }
}
