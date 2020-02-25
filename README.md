#### Quelles relations existent entre les entités (Many To One/Many To Many/...) ? Faire un schema de la base de données.

> - **User**
> 	- **OneToMany** : User a des Posts
> 	- **OneToMany** : User a des Comments
>
> - **Post**
> 	- **ManyToOne** : Post a un auteur qui est un User
> 	- **OneToMany** : Post a des Comments
>
> - **Comment**
> 	- **ManyToOne** : Comment est attaché à un Post
> 	- **ManyToOne** : Comment est attaché à un User

#### Expliquer ce qu'est le fichier .env
> C'est un fichier definissant des constantes globales permettant d'être utilisées sur tout le site.

#### Expliquer pourquoi il faut changer le connecteur à la base de données
> Il faut changer le connecteur à la base de données car dans notre cas nous n'utilisons pas MySQL, mais SQLite.

#### Expliquer l'intérêt des migrations d'une base de données
> Les migrations permettent de générer des fichiers de déploiement de base de données. Ainsi, n'importe qui travaillant sur le projet pourra avoir exactement le même schéma de BDD que le reste de l'équipe, car la BDD est directement créer à partir des fichiers de migrations générés par Doctrine.
> Elle permet également de revenir en arrière dans le cas d'une mise à jour non concluante.

#### Travail préparatoire : Qu'est-ce que EasyAdmin ?
> C'est un service permettant de créer un backend administrateur pré-configuré afin de faciliter la création et la gestion de nos entity avec un affichage déjà tout fait

#### Pourquoi doit-on implémenter des méthodes to string dans nos entités ?
> Afin de permettre d'afficher le contenu voulu lors de l'appel a cette classe. Utile avec easyPHP qui en a besoin pour afficher l'intitulé lors de relations.

#### Qu'est-ce que le ParamConverter ?
> Il sert à déclarer directement des objets à partir des paramètres demandés dans la route

#### Qu'est ce qu'un formulaire Symfony ?
> C'est un service permettant de créer des formulaires directement via les champs de l'Entity mentionné.

#### Quels avantages offrent l'usage d'un formulaire ?
> Il permettent une création et une personnalisation rapide et complète de formulaires

#### Définir les termes suivants : Encoder, Provider, Firewall, Access Control, Role, Voter
> - **Encoder** : C'est ce qui permet de hasher des champs d'une entity avec un algorythm particulier
> - **Provider** : C'est le fournisseur d'utilisateur permettant de dire à Symfony la classe et le champ d'identification à utiliser pour la sécurité de la gestion de l'utilisateur connecté. Celui ci permet de faire des controles de session et de base de données sur l'utilisateur à chaque nouvelle requete.
> - **Firewall** : Le pare-feu en francais, c'est le système d'authentification. Symfony offre la possibilité de le configurer facilement
> - **Access Control** : C'est une facon de pouvoir vérifier si l'utilisateur bénéficie d'un certain role lui donnant certains droits, avec la fonction twig is_granted('THE_ROLE')
> - **Role** : Ce sont des permissions accordées à l'utilisateur
> - **Voter** : Ils permettent de vérifier les autorisations d'un utilisateur en particulier, et de repondre en conséquence.

#### Qu'est-ce que FOSUserBundle ? Pourquoi ne pas l'utiliser ?
> C'est un ensemble de composant permettant de gérer tout l'aspect utilisateur (formulaire de connexion, d'inscription, gestion du compte, mot de passe oublié, l'édition du profil, etc) et compatible avec Doctrine.
> Les raisons de ne pas l'utiliser sont que la personnalisation y est obligatoire, la flexibilité des controller est limité et il est obligatoire d'overrider ces controllers, il possède de nombreuses fonctionnalités inutiles, et est complexe à mettre en place. 
> Il vaut mieux privilégier le MakerBundle, plus simple, plus léger, plus flexible.

#### Définir les termes suivants : Argon2i, Bcrypt, Plaintext, BasicHTTP
> - **Argon2i** : C'est une fonction de hashage reconnue pour être très fiable, et qui à remporter le Password Hashing Competition en 2015. Depuis php 7.2, celle-ci fait parti de la fonction php password_hash en tant que constante possible.
> - **Bcrypt** : C'est une fonction de hashage reconnue pour être très fiable également, et qui est la méthode par défault dans la fonction php_hash, et dans plein d'autres langage également. Celle-ci existe depuis 1999.
> - **Plaintext** : Signifie que le texte est en clair, et donc non hashé.
> - **BasicHTTP** : C'est une authentification HTTP peu sécurisé et non chiffré, qui necessite de recevoir les informations utilisateur dans l'entête de la requête. Les navigateurs mettent donc en cache (et non pas en cookie ou en session comme il est commun de le faire), afin d'évité d'avoir à redemander les identifiants de connexion à l'utilisateur à chaque navigation de page.

#### Faire un schema expliquant quelle méthode est appelée dans quel ordre dans le LoginFormAuthenticator. Définir l'objectif de chaque méthodes du fichier.
>

#### À quoi sert un service dans Symfony ?
> L’avantage d’un service est d’avoir un code modulaire et réutilisable partout dans l’application juste on faisant appel a celui-ci.

#### Avez-vous déjà utilisé des services dans ce projet ? Si oui, lesquels ?
> Oui, le Request, le Mailer, etc.

#### Définir les termes suivant : 
> - **Dependency** : 
> - **Injection** : 
> - **Service** : C'est un objet PHP qui remplit une fonction bien spécifique au sein de symfony (comme l'envoye d'emails, effectuer une tâche récurrente, etc), associé à une configuration, qui a pour vocation d'être accessible n'importe où dans votre code
> - **Autowiring** : C'est ce qui permet de gérer les services dans le conteneur avec une configuration minimale. Il lit les indications de type en paramètres des methodes des Controllers et transmet automatiquement les services corrects à chaque méthode.
> - **Container** : C'est la boite à outil de Symfony. Il permet d'instancier, d'organiser et de récupérer les nombreux services de votre application. 

#### Quelle importance a les services dans le fonctionnement de Symfony ?
> Les services dans Symfony sont très utile et important car ils servent à être injecté directement dans les paramètres des methodes afin de pouvoir utiliser immédiatement toutes les foncions qu'elles contiennent