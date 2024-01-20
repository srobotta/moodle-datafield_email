# Database Field Email

This plugin provides a new field type email for the database activity.
The field is very similar to the URL field type, only that it accepts
syntactically correct email addresses as values.

## Installation

Please run the following steps:
1. Extract the zip archive into 
`<moodle_install_dir>/mod/data/field/` so that inside this directory
there is a new `email` subdirectory that contains the files of
this plugin.
1. Run ```php mod/data/field/email/cli/install.php``` to symlink/copy
the icon file from the plugin directory into the `mod/data/pix/field`
directory.
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
