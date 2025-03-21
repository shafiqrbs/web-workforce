{
    "name": "laravel/laravel",
    "type": "project",
    "description": "The Laravel Framework.",
    "keywords": [
        "framework",
        "laravel"
    ],
    "license": "MIT",
    "require": {
        "php": "^7.4|^8.0",
        "anhskohbo/no-captcha": "^3.2",
        "cakephp/chronos": "^2.0",
        "cviebrock/eloquent-sluggable": "^8.0",
        "dawson/youtube": "^6.0",
        "fideloper/proxy": "^4.2",
        "fruitcake/laravel-cors": "^2.0",
        "goodnesskay/laravelpdfviewer": "^1.0",
        "guzzlehttp/guzzle": "^7.0.1",
        "intervention/image": "^2.5",
        "jrean/laravel-user-verification": "dev-master",
        "laracasts/flash": "^3.1",
        "laravel/framework": "^8.75",
        "laravel/socialite": "^5.2",
        "laravel/tinker": "^2.5",
        "laravel/ui": "^3.4",
        "league/oauth2-google": "^4.0",
        "maatwebsite/excel": "^3.1",
        "nwidart/laravel-modules": "^8.0",
        "omnipay/paypal": "^3.0",
        "paypal/paypal-checkout-sdk": "1.0.1",
        "paypal/rest-api-sdk-php": "^1.14",
        "phpmailer/phpmailer": "^6.6",
        "spatie/laravel-newsletter": "^4.8",
        "stripe/stripe-php": "^7.49",
        "yajra/laravel-datatables": "^1.5"
    },
    "require-dev": {
        "facade/ignition": "^2.5",
        "fzaninotto/faker": "^1.9.1",
        "mockery/mockery": "^1.4.4",
        "nunomaduro/collision": "^5.10",
        "phpunit/phpunit": "^9.5.10"
    },
    "config": {
        "optimize-autoloader": true,
        "preferred-install": "dist",
        "sort-packages": true
    },
    "extra": {
        "laravel": {
            "dont-discover": []
        }
    },
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Modules\\": "Modules/"
        },
        "classmap": [
            "database/seeds",
            "database/factories"
        ]
    },
    "autoload-dev": {
        "psr-4": {
            "Tests\\": "tests/"
        }
    },
    "minimum-stability": "dev",
    "prefer-stable": true,
    "scripts": {
        "post-autoload-dump": [
            "Illuminate\\Foundation\\ComposerScripts::postAutoloadDump",
            "@php artisan package:discover --ansi"
        ],
        "post-root-package-install": [
            "@php -r \"file_exists('.env') || copy('.env.example', '.env');\""
        ],
        "post-create-project-cmd": [
            "@php artisan key:generate --ansi"
        ]
    }
}
