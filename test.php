<?php

use Baukevdw\Crud\Overview;
use Neat\Database\Connection;
use Neat\Object\Manager;
use Neat\Object\Relations;
use Neat\Object\Storage;

require_once 'vendor/autoload.php';

$pdo        = new PDO('sqlite:/home/bvanderwoude/development/baukevdw/crud/database.sqlite');
$connection = new Connection($pdo);
Manager::create($connection);

class User
{
    use Storage;
    use Relations;

    /** @var int */
    public $id;

    /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var int */
    public $addressId;

    /**
     * @return Relations\One
     */
    public function address(): Relations\One
    {
        return $this->belongsToOne(Address::class);
    }
}

class Address
{
    use Storage;

    /** @var int */
    public $id;

    /** @var string */
    public $street;

    /** @var string */
    public $houseNumber;

    /** @var string */
    public $zipCode;

    /** @var string */
    public $city;

    /** @var string */
    public $country;
}

class AddressColumn extends Overview\Column
{
    /**
     * @return string
     */
    public function getValue(): string
    {
        if (!$this->value) {
            return '';
        }
        /** @var Address $value */
        $value = $this->value;

        return <<<HTML
{$value->street} {$value->houseNumber}<br>
{$value->zipCode} {$value->city}<br>
{$value->country}
HTML;
    }
}

$overview = new Overview(User::repository(), User::select());
$overview->row(function (User $user) {
    $row = new \Baukevdw\Crud\Overview\Row();
    $row->column('Naam', 'name', $user->name);
    $row->column('E-mail', 'email', $user->email);
    $row->addColumn(new AddressColumn('Adres', 'address', $user->address()->get()));

    return $row;
});

return $overview->render();
