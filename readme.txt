ToDo Task Tracking Application
Jacob Bednard
CSC4996 Wayne State University

This application allows a user to enter and track tasks. Each task has a deadline which is maintained by
the system to notify the user if a task is late.

Original Problem Statement:
"Make a small application that can be used as a simple todo list. You should be able to add tasks, view tasks,
delete tasks. Each task has a status i.e. Pending, Started, Completed, Late. There is a due date for each task
as well.  On the main page you need to show how many total tasks are in the system and the count for each status type
i.e. 3 pending tasks. Clicking on the status count filters the list ( or takes you to the new page) with these tasks."

Dependencies:
- Bitnami WAMP Stack 7.1
    - PHP7
    - MySQL
    - Apache
- Bootstrap 3
- jQuery 1.12

Installation Instructions:
1) Copy repository into web server root/application folder
2) Launch web/database server. Verify credentials.
3) Run "Setup.ps1" powershell script as admin from the root project directory. Follow the prompts. This script will
   generate an app config file then initialize the database schema. Then it will add setup scripts to block in
   .htaccess. If all is successful, the script will invite you reboot your apache server at the end.
4) Navigate to your server address.


How To Use:
The video located at "docs/Demo.mp4" provides a walk-through of this application's features.

Directory Highlights:
- docs
    - Sequence Diagrams : Diagrams show application operation
    - Use Cases : Uses cases that the application was modeled around
    - DatabaseDiagram.png : Database Layout for application
    - DataFlowDiagram.png : Diagram showing the progression of data through application.
    - Demo.mp4 : Walk Through Videos
    - ProjectRequirements.txt : Functional and Non-Functional requirements this app was built to.
    - SystemArchitecture.png : Diagram of high-level system design
    - UML_Diagram.png : Class relationships within application
    - WorkBreakDown.txt : Summary of all task and time spent.
- include
    - : PHP Elements of Application
- static
    - : Misc static elements to be served such as js, img, css
- index.html
    - : Main template for this application
- Setup.ps1
    - : PowerShell script to configure application

Unit Test Page
To view the current status of Unit Test output, travel to:
http://yourserver/include/UnitTests.php