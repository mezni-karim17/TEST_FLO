<?php

namespace App\Entity;

use App\Repository\SourceRepository;
use App\State\SourceProcessor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Post;

#[ORM\Entity(repositoryClass: SourceRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'source:item']),
        new GetCollection(normalizationContext: ['groups' => 'source:list'])
    ],
)]


#[Post(processor: SourceProcessor::class, denormalizationContext: ['groups' => 'source:post'])]
class Source
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['source:list', 'source:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['source:list', 'source:item', 'source:post'])]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Article::class, mappedBy: 'source')]
    private Collection $articles;

    #[ORM\Column(length: 255)]
    #[Groups(['source:list', 'source:item', 'source:post'])]
    private ?string $src = null;

    #[ORM\Column(length: 255)]
    #[Groups(['source:list', 'source:item', 'source:post'])]
    private ?string $type = null;

    const RSS = 'RSS';
    const FS = 'FILESYSTEM';
    const DB = 'DATABASE';
    const API = 'API';

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setSource($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getSource() === $this) {
                $article->setSource(null);
            }
        }

        return $this;
    }

    public function getSrc(): ?string
    {
        return $this->src;
    }

    public function setSrc(string $src): static
    {
        $this->src = $src;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }
}
