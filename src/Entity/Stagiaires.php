<?php

namespace App\Entity;

use App\Repository\StagiairesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StagiairesRepository::class)]
class Stagiaires extends User
{

}
