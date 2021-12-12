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