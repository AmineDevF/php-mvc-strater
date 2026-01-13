# Project Setup — Composer

This project ignores the `vendor/` directory. To install PHP dependencies and generate the autoloader, install Composer and run the commands below.

## 1) Install Composer

- Windows: download and run the Composer installer from https://getcomposer.org/download/
- Or install locally with PHP:

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

This will create `composer.phar` you can use as `php composer.phar` if Composer isn't global.

## 2) Install project dependencies

From the project root (where `composer.json` is located), run:

```bash
composer install
```

If you installed Composer locally:

```bash
php composer.phar install
```

This will create the `vendor/` directory and the autoloader (`vendor/autoload.php`).

## 3) If `vendor/` was previously committed

If `vendor/` is already tracked by Git, remove it from the index so the `.gitignore` takes effect (files remain on disk):

```bash
git rm -r --cached vendor
git commit -m "Remove vendor directory from repository"
```

Then push the commit.

## 4) Useful commands

- Re-generate autoload files:

```bash
composer dump-autoload
```

- Install dependencies (fresh):

```bash
composer install --no-dev --optimize-autoloader
```

## 5) Run development server

Use the PHP built-in web server to serve the `public` directory during development:

```bash
php -S localhost:8080 -t public
```

On Windows, ensure `php` is in your `PATH` or run via the full path to `php.exe`.

## 5) Notes

- Commit `composer.json` and `composer.lock` to lock dependency versions.
- `vendor/` is intentionally ignored to keep the repository small; CI or deployment should run `composer install`.

---

If you want, I can also add a short `INSTALL.md` for Windows-specific steps or commit the `README.md` for you.