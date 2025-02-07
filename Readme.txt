

Configuration

To use Laravel's encryption services, you need to configure the APP_KEY in the config/app.php file.
This key is critical for encryption and decryption operations. The value of APP_KEY is set using the APP_KEY environment variable,
which is generated using the php artisan key:generate command.

This command ensures that a cryptographically secure key is generated using PHP’s random byte generator.
The key is typically created automatically during Laravel's installation, but if needed, it can be manually generated using artisan.

php artisan key:generate
The APP_KEY value will be in the format:

APP_KEY=base64:randomgeneratedkey==

Gracefully Rotating Encryption Keys
When you change the encryption key in your Laravel application (e.g., by regenerating APP_KEY), it has important implications:

User Sessions: All authenticated user sessions will be invalidated. This is because session cookies are encrypted with your current encryption key.
Data Decryption: Any data previously encrypted with the old key will become inaccessible unless the key is also available for decryption.


No need of Test flags

Laravel can now automatically recognize whether you're using PHPUnit or Pest,
so you no longer need to manually specify that you're using Pest,
streamlining the process of running tests.

eg:
php artisan make:test MyExampleTest
