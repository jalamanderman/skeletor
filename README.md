# Skeletor

This is the base platform for new installs on the SilverStripe framework. It indicates the preferred approach for all of our projects.


## Requirements

- Composer (https://getcomposer.org)
- Node Package Manager (npm) (https://www.npmjs.com/)
- Webpack (https://webpack.github.io/)
- SilverStripe 4


## Installation

1. Create a new GitHub repository for your project
2. Create your project in the appropriate directory `composer create-project plasticstudio/skeletor mywebsitenamehere/public_html`
3. Create an environment file (`.env`) outside of the web root to reflect your environment details
4. `composer install` to compile your PHP dependencies with Composer 
5. `npm install` compile your Javascript dependencies with NPM 
6. `/dev/build?flush=all` to build your SilverStripe environment 
7. `npm run dev` to build a development version of your project, or `npm run prod` to build a production-ready version