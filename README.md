<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
    <h1>TechVritti Internship - Installation and Setup</h1>
    
    Step 1: Clone the Repository
    Clone the repository to your local machine
    
        git clone https://github.com/Karthik-099/TechVrittiInternship.git
        cd TechVrittiInternship
    
    
    Step 2: Pull the Docker Image (Optional)
    If you don’t want to build the image locally, you can pull it from Docker Hub:
    
        docker pull karthik75/techvritti-app
    
    
    Step 3: Start the Application
    Run the application using Docker Compose:
    
        docker-compose up --build
    
    This will start:
    
        The PHP + Apache service (app).
        The MySQL database service (db).
        The Nginx web server (web).
    
    
    Step 4: Access the Application
    Once the containers are running, open your browser and navigate to:
    
        "http://localhost:8080/index.html"   Form Page
        "http://localhost:8080/quiz.html"  Quiz Page
        "http://localhost:8080/php/admin.php"  Admin Dashboard
    
    
    Viewing the Database and Stored Data
    
    Step 1: Access the MySQL Container
    To view the data stored in the MySQL database:
    
        docker exec -it techvritti-db-1 mysql -u user -p
    
    Enter the password when prompted:
    
        password: password
    
    
    Step 2: Run Queries
    Once inside the MySQL shell, run the following commands:
    
        USE internship_portal;

        -- View all students
        SELECT * FROM students;

        -- View all quiz questions
        SELECT * FROM questions;
    
</body>
</html>
