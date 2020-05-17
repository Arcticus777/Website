<?php

declare(strict_types=1);

namespace Minecord\Model\Product;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Minecord\Model\Image\Image;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="product")
 */
class Product
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="uuid_binary", unique=true)
	 */
	private UuidInterface $id;

	/** @ORM\Column(type="string") */
	private string $nameEnglish;

	/** @ORM\Column(type="string") */
	private string $nameCzech;

	/** @ORM\Column(type="text") */
	private string $descriptionEnglish;

	/** @ORM\Column(type="text") */
	private string $descriptionCzech;

	/** @ORM\Column(type="float") */
	private float $price = 0;

	/** @ORM\Column(type="float") */
	private float $priceCzechSms = 0;

	/** @ORM\Column(type="float") */
	private float $priceSlovakSms = 0;

	/** @ORM\Column(type="float") */
	private float $discountedPrice = 0;

	/** @ORM\Column(type="float") */
	private float $discountedPriceCzechSms = 0;

	/** @ORM\Column(type="float") */
	private float $discountedPriceSlovakSms = 0;

	/** @ORM\Column(type="datetime") */
	private ?DateTime $discountActiveTo;

	/** @ORM\Column(type="integer") */
	private int $discountPercent = 0;

	/** @ORM\Column(type="boolean") */
	private bool $isRank = false;

	/** @ORM\ManyToOne(targetEntity="\Minecord\Model\Image\Image") */
	private ?Image $thumbnail = null;

	public function __construct(UuidInterface $id, ProductData $data)
	{
		$this->id = $id;
		$this->edit($data);
	}

	public function edit(ProductData $data): void
	{
		$this->nameEnglish = $data->nameEnglish;
		$this->nameCzech = $data->nameCzech;
		$this->descriptionEnglish = $data->descriptionEnglish;
		$this->descriptionCzech = $data->descriptionCzech;
		$this->price = $data->price;
		$this->priceCzechSms = $data->priceCzechSms;
		$this->priceSlovakSms = $data->priceSlovakSms;
		$this->discountedPrice = $data->discountedPrice;
		$this->discountedPriceCzechSms = $data->discountedPriceCzechSms;
		$this->discountedPriceSlovakSms = $data->discountedPriceSlovakSms;
		$this->discountActiveTo = $data->discountActiveTo;
		$this->discountPercent = $data->discountPercent;
		$this->isRank = $data->isRank;
	}

	public function getData(): ProductData
	{
		$data = new ProductData();
		$data->nameEnglish = $this->nameEnglish;
		$data->nameCzech = $this->nameCzech;
		$data->descriptionEnglish = $this->descriptionEnglish;
		$data->descriptionCzech = $this->descriptionCzech;
		$data->price = $this->price;
		$data->priceCzechSms = $this->priceCzechSms;
		$data->priceSlovakSms = $this->priceSlovakSms;
		$data->discountedPrice = $this->discountedPrice;
		$data->discountedPriceCzechSms = $this->discountedPriceCzechSms;
		$data->discountedPriceSlovakSms = $this->discountedPriceSlovakSms;
		$data->discountActiveTo = $this->discountActiveTo;
		$data->discountPercent = $this->discountPercent;
		$data->isRank = $this->isRank;

		return $data;
	}

	public function getId(): UuidInterface
	{
		return $this->id;
	}

	public function getNameEnglish(): string
	{
		return $this->nameEnglish;
	}

	public function getNameCzech(): string
	{
		return $this->nameCzech;
	}

	public function getDescriptionEnglish(): string
	{
		return $this->descriptionEnglish;
	}

	public function getDescriptionCzech(): string
	{
		return $this->descriptionCzech;
	}

	public function getPrice(): float
	{
		return $this->price;
	}

	public function getPriceCzechSms(): float
	{
		return $this->priceCzechSms;
	}

	public function getPriceSlovakSms(): float
	{
		return $this->priceSlovakSms;
	}

	public function getDiscountedPrice(): float
	{
		return $this->discountedPrice;
	}

	public function getDiscountedPriceCzechSms(): float
	{
		return $this->discountedPriceCzechSms;
	}

	public function getDiscountedPriceSlovakSms(): float
	{
		return $this->discountedPriceSlovakSms;
	}

	public function getDiscountActiveTo(): ?DateTime
	{
		return $this->discountActiveTo;
	}

	public function getDiscountPercent(): int
	{
		return $this->discountPercent;
	}

	public function isIsRank(): bool
	{
		return $this->isRank;
	}

	public function changeThumbnail(?Image $thumbnail): void
	{
		$this->thumbnail = $thumbnail;
	}

	public function getThumbnail(): ?Image
	{
		return $this->thumbnail;
	}
}
