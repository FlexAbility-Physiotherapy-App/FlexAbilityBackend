-- Populate database with data for testing purposes
INSERT INTO `user` (`username`, `password`, `category`) VALUES
('usernamePhysio', 'passwordPhysio', 'admin'),
('usernameDoctor', 'passwordDoctor', 'physio'),
('usernamePatient1', 'passwordPatient1', 'patient'),
('usernamePatient2', 'passwordPatient2', 'patient'),
('usernamePatient3', 'passwordPatient3', 'patient');

INSERT INTO `patient` (`id`, `name`, `surname`, `phone_number`, `sex`, `amka`) VALUES
(3, 'John', 'Doe', '1234567890', 'Male', '33333333333'),
(4, 'Jane', 'Smith', '9876543210', 'Female', '44444444444'),
(5, 'Mike', 'Johnson', '5678901234', 'Male', '55555555555');

INSERT INTO `physio` (`id`, `address`, `name`, `owner`, `afm`, `phone_number`) VALUES
(1, '123 Main Street', 'Physio Care', 'John Doe', '445566778', '1234567890');
