CREATE DATABASE gestion_des_cours;
USE gestions_des_coures;
CREATE DATABASE gestions_des_coures;
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    level VARCHAR(50) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    CHECK (level IN ('Débutant', 'Intermédiaire', 'Avancé'))
);
CREATE TABLE sections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    position INT DEFAULT 1,

    FOREIGN KEY (course_id) REFERENCES courses(id)
   
);


-- modifier dans la table sections

AlTER TABLE sections
ADD CONSTRAINT unique_course_position
UNIQUE(course_id,position);



INSERT INTO courses (id, title, description, level, created_at) VALUES (1, 'Introduction au Développement Web', 'Apprendre les bases du HTML, CSS et JavaScript pour créer des sites web modernes.', 'Débutant', '2025-01-10 09:32:00'),
(2, 'Python pour Data Science', 'Découverte des bibliothèques Python utilisées en Data Science.', 'Intermédiaire', '2025-02-04 14:12:30'),
(3, 'Bases de Données MySQL', 'Comprendre la modélisation, les requêtes SQL et l’optimisation.', 'Débutant', '2025-03-11 11:47:15'),
(4, 'Machine Learning Fondamentaux', 'Introduction aux algorithmes d’apprentissage supervisé.', 'Avancé', '2025-04-18 16:21:50');





INSERT INTO sections (id, course_id, title, content, position) VALUES (1, 1, 'Qu’est-ce que le Web ?', 'Présentation générale du fonctionnement du web.', 1),
(2, 1, 'Introduction au HTML', 'Les balises, la structure et les éléments courants.', 2),
(3, 1, 'Bases du CSS', 'Styliser vos pages avec le CSS.', 3),
(4, 2, 'Introduction à Python', 'Variables, boucles, fonctions et structures de données.', 1),
(5, 2, 'NumPy pour les tableaux', 'Manipulation de données avec NumPy.', 2),
(6, 2, 'Pandas pour l’analyse', 'Chargement, nettoyage et manipulation de données.', 3),
(7, 3, 'Introduction à SQL', 'Présentation des requêtes SELECT, INSERT, UPDATE.', 1),
(8, 3, 'Relations et clés étrangères', 'Comprendre les relations entre tables.', 2),
(9, 3, 'Requêtes avancées', 'GROUP BY, JOIN, sous-requêtes.', 3),