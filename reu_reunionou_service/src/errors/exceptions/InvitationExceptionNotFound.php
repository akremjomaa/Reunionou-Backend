<?php

namespace events\errors\exceptions;

class InvitationExceptionNotFound extends \Exception
{
    protected $code = 404;
    protected $message = 'L\'identifiant de l\'invitation demandée ne correspond à aucune ressource disponible';
    protected string $title = 'Ressource non trouvée';
    protected string $description = 'data not found';
}
