<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ActiveRepository;
use App\Entities\Active;
use App\Validators\ActiveValidator;

/**
 * Class ActiveRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ActiveRepositoryEloquent extends BaseRepository implements ActiveRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Active::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
