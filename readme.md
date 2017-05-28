# Laravel Feedback API

This package provide feedback API to your Laravel project.

*Support Laravel 5.4~*

## Installation

Install with composer.

`composer require hareku/laravel-feedback-api`

include the service provider within `config/app.php`.

```php
'providers' => [
    Hareku\LaravelFeedbackAPI\LaravelFeedbackAPIServiceProvider::class,
];
```

You can customzie.

```sh
$ php artisan vendor:publish --provider="Hareku\LaravelFeedbackAPI\LaravelFeedbackAPIServiceProvider"
```

Setting is completed!

## Usage

Route is preset. (post: /feedbacks)

### Post with axios (Javascript)

```javascript
axios.post('feedbacks', {
    'body' => 'This is a feedback body.'
}).then(({ data }) => {
    const feedbackBody = data.feedback.body
    console.log(feedbackBody) // This is a feedback body.
})
```

## License

MIT

## Author

hareku (hareku908@gmail.com)
