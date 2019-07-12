# Laravel-Tokenable

Easy creation of API Tokens for your Laravel models.

---

## Installation

`$ composer require stokoe/tokenable`

## Publish assets

`$ php artisan vendor:publish --provider="Stokoe\TokenableServiceProvider"`

---

## Configuration

### API Token length

Open up `config/tokenable.php`:

```php
return [
	'token_length' => 60,
...
```

### Set New Tokens As Primary

Open up `config/tokenable.php`:

```php
return [
...
	'make_primary' => true,
...
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

Normally you'd find an API key by looking up users like:

```php
$user = User::where('api_token', $token)->first();
```

or similar. In this case it's not so simple. There is a method provided but you may write your own inverse relationship. (Or improve mine and make a pull request!)

Here's how to find the model related to an API token.

```php
$user = App\User::first();
$user->api_token;

$token = $request->input('token');
$relatedModel = $token->getRelatedModel();

// return ex: d96d7fb36e394c22bab8d4089f619752a3fe172effbdaad738d4276d81df72305373e207a7a91f8e18fc32cf1f9b6c6977d540f9a125c0746101d539
```