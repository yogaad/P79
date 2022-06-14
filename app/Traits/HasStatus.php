<?php

namespace App\Traits;

use App\Exceptions\InvalidEntityException;

trait HasStatus
{
    /**
     * Check status
     */
    public function isStatus(string $status, $throwErr = true)
    {
        if ($this->status != $status) {
            if ($throwErr) {
                throw new InvalidEntityException('Status seharusnya ' . $this->getStatusMeta('label'));
            }

            return false;
        }

        return true;
    }

    /**
     * Check status if matched array of statuses
     */
    public function isStatusAny(array $states, $throwErr = true)
    {
        if (!in_array($this->status, $states)) {
            if ($throwErr) {
                throw new InvalidEntityException('Status tidak valid');
            }

            return false;
        }

        return true;
    }
    
    /**
     * Get status meta 
     */
    public function getStatusMeta(string $meta)
    {
        return ($this->status) ? $this->states[$this->status][$meta] : null;
    }

    /**
     * Get status label attribute
     */
    public function getStatusLabelAttribute()
    {
        return $this->getStatusMeta('label');
    }

    /**
     * Get status class attribute
     */
    public function getStatusClassAttribute()
    {
        return $this->getStatusMeta('class');
    }
}