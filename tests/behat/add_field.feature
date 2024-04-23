@mod @mod_data @datafield @datafield_email
Feature: Teachers can create a new datatype field email

  Background:
    Given the following "users" exist:
      | username | firstname | lastname | email                |
      | teacher1 | Teacher   | One      | teacher1@example.com |
      | student1 | Student   | One      | student1@example.com |
    And the following "courses" exist:
      | fullname | shortname | category |
      | Course 1 | C1        | 0        |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
      | student1 | C1     | student        |
    And the following "activities" exist:
      | activity | name               | intro | course | idnumber |
      | data     | Test database name | n     | C1     | data1    |

  @javascript
  Scenario: Teacher can create fields, one of the type email
    When I am on the "Course 1" course page logged in as teacher1
    And I am on the "Test database name" "data activity" page logged in as teacher1
    And I navigate to "Fields" in current page administration
    And I click on "Create a field" "button"
    And I click on "Email" "link" in the "#action_bar" "css_element"
    And I set the following fields to these values:
      | Field name         | Test field mail        |
      | Field description  | Description field mail |
      | Create mailto link | 1                      |
    And I press "Save"
    Then I should see "Test field mail"
    And I should see "Description field mail"
    And I should see "Email"
    And I log out
    When I am on the "Course 1" course page logged in as student1
    And I am on the "Test database name" "mod_data > add entry" page logged in as student1
    And I set the following fields to these values:
      | Test field mail | john.doe@example.org |
    And I press "Save"
    Then I should see "john.doe@example.org"
    And "//a[@href = 'mailto:john.doe@example.org']" "xpath_element" should exist
