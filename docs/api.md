# Documentation de l'API

| Numero | Endpoint | Méthode HTTP | Donnée(s) à transmettre | Description |
|--|--|--|--|--|
| 1 | `/videogames` | GET | - | Récupération des données de tous les jeux vidéos |
| 2 | `/videogames` | POST | **name**, editor, status | Ajout d'un jeu vidéo |
| 3 | `/videogames/[id]` | GET | - | Récupération des données du jeu vidéo dont l'id est fourni |
| 4 | `/videogames/[id]` | PUT | name, editor, status | Mise à jour d'un jeu vidéo |
| 5 | `/videogames/[id]` | DELETE | - | Suppression d'un jeu vidéo |
| 3 | `/videogames/[id]/reviews` | GET | - | Récupération les données des critiques du jeu vidéo dont l'id est fourni |
| 6 | `/platforms` | GET | - | Récupération des données de toutes les plate-formes |
| 7 | `/platforms` | POST | name, manufacturer, status | Ajout d'une plate-forme |
| 8 | `/platforms/[id]` | GET | - | Récupération des données de la plate-forme dont l'id est fourni |
| 9 | `/platforms/[id]` | PUT | **name**, manufacturer, status | Mise à jour d'une plate-forme |
| 10 | `/platforms/[id]` | DELETE | - | Suppression d'une plate-forme |
| 11 | `/reviews` | GET | - | Récupération des données de toutes les critiques |
| 12 | `/reviews` | POST | **title**, text, author, publication_date, display_note, gameplay_note, scenario_note, lifetime_note, **videogame_id**, **platform_id**, status | Ajout d'une critique |
| 13 | `/reviews/[id]` | GET | - | Récupération des données de la critique dont l'id est fourni |
| 14 | `/reviews/[id]` | PUT | title, text, author, publication_date, display_note, gameplay_note, scenario_note, lifetime_note, videogame_id, platform_id, status | Mise à jour d'une critique |
| 15 | `/reviews/[id]` | DELETE | - | Suppression d'une critique |