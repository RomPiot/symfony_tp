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
### Expliquer pourquoi il faut changer le connecteur à la base de données
> C'est un fichier definissant des constantes globales permettant d'être utilisées sur tout le site.
> Il faut changer le connecteur à la base de données car dans notre cas nous n'utilisons pas MySQL, mais SQLite.

#### Expliquer l'intérêt des migrations d'une base de données
> Les migrations permettent de générer des fichiers de déploiement de base de données. Ainsi, n'importe qui travaillant sur le projet pourra avoir exactement le même schéma de BDD que le reste de l'équipe, car la BDD est directement créer à partir des fichiers de migrations générés par Doctrine.

#### Travail préparatoire : Qu'est-ce que EasyAdmin ?
>

#### Pourquoi doit-on implémenter des méthodes to string dans nos entités ?
>

#### Qu'est ce que le ParamResolver ?
>

#### Qu'est ce qu'un formulaire Symfony ?
>

#### Pourquoi utiliser des formulaires directement en PHP ?
>