# Database Field Email

![Release](https://img.shields.io/badge/Release-1.6-blue.svg)
[![Moodle Plugin CI](https://github.com/srobotta/moodle-datafield_email/actions/workflows/moodle-plugin-ci.yml/badge.svg)](https://github.com/srobotta/moodle-datafield_email/actions/workflows/moodle-plugin-ci.yml)
[![PHP Support](https://img.shields.io/badge/php-8.1--8.4-blue)](https://github.com/srobotta/moodle-datafield_email/action)
[![Moodle Support](https://img.shields.io/badge/Moodle-4.1--5.1-orange)](https://github.com/srobotta/moodle-datafield_email/actions)
[![License GPL-3.0](https://img.shields.io/github/license/srobotta/moodle-datafield_email?color=lightgrey)](https://github.com/srobotta/moodle-datafield_email/blob/main/LICENSE)

This plugin provides an additional field type email for the database activity.
The field is very similar to the URL field type, only that it accepts
syntactically correct email addresses as values.

## Installation

Please run the following steps:
1. Extract the zip archive into 
`<moodle_install_dir>/mod/data/field/`. From Moodle 5.1 onwards it is
`<moodle_install_dir>/public/mod/data/field/`.
1. Rename the newly created directory `moodle-datafield_email` into `email`
so that the files from the repository are inside the directory hierarchy
`.../mod/data/field/email`.
1. Finish the installation via the Moodle admin page.

## Usage

Within your database activity in the *Fields* tab when creating a new
field, the selection contains the type "Email" with an envelope
icon.

Apart from the standard settings for a field, there is the additional
option *Create mailto link*. When this checkbox is checked, the
values of the email field are automatically converted in a mailto
link in the view templates. If the checkbox is not checked, then
the plain email value is printed without any modification.

## Version History

### 1.6

- Add support for Moodle 5.1
- Remove unsupported PHP versions from the CI pipeline

### 1.5

- Add support for Moodle 5.0

### 1.4

- Added Moodle 4.5 to the CI pipeline.

### 1.3

- Moved install script to the correct location db/install.php.
- Support for Moodle 4.4 and PHP 8.3.

### 1.2

- Fix namespace in privacy provider class.
- Fix value in language tag.

### 1.1

- Add Moodle ci testsuite and behat tests for this plugin.
- Fix some coding styles reported by the Moodle ci.
- Fix mailto link.

### 1.0

Initial release.
