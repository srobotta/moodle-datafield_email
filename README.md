# Database Field Email

![Release](https://img.shields.io/badge/Release-1.1-blue.svg)
[![Moodle Plugin
CI](https://github.com/srobotta/moodle-datafield_email/workflows/Moodle%20Plugin%20CI/badge.svg?branch=master)](https://github.com/srobotta/moodle-datafield_email/actions?query=workflow%3A%22Moodle+Plugin+CI%22+branch%3Amaster)
![Supported](https://img.shields.io/badge/Moodle-4.1+-orange.svg)
[![License GPL-3.0](https://img.shields.io/github/license/srobotta/moodle-datafield_email?color=lightgrey)](https://github.com/srobotta/moodle-datafield_email/blob/master/LICENSE)

This plugin provides a new field type email for the database activity.
The field is very similar to the URL field type, only that it accepts
syntactically correct email addresses as values.

## Installation

Please run the following steps:
1. Extract the zip archive into 
`<moodle_install_dir>/mod/data/field/`. 
1. Rename the newly created directory `moodle-datafield_email` into `email`
so that the files from the repository are inside the directory hierarchy
`<moodle_install_dir>/mod/data/field/email`.
1. Run `php mod/data/field/email/cli/install.php` to symlink/copy
the icon file from the plugin directory into the `mod/data/pix/field`
directory. This step is optional, when not executed, the icon next to the
email entry under the button "Create a field" will be missing.
1. Finish the installation via the Moodle admin page.

## Usage

Within your database activity in the *Fields* tab when creating a new
field, the selection contains the new item "Email" with an envelope
icon.

Apart from the standard settings for a field, there is the additional
option *Create mailto link*. When this checkbox is checked, the
values of the email field are automatically converted in a mailto
link in the view templates. If the checkbox is not checked, then
the plain email value is printed without any modification.

## Version History

### 1.1

- Add Moodle ci testsuite and behat tests for this plugin.
- Fix some coding styles reported by the Moodle ci.
- Fix mailto link.

### 1.0

Initial release.