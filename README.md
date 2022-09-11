# ************ This is the backEnd of our car management project *************

This repository is help you to manage the Car

---

### Install Dependencies
To install all dependencies make **`composer install`**

---

### Configure Database, Environment Variables

- Make a copy of `.env` and rename it to `.env.local`
- Update it with your database credentials

If you haven't created a database, you can create it with doctrine:

```bash
- php bin/console doctrine:database:create

- php bin/console doctrine:migrations:migrate
```

---

### For authentication JWT token
- composer require "lexik/jwt-authentication-bundle"

``` install ssl, and then
- php bin/console lexik:jwt:generate-keypair

OR
- mkdir -p config/jwt
- openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
- openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout

```

