
CREATE TABLE IF NOT EXISTS Admin(
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NULL,
    login_type ENUM('email', 'google') DEFAULT 'email',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS Course(
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS Student(
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    course_id INT NOT NULL,
    yearLevel INT NOT NULL,
    status ENUM('active', 'inactive') DEFAULT 'inactive',
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES Course(course_id),
    FOREIGN KEY (created_by) REFERENCES Admin(admin_id)
);

CREATE TABLE IF NOT EXISTS Announcement(
    announcement_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    target_course INT NOT NULL,
    target_yearLevel INT NOT NULL,
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (target_course) REFERENCES Course(course_id),
    FOREIGN KEY (created_by) REFERENCES Admin(admin_id)
);

CREATE TABLE IF NOT EXISTS Exams(
    exam_id INT AUTO_INCREMENT PRIMARY KEY,
    room VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    duration INT NOT NULL,
    date DATE,
    requirement TEXT,
    target_course INT NOT NULL,
    target_yearLevel INT NOT NULL,
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (target_course) REFERENCES Course(course_id),
    FOREIGN KEY (created_by) REFERENCES Admin(admin_id)
);

CREATE TABLE IF NOT EXISTS Command(
    command_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    command TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    executed_at TIMESTAMP NULL,
    FOREIGN KEY (student_id) REFERENCES Student(student_id)
);

--FUNCTIONS HERE--

DELIMITER $$
CREATE PROCEDURE signup(
    IN p_username VARCHAR(50),
    IN p_email VARCHAR(100),
    IN p_password VARCHAR(100)
)
BEGIN
    DECLARE email_count INT;
    DECLARE user_count INT;

    SELECT COUNT(*) INTO email_count
    FROM Admin
    WHERE email = p_email;

    SELECT COUNT(*) INTO user_count
    FROM Admin
    WHERE username = p_username;

    IF email_count > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Email already exists';
    ELSEIF user_count > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Username already exists';
    ELSE
        INSERT INTO Admin(username, email, password, login_type)
        VALUES(p_username, p_email, SHA2(p_password, 256), 'email');
    END IF;
END$$
DELIMITER ;



DELIMITER $$

CREATE PROCEDURE login(
    IN p_email VARCHAR(50),
    IN p_password VARCHAR(100)
)
BEGIN
    SELECT admin_id, username, password
    FROM Admin 
    WHERE email = p_email 
      AND password = SHA2(p_password,256);
END $$

DELIMITER ;




DELIMITER $$
CREATE PROCEDURE continue_google(
    IN p_username VARCHAR(50),
    IN p_email VARCHAR(100)
)
BEGIN
    DECLARE email_count INT;
    DECLARE user_count INT;

    SELECT COUNT(*) INTO email_count
    FROM Admin
    WHERE email = p_email;

    SELECT COUNT(*) INTO user_count
    FROM Admin
    WHERE username = p_username;
    
    IF email_count > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Email already exists';
    ELSE
        INSERT INTO Admin(username, email, password, login_type)
        VALUES(p_username, p_email, NULL, 'google');
    END IF;
END$$
DELIMITER ;


