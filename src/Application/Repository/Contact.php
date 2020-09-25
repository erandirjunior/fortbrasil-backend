<?php

namespace SRC\Application\Repository;

use SRC\Domain\Contact\Interfaces\CreateRepository;
use SRC\Domain\Contact\Interfaces\DeleteRepository;
use SRC\Domain\Contact\Interfaces\FindContactsByEstablishmentRepository;
use SRC\Domain\Contact\Interfaces\UpdateRepository;

interface Contact extends
    CreateRepository,
    DeleteRepository,
    UpdateRepository,
    FindContactsByEstablishmentRepository
{}