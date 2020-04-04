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


    /**
     * Get list active for the rooms the user participates
     * 
     * $return array
     */
    public function getActivesOfUser($idUser)
    {
        $actives = [];
        $rooms = $this->findByField('id_user', $idUser); // List room of user
        foreach ($rooms as $room) {
            $id_room = $room['id_room'];
            $active = $this->findByField('id_room', $id_room)->toArray();
            array_push($actives, [
                'id_room'   => $id_room,
                'actives'   => $active
            ]);
        }
        return $actives;
    }
    
}
