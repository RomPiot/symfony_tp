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

#### Qu'est ce que le ParamResolver ?
>

#### Qu'est ce qu'un formulaire Symfony ?
> C'est un service permettant de créer des formulaires directement via les champs de l'Entity mentionné.

#### Quels avantages offrent l'usage d'un formulaire ?
> Il permettent une création et une personnalisation rapide et complète de formulaires