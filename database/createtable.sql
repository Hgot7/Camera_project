CREATE DATABASE camera_project;
USE camera_project;

CREATE TABLE building (
    building_id INT NOT NULL AUTO_INCREMENT,
    building_fullname TEXT,
    building_name TEXT,
    time TIMESTAMP,
    PRIMARY KEY (building_id)
);

CREATE TABLE room (
    room_id INT NOT NULL AUTO_INCREMENT,
    room_name TEXT,
    room_number TEXT,
    building_id INT,
    time TIMESTAMP,
    PRIMARY KEY (room_id),
    FOREIGN KEY (building_id) REFERENCES building(building_id)
);

CREATE TABLE camera (
    camera_id INT NOT NULL AUTO_INCREMENT,
    camera_name TEXT,
    status INT,
    building_id INT,
    room_id INT,
    time TIMESTAMP,
    PRIMARY KEY (camera_id),
    FOREIGN KEY (building_id) REFERENCES building(building_id),
    FOREIGN KEY (room_id) REFERENCES room(room_id)
);

CREATE TABLE images (
    image_id INT NOT NULL AUTO_INCREMENT,
    image_name TEXT,
    camera_id INT,
    time TIMESTAMP,
    PRIMARY KEY (image_id),
    FOREIGN KEY (camera_id) REFERENCES camera(camera_id)
);

CREATE TABLE department (
    department_id INT NOT NULL AUTO_INCREMENT,
    department_name TEXT,
    time TIMESTAMP,
    PRIMARY KEY (department_id)
);

CREATE TABLE subject (
    subject_id INT NOT NULL AUTO_INCREMENT,
    subject_name TEXT,
    department_id INT,
    PRIMARY KEY (subject_id),
    FOREIGN KEY (department_id) REFERENCES department(department_id)
);

CREATE TABLE sub_subject (
    sub_subject_id INT NOT NULL AUTO_INCREMENT,
    sub_subject_name TEXT,
    subject_id INT,
    PRIMARY KEY (sub_subject_id),
    FOREIGN KEY (subject_id) REFERENCES subject(subject_id)
);

CREATE TABLE classroom (
    classroom_id INT NOT NULL AUTO_INCREMENT,
    level TEXT,
    sub_level INT,
    class TEXT,
    department_id INT,
    subject_id INT,
    sub_subject_id INT,
    building_id INT,
    room_id INT,
    camera_id INT,
    line_token TEXT,
    time TIMESTAMP,
    PRIMARY KEY (classroom_id),
    FOREIGN KEY (department_id) REFERENCES department(department_id),
    FOREIGN KEY (subject_id) REFERENCES subject(subject_id),
    FOREIGN KEY (sub_subject_id) REFERENCES sub_subject(sub_subject_id),
    FOREIGN KEY (building_id) REFERENCES building(building_id),
    FOREIGN KEY (room_id) REFERENCES room(room_id),
    FOREIGN KEY (camera_id) REFERENCES camera(camera_id)
);

CREATE TABLE queue_setup (
    queue_id INT NOT NULL AUTO_INCREMENT,
    day INT,
    time_start TIME,
    time_stop TIME,
    classroom_id INT,
    time TIMESTAMP,
    PRIMARY KEY (queue_id),
    FOREIGN KEY (classroom_id) REFERENCES classroom(classroom_id)
);
