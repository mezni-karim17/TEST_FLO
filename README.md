# TEST_FLORAJET


Technologies Utilisées
------------
- PHP 8.1, Symfony 6.4, Api Platform 3.2, MySQL, Docker



Installation
------------

- Aprés de cloner le projet lancer les commandes :
    - 1 make init
    - 2 make database-init
    - 3 make jwt-keypair

API Swagger : http://127.0.0.1:8000/api
DataBase : http://127.0.0.1:8080/


Description
------------

- Disposition d’un API REST mettant à disposition les articles, les sources et User et login Check :
    - La création de deux entités, Sources et Articles. J'ai ajouté un attribut 'type' pour déterminer la nature de la source (RSS, DB, FS, API).

    - La création d'un service AdapterAgregator appliquant le pattern Aggregator est utilisée pour agréger plusieurs objets en un seul objet agrégé. Dans ce cas, la classe AdapterAggregator agrège plusieurs objets qui implémentent l'interface DataAdapterInterface. Elle fournit une méthode getAdapter() pour récupérer un adaptateur spécifique en fonction du type de la source.

    - La classe RssAdapter, qui implémente l'interface DataAdapterInterface, encapsule la logique métier permettant de récupérer les articles d'un flux RSS et de les persister dans la base de données. On peut ajouter plusieur class de flux sans modifier le code source

    - Authentification avec JWT (JSON Web Token) et Refresh Token


Scénario de test
------------

- Creates a Source resource : POST  | http://127.0.0.1:8000/api/sources
 {
  "name": "Le monde",
  "src": "http://www.lemonde.fr/rss/une.xml",
  "type": "RSS"
  }

  ==> Insertion le donné dans la table source et récupérer les articles et inserer dans la DB
