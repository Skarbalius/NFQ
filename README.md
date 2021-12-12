# NFQ
 
1. On first visit a teacher should create a new project by providing a title of the project and
a number of groups that will participate in the project and a maximum number of
students per group. Groups should be automatically initialized when a project is created.

*In the Index.php
*Validated all required fields by checking if they are not empty and matched required data type
*Decided to initialise the groups by a simple FOR loop with SQL query inside. Alternative would have required a trigger but I decided to keep this solution simple.

2. If the project exists, a teacher can add students using the “Add new student” button.
Each student must have a unique full name.

*If a project exists, redirect from index.php to project.php
*Opted for a simple non-hidden field and a button.
*In create method, I validate the data and trim unnecessary whitespace, then check if the name exists in the database.
*If the name is unique and valid, it is then added to the database.

3. All students are visible on a list.

*Displayed all students with while($row = $result->fetch_assoc())

4. Teacher can delete a student. In such a case, the student should be removed from the
group and project.

*Removed the student with SQL DELETE statement.

5. Teacher can assign a student to any of the groups. Any student can only be assigned to
a single group. In case the group is full, information text should be visible to a teacher.

*Assignment is fullfilled with html select/option and onchange directing to Javascript function. With Ajax post the student ID and group ID is sent to the update function.
*Select/option only displays students who are not assigned to any group or a student that was assigned to that group and position (both saved in database)
*Also has default 'Assign Student' value
*Ajax also updates the page without a reload. This applies to the student table and other select/option elements. (see main.js)

6. The page is operational and publicly accessible.

*The page is accessible in localhost
*The page was created according to status page mockup and functions similarly.

For bonus requirements added an interval with Javascript that refreshes every 10 seconds. (See main.js)