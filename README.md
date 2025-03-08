1. Introduction
The University System Project is an application designed to streamline the administrative processes of managing faculty, students, and courses. Developed for the course Web Design and Development, the project aims to simulate a basic university management system where an admin can efficiently handle key operations, such as adding, viewing, editing, and deleting faculty and student records, managing courses, and allocating courses to faculty members. The inclusion of edit and delete functionality enhances the system's usability, allowing for better data management and accuracy. Built using modern web development technologies, this project provides a practical, real-world solution for university management.

2. System Overview
The University System allows the administrator to log in, view the dashboard, and perform key operations efficiently. The system ensures that only authenticated users can access the admin panel, enhancing its security and reliability. The operations available include adding, viewing, editing, and deleting records for faculty, students, and courses. Additionally, the administrator can allocate courses to faculty members and view allocated courses, providing a comprehensive management solution within a single platform.
2.1 Objectives of the Project
•	Simplify the management of university faculty, students, and courses.
•	Provide secure and efficient user authentication.
•	Reduce manual errors by automating the processes of course allocation and record management, including editing and deleting records as needed.
•	Improve overall efficiency in handling university administrative tasks.
3. System Architecture
The system follows a multi-tier architecture, separating the client-side and server-side functionalities. The front-end is responsible for user interactions, while the back-end handles data processing and communication with the database, including operations for adding, viewing, editing, and deleting records.
•	Client-Side (Front-End): HTML, CSS, and JavaScript
•	Server-Side (Back-End): PHP
•	Database: MySQL
The system adopts a Model-View-Controller (MVC) structure, ensuring scalability and maintainability while supporting efficient management of university data.
4. Admin Login & Dashboard
4.1 Admin Login
The admin login interface ensures that only authorized personnel can access the dashboard and perform operations, including adding, viewing, editing, and deleting records for faculty, students, and courses. The login system is secured using encrypted passwords stored in the database, enhancing security. Additionally, invalid login attempts are handled gracefully with appropriate error messages to guide users.
4.2 Dashboard
Once logged in, the admin is presented with a dashboard that serves as a centralized hub for all operations. The dashboard is designed for ease of navigation, allowing the admin to quickly access and manage the following features:
•	Add/View Faculty: Admins can add new faculty members, view existing records, and edit or delete faculty details as needed.
•	Add/View Students: The admin can add new students to the system, view their profiles, and have the capability to edit or delete student records.
•	Add/View Courses: Admins can add new courses, view course details, and edit or delete course information efficiently.
•	Allocate/View Allocated Courses
The user interface is responsive, meaning it can be accessed from multiple devices without losing functionality.
5. Key Features and Functionalities
5.1 Add/View Faculty
•	Add Faculty: Admins can add new faculty members by entering details such as name, department, and qualifications. This information is stored securely in the database.
•	View Registered Faculty: Admins can view a comprehensive list of all registered faculty members. Each faculty member's profile includes information on assigned courses, contact details, and department.
•	Edit Faculty: Admins can modify the details of existing faculty members to ensure that the information remains current and accurate.
•	Delete Faculty: Admins have the ability to remove faculty records from the system when necessary, ensuring that outdated or incorrect information is cleared from the database.
5.2 Add/View Students
•	Add Students: Admins can add new students to the university's database, including their name, roll number, department, and other details. Each student is assigned a unique ID.
•	View Registered Students: This section allows the admin to view all students, along with their enrolled courses, contact information, and academic progress.
•	Edit Students: Admins can update the details of existing students to reflect any changes in their information or status, ensuring the database remains accurate.
•	Delete Students: Admins can remove student records from the database when necessary, allowing for the management of outdated or incorrect information.
5.3 Allocate and Register Courses
•	Allocate Courses: Admins can allocate specific courses to faculty members, ensuring that each course has a designated instructor. This process involves selecting a course from the database and assigning it to the appropriate faculty member.
•	View Allocated Courses: Admins can view all allocated courses, listed alongside their respective faculty members. This feature allows for efficient tracking of faculty assignments and ensures accountability.
•	Edit Allocated Courses: Admins can modify course allocations if changes are necessary, such as reassigning a course to a different faculty member or updating the course details.
•	Delete Allocated Courses: Admins have the ability to remove course allocations when needed, streamlining faculty assignments and maintaining an accurate record of teaching responsibilities.
6. Future Enhancements
6.1 Student Login
•	Extend the system to include a student login portal, enabling students to view their enrolled courses, grades, and academic records securely.
6.2 Course Registration
•	Implement an automated course registration system for students, allowing them to register for courses online during the registration period, thereby enhancing the user experience.
6.3 Notifications
•	Integrate an email or SMS notification system to inform faculty and students about important updates, such as course allocations, schedule changes, and deadlines.
6.4 Attendance Management
•	Add an attendance management feature to track student attendance for each course, enabling faculty and administration to monitor student participation effectively.

ADMIN LOGIN

 ![image](https://github.com/user-attachments/assets/b67cb9b4-2678-428c-8670-620f13866ac4)


DASHBOARD
 ![image](https://github.com/user-attachments/assets/3887f6ce-76f2-4962-8b0e-631e39fc0392)

ADD STUDENT
 ![image](https://github.com/user-attachments/assets/93206f00-da6b-4607-b27f-deec03e2d008)

VIEW STUDENTS
 ![image](https://github.com/user-attachments/assets/cebfdead-1db7-43db-b723-f762f833280e)

ADD FACULTY
  ![image](https://github.com/user-attachments/assets/aab7afe7-3bd4-412c-a1c9-6b1bc2c3146b)

VIEW REGISTERED FACULTY
 ![image](https://github.com/user-attachments/assets/0d042695-5f5d-4bdd-a08d-0784f562d5d8)

ADD COURSES
 ![image](https://github.com/user-attachments/assets/92231a44-f48b-4194-a5ea-d3f231a92510)

VIEW COURSES
 ![image](https://github.com/user-attachments/assets/63acbd01-cc85-47a2-96ba-877f608ba69e)

ALLOCATE COURSES
 ![image](https://github.com/user-attachments/assets/65874258-29b0-4c05-94d6-9b5b3a7109ca)

VIEW ALLOCATED COURSES
 ![image](https://github.com/user-attachments/assets/06b2f647-44be-4349-a75d-b414fc16ccc7)

8. Conclusion
The University System project offers a comprehensive solution for managing university operations, emphasizing efficiency and user-friendliness. The system facilitates the effective management of faculty, students, and courses through a secure login and a feature-rich dashboard. Key functionalities, such as the ability to add, view, edit, and delete records for faculty, students, and courses, enhance administrative capabilities and ensure data accuracy. While the current version meets the project's objectives, future enhancements, such as student portals and automated course registration, can further improve the system's functionality and user experience.

