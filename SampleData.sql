-- Populate database with data for testing purposes
INSERT INTO `user` (`username`, `password`, `category`) VALUES
('usrAdmin', '1234', 'admin'),
('usrPhysio1', '1234', 'physio'),
('usrPhysio2', '1234', 'physio'),
('usrPhysio3', '1234', 'physio'),
('usrPatient1', '1234', 'patient'),
('usrPatient2', '1234', 'patient'),
('usrPatient3', '1234', 'patient');

INSERT INTO `patient` (`id`, `name`, `surname`, `phone_number`, `sex`, `amka`) VALUES
(5, 'Γιάννης Χρήστου', '1234567890', 'Άρρεν', '55555555555'),
(6, 'Ευθυμία', 'Πατουσάκη', '9876543210', 'θύλη', '66666666666'),
(7, 'Μηχάλης', 'Σωτηρίου', '5678901234', 'Άρρεν', '77777777777');

INSERT INTO `physio` (`id`, `address`, `name`, `afm`, `phone_number`) VALUES
(2, 'Δραγούμη 123', 'Physio Care', '222222222', '1234567890'),
(3, 'Ελευθερίας 456', 'Physio Wellness', '333333333', '9876543210'),
(4, 'Τζουμαγιάς 789', 'Elite Physiotherapy', '444444444', '3355115599');

INSERT INTO `provision` (`id`, `description`, `cost`, `name`) VALUES
('P1', 'Βασική διάγνωση', 50, 'Διάγνωση'),
('P2', 'Εξέταση με ακτινογραφία X-ray', 100, 'Ακτινογραφία'),
('P3', 'Ηλεκτροθεραπεία με ρεύματα TENS', 80, 'Ηλεκτροθεραπεία');

INSERT INTO `patient_physio` (`patient_id`, `physio_id`, `timestamp`, `status`) VALUES
(5, 2, '2023-06-21 12:00:00', 'accepted'),
(5, 3, '2023-06-22 15:00:00', 'pending'),
(6, 3, '2023-06-23 11:00:00', 'accepted'),
(7, 4, '2023-06-24 12:00:00', 'accepted'),
(6, 2, '2023-06-21 18:00:00', 'accepted'),
(7, 4, '2023-06-21 10:00:00', 'pending');

INSERT INTO `patient_physio` (`patient_id`, `physio_id`, `timestamp`, `status`, `cost`, `comment`, `provision_id`) VALUES
(5, 2, '2023-06-18 09:00:00', 'completed', 50, 'Συνταγογράφηση φυσιοθεραπείας', 'P1'),
(6, 2, '2023-06-18 20:00:00', 'completed', 100, 'Συνταγογράφηση αναλγητικών φαρμάκων', 'P2'),
(6, 3, '2023-06-18 16:00:00', 'completed', 80, 'Συνιστώνται καθημερινές μαλάξεις', 'P3'),
(7, 4, '2023-06-18 13:00:00', 'completed', 100, 'Προτροπή σε ορθοπαιδικό', 'P2');

