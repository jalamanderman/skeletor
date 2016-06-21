## Skeletor

This is the base platform for new installs on the SilverStripe framework. It indicates the preferred approach for all of our projects.


# Requirements

- GruntJS
- Node Package Manager (npm)
- SilverStripe 3.2


# Setup

1. Clone this repository to your local environment
2. Create your `_ss_environment.php` file (use the example if necessary). Remember to keep this outside of the `public_html` folder!
3. Compile your PHP dependencies with Composer `composer install`
4. Compile your Javascript dependencies with NPM `npm install`
5. Build your SilverStripe environment `/dev/build?flush=all`
6. Watch for sass and js file changes `grunt` or `grunt &` to run in the background