<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * this method runs before all other
     * @param  User   $user    
     * @param   $ability 
     * @return bool          
     */
    public function before(User $user, $ability)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    /**
     * this method checks if the user is authorized to create user
     * @param  User   $user 
     * @return bool       
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * checks to view users
     * @param  User   $user 
     * @return bool       
     */
    public function view(User $user)
    {
        return false;
    }

    /**
     * check to show individual user
     * @param  User   $user       
     * @param  User   $policyUser 
     * @return bool             
     */
    public function show(User $user, User $policyUser)
    {
        return $user->id == $policyUser->id ? true : false;
    }

    /**
     * checks to view edit form
     * @param  User   $user      
     * @param  User   $policyUser 
     * @return bool             
     */
    public function edit(User $user, User $policyUser)
    {
        return $user->id == $policyUser->id ? true : false;
    }

    /**
     * checks to update useer
     * @param  User   $user       
     * @param  User   $policyUser 
     * @return bool             
     */
    public function update(User $user, User $policyUser)
    {
        return $user->id == $policyUser->id ? true : false ;
    }
}
