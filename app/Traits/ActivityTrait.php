<?php
namespace App\Traits;

trait ActivityTrait
{   
    /**
     * creates log on activity log table
     * @param  array $inputs 
     * @return mixed         
     */
    public function log($inputs)
    {
        $this->logs()->create($this->getInputs($inputs));
    }

    /**
     * this method bulids the log while updating based on old and new data
     * @return mixed 
     */
    public function buildLog()
    {
        $before = array_intersect_key($this->getOriginal(), $this->getDirty());
        $after  = $this->getDirty();

        foreach ($before as $key => $value) {
            if ($value == '0000-00-00') {
                unset($after[$key]);
                unset($before[$key]);
            }

            foreach ($after as $i => $v) {
                if ($value == null && $v == null) {
                    unset($after[$i]);
                }
                unset($after['slug']);
            }
        }

        foreach ($after as $field => $value) {

            $this->log(
                [
                    'activity' => 'updated',
                    'field'    => $field,
                    'before'   => $this->getOriginal($field),
                    'after'    => $value,
                ]
            );
        }
    }

    /**
     * gets user id
     * @param  int $userId 
     * @return mixed         
     */
    public function getUserId($userId = null)
    {
        return $userId ?: authUser()->id;
    }

    /**
     * gets client ip
     * @return mixed 
     */
    public function getClientIp()
    {
        return request()->getClientIp();
    }

    /**
     * gets input for activity log table
     * @param   $inputs 
     * @return mixed         
     */
    public function getInputs($inputs)
    {
        $inputs['user_id']    = $this->getUserId();
        $inputs['ip_address'] = $this->getClientIp();
        $inputs['object']     = $this->getTitle();

        return $inputs;
    }

    public function logs()
    {
        return $this->morphMany('App\Models\Activity', 'loggable');
    }
}
