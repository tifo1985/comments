<?php

declare(strict_types=1);

namespace App\Infrastructure\Ports;

use App\Domain\Gateway\ArticleGateway;

class ArticleRepository implements ArticleGateway
{
    private const ARTICLES = [
        [
            'uuid' => 'e94ee283-e12e-4548-93b1-5d100290c57e',
            'title' => 'Pour être adoptée et faire tomber le gouvernement',
            'image' => 'https://www.francetvinfo.fr/pictures/kOe5hwQO7NNKMloi0ndfRtMTIzg/752x423/2023/02/15/phptm3KYx.jpg',
            'text' => <<<EOT
                Marine Le Pen a annoncé, mercredi 15 février, avoir déposé une motion de censure avec son groupe Rassemblement national (RN) "afin que les députés opposés" à la réforme des retraites "puissent exprimer leur rejet de ce texte", évoquant un "référendum parlementaire" contre le gouvernement d'Elisabeth Borne. Alors que les débats doivent prendre fin vendredi soir, à minuit, "il apparaît clairement qu'aucun vote ne sera possible sur l'article 7" faisant passer l'âge de la retraite de 62 à 64 ans, "et encore moins sur l'ensemble du projet de loi", a poursuivi la leader d'extrême droite lors d'une conférence de presse organisée en fin d'après-midi.
                >> Réforme des retraites : suivez les dernières actualités dans notre direct
                "Les quelques jours de discussions dans l'hémicycle ont montré qu'en réalité, la mesure majeure du texte était bien le passage de l'âge de départ à 64 ans et que le reste des mesures étaient des artifices nullement à même de compenser la brutalité, l'injustice et le caractère antisocial de cette réforme", écrit Marine Le Pen dans le texte de la motion de censure. La cheffe de file du RN au Palais-Bourbon considère qu'"il serait par conséquent antidémocratique que les représentants de la nation ne puissent pas s'exprimer sur cette réforme".
                EOT
        ],
        [
            'uuid' => '1124d9e8-6266-4bcf-8035-37a02ba75c69',
            'title' => 'arine Le Pen a annoncé',
            'image' => 'https://www.francetvinfo.fr/pictures/kOe5hwQO7NNKMloi0ndfRtMTIzg/752x423/2023/02/15/phptm3KYx.jpg',
            'text' => <<<EOT
                            Pour être adoptée et faire tomber le gouvernement, "la motion de censure ne peut être adoptée qu'à la majorité des membres composant l'Assemblée", soit 289 députés. Celle-ci a donc peu de chances d'aboutir, car les députés Les Républicains soutiennent officiellement la réforme et font passer le nombre d'opposants au texte sous les 289, en théorie.

                            De plus, l'opposition de gauche a plusieurs fois refusé de signer les motions de censure déposées par le Rassemblement national depuis le début de la législature, en juin dernier. En refusant de nouveau de voter la motion de censure du RN, la Nupes ferait mécaniquement échouer celle-ci.
                            EOT,
        ],
    ];

    public function findAll(): array
    {
        return self::ARTICLES;
    }

    public function find(string $articleId): null|array
    {
        $articles = array_filter(self::ARTICLES, fn (array $article) => $article['uuid'] === $articleId);

        return array_pop($articles);
    }
}
