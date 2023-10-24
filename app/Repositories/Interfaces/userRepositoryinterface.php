<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryinterface
{
    public function all();
    public function store(UserRequest $request);
    public function edit(UserRequest $request, $id);
    public function delete($id);

}
?>