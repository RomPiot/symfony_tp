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
> 

#### Expliquer l'intérêt des migrations d'une base de données
>

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