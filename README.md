# Levart Coding Test
<!-- ABOUT THE PROJECT -->
## About The Project

This is a simple mail sender exercise. 

### Built With

This section should list any major frameworks that you built your project using. Leave any add-ons/plugins for the acknowledgements section. Here are a few examples.
* [PHP](https://www.php.net)
* [PostgreSQL](https://www.postgresql.org/)
* [Composer](https://getcomposer.org)
* [Google OAuth2](https://developers.google.com/identity/protocols/oauth2)

<!-- GETTING STARTED -->
## Getting Started

1. Clone this repository
2. Change directory to repository
3. Install dependencies
```bash
composer install
```
4. Configuration of environment `.env` file
5. Create some database and mail table with command
```bash
CREATE TABLE IF NOT EXISTS mail (
        id SERIALNOT NULL,
        receiver_mail VARCHAR(100) NOT NULL,
        subject_mail VARCHAR(100) NOT NULL,
        message TEXT,
        created_at TIMESTAMPTZ NOT NULL DEFAULT NOW(),
        updated_at TIMESTAMPTZ NOT NULL DEFAULT NOW(),
        PRIMARY KEY (id)
    )
```

6. Than run server
```bash
php -S 127.0.0.1:8000 -t public
```

## Documentation
The endpoint documentation in `/dependency_data`.

## Afterword
Hopefully, it can be easily understood and useful. Thank you~