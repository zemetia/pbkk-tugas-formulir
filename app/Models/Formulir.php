<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulir
{
    private FormulirId $id;
    private string $name;
    private int $age;
    private float $height;
    private ImageUpload $photo_url;

    public function __construct(FormulirId $id, string $name, int $age, float $height, ImageUpload $photo_url)
    {
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
        $this->height = $height;
        $this->photo_url = $photo_url;
    }

    public static function create(string $name, int $age, string $height, ImageUpload $photo_url)
    {
        return new Formulir(
            FormulirId::generate(),
            $name,
            $age,
            $height,
            $photo_url
        );
    }

    public function getId(): FormulirId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function getPhotoUrl(): ImageUpload
    {
        return $this->photo_url;
    }
}
