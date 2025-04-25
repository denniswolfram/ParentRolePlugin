CREATE TABLE IF NOT EXISTS parent_student_relations (
    parent_id CHAR(32) NOT NULL,
    student_id CHAR(32) NOT NULL,
    verified TINYINT(1) DEFAULT 0,
    PRIMARY KEY (parent_id, student_id),
    FOREIGN KEY (parent_id) REFERENCES auth_user_md5(user_id),
    FOREIGN KEY (student_id) REFERENCES auth_user_md5(user_id)
) ENGINE=InnoDB;