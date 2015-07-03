<?php

namespace App\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class TaskController
{
    private $task_added = false;
    private $task_group_id = 1;
    private $messages = array();
    public function indexAction(Request $request, Application $app)
    {
        if ($request->isMethod('POST')) {
            $this->task_group_id = $request->get('group_id');
            $entity = $app['repository.tasks']->buildTaskEntity($request->request->all());
            $app['repository.tasks']->save($entity);
            $this->task_added = true;
            $this->messages[] = 'Task is added to the list successfully.';
        }
        //usecase
        $tasks = $app['repository.tasks']->findAll();
        $groups = $app['repository.groups']->findAll();
        return $app['twig']->render('home.html', array(
            'message' => $this->messages,
            'taskAdded' => $this->task_added,
            'tasks' => $tasks,
            'groups' => $groups,
            'active_group_id' => $this->task_group_id,
        ));
    }

    public function updateAction(Request $request, Application $app)
    {
        $entity = $app['repository.tasks']->find($request->get('id'));
        $entity->getStatus() == 0 ? $entity->setStatus('1') : $entity->setStatus('0');
        $app['repository.tasks']->save($entity);
        $this->messages[] = 'Task marked as done.';
        $this->task_group_id = $entity->getGroupId();
        return "ok";
    }

    public function deleteAction(Request $request, Application $app)
    {
        $entity = $app['repository.tasks']->find($request->get('id'));
        $app['repository.tasks']->delete($entity);
        return "ok";
    }
}
