## 🗒️ Barème :

Michel Recchia

| **Barème**                           | **Points**| **Remarque**                               |**Points Obtenus**|
| :-----------------------------------:| :-------: | :-------------------------------------:    |:-:|
| Entités                              |     4     |                                            | 4 |
| Fixtures                             |     2     |                                            | 2 |
| Système de traduction                |     2     |                                            | 2 |
| Formulaires                          |     5     | Problème avec l'entité Cover. Quand je fais un Album je peux choisir dans toutes les Cover. Mais Cover est en OneToOne avec un Album. Donc si j'ajoute une Cover déjà dans un Album j'ai une erreur 'UniqueConstraintViolationException'. Solution possible : ne pas afficher les Cover déjà utilisées.    | 4 |
| Système de connexion                 |     3     |  Ton RegistrationFormType utilise un TextType pour l'email à la place d'un EmailType, je peux donc m'inscrire en mettant une chaîne de caractère classique alors que tu demandes un email. | 2 |
| Tableau de bord                      |     2     |                                            | 2 |
| Création d'un EventCustom            |     2     |                                            | 2 |
| Code convention (points bonus)       |     2     | Code inutilisé FanRepository, YearRepository. J'imagine que tu avais prévu d'autre chose dans ce cas n'hésite pas à le mettre dans le readme en TODO. Dans artist $this->albums = new ArrayCollection(); alors qu'il n'y a pas de propriété albums dans Artist.php. Peut importe le langage, il est important de regarder les outils de qualité de code qu'il existe, car souvent, tu n'as rien à faire pour vérifier si tous tes fichiers sont correctes. Il suffit souvent d'une commande.| 1 |
| **Total**                            |   **22**  |                                            | 19 |