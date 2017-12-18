# Skeletor

This is the base platform for new installs on the SilverStripe framework. It indicates the preferred approach for all of our projects.


## Requirements

- Node Package Manager (npm) (https://www.npmjs.com/)
- Webpack (https://webpack.github.io/)
- SilverStripe 3.6.2


## Install requirements

1. `sudo apt-get update` to update package sources
2. Install composer from https://getcomposer.org/download/
3. `sudo mv ./composer.phar /usr/local/composer` to make composer globally accessible
4. Install NPM with `sudo apt-get install npm`


## Installation

1. Create a new GitHub repository for your project
2. Create your project in the appropriate directory `composer create-project plasticstudio/skeletor mywebsitenamehere/public_html`
3. Update `_ss_environment.php` to reflect your environment details
4. `composer install` to compile your PHP dependencies with Composer 
5. `npm install` compile your Javascript dependencies with NPM 
6. `/dev/build?flush=all` to build your SilverStripe environment 
7. `npm run dev` to build a development version of your project, or `npm run prod` to build a production-ready version