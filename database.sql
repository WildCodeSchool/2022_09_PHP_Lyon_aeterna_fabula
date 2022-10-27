DROP DATABASE IF EXISTS aeterna_fabula;

CREATE DATABASE aeterna_fabula;

USE aeterna_fabula;

CREATE TABLE `chapter` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(35) NOT NULL,
  `title` VARCHAR(80) NOT NULL,
  `description` VARCHAR(500) NOT NULL,
  `background_image` VARCHAR(100) NOT NULL,
  `background_image_alt` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO
  `chapter` (
    `id`,
    `name`,
    `title`,
    `description`,
    `background_image`,
    `background_image_alt`
  )
VALUES
(1, "village", "Vous quittez votre village et partez à l'aventure.", "Tuer un dragon... Voilà une quête pour vous ! Et si vous y parveniez ? Vous deviendriez alors le héros du village, et vous inscririez votre nom à la postérité... Après quelques centaines de mètres, un premier choix s'offre à vous. Quel chemin choisir ?", "image_01.jpg", "Départ du village"),
(2, "mountain_base", "La montagne, imposante, se dresse devant vous.", "Vous marchez encore plusieurs heures avant d'arriver à un embranchement. Un chemin escarpé s'enfonce dans la forêt, tandis qu'un autre semble vous conduire tout droit vers une grotte. Lequel prendre ?", "image_02.jpg", "Au pied de la montagne"),
(3, "castle", "Vous arrivez aux abords du château de KastelÆter.", "Il y a beaucoup d'animation aujourd'hui au château. Des hommes en armes font des allers et venues vers le donjon tandis qu'une ambiance tumulteuse émane du coeur de la ville fortifiée, où de nombreux badauds se pressent.", "image_03.jpg", "Arrivée au château"),
(4, "market", "Vous débouchez sur une place très animée où se tient le marché.", "Différents étals se présentent à  vous et éveillent vos sens : là des étoffes de toutes les couleurs, et un peu plus loin un mélange de parfums délicieux qui vous mettent en appétit ... Un petit marchand trappu à la mine joviale semble vous appeler du regard, devant sa sélection de fioles d'apothicaire. Vous vous approchez, et il vous propose de répondre à une simple question pour tenter de gagner l'une de ses potions. Que décidez-vous ?", "image_04.jpg", "Le marché"),
(5, "dungeon", "Vous trouvez facilement l'entrée du donjon et en gravissez les marches.", "Vous recontrez un chevalier. Il est gravement blessé, Il vous explique qu'il a déjà combattu le dragon. Il vous propose de vous confier sa monture et l'aide de son écuyer pour vous conduire au repaire de la bête. ", "image_05.jpg", "Le donjon"),
(6, "steep_path", "Vous avancez péniblement en suivant ce chemin sinueux.", "Vous vous enfoncez dans une forêt inextricable où règnent une ambiance moite et une odeur pestidentelle. Le terrain devient marécageux, et des bruits métalliques très cadencés semblent de plus en plus proches. Vous n'êtes clairement pas seul dans ce bourbier.", "image_06.jpg", "Le chemin escarpé"),
(7, "cave_ravine", "Vous vous enfoncez dans la grotte et arrivez au bord d'un ravin.", "Une grotte, un gouffre, ça vous rappelle une histoire... Vous apercevez une corniche très étroite qui devrait supporter votre poids. Vous pouvez aussi sauter de l'autre côté pour gagner de précieuses heures, il y a justement un endroit d'où vous pouvez vous lancer, ça vous semble à votre portée.", "image_07.jpg", "Le gouffre de la grotte"),
(8, "merchant_enigma", "Vous écoutez le marchand vous poser son énigme ...", "Difficile à trouver, difficile à garder, je cesse d'être à l'instant où je suis découvert. Qui suis-je ?", "image_08.jpg", "L'énigme du marchand"),
(9, "earned_vial", "Bonne réponse ! Le marchand, à contrecoeur, vous offre votre dû.", "Il s'agit d'une petite fiole contenant un liquide de couleur rouge. Le marchand ambulant vous explique qu'il est apothicaire, et qu'il a confectionné lui-même cette potion de guérison. Elle devrait vous permettre de retrouver toute votre santé dans le cas où vous vous trouveriez mal en point. Sans doute un atout pour la suite de votre quête ...", "image_09.jpg", "Potion gagnée"),
(10, "lost_vial", "Mauvaise réponse ! La potion vous échappe pour cette fois.", "Vous pourrez retenter votre chance la semaine prochaine si vous êtes toujours de ce monde. En attendant, une quête vous attend : il y a un dragon à tuer je vous rappelle ...", "image_10.jpg", "Potion perdue"),
(11, "orc_death", "Vous tombez nez à nez avec un orc en train d'aiguiser sa hache.", "En un éclair il jette son arme vers vous, et vous fracasse le crâne sans que vous n'ayez le temps de réagir. Vous tombez raide mort.", "image_11.jpg", "Tué par un orc"),
(12, "ravine_death", "Vous prenez votre élan, inspirez profondément, et faites le grand saut ...", "Aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaah ............ BAM ! Personne ne viendra jamais vous ramasser au fond de ce trou, et votre nom restera dans l'oubli pour l'éternité. RIP", "image_12.jpg", "Chute mortelle"),
(13, "mountain_top", "Cette route vous conduit tant bien que mal au sommet de la montagne.", "Les grondements se font de plus en plus menaçants. Vous apercevez la silhouette de la bête qui s'agite derrière de gros rochers. Le sol est jonché de cadavres. Êtes-vous prêt à combattre ? À devenir le héros que vous rêvez d'être ?", "image_13.jpg", "Au sommet de la montagne"),
(14, "fighting", "Vous prenez votre courage à deux mains et vous dirigez vers le monstre.", "Le combat est acharné. Vous videz presque entièrement votre carquois tandis que le dragon vous crache ses flammes. En réponse à ses terribles griffures, vous lui asssénez quelques coups d'épée bien placés. Vous arrivez tout deux à bout de force. Le coup décisif doit être porté. Quelle arme choisir ?", "image_14.jpg", "Combat avec le dragon"),
(15, "combat_death", "Vous dégainez votre épée, et pivotez pour décapiter le dragon ...", "Mais dans un ultime mouvement, celui-ci se jette sur vous et vous désarme. Vous touchez le sol, et la bête commence à vous grignoter. Vous perdez progressivement conscience, et dans un dernier sourire, vous réalisez que vous servirez d'engrais, comme tous les héros portés par cette maudite contrée.", "image_15.jpg", "Tué par le dragon"),
(16, "victory", "En un éclair, vous décochez une flèche en direction du dragon ...", "Le projectile atteint le monstre, en plein dans l'oeil, et traverse son crâne. Il s'écroule, terrassé. Vous avez vaincu la bête, les villages alentours sont libérés de la terreur, et vous êtes porté en héros dans les rues de KastelÆter.", "image_16.jpg", "Victoire")