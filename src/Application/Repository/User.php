<?php

namespace SRC\Application\Repository;

use SRC\Domain\User\Interfaces\CreateRepository;
use SRC\Domain\User\Interfaces\FindRepository;
use SRC\Domain\User\Interfaces\UpdateRepository;

interface User extends CreateRepository, UpdateRepository, FindRepository
{}