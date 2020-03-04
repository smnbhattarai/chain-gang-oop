<?php

class Bicycle extends DatabaseObject
{

    static protected $table_name = 'bicycles';

    static protected $db_columns = ['id', 'brand', 'model', 'year', 'category', 'color', 'gender', 'price', 'weight_kg', 'condition_id', 'description'];

    public $id;
    public $brand;
    public $model;
    public $year;
    public $category;
    public $color;
    public $description;
    public $gender;
    public $price;
    public $weight_kg;
    public $condition_id;

    public const CATEGORIES = ['Road', 'Mountain', 'Hybrid', 'Cruiser', 'City', 'BMX'];

    public const GENDERS = ['Mens', 'Womens', 'Unisex'];

    public const CONDITION_OPTIONS = [
        1 => 'Beat up',
        2 => 'Decent',
        3 => 'Good',
        4 => 'Great',
        5 => 'Like New'
    ];

    public function __construct($args = [])
    {
        $this->brand        = $args['brand'] ?? '';
        $this->model        = $args['model'] ?? '';
        $this->year         = $args['year'] ?? '';
        $this->category     = $args['category'] ?? '';
        $this->color        = $args['color'] ?? '';
        $this->description  = $args['description'] ?? '';
        $this->gender       = $args['gender'] ?? '';
        $this->price        = $args['price'] ?? 0;
        $this->weight_kg    = $args['weight_kg'] ?? 0.0;
        $this->condition_id = $args['condition_id'] ?? 3;
    }

    /**
     * @return string
     */
    public function name()
    {
        return "{$this->brand} {$this->model} {$this->year}";
    }

    /**
     * @return string
     */
    public function weight_kg()
    {
        return number_format($this->weight_kg, 2) . ' kg';
    }

    /**
     * @param $value
     */
    public function set_weight_kg($value)
    {
        $this->weight_kg = floatval($value);
    }

    /**
     * @return string
     */
    public function weight_lbs()
    {
        $weight_lbs = floatval($this->weight_kg) * 2.2046226218;
        return number_format($weight_lbs, 2) . ' lbs';
    }

    /**
     * @param $value
     */
    public function set_weight_lbs($value)
    {
        $this->weight_kg = floatval($value) / 2.2046226218;
    }

    /**
     * @return mixed|string
     */
    public function condition()
    {
        if ($this->condition_id > 0) {
            return self::CONDITION_OPTIONS[$this->condition_id];
        } else {
            return "Unknown";
        }
    }

    /**
     * @return array
     */
    public function validate()
    {
        $this->errors = [];

        if(is_blank($this->brand)) {
            $this->errors[] = "Brand cannot be blank.";
        }
        if(is_blank($this->model)) {
            $this->errors[] = "Model cannot be blank.";
        }

        return $this->errors;
    }

}
