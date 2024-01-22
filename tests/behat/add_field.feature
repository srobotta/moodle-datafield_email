@mod @mod_data @datafield @datafield_email
Feature: Teachers can create a new datatype field email

  Background:
    Given the following "users" exist:
      | username | firstname | lastname | email |
      | teacher1 | Teacher1 | One | teacher1@example.com |
    And the following "courses" exist:
      | fullname | shortname | category |
      | Course 1 | C1 | 0 |
    And the following "course enrolments" exist:
      | user | course | role           |
      | teacher1 | C1 | editingteacher |
    And the following "activities" exist:
      | activity | name               | intro | course | idnumber |
      | data     | Test database name | n     | C1     | data1    |

  @javascript
  Scenario: Teacher can create fields, one of the type email
    When I am on the "Course 1" course page logged in as teacher1
    And I add a "Email" field to "Test database name" database and I fill the form with:
      | Field name         | user_email |
      | Field description  | Your mail  |
      | Create mailto link | 1          |
    Then I should see "user_email"
    And I should see "Your mail"
    And I should see "Email"
    When I am on the "Course 1" course page logged in as teacher1
    And I add an entry to "Test database name" database with:
      | user_email | john.doe@example.org |
    And I press "Save"
    Then I should see "john.doe@example.org"
    And "//a[@href = 'mailto:john.doe@example.org']" "xpath_element" should exist
