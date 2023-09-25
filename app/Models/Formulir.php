<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulir
{
    private FormulirId $id;
    private string $name;
    private string $email;
    private int $age;
    private float $height;
    private ImageUpload $photo_url;

    public function __construct(FormulirId $id, string $name, string $email, int $age, float $height, ImageUpload $photo_url)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
        $this->height = $height;
        $this->photo_url = $photo_url;
    }

    public static function create(string $name, string $email, int $age, string $height, ImageUpload $photo_url)
    {
        return new Formulir(
            FormulirId::generate(),
            $name,
            $email,
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

    public function getEmail(): string
    {
        return $this->email;
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
