<?php


namespace App\Filters;


use Illuminate\Http\Request;

abstract class Filters
{
    protected $request, $builder;
    protected $filters = [];
    /**
     * ThreadFilter constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply our filters to the builder
     * @param $builder
     * @return mixed
     */
    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) { // ['by' => 'JohnDoe']
            if(method_exists($this, $filter)){
                $this->$filter($value);
            }
        }
        return $this->builder;
    }

    public function getFilters()
    {
        return array_filter($this->request->only($this->filters));
    }

}
