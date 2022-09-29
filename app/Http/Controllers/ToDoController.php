<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ToDoController extends Controller
{
    /**
     * Display a listing of the To Do items ordered by created time.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ToDo::orderBy('created_at', 'desc')->get();
    }

    /**
     * Store a newly created To Do in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ToDo
     */
    public function store(Request $request)
    {
        $newToDo = new ToDo();
        $newToDo->name = $request->toDo["name"];
        $newToDo->save();

        return $newToDo;
    }

    /**
     * Update the status of specified To-Do in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return ToDo|string
     */
    public function update(Request $request, $id)
    {
        /** @var ToDo $toDo */
        $toDo = ToDo::find($id);
        if($toDo){
            $toDo->status = $request->toDo["completed"] ? 'completed' : 'pending';
            $toDo->completed_at = $toDo->status == 'completed' ? Carbon::now() : null;
            $toDo->save();
            return $toDo;
        }

        return "To Do not found";
    }

    /**
     * Remove the specified To-Do from the database.
     *
     * @param  int  $id
     * @return string
     */
    public function destroy($id)
    {
        /** @var ToDo $toDo */
        $toDo = ToDo::find($id);
        if($toDo){
            $toDo->delete();
            return "Deleted successfully";
        }

        return "To Do not found";
    }
}
