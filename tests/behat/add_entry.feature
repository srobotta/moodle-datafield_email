@mod @mod_data @datafield @datafield_email
Feature: Users can use the datatype field email and add an entry with that type.

  Background:
    Given the following "users" exist:
      | username | firstname | lastname | email |
      | student1 | Student | 1 | student1@example.com |
    And the following "courses" exist:
      | fullname | shortname | category |
      | Course 1 | C1 | 0 |
    And the following "course enrolments" exist:
      | user | course | role |
      | student1 | C1 | student |
    And the following "activities" exist:
      | activity | name               | intro | course | idnumber |
      | data     | Test database name | n     | C1     | data1    |

  @javascript
  Scenario: Student can add an entries to a database with a valid or empty email
    Given the following "mod_data > fields" exist:
      | database | type  | name            | description            |
      | data1    | text  | Test field name | Description field name |
      | data1    | email | Test field mail | Description field mail |
    When I am on the "Course 1" course page logged in as student1
    And I am on the "Test database name" "mod_data > add entry" page logged in as student1
    And I set the following fields to these values:
      | Test field name | John Doe |
      | Test field mail | foo.bar  |
    And I press "Save"
    Then I should see "You must enter a valid email address here."
    And I set the field "Test field mail" to "foo@bar.com"
    And I press "Save"
    Then I should see "John Doe"
    And I should see "foo@bar.com"
    When I am on the "Test database name" "mod_data > add entry" page logged in as student1
    And I set the following fields to these values:
      | Test field name | Homer Simpson |
    And I press "Save"
    Then I should see "Homer Simpson"
