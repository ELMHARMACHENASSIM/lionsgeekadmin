## Intro : 
L'objectif de ce cahier des charges est de définir les exigences fonctionnelles pour le developpement d'une application web qui permettra de suivre l'utilisation des studios de tournages , des classes , et de générer des rapports réguliers sur cette utilisation . 

## Gestion des utilisateurs : 
- Authentification sécurisé avec des rôles d'utilisateur .
- Double authentification par mail obligatoire pour le role Administrateur ( mehdi ) , possibilité du choix pour les autres utilisateurs .
- Seul l'administrateur peut créer des comptes et assigner des rôles .
- Les rôles : 
    <Administrateur>
    <Gestion_studio>
    <Gestion_classe>
    <User_interne>
    <User_externe>
- Chaque user , sera assigner quel type de user est-il + de quel gestion s'occupe-t-il . un user peut avoir tout les rôles . ( Mehdi a tout les rôles aussi )
<!-- !Explaining Done  -->
## Gestion des studios :
Possibilité de modifier les noms de chaques studios , créer des studios . Chaque studio aura une liste de photo qui le représente . ( ADMIN )
Les studios : 
    <Studio_1>
    <Studio_2>
    <Espace_cafe>
    <Espace_Agora>
    <Co_working>
    <Externe>
<!-- !Explaining Done  -->
## Gestion des équipements :
Possibilité de créer , modifier chaque équipement , son état , et son stock . Chaque équipement doit avoir une photo qui le représente . ( ADMIN )
    <Liste_équipement>
<!-- !Explaining Done  -->

## Gestion des classes :
Possibilité de modifier les noms de chaques classes , créer des classes . Chaque classe aura une liste de photo qui le représente . ( ADMIN )
Il y a 6 classes :
    <Salle_1>
    <Salle_2>
    <Salle_3>
    <Salle_4>
    <Salle_5>
    <Salle_6>
<!-- !Explaining Done  -->

## Gestion du calendrier :
Caldendrier interactif permettant aux users de réserver des plages horraires pour un tournage ou une classe .
- Pour Equipement : Il faut un calendrier ou il sera afficher pour chaque équipement choisis , les plages horraires de réservation qu'il a .

- Pour Studio : Il faut un calendrier ou il sera afficher les réservations de chaque studio choisis .

- Pour classe : Même que Studio .

## Reserver un studio : 
- Pour reserver un studio , avec/ou un équipement , l'user doit d'abord choisir quel type de tournage ( donc dans quel studio ) , il doit choisir les heures possible et les équipements disponible à travers le calendrier de réservation .
- Seul les user avec le role <gestion_studio> peuvent reserver dans le calendrier du studio .
- Seul les reservations du user sont modifiables . Il ne peut pas toucher à la reservation des autres user qu'on le même role .
- L'user doit remplir , un titre , une description , les personnes qui travaillerons avec lui , le temps de tournage + les équipements et commentaire .
- L'user peut aussi annonçer un problème avec les équipements , si ils sont défféctueux .
- Quand un user annonce un problème avec un matériel , si celui est deja reservé par d'autres , un mail automatique s'envoie pour chaque user ayant reserver ce matériel dans le futur pour annoncer la mauvaise nouvelle .
- L'user peut annuler sa reservation , mais elle n'est supprimé seulement si l'admin en décide ainsi . ( garder un historique )

## Reserver une classe : 
- Pour reserver une classe , l'user doit choisir la classe qu'il veut , si elle est dispo pour le jour et le temps qu'il a besoin .
- Seul les user avec le role <gestion_classe> peuvent reserver dans le calendrier de classe .
- Seul les réservations du user sont modifiable . Il ne peut pas toucher à la reservations des autres users qu'on le même role .
- L'user doit remplir un titre , une description + commentaire .
- L'user peut annuler sa reservation , mais elle n'est supprimé seulement si l'admin en décide ainsi . ( garder un historique )

## Admin :
- L'admin a acces a l'historique de toute les reservations , celle qui sont passé + annulé .
- L'admin peut s'envoyer un mail avec le rapport de chaque jour sur chaque reservation (même les annuler) .
- L'admin a acces a une statistique de chaque salle / studio , avec le nombre de fois qu'elle a été utilisé par (jour / semaine) + (interne / exeterne) . BONUS

## Autres possibilités : 
Possibilité d'upload des photos + videos ( ou un fichier zip ) pour chaque réservations . Et donc de pouvoir le retélécharger ( créer comme une sorte de cloud pour lionsgeek ).




