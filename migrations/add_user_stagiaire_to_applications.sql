-- Add user_id and trainee_id to internship_applications table
ALTER TABLE internship_applications
ADD COLUMN user_id BIGINT UNSIGNED NULL;

ALTER TABLE internship_applications
ADD COLUMN trainee_id BIGINT UNSIGNED NULL;