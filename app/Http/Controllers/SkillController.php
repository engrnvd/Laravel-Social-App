<?php

namespace App\Http\Controllers;

use App\Repositories\SkillRepository;
use App\Skill;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SkillController extends Controller
{
    protected $skills;
    public function __construct(SkillRepository $skills)
    {
        $this->middleware('jwt.auth');
        $this->skills = $skills;
    }

    public function forUser( Request $request, User $user )
    {
        return $this->skills->forUser($user);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->skills->forUser($request->user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo __FUNCTION__;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->skills()->create([
            'name' => $request->name,
        ]);

        return $this->skills->forUser($request->user());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo __FUNCTION__;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo __FUNCTION__;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skill $skill)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        $this->authorize('owns', $skill);
        $skill->name = $request->name;
        $skill->save();
        return $this->skills->forUser($request->user());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Skill $skill)
    {
        $this->authorize('owns', $skill);
        $skill->delete();
        return $this->skills->forUser($request->user());
    }
}
