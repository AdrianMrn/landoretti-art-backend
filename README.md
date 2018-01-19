# landoretti-art-backend

# ERD
http://laravelsd.com/5a523d13e520f

# How to deploy
Requirements: 
    - ssh access to your webserver running an Apache/nginx/... web server and php7.0 installed
    - MySQL server

1. `git clone` this entire repository onto your server, point your domain to the proper route (/public), use your .htaccess file or your Apache config for this

2. Run `composer update` in the root folder of the project (get composer.phar if you don't have composer installed on your machine)

3. Copy and rename the .env.example file to .env and fill in the database and mailgun settings, generate a Laravel app key using `php artisan key:generate`

4. Run `php artisan migrate` to create the tables in your database

5. Create a cronjob `* * * * * php [projectroot]/artisan schedule:run >> /dev/null 2>&1`

# SEO implementations
- title on each page
- meta description & keywords on each page that should be SEO optimized
- properly used h1 & h2 tags
- HTTPS on all pages (not anymore)
- all pages "mobile friendly"
- alt tags on img elements
- title tags on divs that have an image as background
- page load speed optimized by minifying css & js and optimizing logo (logo size reduced by 99% through Google image optimization)