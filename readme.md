Small task management app written in Laravel 5. Main functionalities:
 
1. Membership
- 2 user roles: admin, user (first name, last name, username)
- for admin, CRUD operarions for managing users. All operations are done via AJAX calls. Search for users functionality.
 
2. Tasks
- users have tasks assigned. Tasks have the following properties: name, description, due date, status (new, in progress, done, closed).
- tasks are created by admin and assigned to users (default status: new).
- user can only see his tasks and modify their status from "new" to "in progress", from "in progress" to "done" (canot set status from "new" to "done").
- admin can change status from "done" to "closed".
