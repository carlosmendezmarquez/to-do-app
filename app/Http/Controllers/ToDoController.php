<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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

    /**
     * Receives the date range and convert it into valid format to calculate the amount of To Do's
     * created and completed
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAnalytics(Request $request){

        $startDate = $request->get('start_date') ? Carbon::parse($request->get('start_date')): Carbon::now()->subDays(7);
        $endDate = $request->get('end_date') ? Carbon::parse($request->get('end_date')) : Carbon::now();

        $createdItems = $this->getCountColumnByDateRange('created_at',$startDate,$endDate);
        $completedItems = $this->getCountColumnByDateRange('completed_at',$startDate,$endDate);

        return response()->json([
            'created' => $createdItems,
            'completed'=> $completedItems,
            'start_date' =>date_format($startDate,"Y-m-d"),
            'end_date' =>date_format($endDate,"Y-m-d"),]);
    }

    /**
     *  Query the database according to the column and the date range
     *
     * @param string $column
     * @param Carbon $start_date
     * @param Carbon $end_date
     * @return int
     */
    private function getCountColumnByDateRange(string $column, Carbon $start_date, Carbon $end_date){
        return DB::table('to_dos')
            ->whereDate($column,'>=',$start_date)
            ->whereDate($column,'<=',$end_date)
            ->count();
    }
}
