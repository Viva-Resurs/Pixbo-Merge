<?php
/**
 * Created by PhpStorm.
 * User: xergo
 * Date: 20-Apr-16
 * Time: 4:37 PM
 */
namespace App\Api\V1\Transformers\Screen;

use App\Models\Screen;
use League\Fractal\TransformerAbstract;

class ScreenTransformer extends TransformerAbstract
{
    public function transform(Screen $screen)
    {
        return [
            'id'           => (int) $screen->id,
            'type'         => 'screen',
            'categories'   => $screen->categories,
            'event'        => $screen->event->first(),
            'photo'        => $screen->photo,
            'screengroups' => $screen->screengroups,
            'active'       => $screen->getActiveEvents()
        ];
    }
}
