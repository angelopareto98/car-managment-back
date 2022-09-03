# ************ This is the back end of our car management project *************

# *********** Don't forget to make composer install after clonnign this. ********

- php bin/console doctrine:migrations:migrate


# For authentication JWT token
- composer require "lexik/jwt-authentication-bundle"

$ install ssl, and then
- php bin/console lexik:jwt:generate-keypair

OR
$ for the authentication
- mkdir -p config/jwt
- openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
- openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout

