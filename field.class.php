<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * The class for a database activity field type email.
 *
 * @package    datafield
 * @subpackage email
 * @copyright  2024 Stephan Robotta <stephan.robotta@bfh.ch>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class data_field_email extends data_field_base {
    /**
     * Name of the field type.
     * @var string
     */
    public $type = 'email';

    /**
     * Priority for globalsearch indexing.
     *
     * @var int
     */
    protected static $priority = self::MIN_PRIORITY;

    /**
     * Preview is supported.
     * @return bool
     */
    public function supports_preview(): bool {
        return true;
    }

    /**
     * Prints the respective type icon for the field type (when managing the fields).
     *
     * @return string
     */
    public function image() {
        global $OUTPUT;

        // When the cli/install.php was executed, the icon was linked/copied at this location.
        $icon = implode(DIRECTORY_SEPARATOR, [__DIR__, '..', '..', 'pix', 'field', 'email.svg']);
        if (file_exists($icon)) {
            return $OUTPUT->pix_icon('field/email', 'email', 'data');
        }
        // Fallback that is used from the font awesome icons that exist in Moodle.
        return $OUTPUT->pix_icon('i/email', 'email');
    }

    /**
     * Sample object for the preview.
     * @param int $recordid
     * @return stdClass
     */
    public function get_data_content_preview(int $recordid): stdClass {
        return (object)[
            'id' => 0,
            'fieldid' => $this->field->id,
            'recordid' => $recordid,
            'content' => 'email@example.com',
            'content1' => null,
            'content2' => null,
            'content3' => null,
            'content4' => null,
        ];
    }

    /**
     * The input field that is displayed in the advanced search.
     * @param $value
     * @return string
     * @throws coding_exception
     */
    public function display_search_field($value = '') {
        return '<label class="accesshide" for="f_' . $this->field->id . '">' . get_string('fieldname', 'data') . '</label>' .
               '<input type="text" size="16" id="f_' . $this->field->id . '" '.
               ' name="f_' . $this->field->id . '" value="' . s($value) . '" class="form-control d-inline"/>';
    }

    /**
     * Te search field parameter value, derived from the request.
     * @param $defaults
     * @return mixed
     * @throws coding_exception
     */
    public function parse_search_field($defaults = null) {
        $param = 'f_'.$this->field->id;
        if (empty($defaults[$param])) {
            $defaults = [$param => ''];
        }
        return optional_param($param, $defaults[$param], PARAM_NOTAGS);
    }

    /**
     * Return the partial search sql when in advanced search the email field is filled with a search term.
     * @param $tablealias
     * @param $value
     * @return array
     */
    public function generate_sql($tablealias, $value) {
        global $DB;

        static $i = 0;
        $i++;
        $name = "df_email_$i";
        return [
            " ({$tablealias}.fieldid = {$this->field->id} AND "
                . $DB->sql_like("{$tablealias}.content", ":$name", false)
            . ') ',
            [$name => "%$value%"],
        ];
    }

    /**
     * This function returns the field value when the field name is used as a placeholder in the template.
     * Depending on the field setting, the email is returned as it is or a mailto link is returned.
     *
     * @param $recordid
     * @param $template
     * @return string
     */
    public function display_browse_field($recordid, $template) {
        $content = $this->get_data_content($recordid);
        if (!$content || !$content->content) {
            return '';
        }
        $email = self::get_content_value($content);
        if (empty($email)) {
            return '';
        }

        if (!$this->field->param1) {
            return $email;
        }
        // If param1 is set, then we need to create a mailto link.
        $attributes = ['class' => 'data-field-link'];
        return html_writer::link("mailto:{$email}", $email, $attributes);
    }

    /**
     * Validate the submitted email address, in case the field was filled with something.
     * @param $value
     * @return lang_string|string
     * @throws coding_exception
     */
    public function field_validation($value) {
        if (!\is_array($value) || empty($value[0]->value)) {
            return '';
        }
        if (empty(clean_param($value[0]->value, PARAM_EMAIL))) {
            return get_string('err_email', 'form');
        }
        return '';
    }

    /**
     * Just make sure that the submitted value is an email address.
     * @param $recordid
     * @param $value
     * @param $name
     * @return bool
     * @throws coding_exception
     */
    public function update_content($recordid, $value, $name='') {
        return parent::update_content($recordid, clean_param($value, PARAM_EMAIL), $name);
    }

    /**
     * Return the plugin configs for external functions.
     *
     * @return array the list of config parameters
     * @since Moodle 3.3
     */
    public function get_config_for_external() {
        // Return all the config parameters.
        $config = parent::get_config_for_external();
        $config["param1"] = $this->field->param1;
        return $config;
    }
}
