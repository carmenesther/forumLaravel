<?php

namespace App\Filters;

use App\User;

class ThreadFilter extends Filters {

    protected $filters = ['by', 'popular', 'unanswered'];
    /**
     * Filter the query by a given username
     * @param $username
     * @return mixed
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }
    /**
     * Filter the query according to most popular
     * @return $this
     */
    protected function popular()
    {
        return $this->builder->orderBy('replies_count', 'desc');
    }

    public function unanswered()
    {
        return $this->builder->where('replies_count', 0);
    }
}
