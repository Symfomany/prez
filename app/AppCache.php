<?php

require_once __DIR__.'/AppKernel.php';

use Symfony\Bundle\FrameworkBundle\HttpCache\HttpCache;

/**
 * Class AppCache
 */
class AppCache extends HttpCache
{
    /**
     * Override HTTP options
     * default_ttl : Le nombre de secondes pendant lesquelles une entrée du cache doit être considérée comme « valide » quand il n'y a pas d'information explicite fournie dans une réponse. Une valeur explicite pour les entêtes Cache-Control ou Expires surcharge cette valeur (par défaut : 0);
     *  private_headers : Ensemble d'entêtes de requête qui déclenche le comportement « privé » du Cache-Control pour les réponses qui ne précisent pas explicitement si elle sont publiques ou privées via une directive du Cache-Control. (par défaut : Authorization et Cookie);
     *  allow_reload : Définit si le client peut forcer ou non un rechargement du cache en incluant une directive du Cache-Control « no-cache » dans la requête. Définissez-la à true pour la conformité avec la RFC 2616 (par défaut : false);
     *  allow_revalidate : Définit si le client peut forcer une revalidation du cache en incluant une directive de Cache-Control « max-age=0 » dans la requête. Définissez-la à true pour la conformité avec la RFC 2616 (par défaut : false);
     *  stale_while_revalidate : Spécifie le nombre de secondes par défaut (la granularité est la seconde parce que le TTL de la réponse est en seconde) pendant lesquelles le cache peut renvoyer une réponse « périmée » alors que la nouvelle réponse est calculée en arrière-plan (par défaut : 2). Ce paramètre est surchargé par l'extension HTTP stale-while-revalidate du Cache-Control (cf. RFC 5861);
     *  stale_if_error : Spécifie le nombre de secondes par défaut (la granularité est la seconde) pendant lesquelles le cache peut renvoyer une réponse « périmée » quand une erreur est rencontrée (par défaut : 60). Ce paramètre est surchargé par l'extension HTTP stale-if-error du Cache-Control (cf. RFC 5961).
     * @return array
     */
    protected function getOptions()
    {
        return array(
            'debug'                  => false,
            'default_ttl'            => 0,
            'private_headers'        => array('Authorization', 'Cookie'),
            'allow_reload'           => false,
            'allow_revalidate'       => false,
            'stale_while_revalidate' => 2,
            'stale_if_error'         => 60,
        );
    }
}
