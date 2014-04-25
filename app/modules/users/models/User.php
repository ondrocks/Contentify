<?php namespace App\Modules\Users\Models;

use User as BaseUser;
use Sentry, Ardent;

class User extends BaseUser {

    protected $fillable = ['activated', 'relation_groups', 'relation_teams'];

    protected $slugable = true;

    public static $relationsData = [
        'groups'    => [Ardent::BELONGS_TO_MANY, 'Group', 'table' => 'users_groups'],
        'teams'     => [Ardent::BELONGS_TO_MANY, 'App\Modules\Teams\Models\Team', 'table' => 'team_user'],
    ];

    /**
     * Getter for $relationsData.
     * NOTE: This model does not inherit from Ardent.
     * The relations method is used to copy some of the Ardent behaviour.
     * 
     * @return array
     */
    public static function relations()
    {
        return static::$relationsData;
    }

    /**
     * This is a copy of an Ardent method.
     * 
     * @return bool
     */
    public function modifiable()
    {
        return true;
    }

}