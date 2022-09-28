## Setup

1. Clone github.
2. Run `composer install`
3. Create file `.env` from `.env.example`
4. Run `./vendor/bin/sail artisan migrate`
5. Run `./vendor/bin/sail up`

## Use

- Visit `localhost/api/rover/init?direction=N&position_x=1&position_y=1` to initialize the rover.
- Visit `localhost/api/rover/get` to check the current rover position.
- Visit `localhost/api/rover/move?commands=FF` to make the rover move two times to the North.

## Tests

Run `./vendor/bin/sail artisan test` to check all tests 


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
