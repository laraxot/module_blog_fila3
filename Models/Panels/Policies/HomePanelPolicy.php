<?php
namespace Modules\Blog\Models\Panels\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\User\Models\User as User;
use Modules\Blog\Models\Panels\Policies\HomePanelPolicy as Post; 

use Modules\Cms\Models\Panels\Policies\XotBasePanelPermissionPolicy;

class HomePanelPolicy extends XotBasePanelPermissionPolicy {
}
