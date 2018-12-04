<?php

namespace Baukevdw\Crud;

use Neat\Http\Request;

abstract class Controller
{
    abstract protected function overview(): Overview;

    abstract protected function form(): Form;

    public function getOverview(Request $request)
    {

    }

    public function getEdit(Request $request)
    {

    }

    public function postStore(Request $request)
    {

    }
}
