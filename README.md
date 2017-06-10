# LISP Interpreter Module
[![Build Status](https://scrutinizer-ci.com/g/Yoshi2889/wphp-module-lisp/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Yoshi2889/wphp-module-lisp/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Yoshi2889/wphp-module-lisp/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Yoshi2889/wphp-module-lisp/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/yoshi2889/wphp-module-lisp/v/stable)](https://packagist.org/packages/yoshi2889/wphp-module-lisp)
[![Latest Unstable Version](https://poser.pugx.org/yoshi2889/wphp-module-lisp/v/unstable)](https://packagist.org/packages/yoshi2889/wphp-module-lisp)
[![Total Downloads](https://poser.pugx.org/yoshi2889/wphp-module-lisp/downloads)](https://packagist.org/packages/yoshi2889/wphp-module-lisp)

LISP interpreter module based on [Archer70's Desmond](https://github.com/Archer70/Desmond).

## System Requirements
If your setup can run the main bot, it can run this module as well.

## Installation
To install this module, we will use `composer`:

```composer require yoshi2889/wphp-module-lisp```

That will install all required files for the module. In order to activate the module, add the following line to your modules array in `config.neon`:

    - Yoshi2889\WPHPModules\Lisp\Lisp

The bot will run the module the next time it is started.

## Configuration
No configuration needed. Grant users who should be able to use the `lisp` command the `lisp` permission.

## Usage
The `lisp` command takes all of its parameters as a LISP expression. Output is returned to the channel.

## License
This module is licensed under the GNU General Public License, version 3. Please see `LICENSE` to read it.
