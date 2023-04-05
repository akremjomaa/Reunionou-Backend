<?php

namespace events\errors\exceptions;

class UserExceptionNotFound extends \Exception
{
    protected $code = 404;
    protected $message = 'L\'identifiant de l\'utilisateur demandé ne correspond à aucune ressource disponible';
    protected string $title = 'Ressource non trouvée';
    protected string $description = 'data not found';
}
