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
Now that model has a relationship called `apiKey`.

### Generate new API Token for a given record.
Generate an API token for given record.
```php
$user = App\User::first();
$user->generateApiToken();
// return ex: d96d7fb36e394c22bab8d4089f619752a3fe172effbdaad738d4276d81df72305373e207a7a91f8e18fc32cf1f9b6c6977d540f9a125c0746101d539

// You can also set token length at time of generation by passing an integer to the generate method.
$user->generateApiToken(12);
// return ex: 4bfc264da5337994341981a2
```
## Get the API Token related to the record
The property is appended to the record, so be careful when querying.

I recommend diong the look up on the ApiToken side. eg. `Stokoe\Models\ApiToken::find($token)->tokenable;`)_
```php
$user = App\User::first();
$user->api_token;

// return ex: d96d7fb36e394c22bab8d4089f619752a3fe172effbdaad738d4276d81df72305373e207a7a91f8e18fc32cf1f9b6c6977d540f9a125c0746101d539
```