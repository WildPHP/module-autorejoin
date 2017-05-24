# AutoRejoin Module
[![Build Status](https://scrutinizer-ci.com/g/WildPHP/module-autorejoin/badges/build.png?b=master)](https://scrutinizer-ci.com/g/WildPHP/module-autorejoin/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/WildPHP/module-autorejoin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/WildPHP/module-autorejoin/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/wildphp/module-autorejoin/v/stable)](https://packagist.org/packages/wildphp/module-autorejoin)
[![Latest Unstable Version](https://poser.pugx.org/wildphp/module-autorejoin/v/unstable)](https://packagist.org/packages/wildphp/module-autorejoin)
[![Total Downloads](https://poser.pugx.org/wildphp/module-autorejoin/downloads)](https://packagist.org/packages/wildphp/module-autorejoin)

Automatically rejoin channels when the bot is kicked.

## System Requirements
If your setup can run the main bot, it can run this module as well.

## Installation
To install this module, we will use `composer`:

```composer require wildphp/module-autorejoin```

That will install all required files for the module. In order to activate the module, add the following line to your modules array in `config.neon`:

    - WildPHP\Modules\AutoRejoin\AutoRejoin

The bot will run the module the next time it is started.

## Usage
Nothing to do! The bot will automatically rejoin channels when it is kicked now.

## License
This module is licensed under the GNU General Public License, version 3. Please see `LICENSE` to read it.
