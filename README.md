# Skeletor

This is the base platform for new installs on the SilverStripe framework. It indicates the preferred approach for all of our projects.


## Requirements

- Node Package Manager (npm) (https://www.npmjs.com/)
- Webpack (https://webpack.github.io/)
- SilverStripe 3.2


## Environment setup

1. `sudo apt-get update` to update package sources
2. Install composer from https://getcomposer.org/download/
3. `sudo mv ./composer.phar /usr/local/composer` to make composer globally accessible
4. `sudo apt-get install npm` to install npm


## Installation

1. Clone this repository to your local environment
2. Create your `_ss_environment.php` file based on the sample. Keep this outside of the `public_html` folder
3. `composer install` to compile your PHP dependencies with Composer 
4. `npm install` compile your Javascript dependencies with NPM 
5. `/dev/build?flush=all` to build your SilverStripe environment 
6. `npm run dev` to build a development version of your project, or `npm run prod` to build a production-ready version