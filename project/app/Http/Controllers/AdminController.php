<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function users() 
    {
        return view('user.admin.dashboard.users', ['users' => User::all()]);
    }

    public function instructorList()
    {
        return view('user.admin.dashboard.instructor.list', ['users' => User::all()]);
    }

    public function instructorAdd()
    {
        return view('user.admin.dashboard.instructor.edit', ['users' => User::all()]);
    }

    public function instructorSave(Request $request)
    {
        $input = $request->only('firstname', 'lastname', 'email');
        $password = Hash::make(Str::random(10));
        $data = array_merge($input, ['password' => $password, 'type' => User::TYPE_TEACHER]);
        $user = User::create($data);
        
        return redirect()->intended('/admin/instructor/list');
    }

    public function subjectList($query = null)
    {
        $table = $this->subjectSearch($query);
        if (! is_null($query)) {
            return $table;
        }
        
        return view('user.admin.dashboard.subject.list', ['subjects' => $table, 'is_main' => true]);
    }

    public function subjectSave(Request $request)
    {
        $input = $request->only('name', 'code', 'status');
        $type = $request->get('type');
        $hasError = false;
        foreach ($input as $key => $value) {
            if (empty(trim($value))) {
                $hasError = true;
                break;
            }
        }

        if ($hasError) {
            return redirect()->intended('/admin/subject/list');
        }
        
        if ($type === 'edit') {
            $subject = new Subject();
            $subject->load($request->get('id'));
            $subject->save($input);
        } else {
            Subject::create($input);
        }

        return redirect()->intended('/admin/subject/list');
    }

    public function subjectSearch($query = null)
    {
        $data = [];
        if ($query != null) {
            $data = DB::table(Subject::TABLE_NAME)->where(
                'name', 'like', "%$query%"
            )->orWhere('code', 'like', "%$query%");
        }

        if ($query === null && sizeof($data) === 0) {
            $data = DB::table(Subject::TABLE_NAME);
        }

        $page = $data->paginate(10);
        return response()->view($this->getView('subject.items'), ['subjects' => $page, 'is_empty' => false]);
    }

    public function subjectDelete(Request $request)
    {
        if (! $request->ajax()) {
            return abort(404);
        }
        
        $subject = Subject::find($request->get('id'));
        $subject->delete();
        return $subject->name;
    }

    private function getView($path)
    {
        return "user.admin.dashboard." . $path;
    }

    public function massDeleteSubject(Request $request)
    {
        if (! $request->ajax()) {
            return abort(404);
        }

        Subject::destroy($request->get('ids'));
    }
}
