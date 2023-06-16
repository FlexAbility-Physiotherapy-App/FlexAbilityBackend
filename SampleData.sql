-- Populate database with data for testing purposes
INSERT INTO `user` (`username`, `password`, `category`) VALUES
('usrAdmin', 'pswAdmin', 'admin'),
('usrPhysio1', 'pswPhysio1', 'physio'),
('usrPhysio2', 'pswPhysio2', 'physio'),
('usrPhysio3', 'pswPhysio3', 'physio'),
('usrPatient1', 'pswPatient1', 'patient'),
('usrPatient2', 'pswPatient2', 'patient'),
('usrPatient3', 'pswPatient3', 'patient');

INSERT INTO `patient` (`id`, `name`, `surname`, `phone_number`, `sex`, `amka`) VALUES
(5, 'John', 'Doe', '1234567890', 'Male', '55555555555'),
(6, 'Jane', 'Smith', '9876543210', 'Female', '66666666666'),
(7, 'Mike', 'Johnson', '5678901234', 'Male', '77777777777');

INSERT INTO `physio` (`id`, `address`, `name`, `afm`, `phone_number`) VALUES
(2, '123 Main Street', 'Physio Care', '222222222', '1234567890'),
(3, '456 Elm Street', 'Physio Wellness', '333333333', '9876543210'),
(4, '789 Oak Street', 'Elite Physiotherapy', '444444444', '3355115599');

INSERT INTO `provision` (`id`, `description`, `cost`, `name`) VALUES
('P1', 'Basic Check-up', 50, 'Check-up'),
('P2', 'X-ray examination', 100, 'X-ray'),
('P3', 'Physical therapy session', 80, 'Physical Therapy');

INSERT INTO `patient_physio` (`patient_id`, `physio_id`, `timestamp`, `status`) VALUES
(5, 2, '2023-06-12 12:00:00', 'accepted'),
(5, 3, '2023-06-13 12:00:00', 'pending'),
(6, 3, '2023-06-14 12:00:00', 'accepted'),
(7, 4, '2023-06-15 12:00:00', 'pending');

