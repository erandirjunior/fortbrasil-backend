<?php

namespace SRC\Application\Repository;

use SRC\Domain\Establishment\Interfaces\CreateRepository;
use SRC\Domain\Establishment\Interfaces\DeleteRepository;
use SRC\Domain\Establishment\Interfaces\FindRepository;
use SRC\Domain\Establishment\Interfaces\UpdateRepository;

interface Establishment extends
    CreateRepository,
    DeleteRepository,
    UpdateRepository,
    FindRepository
{}