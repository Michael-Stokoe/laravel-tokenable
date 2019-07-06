# DISCLAIMER: None of this documentation has been tested yet! I typed this up late at night after finishing work on it without using it as I went.

# Laravel-Tokenable

Easy creation of API Tokens for your Laravel models.

---
## Installation
`$ composer require stokoe/tokenable`

## Publish assets
`$ php artisan vendor:publish --provider="Stokoe\TokenableServiceProvider"`

## Configure Default API Token length
Open up config/tokenable.php:
```php
return [
	'token_length' => 60,
];
```
---
## Usage
Import the trait into your model and use it:

```php
namespace App;

...
use Stokoe\Tokenable;

class User extends Authenticatable
{
	use Notifiable, Tokenable;
...

```
Now that model has a relationship called `apiKey`, it is a one-to-one polymorphic relationship for the time-being, though one-to-many is planned for future a release.

### Generate new API Token for a given record.
Generate an API token for given record.
```php
$user = App\User::first();
$user->generateApiToken();

// return ex: d96d7fb36e394c22bab8d4089f619752a3fe172effbdaad738d4276d81df72305373e207a7a91f8e18fc32cf1f9b6c6977d540f9a125c0746101d539
```
## Get the API Token related to the record
The property is appended to the record, so be careful when querying.

I recommend diong the look up on the ApiToken side. eg. `Stokoe\Models\ApiToken::find($token)->tokenable;`)_
```php
$user = App\User::first();
$user->api_token;

// return ex: d96d7fb36e394c22bab8d4089f619752a3fe172effbdaad738d4276d81df72305373e207a7a91f8e18fc32cf1f9b6c6977d540f9a125c0746101d539
```

# DISCLAIMER: None of this documentation has been tested yet! I typed this up late at night after finishing work on it without using it as I went.