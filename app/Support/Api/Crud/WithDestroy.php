<?php

namespace App\Support\Api\Crud;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

trait WithDestroy
{
    public function destroy($id)
    {
        $model = $this->model::findOrFail($id);

        $this->apiCode(200)->apiMessage(t_('The record has been deleted successfully.'));
        $action = $this->destroyAction($model);

        return $action ?? $this->successfulRequest(asJson: true);
    }
    protected function destroyAction(Model $model)
    {
        $model->delete();

        return null;
    }

    protected function profileResponse(User $user): array
    {
        return ['profile' => $user->only('username', 'bio', 'image')
            + ['following' => $this->user->doesUserFollowAnotherUser(auth()->id(), $user->id)],
        ];
    }
}
